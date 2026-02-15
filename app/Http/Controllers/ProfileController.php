<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Make sure to import your User model

class ProfileController extends Controller
{
    /**
     * Display the authenticated user's profile.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return view('pages.profile', compact('user'));
    }

    /**
     * Show the form for editing the authenticated user's profile.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return view('pages.profile_edit', compact('user')); // You'll create this view
    }

    /**
     * Update the authenticated user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the incoming request data
        $request->validate([
            'user_fullname' => 'required|string|max:255',
            'user_nickname' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Add other fields you allow to be updated
        ]);

        // Update the user's information
        $user->update([
            'user_fullname' => $request->user_fullname,
            'user_nickname' => $request->user_nickname,
            'email' => $request->email,
            // Update other fields
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
