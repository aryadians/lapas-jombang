<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SurveyController extends Controller
{
    /**
     * Store a newly created survey response.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'rating' => 'required|integer|min:1|max:4',
            'saran' => 'nullable|string|max:1000',
        ]);

        // Log the survey response (you can save to database later if needed)
        Log::info('Survey Response', [
            'rating' => $request->rating,
            'saran' => $request->saran,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'timestamp' => now(),
        ]);

        // For now, just return success response
        // In production, you might want to save this to a database
        return response()->json([
            'success' => true,
            'message' => 'Terima kasih atas penilaian Anda! Masukan Anda sangat berharga untuk meningkatkan pelayanan kami.'
        ]);
    }
}
