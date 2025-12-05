<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository implements CompanyRepositoryInterface
{
    // Ambil semua data companies
    public function getAll(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Company::paginate(5); // Menampilkan 5 data per halaman
    }

    // Menambahkan company baru
    public function create(array $data): Company
    {
        return Company::create($data);
    }

    // Mengupdate data company
    public function update(Company $company, array $data): bool
    {
        return $company->update($data);
    }

    // Menghapus company
    public function delete(Company $company): bool
    {
        return $company->delete();
    }

    // Dapatkan company berdasarkan id
    public function findById(int $id): ?Company
    {
        return Company::find($id);
    }
}
