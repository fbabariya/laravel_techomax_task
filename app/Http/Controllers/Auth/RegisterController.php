<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\customermodel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\TechnologyTag;
use Illuminate\Support\Facades\DB;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;



class RegisterController extends Controller
{
    public function register(Request $request)
    {
       
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'referrer' => 'nullable|string|max:255',
        ]);

        try {
        //$phones = implode(',', $request->phone);

        $user = customermodel::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'referrer' => $request->referrer,
        ]);
        // Authenticate the newly registered user
        Auth::login($user);

        // Redirect the user to the dashboard
        return response()->json(['message' => 'Registration successful', 'redirect_url' => route('dashboard')], 200);

    } catch (\Exception $e) {
        Log::error('Registration error: ' . $e->getMessage());
        return response()->json(['error' => 'Registration failed'], 500);
    }  
 }



    public function showRegistrationForm()
    {
        return view('register');
    }

    public function showLoginForm()
    {
        return view('admin');
    }

    public function admin(Request $request)
    {
         $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);
    $credentials = $request->only('email', 'password');
    $remember = $request->filled('remember');

    if (Auth::attempt($credentials, $remember)) {
     
        return redirect()->intended('dashboard')
            ->withSuccess('Signed in');
    }
    return redirect()->back()->withErrors([
        'email' => 'Please provide valid Email and password.',
    ]);

    }


    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin');
    }

    


    public function report(Request $request)
    {
        $referrerCounts = Customermodel::selectRaw("DATE(created_at) as Date, referrer as Source, COUNT(*) as registration")
        ->groupBy('Date', 'Source')
        ->get();

        return view('report', compact('referrerCounts'));
    }
    
    // public function technology_user(Request $request)
    // {
    //     $request->validate([
    //         'technology' => 'required|string|in:PHP,Laravel,Vue.js,CodeIgniter,MySQL',
    //     ]);

    //     // Get the authenticated user
    //     $user = auth()->user();

    //     // Update the user's technology in the database
    //     $user->technology = $request->technology;
    //     $user->save();
       
    //     // Redirect back or return a success response
    //     return redirect()->back()->with('success', 'Technology saved successfully.');
    // }

//     public function technologyTagReport()
// {
//     $technologyTags = TechnologyTag::withCount('customers')->get();

//     return view('technology_tag_report', compact('technologyTags'));
// }




// public function selectTechnology(Request $request)
// {
//     // Update the selected technology tags for the authenticated user
//     $user = auth()->user();
//     $user->customers()->sync($request->input('technology_tags'));


//     // Fetch technology tags from the database
//     $technologyTags = TechnologyTag::all();

//     // Pass technology tags to the view
//     return view('dashboard', compact('technologyTags'))->with('success', 'Technology tags updated successfully.');
// }


public function technologyReport()
    {
        $technologyTags = TechnologyTag::withCount('customers')->get();
        return view('technology_tag_report', compact('technologyTags'));
    }

    public function chooseTechnologies(Request $request)
    {
        Customermodel::find(auth()->id())->
        technologyTags()->sync($request->input('technology_tags',[]));
        return redirect()->route('dashboard')->with('success', 'Technology tags updated successfully');
    }

}
