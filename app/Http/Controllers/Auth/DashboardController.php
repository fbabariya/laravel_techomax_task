<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\customermodel;
use App\Models\TechnologyTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;


class DashboardController extends Controller
{   
    
    public function index()
    {
        {
            // Get the authenticated user
            $user = auth()->user();
           
          
            // Query the database to get the user's role
            $role = customermodel::where('id', $user->id)->value('roll_id');
            $technologyTags = TechnologyTag::all();
          
            // Check if the user's role matches the admin role (assuming roll_id 1 represents admin)
            if ($role == 1) {
                // User has admin role, show admin dashboard
                return view('dashboard');
            } elseif ($role == 0) {
                $selectedTags = $user->technologytags()->get();
                // User has role_id = 0, redirect to user dashboard
                return view('dashboard', compact('user','technologyTags','selectedTags'));
            } else {
                // User does not have admin role or user role, redirect with error message
                return redirect('/admin')->with('error', 'You do not have permission to access this page.');
            }
        }
    }

   }
