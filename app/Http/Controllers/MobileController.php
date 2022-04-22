<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MobileController extends Controller
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

}
}
