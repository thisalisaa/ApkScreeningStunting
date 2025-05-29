<div class="modal fade" id="editPuskesmasModal{{ $datapuskesmas->id }}" tabindex="-1" aria-labelledby="editPuskesmasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="editPuskesmasModalLabel">Edit Data Puskesmas</h5>
            </div>

            <form action="{{ route('admin.data-puskesmas.update', $datapuskesmas->id) }}" method="POST"
                id="formEditPuskesmas">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="nama_puskesmas" class="form-label">Nama Puskesmas</label>
                        <input type="text" class="form-control @error('nama_puskesmas') is-invalid @enderror"
                            id="nama_puskesmas" name="nama_puskesmas"
                            value="{{ old('nama_puskesmas', $datapuskesmas->nama_puskesmas) }}" required>
                        @error('nama_puskesmas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_kecamatan" class="form-label">Kecamatan</label>
                        <select class="form-select @error('id_kecamatan') is-invalid @enderror" id="id_kecamatan"
                            name="id_kecamatan" required>
                            <option value="" disabled
                                {{ old('id_kecamatan', $datapuskesmas->id_kecamatan) == '' ? 'selected' : '' }}>Pilih
                                Kecamatan</option>
                            @foreach ($kecamatans as $kecamatan)
                                <option value="{{ $kecamatan->id }}"
                                    {{ old('id_kecamatan', $datapuskesmas->id_kecamatan) == $kecamatan->id ? 'selected' : '' }}>
                                    {{ $kecamatan->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kecamatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_desa" class="form-label">Desa</label>
                        <select class="form-select @error('id_desa') is-invalid @enderror" id="id_desa" name="id_desa"
                            required>
                            @if (isset($desas))
                                @foreach ($desas as $desa)
                                    <option value="{{ $desa->id }}"
                                        {{ old('id_desa', $datapuskesmas->id_desa) == $desa->id ? 'selected' : '' }}>
                                        {{ $desa->name }}
                                    </option>
                                @endforeach
                            @else
                                <option value="" selected disabled>Pilih Desa</option>
                            @endif
                        </select>
                        @error('id_desa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn btn-warning text-white">UPDATE</button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- Javascript untuk ambil data desa sesuai kecamatan --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const kecamatanSelect = document.getElementById('id_kecamatan');
        const desaSelect = document.getElementById('id_desa');
    
        const selectedKecamatan = "{{ old('id_kecamatan', $datapuskesmas->id_kecamatan) }}";
        const selectedDesa = "{{ old('id_desa', $datapuskesmas->id_desa) }}";
    
        function loadDesa(kecamatanId, selectedDesaId = null) {
            desaSelect.innerHTML = '<option value="" disabled selected>Loading...</option>';
    
            fetch(`/admin/data-puskesmas/desa/${kecamatanId}`)
                .then(response => response.json())
                .then(data => {
                    desaSelect.innerHTML = '<option value="" disabled>Pilih Desa</option>';
                    if (data.length > 0) {
                        data.forEach(desa => {
                            const option = document.createElement('option');
                            option.value = desa.id;
                            option.text = desa.name;
                            if (desa.id == selectedDesaId) {
                                option.selected = true;
                            }
                            desaSelect.appendChild(option);
                        });
                    } else {
                        const option = document.createElement('option');
                        option.text = 'Desa tidak tersedia';
                        option.disabled = true;
                        desaSelect.appendChild(option);
                    }
                })
                .catch(error => {
                    desaSelect.innerHTML = '<option value="" disabled>Gagal memuat desa</option>';
                    console.error('Error:', error);
                });
        }
    
        // Saat ganti kecamatan
        kecamatanSelect.addEventListener('change', function () {
            const kecamatanId = this.value;
            loadDesa(kecamatanId);
        });
    
        // Saat load halaman (edit)
        if (selectedKecamatan) {
            loadDesa(selectedKecamatan, selectedDesa);
        }
    });
    </script>
    
