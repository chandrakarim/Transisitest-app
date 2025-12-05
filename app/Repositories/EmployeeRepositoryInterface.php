<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Pagination\LengthAwarePaginator;

interface EmployeeRepositoryInterface
{
    public function getAll(): LengthAwarePaginator; // Ganti Collection dengan LengthAwarePaginator

    public function create(array $data): Employee;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

    public function findById(int $id): ?Employee;
}
