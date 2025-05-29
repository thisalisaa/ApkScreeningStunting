@extends('layouts.admin')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.data-posyandu') }}">Data Posyandu</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Posyandu</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-semibold mb-0">Tambah Data Posyandu</h5>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.data-posyandu.store') }}" method="POST">
                @csrf

                <!-- Nama Posyandu -->
                <div class="row mb-3">
                    <label for="nama_posyandu" class="col-sm-3 col-form-label">Nama Posyandu</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('nama_posyandu') is-invalid @enderror" id="nama_posyandu" name="nama_posyandu"
                            placeholder="Contoh: Posyandu Melati" value="{{ old('nama_posyandu') }}" required>
                        @error('nama_posyandu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Kecamatan -->
                <div class="row mb-3">
                    <label for="id_kecamatan" class="col-sm-3 col-form-label">Kecamatan</label>
                    <div class="col-sm-9">
                    <select class="form-select @error('id_kecamatan') is-invalid @enderror" id="id_kecamatan" name="id_kecamatan" required>
                        <option value="" selected disabled>Pilih Kecamatan</option>
                        @foreach ($kecamatans as $kecamatan)
                            <option value="{{ $kecamatan->id }}" {{ old('id_kecamatan') == $kecamatan->id ? 'selected' : '' }}>
                                {{ $kecamatan->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_kecamatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                </div>

                <!-- Desa -->
                <div class="row mb-3">
                    <label for="id_desa" class="col-sm-3 col-form-label">Desa</label>
                    <div class="col-sm-9">
                    <select class="form-select @error('id_desa') is-invalid @enderror" id="id_desa" name="id_desa" required>
                        <option value="" selected disabled>Pilih Desa</option>
                    </select>
                    @error('id_desa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>


                <!-- Puskesmas -->
                <div class="row mb-3">
                    <label for="id_puskesmas" class="col-sm-3 col-form-label">Puskesmas</label>
                    <div class="col-sm-9">
                        <select class="form-select @error('id_puskesmas') is-invalid @enderror" id="id_puskesmas" name="id_puskesmas" required>
                            <option value="" selected disabled>Pilih Puskesmas</option>
                            @foreach ($puskesmas as $item)
                                <option value="{{ $item->id }}" {{ old('id_puskesmas') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_puskesmas }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_puskesmas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Alamat -->
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row">
                    <div class="col-sm-9 offset-sm-3">
                        <a href="{{ route('admin.data-posyandu') }}" class="btn btn-info">CANCEL</a>
                        <button type="submit" class="btn btn-success">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.getElementById('id_kecamatan').addEventListener('change', function() {
        var kecamatanId = this.value;
    
        var desaSelect = document.getElementById('id_desa');
        desaSelect.innerHTML = '<option value="" selected disabled>Loading...</option>';
    
        if (kecamatanId) {
            fetch(`/admin/data-posyandu/desa/${kecamatanId}`)
                .then(response => response.json())
                .then(data => {
                    desaSelect.innerHTML = '<option value="" selected disabled>Pilih Desa</option>';
    
                    if (data.length > 0) {
                        data.forEach(desa => {
                            var option = document.createElement('option');
                            option.value = desa.id;
                            option.text = desa.name;
                            desaSelect.appendChild(option);
                        });
                    } else {
                        var option = document.createElement('option');
                        option.value = '';
                        option.text = 'Data desa tidak ditemukan';
                        desaSelect.appendChild(option);
                    }
                })
                .catch(error => {
                    console.log('Error fetching desa data:', error);
                    desaSelect.innerHTML = '<option value="" selected disabled>Gagal memuat desa</option>';
                });
        } else {
            desaSelect.innerHTML = '<option value="" selected disabled>Pilih Desa</option>';
        }
    });
</script>
@endpush
