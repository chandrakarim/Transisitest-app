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
                    <h4>Daftar Perusahaan</h4>
                    <a href="{{ route('companies.create') }}" class="btn btn-primary float-right">Tambah Perusahaan</a>
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
                                <th>Logo</th>
                                <th>Website</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" class="img-fluid mb-2" style="width: 100px; height: 100px;">
                                </td>

                                <td><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></td>
                                <td>
                                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                    <!-- <a href="{{ route('companies.employees.index', $company->id) }}" class="btn btn-info btn-sm">Lihat Karyawan</a> -->

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $companies->links() }}<!-- Pagination -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
@include('admin.layouts.footer')
@endsection