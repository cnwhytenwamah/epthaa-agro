<?php

namespace App\Repositories\Eloquent;

use App\Http\Requests\BookingsFormRequest;
use App\Repositories\Interface\BookingsRepositoryInterface;

class BookingsRepository
{
    /**
     * Create a new class instance.
     */
    protected $bookingRepository;

    public function __construct(BookingsRepositoryInterface $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function index(BookingsFormRequest $request)
    {
        if ($request->has('status') && $request->status) {
            $bookings = $this->bookingRepository->getByStatus($request->status);
            $bookings = new \Illuminate\Pagination\LengthAwarePaginator(
                $bookings,
                $bookings->count(),
                15
            );
        } else {
            $bookings = $this->bookingRepository->paginate(15);
        }

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = $this->bookingRepository->find($id);
        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(BookingsFormRequest $request, $id)
    {
        $validated = $request->validated();
        $this->bookingRepository->updateStatus($id, $validated['status'], $validated['admin_notes'] ?? null);

        return redirect()->back()->with('success', 'Booking status updated successfully!');
    }

    public function destroy($id)
    {
        $this->bookingRepository->delete($id);
        
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully!');
    }
}
