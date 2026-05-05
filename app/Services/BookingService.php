<?php

namespace App\Services;

use App\Models\Booking;

class BookingService
{
    public function getAll()
    {
        return Booking::orderBy('created_at', 'desc')->paginate(10);
    }

    public function getById($id)
    {
        return Booking::findOrFail($id);
    }

    public function create(array $data)
    {
        return Booking::create($data);
    }

    public function updateStatus($id, $status)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $status]);
        return $booking;
    }

    public function delete($id)
    {
        $booking = Booking::findOrFail($id);
        return $booking->delete();
    }
}
