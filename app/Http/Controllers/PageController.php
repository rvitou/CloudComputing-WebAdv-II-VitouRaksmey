<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Show the About Us page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function aboutUs()
    {
        return view('pages.about_us');
    }

    /**
     * Show the Contact page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Show the Privacy Policy page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function privacyPolicy()
    {
        return view('pages.privacy_policy');
    }
}
