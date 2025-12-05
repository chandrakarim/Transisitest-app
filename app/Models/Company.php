<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Company extends Model
{
    // Tentukan nama tabel yang digunakan
    protected $table = 'companies';

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'name',
        'email',
        'logo',
        'website'
    ];

    // Relasi: satu perusahaan memiliki banyak karyawan
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    // Menentukan atribut yang harus diperlakukan sebagai tanggal
    protected $dates = ['created_at', 'updated_at'];
}
