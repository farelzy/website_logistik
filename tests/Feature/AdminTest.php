<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Service;
use App\Models\Shipment;
use App\Models\Setting;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
        Setting::create(['key' => 'company_name', 'value' => 'SwiftLogix', 'group' => 'general']);
        Setting::create(['key' => 'company_tagline', 'value' => 'Tagline', 'group' => 'general']);
        Setting::create(['key' => 'company_about', 'value' => 'About', 'group' => 'general']);
    }

    /** @test */
    public function guest_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function admin_can_access_dashboard(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }

    /** @test */
    public function admin_can_create_service(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/services', [
            'title'             => 'Layanan Test',
            'short_description' => 'Deskripsi singkat',
            'description'       => 'Deskripsi lengkap layanan test ini',
            'icon'              => 'fas fa-truck',
            'order'             => 1,
            'is_active'         => 1,
        ]);
        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('services', ['title' => 'Layanan Test']);
    }

    /** @test */
    public function admin_can_delete_service(): void
    {
        $service = Service::create([
            'title' => 'To Delete', 'slug' => 'to-delete',
            'description' => 'x', 'short_description' => 'x',
            'is_active' => true, 'order' => 1,
        ]);
        $response = $this->actingAs($this->admin)->delete("/admin/services/{$service->id}");
        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseMissing('services', ['id' => $service->id]);
    }

    /** @test */
    public function admin_can_create_shipment(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/shipments', [
            'tracking_number'  => 'SWL9999999',
            'sender_name'      => 'Pengirim Test',
            'sender_address'   => 'Jl. Pengirim No.1',
            'receiver_name'    => 'Penerima Test',
            'receiver_address' => 'Jl. Penerima No.2',
            'weight'           => 2.5,
            'origin_city'      => 'Jakarta',
            'destination_city' => 'Bandung',
            'status'           => 'pending',
            'shipping_cost'    => 75000,
        ]);
        $response->assertRedirect();
        $this->assertDatabaseHas('shipments', ['tracking_number' => 'SWL9999999']);
    }

    /** @test */
    public function admin_can_view_shipments_list(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/shipments');
        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_view_contacts(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/contacts');
        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_view_settings(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/settings');
        $response->assertStatus(200);
    }
}
