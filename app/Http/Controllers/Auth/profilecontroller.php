<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class profilecontroller extends Controller
{

    public function edit()
    {
        //$user = Auth::user();
        return view('profile.edit');


        // if (Auth::check()) {
        //     $user = Auth::user();
        //     return view('profile.edit', compact('user'));
        // } else {
        //     // If the user is not authenticated, redirect them to the login page
        //     return redirect()->route('login')->with('error', 'Please login to edit your profile.');
        // }
    }

    /**
     * Update the user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
{
    // Retrieve the authenticated user
    $user = $request->user();

    // Validate the request data
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:20',
        // Add more validation rules as needed
    ]);

    // Update the user's profile attributes
    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    // Add more fields to update as needed

    // Save the changes
    $user->save();

    // Optionally, you can redirect the user back to the edit profile page with a success message
    return redirect()->route('dashboard')->with('success', 'Profile updated successfully.');
}

}
