<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        return Car::all();
    }

    public function store(Request $request)
    {
        return Car::create($request->all());
    }

    public function show($id)
    {
        return Car::find($id);
    }

    public function update(Request $request, $id)
    {
        $car = Car::find($id);
        $car->update($request->all());
        return $car;
    }

    public function destroy($id)
    {
        return Car::destroy($id);
    }

    public function search($matricule)
    {
        return Car::where('matricule', 'like', '%'.$matricule.'%')->get();
    }
}
