<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Staff\StudentViewController;
use App\Http\Controllers\Student\StudentDashboardController;


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
| Post-login Redirect
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();
    if (!$user) return redirect()->route('login');

    if ($user->isAdmin()) return redirect()->route('admin.index');
    if ($user->isStaff()) return redirect()->route('staff.index');

    return redirect()->route('student.index');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')->as('admin.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::get('/export-plan-pdf', [DashboardController::class, 'exportPlanPdf'])
            ->name('export.pdf');

        // Students
        Route::post('/students', [DashboardController::class, 'studentsStore'])->name('students.store');
        Route::put('/students/{student}', [DashboardController::class, 'studentsUpdate'])->name('students.update');
        Route::delete('/students/{student}', [DashboardController::class, 'studentsDestroy'])->name('students.destroy');

        // Departments
        Route::post('/departments', [DashboardController::class, 'departmentsStore'])->name('departments.store');
        Route::delete('/departments/{department}', [DashboardController::class, 'departmentsDestroy'])->name('departments.destroy');

        // Rooms
        Route::post('/rooms', [DashboardController::class, 'roomsStore'])->name('rooms.store');
        Route::put('/rooms/{room}', [DashboardController::class, 'roomsUpdate'])->name('rooms.update');
        Route::delete('/rooms/{room}', [DashboardController::class, 'roomsDestroy'])->name('rooms.destroy');
    });

/*
|--------------------------------------------------------------------------
| Staff (Final)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:staff'])
    ->prefix('staff')->as('staff.')
    ->group(function () {

        Route::get('/', [\App\Http\Controllers\Staff\StudentViewController::class, 'dashboard'])
             ->name('index');

    });

/*
|--------------------------------------------------------------------------
| Student
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:student'])
    ->prefix('student')->as('student.')
    ->group(function () {
        Route::get('/', [\App\Http\Controllers\Student\StudentDashboardController::class, 'index'])
            ->name('index');
    });



require __DIR__ . '/auth.php';
