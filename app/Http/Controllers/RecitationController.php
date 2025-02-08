<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recitation;

class RecitationController extends Controller
{
    public function create(Request $request)
    {
        // Step 1: Log request data
        \Log::info('Received request data:', $request->all());
        
        $user = Auth::user();
        \Log::info('Authenticated user:', ['id' => $user->id, 'name' => $user->name]);

        // Step 2: Validate the request
        try {
            $validatedData = $request->validate([
                'durud_count' => 'required|integer|min:0',
                'para_count' => 'nullable|integer|min:0',
            ]);
            \Log::info('Validation successful:', $validatedData);
        } catch (\Exception $e) {
            \Log::error('Validation failed:', ['error' => $e->getMessage()]);
            return back()->withErrors('Invalid data provided.')->withInput();
        }

        // Step 3: Prepare the data for saving
        $recitationData = [
            'user_id' => $user->id,
            'date' => now()->toDateString(),
            'durud_count' => $request->durud_count,
            'quran_para_count' => $request->para_count,
        ];
        \Log::info('Prepared recitation data:', $recitationData);

        // Step 4: Save the recitation data
        try {
            $recitation = Recitation::create($recitationData);
            \Log::info('Recitation data added:', $recitation->toArray());
        } catch (\Exception $e) {
            \Log::error('Failed to save recitation data:', ['error' => $e->getMessage()]);
            return back()->withErrors('Failed to save data. Please try again later.');
        }

        // Step 5: Return success response
        return redirect()->route('dashboard')->with('success', 'Recitation data added successfully!');

    }

    
    

}
