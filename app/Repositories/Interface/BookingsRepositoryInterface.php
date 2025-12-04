<?php

namespace App\Repositories\Interface;

use App\Http\Requests\BookingsFormRequest;

interface BookingsRepositoryInterface
{
    public function __construct(BookingRepositoryInterface $bookingRepository);
    public function index(BookingsFormRequest $request);
    public function show($id);
    public function updateStatus(BookingsFormRequest $request, $id);
    public function destroy($id);
}
