<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAll(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Employee::paginate(5); // Menampilkan 5 data per halaman
    }


    public function create(array $data): Employee
    {
        return Employee::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $employee = Employee::find($id);
        return $employee ? $employee->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $employee = Employee::find($id);
        return $employee ? $employee->delete() : false;
    }

    public function findById(int $id): ?Employee
    {
        return Employee::find($id);
    }
}
