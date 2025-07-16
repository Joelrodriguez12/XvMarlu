<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\RsvpController;

// Main invitation page
Route::get('/', [InvitationController::class, 'index'])->name('home');

// RSVP routes
Route::post('/rsvp', [RsvpController::class, 'store'])->name('rsvp.store');
Route::get('/rsvp/thank-you', [RsvpController::class, 'thankYou'])->name('rsvp.thank-you');

// Simple admin login
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', function () {
    if (request('password') === 'your-secret-password') {
        session(['admin_logged_in' => true]);
        return redirect()->route('admin.rsvp.index');
    }
    return back()->with('error', 'Invalid password');
})->name('admin.login.submit');

Route::get('/admin/logout', function () {
    session()->forget('admin_logged_in');
    return redirect('/');
})->name('admin.logout');

// Admin routes with auth check inside
Route::prefix('admin')->group(function () {
    Route::get('/rsvp', function () {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        $controller = new RsvpController();
        return $controller->index();
    })->name('admin.rsvp.index');
    
    Route::delete('/rsvp/{id}', function ($id) {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        $controller = new RsvpController();
        return $controller->destroy($id);
    })->name('admin.rsvp.destroy');
});