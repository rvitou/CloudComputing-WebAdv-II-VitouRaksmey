<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Currency; // Ensure Currency model is imported
use App\Models\Country;  // Ensure Country model is imported
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    /**
     * Display the application statistics dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // 1. Total Users
        $totalUsers = User::count();

        // 2. User Distribution by Gender (Pie Chart Data)
        $genderDistribution = User::select('gender', DB::raw('count(*) as count'))
                                  ->groupBy('gender')
                                  ->get()
                                  ->pluck('count', 'gender')
                                  ->toArray();
        // Ensure all expected genders are present, even if count is 0
        $genderData = [
            'Male' => $genderDistribution['Male'] ?? 0,
            'Female' => $genderDistribution['Female'] ?? 0,
            'Other' => $genderDistribution['Other'] ?? 0,
            'Prefer not to say' => $genderDistribution['Prefer not to say'] ?? 0,
        ];

        // 3. User Distribution by Country (Bar Chart Data)
        $countryDistribution = User::select('country', DB::raw('count(*) as count'))
                                   ->whereNotNull('country')
                                   ->groupBy('country')
                                   ->orderBy('count', 'desc')
                                   ->take(10)
                                   ->get()
                                   ->pluck('count', 'country')
                                   ->toArray();

        // --- UPDATED LOGIC FOR GLOBAL ARCHIVE STATISTICS ---

        // 4. Total Currency Items (Total number of individual notes/coins in the archive)
        // This counts every single record in the 'currencies' table.
        $totalCurrencyItems = Currency::count(); // CHANGED: from distinct('denomination') to count()

        // 5. Total Countries with Currencies in Archive
        // This remains the same, counting distinct 'country_id' values from the 'currencies' table.
        $totalCountriesWithCurrencies = Currency::distinct('country_id')->count();

        // --- END UPDATED LOGIC ---


        // Placeholder data for "New Currency Additions" (line graph)
        $newCurrencyAdditionsData = [
            'labels' => ['Day 1', 'Day 7', 'Day 14', 'Day 21', 'Day 28', 'Day 30'],
            'new_notes' => [5, 8, 12, 10, 15, 18],
            'updates' => [2, 3, 5, 4, 6, 7],
        ];


        return view('pages.statistics', compact(
            'totalUsers',
            'genderData',
            'countryDistribution',
            'totalCurrencyItems',           // UPDATED variable name
            'totalCountriesWithCurrencies',
            'newCurrencyAdditionsData'
        ));
    }
}
