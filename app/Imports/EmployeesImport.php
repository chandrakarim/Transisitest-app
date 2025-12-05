<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Employee([
            'name' => $row['name'],      // Sesuaikan dengan nama kolom di file Excel
            'email' => $row['email'],    // Sesuaikan dengan nama kolom di file Excel
            'company_id' => $row['company_id'],  // Sesuaikan dengan nama kolom di file Excel
        ]);
    }
}

