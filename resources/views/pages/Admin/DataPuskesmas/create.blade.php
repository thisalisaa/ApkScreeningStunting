@extends('layouts.admin')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.data-puskesmas') }}">Data Puskesmas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Puskesmas</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-semibold mb-0">Tambah Data Puskesmas</h5>
            </div>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.data-puskesmas.store') }}" method="POST" id="formTambahPuskesmas">
                @csrf
                
                <div class="mb-3">
                    <label for="nama_puskesmas" class="form-label">Nama Puskesmas</label>
                    <input type="text" class="form-control" id="nama_puskesmas" name="nama_puskesmas" required>
                </div>

                <div class="mb-3">
                    <label for="id_kecamatan" class="form-label">Kecamatan</label>
                    <select class="form-select" id="id_kecamatan" name="id_kecamatan" required>
                        <option value="" selected disabled>Pilih Kecamatan</option>
                        @foreach($kecamatans as $kecamatan)
                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="id_desa" class="form-label">Desa</label>
                    <select class="form-select" id="id_desa" name="id_desa" required>
                        <option value="" selected disabled>Pilih Desa</option>
                    </select>
                </div>
                
               <div class="row">
                    <div class="col-sm-9 offset-sm-3">
                        <a href="{{ route('admin.data-puskesmas') }}" class="btn btn-info">CANCEL</a>
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
