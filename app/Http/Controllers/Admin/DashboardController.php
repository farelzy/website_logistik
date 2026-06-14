<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Shipment;
use App\Models\BlogPost;
use App\Models\Contact;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'services'       => Service::count(),
            'shipments'      => Shipment::count(),
            'delivered'      => Shipment::where('status', 'delivered')->count(),
            'in_transit'     => Shipment::whereIn('status', ['picked_up', 'in_transit', 'out_for_delivery'])->count(),
            'blog_posts'     => BlogPost::count(),
            'contacts'       => Contact::count(),
            'unread_contacts'=> Contact::unread()->count(),
            'testimonials'   => Testimonial::count(),
        ];

        $recent_shipments = Shipment::latest()->take(5)->get();
        $recent_contacts  = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_shipments', 'recent_contacts'));
    }
}
