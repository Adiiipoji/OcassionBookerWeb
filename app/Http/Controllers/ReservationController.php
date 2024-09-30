<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reservation;


class ReservationController extends Controller
{
    public function index()
    {
        $reservations = reservation::all();
        return response()->json($reservations);
    }

    // Store (Create)
    public function store(Request $request)
    {
        // Retrieve data from the request
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $eventId = $request->input('event_id');
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');

        // Check if a reservation exists for the given event within the specified date range
        $isReservation = Reservation::where('event_id', $eventId)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('start_date', '<=', $endDate)
                      ->where('end_date', '>=', $startDate);
            })
            ->exists();

        // If a reservation already exists, return a response indicating failure
        if ($isReservation) {
            return response()->json(['message' => 'Event already booked. Please try a different date!'], 400);
        }

        // If no reservation exists, create a new one
        $reservation = new Reservation();
        $reservation->event_id = $eventId;
        $reservation->name = $name;
        $reservation->email = $email;
        $reservation->phone = $phone;
        $reservation->start_date = $startDate;
        $reservation->end_date = $endDate;
        $reservation->save();

        // Return a response indicating success
        return response()->json(['message' => 'Reservation created successfully'], 201);
    }

    // Update
    public function update(Request $request, Reservation $reservation)
    {
        $reservation->update($request->all());
        return response()->json($reservation, 200);
    }

    // Delete
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json(null, 204);
    }
}
