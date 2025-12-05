<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeesImport;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Repositories\EmployeeRepositoryInterface;

class AdminDashboardController extends Controller
{
    protected $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::paginate(5); 
        $companies = Company::all(); 
        return view('admin.dashboard', compact('employees', 'companies'));
    }
    public function importExcel(Request $request)
    {
        // Validasi bahwa file yang diupload adalah file Excel dengan ekstensi xlsx atau csv
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048',
        ]);

        // Menangani proses import menggunakan Laravel Excel
        Excel::import(new EmployeesImport, $request->file('file'));

        // Mengembalikan ke halaman employees dengan pesan sukses
        return redirect()->route('employees.index')->with('success', 'Data employees berhasil diimport.');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
