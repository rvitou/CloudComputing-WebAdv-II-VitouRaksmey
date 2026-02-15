<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // REMOVED: $this->middleware('auth');
        // By removing this, the HomeController's index method is now accessible to guests.
        // Routes that *do* require authentication (like /profile, /dashboard)
        // are now protected by middleware directly in routes/web.php.
    }

    /**
     * Show the application dashboard (which is now your main homepage).
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // You can fetch data here that is visible to all visitors (guests and logged-in)
        // For example, general site statistics or featured content.

        return view('pages.home'); // This will load your home page view
    }
}
