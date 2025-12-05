<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Employee extends Model
{
    //
    // Tentukan nama tabel yang digunakan
    protected $table = 'employees';

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'name',
        'email',
        'company_id'
    ];

    // Relasi: seorang karyawan bekerja di satu perusahaan
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Menentukan atribut yang harus diperlakukan sebagai tanggal
    protected $dates = ['created_at', 'updated_at'];
}
