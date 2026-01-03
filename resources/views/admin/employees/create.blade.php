@extends('admin.layouts.master')

@section('menu')
@include('admin.layouts.menu')
@endsection

@section('navbar')
@include('admin.layouts.navbar')
@endsection

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tambah Karyawan') }}</div>

                <div class="card-body">
                    <form action="{{ route('employees.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="company_id">Perusahaan</label>
                            <select id="company_id" name="company_id" class="form-control select2-ajax" required autocomplete="off"></select>
                        </div>
                        @error('company_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                </div>
                @push('scripts')
                <script>
                    $('#company_id').select2({
                        placeholder: '--Cari Nama Perusahaan--',
                        ajax: {
                            url: "{{ route('companies.select2') }}",
                            dataType: 'json',
                            delay: 300,
                            data: function(params) {
                                return {
                                    search: params.term || '',
                                    page: params.page || 1
                                };
                            },
                            processResults: function(data) {
                                return {
                                    results: $.map(data.data, function(item) {
                                        return {
                                            id: item.id,
                                            text: item.name
                                        }
                                    }),
                                    pagination: {
                                        more: data.pagination.more
                                    }
                                };
                            }
                        }
                    });

                    // **Jika validasi gagal → tampilkan data sebelumnya**
                    @if(old('company_id'))
                    var companyId = "{{ old('company_id') }}";
                    $.ajax({
                        url: "{{ route('companies.find') }}",
                        data: {
                            id: companyId
                        },
                        success: function(data) {
                            var option = new Option(data.name, data.id, true, true);
                            $('#company_id').append(option).trigger('change');
                        }
                    });
                    @endif
                </script>
                @endpush

                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection