<?php

namespace App\Http\Controllers\FrontPages;

use App\Models\Service;
use App\Models\Testimonial;
use App\Http\Controllers\BaseController;

class RvsController extends BaseController
{
    public function index()
    {
        $services = Service::where('is_active', true)->take(4)->get();
        $testimonials = Testimonial::where('is_featured', true)->take(3)->get();
        
        return view('front-pages.rvs.index', compact('services', 'testimonials'));
    }

    public function services()
    {
        $services = Service::where('is_active', true)->get();
        
        return view('front-pages.rvs.services', compact('services'));
    }

    public function serviceDetail($slug)
    {
        $service = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        return view('front-pages.rvs.service-detail', compact('service'));
    }
}