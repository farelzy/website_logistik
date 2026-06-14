<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\Shipment;
use App\Models\ShipmentHistory;
use App\Models\BlogPost;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FrontendRouteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed minimal settings
        Setting::create(['key' => 'company_name', 'value' => 'SwiftLogix', 'group' => 'general']);
        Setting::create(['key' => 'company_tagline', 'value' => 'Test Tagline', 'group' => 'general']);
        Setting::create(['key' => 'company_about', 'value' => 'About text', 'group' => 'general']);
    }

    public function test_home_page_returns_200(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('SwiftLogix');
    }

    public function test_about_page_returns_200(): void
    {
        $response = $this->get('/tentang-kami');
        $response->assertStatus(200);
    }

    public function test_services_index_returns_200(): void
    {
        $response = $this->get('/layanan');
        $response->assertStatus(200);
    }

    public function test_service_detail_returns_200_for_active_service(): void
    {
        $service = Service::create([
            'title' => 'Test Layanan', 'slug' => 'test-layanan',
            'description' => 'Desc', 'short_description' => 'Short',
            'is_active' => true, 'order' => 1,
        ]);
        $response = $this->get("/layanan/{$service->slug}");
        $response->assertStatus(200);
        $response->assertSee('Test Layanan');
    }

    public function test_service_detail_returns_404_for_inactive_service(): void
    {
        $service = Service::create([
            'title' => 'Hidden', 'slug' => 'hidden',
            'description' => 'x', 'short_description' => 'x',
            'is_active' => false, 'order' => 1,
        ]);
        $response = $this->get("/layanan/{$service->slug}");
        $response->assertStatus(404);
    }

    public function test_tracking_page_returns_200(): void
    {
        $response = $this->get('/lacak');
        $response->assertStatus(200);
    }

    public function test_tracking_post_returns_200_with_valid_number(): void
    {
        $shipment = Shipment::create([
            'tracking_number'   => 'SWL1234567',
            'sender_name'       => 'Test Sender',
            'sender_address'    => 'Jl. Test No.1',
            'receiver_name'     => 'Test Receiver',
            'receiver_address'  => 'Jl. Test No.2',
            'weight'            => 1.0,
            'origin_city'       => 'Jakarta',
            'destination_city'  => 'Surabaya',
            'status'            => 'in_transit',
            'shipping_cost'     => 50000,
        ]);

        $response = $this->post('/lacak', ['tracking_number' => 'SWL1234567']);
        $response->assertStatus(200);
        $response->assertSee('SWL1234567');
        $response->assertSee('Test Sender');
    }

    public function test_tracking_post_shows_not_found_for_invalid_number(): void
    {
        $response = $this->post('/lacak', ['tracking_number' => 'SWLINVALID']);
        $response->assertStatus(200);
        $response->assertSee('Paket Tidak Ditemukan');
    }

    public function test_tracking_validates_required_tracking_number(): void
    {
        $response = $this->post('/lacak', ['tracking_number' => '']);
        $response->assertSessionHasErrors('tracking_number');
    }

    public function test_blog_index_returns_200(): void
    {
        $response = $this->get('/blog');
        $response->assertStatus(200);
    }

    public function test_blog_shows_only_published_posts(): void
    {
        BlogPost::create(['title' => 'Published', 'slug' => 'pub', 'content' => 'x', 'category' => 'Berita', 'is_published' => true, 'published_at' => now()->subDay(), 'views' => 0]);
        BlogPost::create(['title' => 'Draft Hidden', 'slug' => 'draft', 'content' => 'x', 'category' => 'Berita', 'is_published' => false, 'published_at' => null, 'views' => 0]);

        $response = $this->get('/blog');
        $response->assertSee('Published');
        $response->assertDontSee('Draft Hidden');
    }

    public function test_contact_page_returns_200(): void
    {
        $response = $this->get('/kontak');
        $response->assertStatus(200);
    }

    public function test_contact_form_stores_message_successfully(): void
    {
        $response = $this->post('/kontak', [
            'name'    => 'Budi Test',
            'email'   => 'budi@test.com',
            'subject' => 'Test Inquiry',
            'message' => 'Ini adalah pesan test yang lebih dari 10 karakter',
        ]);
        $response->assertRedirect(route('contact'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', ['email' => 'budi@test.com']);
    }

    public function test_contact_form_validates_required_fields(): void
    {
        $response = $this->post('/kontak', []);
        $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
    }

    public function test_contact_form_validates_email_format(): void
    {
        $response = $this->post('/kontak', [
            'name' => 'Test', 'email' => 'bukan-email', 'subject' => 'Sub', 'message' => 'Pesan cukup panjang ya',
        ]);
        $response->assertSessionHasErrors('email');
    }
}
