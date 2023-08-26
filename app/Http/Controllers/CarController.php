<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarController extends Controller
{
    public function add()
    {
        return view('car.create');
    }

    public function store(Request $request){
        Car::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'police_number' => $request->police_number,
            'price' => $request->price
        ]);

        return redirect('/');
    }

    public function getCars()
    {
        $cars = Car::all();
        return view('welcome', compact(['cars']));
    }

    public function search(Request $request)
    {
        $searchValue = $request->search_value;

        $cars = Car::where('model', 'LIKE', "%$searchValue%")
                    ->orWhere('brand', 'LIKE', "%$searchValue%")
                    ->orWhere('police_number', 'LIKE', "%$searchValue%")
                    ->get();

        return view('welcome', compact('cars'));
    }

    public function CheckListCarsAvailable(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;


         // Get the list of cars that have reservations that don't overlap with the input range
        $cars = Car::whereDoesntHave('reservations', function ($query) use ($start_date, $end_date) {
            $query->where(function ($subquery) use ($start_date, $end_date) {
                $subquery->whereBetween('start_date', [$start_date, $end_date])
                        ->orWhereBetween('end_date', [$start_date, $end_date])
                        ->orWhere(function ($orSubquery) use ($start_date, $end_date) {
                            $orSubquery->where('start_date', '<=', $start_date)
                                        ->where('end_date', '>=', $end_date);
                        });
        });
    })->get();
        return view('welcome', compact('cars'));
    }


}
