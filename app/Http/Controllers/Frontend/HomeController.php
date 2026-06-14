<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\BlogPost;
use App\Models\Setting;
use App\Models\Shipment;
use App\Models\Contact;

class HomeController extends Controller
{
    public function index()
    {
        $services    = Service::active()->take(6)->get();
        $testimonials = Testimonial::active()->take(5)->get();
        $posts       = BlogPost::published()->take(3)->get();
        $stats = [
            'shipments'   => Shipment::count() ?: 15000,
            'cities'      => 200,
            'clients'     => 500,
            'years'       => 15,
        ];

        return view('frontend.home', compact('services', 'testimonials', 'posts', 'stats'));
    }

    public function about()
    {
        $team = \App\Models\TeamMember::active()->get();
        return view('frontend.about', compact('team'));
    }
}
