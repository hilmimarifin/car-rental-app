<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    //
    public function add(string $car_id, Request $request){

        $user = Auth::user();

        $startDate = new DateTime($request->start_date);
        $duration = (int)$request->duration;

        $endDate = clone $startDate;
        $endDate->modify("+$duration days");

        $end_date = $endDate->format('Y-m-d');

        Reservation::create([
            'user_id' => $user->id,
            'car_id' => $car_id,
            'start_date' => $request->start_date,
            'end_date' => $end_date
        ]);

        return redirect('/');

    }

    public function get()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->whereNull('actual_end_date')->get();
        // dd($reservations);
        return view('my_reservations', compact(['reservations']));
    }

    public function returnCar($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);
        // dd($reservation);
        $reservation->update(['actual_end_date' => now()->format('Y-m-d')]);
        return redirect('/reservation');
    }

    public function getCompleted()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)
        ->whereNotNull('actual_end_date')->get();
        // dd($reservations);
        return view('completed_reservation', compact(['reservations']));
    }
}
