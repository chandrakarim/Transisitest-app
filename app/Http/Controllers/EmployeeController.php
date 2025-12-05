<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeesImport;

use App\Models\Employee;
use App\Models\Company;
use App\Http\Requests\EmployeeRequest;
use App\Repositories\EmployeeRepositoryInterface;
use Illuminate\Http\Request;

class EmployeeController extends Controller
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
        return view('admin.employees.index', compact('employees', 'companies'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk menambah employee dan mengirimkan daftar company
        $companies = Company::all(); // Ambil semua company
        //dd($companies);
        return view('admin.employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(EmployeeRequest $request)
    {
        $validated = $request->validated();
        // Simpan data employee
        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan detail employee
        $employee = $this->employeeRepository->findById($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menampilkan form edit employee
        $employee = $this->employeeRepository->findById($id);
        $companies = Company::all(); // Ambil semua company
        return view('admin.employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, string $id)
    {
        //dd($request->validated());
        // Validasi dan update data employee
        $data = $request->validated();
        $this->employeeRepository->update($id, $data);
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data employee
        $this->employeeRepository->delete($id);
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
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
}
