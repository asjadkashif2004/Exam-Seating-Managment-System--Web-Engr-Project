<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Post-login router (redirect by role)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();
    if (!$user) {
        return redirect()->route('login');
    }

    if (method_exists($user, 'isAdmin') && $user->isAdmin()) {
        return redirect()->route('admin.index');
    }
    if (method_exists($user, 'isStaff') && $user->isStaff()) {
        return redirect()->route('staff.index');
    }
    // default → student
    return redirect()->route('student.index');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile (all authenticated)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin (role:admin) – one-page CRUD from DashboardController
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')->as('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        // Students
        Route::post('/students',                    [DashboardController::class, 'studentsStore'])->name('students.store');
        Route::put('/students/{student}',           [DashboardController::class, 'studentsUpdate'])->name('students.update');
        Route::delete('/students/{student}',        [DashboardController::class, 'studentsDestroy'])->name('students.destroy');

        // Departments
        Route::post('/departments',                 [DashboardController::class, 'departmentsStore'])->name('departments.store');
        Route::delete('/departments/{department}',  [DashboardController::class, 'departmentsDestroy'])->name('departments.destroy');

        // Rooms
        Route::post('/rooms',                       [DashboardController::class, 'roomsStore'])->name('rooms.store');
        Route::put('/rooms/{room}',                 [DashboardController::class, 'roomsUpdate'])->name('rooms.update');
        Route::delete('/rooms/{room}',              [DashboardController::class, 'roomsDestroy'])->name('rooms.destroy');
    });

/*
|--------------------------------------------------------------------------
| Staff (role:staff)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:staff'])
    ->prefix('staff')->as('staff.')
    ->group(function () {
        Route::get('/', fn () => view('staff.index'))->name('index');
    });

/*
|--------------------------------------------------------------------------
| Student (role:student)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:student'])
    ->prefix('student')->as('student.')
    ->group(function () {
        Route::get('/', fn () => view('student.index'))->name('index');
    });

/*
|--------------------------------------------------------------------------
| Debug helper (optional)
|--------------------------------------------------------------------------
*/
Route::get('/csrf-check', function () {
    return response()->json([
        'csrf_token'  => csrf_token(),
        'has_session' => session()->has('_token'),
        'session_id'  => session()->getId(),
    ]);
});

require __DIR__ . '/auth.php';
