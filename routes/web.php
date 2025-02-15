<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecitationController;
use App\Http\Controllers\Api\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Recitation;
use App\Http\Middleware\ApiTokenMiddleware;
use App\Http\Controllers\Api\RecitationApiController;
use Carbon\Carbon;  

Route::middleware([ApiTokenMiddleware::class])->group(function () {
    Route::get('/durud-portal/api/recitations', [RecitationApiController::class, 'getCountsByCountry']);
});

// Redirect `/` to `/durud-portal`
Route::get('/', function () {
    return redirect('/durud-portal');
});

// Group all routes under `/durud-portal`
Route::prefix('durud-portal')->group(function () {

    // Redirect `/durud-portal` to login or dashboard
    Route::get('/', function () {
        return Auth::check() ? redirect('/durud-portal/dashboard') : redirect('/durud-portal/login');
    });

    Route::get('/dashboard', function () {
        $user = Auth::user();
    
        // Fetch recitation data for the logged-in user, grouped by date
        $recitations = Recitation::where('user_id', $user->id)
            ->orderBy('date', 'asc')
            ->get()
            ->groupBy(function ($date) {
                // Group by date (ignoring time)
                return Carbon::parse($date->date)->format('Y-m-d');  // This gives you the date in 'YYYY-MM-DD' format
            });
            \Log::info('Prepared recitation data: ' . json_encode($recitations, JSON_PRETTY_PRINT));
        // Prepare the recitations with their total count per day
        $dailyTotals = $recitations->map(function ($dayRecitations) {
            // Calculate the total recitations for the day
            $totalDurud = $dayRecitations->sum('durud_count');
            $totalPara = $dayRecitations->sum('quran_para_count');
            $total = $totalDurud + $totalPara;  // Total recitations for the day
            
            return [
                'date' => $dayRecitations->first()->date,  // Use the first recitation entry to get the date
                'total_durud' => $totalDurud,
                'total_para' => $totalPara,
                'total' => $total,
                'recitations' => $dayRecitations,  // Optional, in case you want to display the individual recitations
            ];
        });

        // \Log::info('Prepared recitation data: ' . json_encode($recitationData, JSON_PRETTY_PRINT));

    
        return view('dashboard', compact('dailyTotals'));
    })->middleware(['auth', 'verified'])->name('dashboard');
    
    Route::get('/verify-email', function () {
        return view('auth.verify-email');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.notice');


    Route::get('/account/enable', [VerifyEmailController::class, 'verifyUser'])
    ->name('account.verify');


    

    // Authenticated Routes
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::post('/recitation/create', [RecitationController::class, 'create'])->name('recitation.create');
    });

    // Auth Routes (Login, Register, etc.)
    require __DIR__.'/auth.php';
});
