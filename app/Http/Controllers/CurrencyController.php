<?php

        namespace App\Http\Controllers;

        use Illuminate\Http\Request;
        use App\Models\Country; // Import the Country model
        use App\Models\Currency; // Import the Currency model (which represents individual notes/coins)

        class CurrencyController extends Controller
        {
            /**
             * Display the details for a specific country's currencies (notes/coins).
             *
             * @param  string  $countrySlug
             * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
             */
            public function show($countrySlug)
            {
                // Fetch the country based on the 'slug' and eager load its associated currencies (notes/coins)
                $country = Country::where('slug', $countrySlug)->with('currencies')->first();

                if (!$country) {
                    // If country is not found, redirect to home with an error message
                    return redirect()->route('home')->with('error', 'Country or currency details not found for ' . $countrySlug);
                    // Or, you could show a 404 page: abort(404, 'Country not found');
                }

                // Pass the country data (which now includes its currencies/notes) to the view
                // The view will then access $country->name, $country->description, $country->main_currency_image_path
                // and $country->currencies (which is the collection of individual notes/coins)
                return view('pages.currency_detail', compact('country'));
            }
        }
        