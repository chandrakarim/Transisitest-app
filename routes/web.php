<?php

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminDashboardController;

// Menggunakan Auth::routes() untuk autentikasi standar Laravel
Auth::routes([
    'register' => false, // Nonaktifkan registrasi jika hanya admin yang bisa login
    'reset' => false, // Nonaktifkan reset password jika tidak diperlukan
]);

// Halaman utama (untuk admin redirect langsung ke dashboard)
Route::get('/', function () {
    return redirect()->route('admin.dashboard'); // Redirect langsung ke dashboard admin setelah login
});

// Rute untuk halaman Home yang diakses oleh user biasa
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rute untuk admin yang dilindungi dengan middleware 'auth' dan 'admin'
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Halaman dashboard untuk admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Rute admin lainnya dapat ditambahkan di sini
    // Contoh: Route::get('/users', [AdminController::class, 'users'])->name('admin.users');

    // Rute CRUD untuk companies dan employees
    Route::get('companies/index', [CompanyController::class, 'index'])->name('companies.index'); // Halaman daftar perusahaan
    Route::get('companies/create', [CompanyController::class, 'create'])->name('companies.create'); // Halaman tambah perusahaan
    Route::post('companies', [CompanyController::class, 'store'])->name('companies.store'); // Proses menyimpan perusahaan
    Route::get('/companies/select2', [CompanyController::class, 'select2'])
        ->name('companies.select2');
    Route::get('/companies/find', [CompanyController::class, 'find'])
        ->name('companies.find');

    Route::get('companies/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit'); // Halaman edit perusahaan
    Route::put('companies/{company}', [CompanyController::class, 'update'])->name('companies.update'); // Proses update perusahaan
    Route::delete('companies/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy'); // Proses hapus perusahaan
    // Route::get('companies/{companyId}/export-pdf', [CompanyController::class, 'exportPDF'])->name('companies.exportPDF');
    // Rute untuk melihat daftar karyawan berdasarkan ID perusahaan
    Route::get('companies/{company}/employees', [EmployeeController::class, 'index'])->name('companies.employees.index');

    // Rute untuk mengekspor PDF data karyawan
    Route::get('companies/{company}/employees/export-pdf', [CompanyController::class, 'exportEmployeesPDF'])->name('companies.exportEmployeesPDF');
    //Route::post('employees/import', [EmployeeController::class, 'importExcel'])->name('employees.importExcel');

    // Rute CRUD untuk companies dan employees
    Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index'); // Halaman daftar karyawan
    Route::get('employees/create', [EmployeeController::class, 'create'])->name('employees.create'); // Halaman tambah karyawan
    Route::post('employees', [EmployeeController::class, 'store'])->name('employees.store'); // Proses menyimpan karyawan
    Route::get('employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit'); // Halaman edit karyawan
    Route::put('employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update'); // Proses update karyawan
    Route::delete('employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy'); // Proses hapus karyawan
    Route::post('employees/import', [EmployeeController::class, 'importExcel'])->name('employees.importExcel');
});
