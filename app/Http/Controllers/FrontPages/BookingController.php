<?php

namespace App\Http\Controllers\FrontPages;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Notifications\BookingCreated;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Notification;

class BookingController extends BaseController
{
    public function create($serviceSlug = null)
    {
        $services = Service::where('is_active', true)->get();
        $selectedService = $serviceSlug ? Service::where('slug', $serviceSlug)->first() : null;

        return view('front-pages.bookings.create', compact('services', 'selectedService'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'client_name' => 'required|string|max:255',
            'client_phone' => 'required|string|max:20',
            'client_email' => 'nullable|email',
            'animal_type' => 'required|string|max:255',
            'location' => 'required|string',
            'preferred_date' => 'required|date|after:today',
            'preferred_time' => 'nullable',
            'issue_description' => 'required|string|min:20',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        $booking = Booking::create($validated);

        // Send notification (optional - set up notifications later)
        // Notification::route('mail', config('mail.from.address'))
        //     ->notify(new BookingCreated($booking));

        return redirect()->route('bookings.success')
            ->with('success', 'Booking request submitted successfully! We will contact you shortly.');
    }

    public function success()
    {
        return view('front-pages.bookings.success');
    }

    public function myBookings()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $bookings = Booking::where('user_id', auth()->id())
            ->with('service')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('front-pages.bookings.my-bookings', compact('bookings'));
    }
}