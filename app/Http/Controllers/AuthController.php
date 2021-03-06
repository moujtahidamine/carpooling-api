<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trajet;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'isAdmin' => false,
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'cars' => $user->cars,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function inscrire($idUser, $idTrajet)
    {
        $trajet = Trajet::find($idTrajet);
        $user = User::find($idUser);

        $user->demandes()->attach($idTrajet, ['acceptance' => false]);

        return $user;
    }

    public function accepterDemande($idUser, $idTrajet)
    {
        $trajet = Trajet::find($idTrajet);
        $user = User::find($idUser);

        $user->demandes()->updateExistingPivot($idTrajet, ['acceptance' => true]);

        return $user;
    }

    public function show($id)
    {
        $user = User::find($id);


        return response($user, 201);

    }
}
