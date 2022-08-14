<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    private $rulesModel = array(
        'name' => 'required||max:45',
        'email' => 'required||max:120|unique:users',
        'password' => 'required||max:45'
    );

    public function addUser(Request $request)
    {


        $validator = Validator::make($request->all(), $this->rulesModel);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors(),
            ], 400);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'type' => 1
        ]);

        $token = $user->createToken('primeirotoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token

        ];

        return $response;
    }



    public function login(Request $request)
    {

        $user =  User::where('email', $request->input('email'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {

            return response()->json([
                'message' => "Credenciais inválidas"
              ], 400);
        }

        $token = $user->createToken('primeirotoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token

        ];

        return $response;
    }
}
