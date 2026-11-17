<?php

namespace Tests\Feature;

use Tests\TestCase;

class PrimaryNavigationTest extends TestCase
{
    public function test_primary_navigation_links_to_six_dedicated_pages(): void
    {
        $response = $this->get(route('home'))->assertOk();

        foreach ([
            'Home' => route('home'),
            'About' => route('about'),
            'Services' => route('services'),
            'Gallery' => route('gallery'),
            'Our Location' => route('location'),
            'Contact' => route('contact'),
        ] as $label => $url) {
            $response->assertSee('href="'.$url.'"', false);
            $response->assertSee('>'.$label.'</a>', false);
        }
    }

    public function test_each_primary_page_renders_its_own_content(): void
    {
        foreach ([
            'home' => 'Step into the magic',
            'about' => 'Momen sebentar.',
            'services' => 'Detail kecil yang membuat momen',
            'gallery' => 'Your people.',
            'location' => 'Momenmu, di',
            'contact' => 'Momen berikutnya,',
        ] as $route => $heading) {
            $this->get(route($route))
                ->assertOk()
                ->assertSee($heading);
        }
    }
}
