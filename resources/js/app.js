// Pertahankan bootstrap.js bawaan proyek (Axios / konfigurasi yang sudah ada).
import "./bootstrap";
import { initLandingPage } from "./pages/landing";

function initNavigation() {
  // Menu mobile: tetap menyediakan navigasi apabila JavaScript dimatikan.
  const toggle = document.getElementById("menu-toggle");
  const menu = document.getElementById("mobile-menu");
  if (!toggle || !menu || toggle.dataset.initialized) return;
  toggle.dataset.initialized = "true";
  const setMenu = (open) => {
    menu.hidden = !open;
    toggle.setAttribute("aria-expanded", String(open));
    toggle.setAttribute(
      "aria-label",
      open ? "Tutup menu navigasi" : "Buka menu navigasi",
    );
  };
  toggle.hidden = false;
  setMenu(false);
  toggle.addEventListener("click", () => setMenu(menu.hidden));
  menu
    .querySelectorAll("a")
    .forEach((link) => link.addEventListener("click", () => setMenu(false)));
  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && !menu.hidden) {
      setMenu(false);
      toggle.focus();
    }
  });
  document.addEventListener("click", (event) => {
    if (
      !menu.hidden &&
      !menu.contains(event.target) &&
      !toggle.contains(event.target)
    )
      setMenu(false);
  });
  window
    .matchMedia("(min-width: 1024px)")
    .addEventListener("change", (event) => {
      if (event.matches) setMenu(false);
    });
}

function initPolicies() {
  // Dialog native mendukung fokus keyboard, Escape, dan pengembalian fokus.
  const dialog = document.getElementById("policy-dialog");
  if (!dialog || dialog.dataset.initialized) return;
  dialog.dataset.initialized = "true";
  if (typeof dialog.showModal === "function") {
    document.getElementById("policy-fallback").hidden = true;
    document.querySelectorAll("[data-policy]").forEach((link) => {
      link.addEventListener("click", (event) => {
        event.preventDefault();
        const article = document.getElementById(link.dataset.policy);
        document.getElementById("policy-title").textContent =
          article.querySelector("h2").textContent;
        document.getElementById("policy-content").textContent =
          article.querySelector("p").textContent;
        dialog.showModal();
      });
    });
    document
      .getElementById("close-policy")
      .addEventListener("click", () => dialog.close());
    dialog.addEventListener("click", (event) => {
      if (event.target === dialog) {
        const rect = dialog.getBoundingClientRect();
        if (
          event.clientX < rect.left ||
          event.clientX > rect.right ||
          event.clientY < rect.top ||
          event.clientY > rect.bottom
        )
          dialog.close();
      }
    });
  }
}

function bootFotoKita() {
  initNavigation();
  initPolicies();
  // Aman pada booking/contact/gallery/location: tidak mencari form yang tidak ada.
  if (document.body.dataset.page === "landing") initLandingPage();
}

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", bootFotoKita, { once: true });
} else {
  bootFotoKita();
}
