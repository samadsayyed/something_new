<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecitationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Recitation;
use App\Http\Middleware\ApiTokenMiddleware;
use App\Http\Controllers\Api\RecitationApiController;


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

    // Dashboard Route
    Route::get('/dashboard', function () {
        $user = Auth::user();

        // Fetch recitation data for the logged-in user
        $recitations = Recitation::where('user_id', $user->id)
            ->orderBy('date', 'asc')
            ->get();

        return view('dashboard', compact('recitations'));
    })->middleware(['auth', 'verified'])->name('dashboard');

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
