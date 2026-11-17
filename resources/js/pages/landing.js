// Tetap menggunakan export yang diimport app.js dari paket sebelumnya.
export function initLandingPage() {
  const section = document.querySelector("[data-review-section]");
  if (!section || section.dataset.initialized) return;
  const form = document.getElementById("review-form");
  const track = document.getElementById("review-track");
  const template = document.getElementById("review-card-template");
  if (!form || !track || !template) return;
  section.dataset.initialized = "true";

  const q = (selector) => section.querySelector(selector);
  const feedback = q("#review-feedback");
  const listStatus = q("#review-list-status");
  const empty = q("#review-empty");
  const navigation = q("#review-navigation");
  const prev = q("#review-prev");
  const next = q("#review-next");
  const position = q("#review-slide-position");
  const loadMore = q("#review-load-more");
  const filters = [...section.querySelectorAll("[data-review-filter]")];
  const submit = q("#review-submit");
  const submitLabel = q("[data-submit-label]");
  const nameInput = q("#review-name");
  const bodyInput = q("#review-body");
  const photoInput = q("#review-photo");
  const preview = q("#review-photo-preview");
  const previewImage = q("#review-preview-image");
  const number = new Intl.NumberFormat("id-ID");
  const motion = () =>
    matchMedia("(prefers-reduced-motion: reduce)").matches ? "auto" : "smooth";
  let currentPage = Number(section.dataset.page) || 1;
  let hasMore = section.dataset.hasMore === "true";
  let currentFilter = "all";
  let feedController = null;
  let feedSequence = 0;
  let submitting = false;
  let photoUrl = null;

  function showFeedback(message, state = "success") {
    feedback.textContent = message;
    feedback.dataset.state = state;
    feedback.hidden = false;
    feedback.focus({ preventScroll: true });
  }

  function fieldError(name, message) {
    const box = section.querySelector(`[data-review-error="${name}"]`);
    if (box) {
      box.textContent = message;
      box.hidden = !message;
    }
    form.querySelectorAll(`[name="${name}"]`).forEach((input) => {
      if (message) input.setAttribute("aria-invalid", "true");
      else input.removeAttribute("aria-invalid");
    });
  }

  function updateSummary(summary) {
    for (const key of ["total", "positive", "negative"])
      q(`[data-count="${key}"]`).textContent = number.format(summary[key]);
    q("#review-positive-meter").value = summary.positive_percentage;
    q("#review-ratio-text").textContent = summary.total
      ? `${summary.positive_percentage}% ulasan positif`
      : "Belum ada penilaian";
  }

  function enhanceCard(card) {
    if (card.dataset.enhanced) return;
    card.dataset.enhanced = "true";
    const paragraph = card.querySelector("[data-review-body]");
    const button = card.querySelector("[data-review-expand]");
    const full = paragraph.textContent.trim();
    const letters = Array.from(full);
    if (letters.length <= 210) return;
    paragraph.textContent = letters.slice(0, 210).join("") + "…";
    paragraph.id = `review-body-${card.dataset.reviewId}`;
    button.setAttribute("aria-controls", paragraph.id);
    button.hidden = false;
    button.addEventListener("click", () => {
      const open = button.getAttribute("aria-expanded") !== "true";
      button.setAttribute("aria-expanded", String(open));
      paragraph.textContent = open
        ? full
        : letters.slice(0, 210).join("") + "…";
      button.textContent = open ? "Tutup ulasan" : "Baca selengkapnya";
    });
  }

  function createCard(review) {
    const card = template.content.firstElementChild.cloneNode(true);
    card.dataset.reviewId = String(review.id);
    card.querySelector("[data-review-name]").textContent = review.name;
    card.querySelector("[data-review-initial]").textContent = review.initial;
    card.querySelector("[data-review-body]").textContent = review.body;
    const date = card.querySelector("[data-review-date]");
    date.textContent = review.date_label;
    date.dateTime = review.created_at;
    const badge = card.querySelector("[data-review-badge]");
    badge.textContent = review.sentiment_label;
    badge.dataset.sentiment = review.sentiment;
    if (review.photo_url) {
      const link = card.querySelector("[data-review-photo-link]");
      const image = card.querySelector("[data-review-photo]");
      link.href = review.photo_url;
      link.setAttribute("aria-label", `Lihat foto ulasan dari ${review.name}`);
      image.src = review.photo_url;
      image.alt = `Foto yang dilampirkan ${review.name} pada ulasannya`;
      link.hidden = false;
    }
    enhanceCard(card);
    return card;
  }

  function activeIndex() {
    const cards = [...track.children];
    if (!cards.length) return 0;
    const left = track.getBoundingClientRect().left;
    return cards.reduce(
      (best, card, index) =>
        Math.abs(card.getBoundingClientRect().left - left) <
        Math.abs(cards[best].getBoundingClientRect().left - left)
          ? index
          : best,
      0,
    );
  }

  function syncSlider() {
    const count = track.children.length;
    const index = activeIndex();
    navigation.hidden = count === 0;
    position.textContent = count ? `${index + 1} / ${count} ulasan dimuat` : "";
    prev.disabled = !count || index === 0;
    next.disabled = !count || index >= count - 1;
    [...track.children].forEach((card, i) =>
      card.setAttribute("aria-label", `Ulasan ${i + 1} dari ${count}`),
    );
  }

  function slide(direction) {
    const index = Math.max(
      0,
      Math.min(track.children.length - 1, activeIndex() + direction),
    );
    const card = track.children[index];
    if (!card) return;
    track.scrollTo({
      left:
        track.scrollLeft +
        card.getBoundingClientRect().left -
        track.getBoundingClientRect().left -
        2,
      behavior: motion(),
    });
  }

  function renderFeed(payload, filter, append = false) {
    if (!append) track.replaceChildren();
    const existing = new Set(
      [...track.children].map((card) => card.dataset.reviewId),
    );
    for (const review of payload.data)
      if (!existing.has(String(review.id))) track.append(createCard(review));
    currentPage = payload.meta.current_page;
    hasMore = payload.meta.has_more;
    currentFilter = filter;
    filters.forEach((button) =>
      button.setAttribute(
        "aria-pressed",
        String(button.dataset.reviewFilter === filter),
      ),
    );
    updateSummary(payload.summary);
    empty.hidden = track.children.length > 0;
    q("#review-empty-title").textContent =
      filter === "all"
        ? "Cerita pertamamu berarti."
        : `Belum ada ulasan ${filter === "positive" ? "positif" : "negatif"}.`;
    q("#review-empty-description").textContent =
      filter === "all"
        ? "Belum ada ulasan. Jadilah yang pertama berbagi pengalaman bersama FotoKita."
        : "Coba lihat kategori lainnya atau bagikan pengalamanmu.";
    loadMore.hidden = !hasMore;
    if (!append) track.scrollTo({ left: 0, behavior: "instant" });
    requestAnimationFrame(syncSlider);
  }

  async function loadFeed(filter = currentFilter, append = false) {
    feedController?.abort();
    const controller = new AbortController();
    feedController = controller;
    const requestId = ++feedSequence;
    track.setAttribute("aria-busy", "true");
    loadMore.disabled = true;
    listStatus.textContent = "Memuat ulasan…";
    const url = new URL(section.dataset.feedUrl, location.href);
    url.searchParams.set("sentiment", filter);
    url.searchParams.set("page", String(append ? currentPage + 1 : 1));
    try {
      const response = await fetch(url, {
        headers: { Accept: "application/json" },
        credentials: "same-origin",
        signal: controller.signal,
      });
      if (!response.ok) throw new Error("feed");
      const payload = await response.json();
      if (requestId !== feedSequence) return;
      renderFeed(payload, filter, append);
      listStatus.textContent = `${number.format(payload.meta.total)} ulasan ${filter === "all" ? "tersedia" : filter === "positive" ? "positif" : "negatif"}.`;
    } catch (error) {
      if (error.name !== "AbortError")
        listStatus.textContent =
          "Ulasan belum dapat dimuat. Coba pilih filter atau muat lagi.";
    } finally {
      if (requestId === feedSequence) {
        track.removeAttribute("aria-busy");
        loadMore.disabled = false;
      }
    }
  }

  q(".review-filters").hidden = false;
  filters.forEach((button) =>
    button.addEventListener("click", () =>
      loadFeed(button.dataset.reviewFilter),
    ),
  );
  loadMore.hidden = !hasMore;
  loadMore.addEventListener("click", () => loadFeed(currentFilter, true));
  prev.addEventListener("click", () => slide(-1));
  next.addEventListener("click", () => slide(1));
  track.addEventListener("scroll", syncSlider, { passive: true });
  track.addEventListener("keydown", (event) => {
    if (
      event.target === track &&
      ["ArrowLeft", "ArrowRight"].includes(event.key)
    ) {
      event.preventDefault();
      slide(event.key === "ArrowLeft" ? -1 : 1);
    }
  });
  new ResizeObserver(syncSlider).observe(track);
  [...track.children].forEach(enhanceCard);
  syncSlider();

  function clearPhoto() {
    if (photoUrl) URL.revokeObjectURL(photoUrl);
    photoUrl = null;
    photoInput.value = "";
    photoInput.setCustomValidity("");
    preview.hidden = true;
    previewImage.removeAttribute("src");
    fieldError("photo", "");
  }

  photoInput.addEventListener("change", () => {
    if (photoUrl) URL.revokeObjectURL(photoUrl);
    photoUrl = null;
    preview.hidden = true;
    const file = photoInput.files[0];
    fieldError("photo", "");
    if (!file) return;
    const invalid = !["image/jpeg", "image/png", "image/webp"].includes(
      file.type,
    )
      ? "Gunakan foto JPG, PNG, atau WebP."
      : file.size > 3 * 1024 * 1024
        ? "Ukuran foto maksimal 3 MB."
        : "";
    if (invalid) {
      clearPhoto();
      fieldError("photo", invalid);
      return;
    }
    photoUrl = URL.createObjectURL(file);
    previewImage.src = photoUrl;
    q("#review-photo-name").textContent = file.name;
    preview.hidden = false;
  });
  q("#review-remove-photo").addEventListener("click", clearPhoto);
  window.addEventListener("pagehide", () => {
    if (photoUrl) URL.revokeObjectURL(photoUrl);
  });
  bodyInput.addEventListener("input", () => {
    bodyInput.setCustomValidity("");
    fieldError("body", "");
    q("#review-char-count").textContent =
      `${Array.from(bodyInput.value).length}/1500`;
  });
  nameInput.addEventListener("input", () => {
    nameInput.setCustomValidity("");
    fieldError("name", "");
  });
  form
    .querySelectorAll('[name="sentiment"]')
    .forEach((input) =>
      input.addEventListener("change", () => fieldError("sentiment", "")),
    );

  form.addEventListener("submit", async (event) => {
    event.preventDefault();
    if (submitting) return;
    nameInput.value = nameInput.value.trim();
    bodyInput.value = bodyInput.value.trim();
    nameInput.setCustomValidity(
      Array.from(nameInput.value).length < 2 ? "Nama minimal 2 karakter." : "",
    );
    bodyInput.setCustomValidity(
      Array.from(bodyInput.value).length < 10
        ? "Ulasan minimal 10 karakter."
        : "",
    );
    if (!form.reportValidity()) return;
    ["name", "body", "sentiment", "photo"].forEach((field) =>
      fieldError(field, ""),
    );
    submitting = true;
    submit.disabled = true;
    submitLabel.textContent = "Mengirim…";
    form.setAttribute("aria-busy", "true");
    let saved = false;
    try {
      const response = await fetch(form.action, {
        method: "POST",
        body: new FormData(form),
        headers: { Accept: "application/json" },
        credentials: "same-origin",
      });
      const payload = response.headers
        .get("content-type")
        ?.includes("application/json")
        ? await response.json()
        : {};
      if (!response.ok) {
        if (response.status === 422) {
          Object.entries(payload.errors || {}).forEach(([field, messages]) =>
            fieldError(field, messages[0]),
          );
          showFeedback(
            "Periksa kembali isian ulasanmu. Jika foto ditolak, pilih ulang fotonya.",
            "error",
          );
        } else if (response.status === 429)
          showFeedback(
            "Terlalu banyak pengiriman dalam satu menit. Tunggu sebentar, lalu coba lagi.",
            "error",
          );
        else if (response.status === 419)
          showFeedback(
            "Sesi halaman berakhir. Muat ulang halaman lalu kirim kembali ulasanmu.",
            "error",
          );
        else
          showFeedback(
            "Ulasan belum dapat diproses. Coba lagi sebentar.",
            "error",
          );
        return;
      }
      saved = true;
      feedController?.abort();
      ++feedSequence;
      track.removeAttribute("aria-busy");
      loadMore.disabled = false;
      renderFeed(payload, "all");
      form.reset();
      form.elements.submission_id.value = payload.next_submission_id;
      clearPhoto();
      q("#review-char-count").textContent = "0/1500";
      listStatus.textContent = "Ulasan terbaru ditampilkan lebih dulu.";
      showFeedback(payload.message);
    } catch {
      showFeedback(
        saved
          ? "Ulasan sudah tersimpan. Muat ulang halaman untuk melihat tampilan terbaru."
          : "Koneksi terputus. Coba kirim ulang; ulasan dengan pengiriman yang sama tidak akan digandakan.",
        saved ? "success" : "error",
      );
    } finally {
      submitting = false;
      submit.disabled = false;
      submitLabel.textContent = "Kirim ulasan";
      form.removeAttribute("aria-busy");
    }
  });
}
