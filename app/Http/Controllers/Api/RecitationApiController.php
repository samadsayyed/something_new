<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recitation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; // Import the DB facade here

class RecitationApiController extends Controller
{

    public function getCountsByCountry()
    {
        // Query for country-wise counts
        $countryCounts = DB::table('users')
            ->join('recitations', 'users.id', '=', 'recitations.user_id')
            ->select(
                'users.country',
                DB::raw('SUM(recitations.durud_count) as total_durud_count'),
                DB::raw('SUM(recitations.quran_para_count) as total_quran_count')
            )
            ->groupBy('users.country')
            ->orderByDesc('total_durud_count')
            ->get();
    
        // Query for top reciters
        $topReciters = DB::table('users')
            ->join('recitations', 'users.id', '=', 'recitations.user_id')
            ->select(
                'users.country',
                'users.name as top_reciter',
                DB::raw('MAX(recitations.durud_count) as highest_durud_count')
            )
            ->groupBy('users.country', 'users.name') // Include all non-aggregated columns
            ->orderByDesc('highest_durud_count')
            ->get();
    
        // Combine the data into a single JSON response
        return response()->json([
            'countries' => $countryCounts,
            'top_reciters' => $topReciters,
        ]);
    }
    
    

}
