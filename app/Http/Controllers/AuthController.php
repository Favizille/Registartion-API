<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'country'=>'required',
            'password'=>'required',
        ]);

        // $user = User::create([
        //     'first_name' => $fields['first_name'],
        //     'last_name' => $fields['last_name'],
        //     'email' => $fields ['email'],
        //     'phone_number' => $fields ['phone_number'],
        //     'country' => $fields ['country'],
        //     'password' => bcrypt($fields['password']),
        // ]);
        $user = User::create($fields);
        $created_user =  $request->all();
        $token = $user->createToken('myapptoken')->plainTextToken;


        return response()->json([
            'status' => 'success',
            'message' => 'User has successfully registered',
            'data' => $created_user,
            'data' => $token,
        ]);
    }

    public function getUser(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'numeric']
        ]);

        $user_id = $request->user_id;
        $user = User::find($user_id);
        if(!$user)
        {
            return response()->json([
                'status' => 'fail',
                'message' => 'no user with that id',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'user found',
            'data' => $user,
        ]);
    }

    public function allUsers(){
        $allUsers = User::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Registered Users',
            'data' => $allUsers,
        ]);
    }

}
