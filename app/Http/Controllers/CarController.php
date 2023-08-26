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
}
