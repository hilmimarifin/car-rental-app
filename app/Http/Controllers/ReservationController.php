<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    //
    public function add(string $car_id, Request $request){

        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'duration' => 'required'
        ]);
        

        $user = Auth::user();

        $startDate = new DateTime($request->start_date);
        $duration = (int)$request->duration;
        $endDate = clone $startDate;
        $endDate->modify("+$duration days");

        $end_date = $endDate->format('Y-m-d');

                 // Retrieve booked dates for the specific room
                 $startoDate = $request->input('start_date');
                 $endoDate = $end_date;
                 $bookedDates = Reservation::where('car_id', $car_id)
                 ->where(function ($query) use ($startoDate, $endoDate) {
                     $query->whereBetween('start_date', [$startoDate, $endoDate])
                         ->orWhereBetween('end_date', [$startoDate, $endoDate])
                         ->orWhere(function ($query) use ($startoDate, $endoDate) {
                             $query->where('start_date', '<=', $startoDate)
                                 ->where('end_date', '>=', $endoDate);
                         });
                 })
                 ->get();
         
         // Check for overlapping dates
         if ($bookedDates->count() > 0) {
             return redirect('/')->with('error', 'The selected dates are already booked.');
         }
         

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
        foreach ($reservations as $reservation) {
            $start = Carbon::parse($reservation->start_date);
            $end = Carbon::parse($reservation->actual_end_date);
            $durationInDays = $start->diffInDays($end);
            $reservation->total_charge = $durationInDays * $reservation->car->price;
        }    
        // dd($reservations);
        return view('completed_reservation', compact(['reservations']));
    }
}
