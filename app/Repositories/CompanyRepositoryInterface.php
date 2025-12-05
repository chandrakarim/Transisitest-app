<?php
namespace App\Repositories;

use App\Models\Company;
use Illuminate\Pagination\LengthAwarePaginator;

interface CompanyRepositoryInterface
{
    // Mengubah tipe kembalian menjadi LengthAwarePaginator
    public function getAll(): LengthAwarePaginator;

    public function create(array $data): Company;

    public function update(Company $company, array $data): bool;

    public function delete(Company $company): bool;

    public function findById(int $id): ?Company;
}
