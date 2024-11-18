<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

// home

Route::get('/', [LoginController::class, 'home']);

Route::get('/dashboard', function () {
    return view('staff.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');

// cadre
Route::get('admin/cadre', [AdminController::class, 'cadre'])->name('admin.cadre');
Route::get('/cadre_entry', [AdminController::class, 'cadre'])->name('cadre'); // entry
Route::post('/cadre/store', [AdminController::class, 'storeCadre'])->name('admin.cadre.store'); // cadre data
Route::delete('/cadre/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.cadre.destroy'); // cadre destroy


//office
Route::get('admin/office', [AdminController::class, 'office'])->name('admin.office');
Route::get('/office_entry', [AdminController::class, 'office'])->name('office'); // entry
Route::post('/office/store', [AdminController::class, 'storeOffice'])->name('admin.office.store'); // office data
Route::delete('/office/destroy/{id}', [AdminController::class, 'destroyOffice'])->name('admin.office.destroy'); // office destroy


// subject
Route::get('admin/subject', [AdminController::class, 'subject'])->name('admin.subject');
Route::get('/subject_entry', [AdminController::class, 'subject'])->name('subject'); // entry
Route::post('/subject/store', [AdminController::class, 'storeSubject'])->name('admin.subject.store'); // subject data
Route::delete('/subject/destroy/{id}', [AdminController::class, 'destroySubject'])->name('admin.subject.destroy'); // office destroy


//staff 

Route::get('/staff_entry', [StaffController::class, 'staff_entry'])->name('staff.staff');
Route::post('staff/store', [StaffController::class, 'store'])->name('staff.store');

Route::get('/staff/view/{id?}', [StaffController::class, 'view_detail'])->name('staff.view_detail');
Route::get('print_pdf/{id}', [StaffController::class, 'printPdf'])->name('staff.print_pdf');





// admin dashboard
Route::get('admin/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');


require __DIR__ . '/auth.php';
