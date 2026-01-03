<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use Barryvdh\Snappy\Facades\SnappyPdf;
use App\Repositories\CompanyRepositoryInterface;

class CompanyController extends Controller
{
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {

        $this->companyRepository = $companyRepository;
    }

    public function index()
    {
        // Mengambil semua data perusahaan dengan pagination
        $companies = $this->companyRepository->getAll();
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(CompanyRequest $request)
    {
        $data = $request->validated();
        $data['logo'] = $this->uploadLogo($request);
        $this->companyRepository->create($data);

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function show(string $id)
    {
        $company = $this->companyRepository->findById($id);

        // Pastikan founded_date tidak null sebelum diproses
        $foundedDate = $company->founded_date ? $company->founded_date->format('Y') : 'Not Available';

        return view('admin.companies.show', compact('company', 'foundedDate'));
    }

    public function edit(string $id)
    {
        $company = $this->companyRepository->findById($id);
        return view('admin.companies.edit', compact('company'));
    }

    public function update(CompanyRequest $request, string $id)
    {
        // Ambil data yang tervalidasi
        $data = $request->validated();

        // Ambil instance company berdasarkan ID
        $company = $this->companyRepository->findById($id);

        // Cek apakah ada file logo yang di-upload
        if ($request->hasFile('logo')) {
            // Jika ada, upload logo baru
            $data['logo'] = $this->uploadLogo($request);
        } else {
            // Jika tidak ada logo yang di-upload, pertahankan logo lama
            $data['logo'] = $company->logo;  // Pertahankan logo lama
        }

        // Lakukan update data perusahaan
        $this->companyRepository->update($company, $data);

        // Redirect ke halaman daftar perusahaan dengan pesan sukses
        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id); // Mencari perusahaan berdasarkan ID

        // Menggunakan repository untuk menghapus
        $this->companyRepository->delete($company);

        return redirect()->route('companies.index')->with('success', 'Perusahaan berhasil dihapus');
    }

    // Fungsi untuk upload logo
    private function uploadLogo($request)
    {
        // Cek jika ada file logo yang di-upload
        if ($request->hasFile('logo')) {
            // Menyimpan logo baru ke folder 'company' di storage
            return $request->file('logo')->storeAs(
                'company',
                time() . '.' . $request->file('logo')->getClientOriginalExtension(),
                'public'
            );
        }
        return null;  // Jika tidak ada logo yang di-upload, kembalikan null
    }

    public function exportEmployeesPDF(Company $company)
    {
        // Pastikan perusahaan memiliki relasi employees
        $employees = $company->employees;

        // Cek apakah ada data karyawan
        if ($employees->isEmpty()) {
            return redirect()->back()->with('error', 'No employees found for this company.');
        }

        // Generate PDF dengan Snappy
        $pdf = SnappyPdf::loadView('admin.employees.pdf', compact('employees', 'company'));

        // Unduh PDF
        return $pdf->download('employees_for_' . $company->name . '.pdf');
    }

    public function select2(Request $request)
    {
        $page = $request->page ?? 1;
        $length = 5;

        $query = Company::query();

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $results = $query->paginate($length, ['*'], 'page', $page);

        return response()->json([
            'data' => $results->items(),
            'pagination' => [
                'more' => $results->hasMorePages()
            ]
        ]);
    }


    public function find(Request $request)
    {
        $company = Company::findOrFail($request->id);
        return response()->json($company);
    }
}
