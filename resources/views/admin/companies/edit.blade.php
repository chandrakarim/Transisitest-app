@extends('admin.layouts.master') <!-- Menggunakan layout admin -->

@section('menu')
    @include('admin.layouts.menu') <!-- Menyertakan menu dari layout admin -->
@endsection

@section('navbar')
    @include('admin.layouts.navbar') <!-- Menyertakan navbar dari layout admin -->
@endsection

@section('content')
<div class="container mt-4"> <!-- Added margin-top to avoid header collision -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Perusahaan') }}</div>

                <div class="card-body">
                    <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nama Perusahaan -->
                        <div class="form-group">
                            <label for="name">Nama Perusahaan</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $company->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Email Perusahaan -->
                        <div class="form-group">
                            <label for="email">Email Perusahaan</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $company->email) }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Logo Perusahaan -->
                        <div class="form-group">
                            <label for="logo">Logo Perusahaan</label><br>
                            @if($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" class="img-fluid mb-2" style="width: 100px; height: 100px;">
                                <br>
                            @endif
                            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/png,image/jpeg">
                            @error('logo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Website -->
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="url" name="website" class="form-control @error('website') is-invalid @enderror" value="{{ old('website', $company->website) }}" required>
                            @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Submit Button with margin-top -->
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
