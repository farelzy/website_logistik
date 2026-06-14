<?php

namespace Tests\Unit;

use App\Models\Service;
use App\Models\Shipment;
use App\Models\BlogPost;
use App\Models\Setting;
use App\Models\Contact;
use App\Models\Testimonial;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_service_auto_generates_slug_on_create(): void
    {
        $service = Service::create([
            'title'             => 'Pengiriman Ekspres Test',
            'slug'              => '',
            'description'       => 'Deskripsi layanan',
            'short_description' => 'Singkat',
            'is_active'         => true,
            'order'             => 1,
        ]);
        $this->assertEquals('pengiriman-ekspres-test', $service->slug);
    }

    public function test_service_scope_active_returns_only_active_services(): void
    {
        Service::create(['title' => 'Active', 'slug' => 'active', 'description' => 'x', 'short_description' => 'x', 'is_active' => true, 'order' => 1]);
        Service::create(['title' => 'Inactive', 'slug' => 'inactive', 'description' => 'x', 'short_description' => 'x', 'is_active' => false, 'order' => 2]);

        $active = Service::active()->get();
        $this->assertCount(1, $active);
        $this->assertEquals('Active', $active->first()->title);
    }

    public function test_shipment_generates_unique_tracking_number(): void
    {
        $number = Shipment::generateTrackingNumber();
        $this->assertStringStartsWith('SWL', $number);
        $this->assertGreaterThanOrEqual(10, strlen($number));
    }

    public function test_shipment_status_label_returns_correct_label(): void
    {
        $shipment = new Shipment(['status' => 'delivered']);
        $this->assertEquals('Terkirim', $shipment->status_label);

        $shipment->status = 'in_transit';
        $this->assertEquals('Dalam Pengiriman', $shipment->status_label);
    }

    public function test_shipment_status_color_returns_correct_color(): void
    {
        $shipment = new Shipment(['status' => 'delivered']);
        $this->assertEquals('success', $shipment->status_color);

        $shipment->status = 'failed';
        $this->assertEquals('danger', $shipment->status_color);
    }

    public function test_blog_post_auto_generates_slug(): void
    {
        $post = BlogPost::create([
            'title'        => 'Artikel Test Logistik',
            'content'      => 'Isi artikel',
            'category'     => 'Berita',
            'is_published' => true,
            'published_at' => now()->subDay(),
            'views'        => 0,
        ]);
        $this->assertEquals('artikel-test-logistik', $post->slug);
    }

    public function test_blog_post_published_scope_excludes_drafts(): void
    {
        BlogPost::create(['title' => 'Published', 'slug' => 'pub', 'content' => 'x', 'category' => 'Berita', 'is_published' => true, 'published_at' => now()->subDay(), 'views' => 0]);
        BlogPost::create(['title' => 'Draft', 'slug' => 'draft', 'content' => 'x', 'category' => 'Berita', 'is_published' => false, 'published_at' => null, 'views' => 0]);

        $published = BlogPost::published()->get();
        $this->assertCount(1, $published);
        $this->assertEquals('Published', $published->first()->title);
    }

    public function test_setting_can_set_and_get_value(): void
    {
        Setting::set('test_key', 'test_value');
        $this->assertEquals('test_value', Setting::get('test_key'));
    }

    public function test_setting_returns_default_when_key_not_found(): void
    {
        $value = Setting::get('nonexistent_key', 'default');
        $this->assertEquals('default', $value);
    }

    public function test_contact_unread_scope_works(): void
    {
        Contact::create(['name' => 'A', 'email' => 'a@a.com', 'subject' => 'S', 'message' => 'Msg', 'is_read' => false]);
        Contact::create(['name' => 'B', 'email' => 'b@b.com', 'subject' => 'S', 'message' => 'Msg', 'is_read' => true]);

        $unread = Contact::unread()->get();
        $this->assertCount(1, $unread);
        $this->assertEquals('A', $unread->first()->name);
    }

    public function test_testimonial_active_scope_works(): void
    {
        Testimonial::create(['name' => 'Active User', 'content' => 'Great!', 'rating' => 5, 'is_active' => true]);
        Testimonial::create(['name' => 'Hidden User', 'content' => 'Meh', 'rating' => 3, 'is_active' => false]);

        $active = Testimonial::active()->get();
        $this->assertCount(1, $active);
        $this->assertEquals('Active User', $active->first()->name);
    }
}
