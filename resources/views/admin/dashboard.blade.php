@extends('admin.layouts.master') <!-- Menggunakan layout admin -->

@section('menu')
@include('admin.layouts.menu') <!-- Menyertakan menu dari layout admin -->
@endsection

@section('navbar')
@include('admin.layouts.navbar') <!-- Menyertakan navbar dari layout admin -->
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Karyawan</h4>
                    <!-- Tombol Tambah Karyawan -->
                    <a href="{{ route('employees.create') }}" class="btn btn-primary float-left">Tambah Karyawan</a>

                    <!-- Form Import Excel di pojok kanan -->
                    <form action="{{ route('employees.importExcel') }}" method="POST" enctype="multipart/form-data" class="d-flex justify-content-end">
                        @csrf
                        <input type="file" name="file" required class="mr-3">
                        <button type="submit" class="btn btn-success">Import Excel</button>
                    </form>
                </div>
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Perusahaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->company->name }}</td>
                                <td>
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm mr-3">Edit</a>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mr-3">Hapus</button>
                                    </form>
                                    <!-- Tombol Export untuk PDF berdasarkan perusahaan terkait -->
                                    <a href="{{ route('companies.exportEmployeesPDF', $employee->company->id) }}" class="btn btn-primary btn-sm">Export to PDF</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $employees->links() }} <!-- Pagination -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection