<?php

        namespace App\Http\Controllers;

        use Illuminate\Http\Request;
        use App\Models\DownloadLog;
        use Illuminate\Support\Facades\Auth;

        class DownloadLogController extends Controller
        {
            public function log(Request $request)
            {
                $request->validate([
                    'currency_id' => 'required|integer|exists:currencies,id', // Validate currency_id exists in currencies table
                ]);

                try {
                    DownloadLog::create([
                        'user_id' => Auth::id(),
                        'currency_id' => $request->currency_id, // Use currency_id as per your table
                        'downloaded_at' => now(),
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->header('User-Agent'),
                    ]);

                    return response()->json(['success' => true, 'message' => 'Download logged successfully.']);
                } catch (\Exception $e) {
                    \Log::error('Error logging download: ' . $e->getMessage(), ['request' => $request->all()]);
                    return response()->json(['success' => false, 'message' => 'Failed to log download due to an internal error.'], 500);
                }
            }
        }
        