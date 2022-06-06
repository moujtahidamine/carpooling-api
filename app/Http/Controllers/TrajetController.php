<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use App\Models\User;

use Illuminate\Http\Request;

class TrajetController extends Controller
{
    public function index()
    {
        return Trajet::with(['car', 'conducteur', 'users'])->get();

    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'villeDepart' => 'required',
        //     'villeArrive' => 'required',
        //     'prix' => 'required'
        // ]);

        $trajets = Trajet::create($request->all());
        return response()->json($trajets, 200); 
    }

    public function show($id)
    {
        $trajet = Trajet::find($id);

        $response = [
            'trajet' => $trajet,
            'car' => $trajet->car,
            'demandes' => $trajet->users,
        ];

        return response($response, 201);

    }

    public function update(Request $request, $id)
    {
        $trajet = Trajet::find($id);
        $trajet->update($request->all());
        return $trajet;
    }

    public function destroy($id)
    {
        return Trajet::destroy($id);
    }

    public function search($name)
    {
        return Trajet::where('name', 'like', '%'.$name.'%')->get();
    }


}
