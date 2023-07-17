<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view("register.index");
    }

    public function register(Request $request) {
        
        $validatedData = $request->validate([
            "email" => "required|email|unique:users",
            "name" => "required|max:255",
            "username" => "required|min:4|max:255|unique:users",
            "password" => "required|min:8|max:255"
        ]);

        $validatedData["password"] = Hash::make($validatedData["password"]);

        User::create($validatedData);

        return redirect("/login")->with("registerSuccess", "Registration successfull! Please Login!");
        
    }
}
