<div class="modal fade" id="tambahFaktorModal" tabindex="-1" aria-labelledby="tambahFaktorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahFaktorModalLabel">Tambah Faktor Risiko</h5>
            </div>
            <form id="tambahFaktorForm" action="{{ route('admin.data-faktor.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kode_faktor" class="form-label">Kode Faktor</label>
                        <input type="text" name="kode_faktor" class="form-control" id="kode_faktor"
                            placeholder="Contoh: FR001">
                        @error('kode_faktor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="range_usia" class="form-label">Range Usia</label>
                        <select name="range_usia[]" id="range_usia" class="form-control" multiple required>
                            <option value="0-6"
                                {{ in_array('0-6', old('range_usia', $faktor->range_usia ?? [])) ? 'selected' : '' }}>0
                                - 6 bulan</option>
                            <option value="6-23"
                                {{ in_array('6-23', old('range_usia', $faktor->range_usia ?? [])) ? 'selected' : '' }}>6
                                - 23 bulan</option>
                            <option value="24-60"
                                {{ in_array('24-60', old('range_usia', $faktor->range_usia ?? [])) ? 'selected' : '' }}>
                                24 - 60 bulan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nama_faktor" class="form-label">Nama Faktor</label>
                        <input type="text" name="nama_faktor" class="form-control" id="nama_faktor">
                        @error('nama_faktor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn btn-success">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tambahFaktorForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(this);

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('Success:', response);
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data berhasil ditambahkan.",
                            icon: "success"
                        }).then(function() {
                            $('#tambahFaktorModal').modal('hide');
                            form[0].reset();
                            window.location.href = "{{ route('admin.data-faktor') }}";
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', xhr);
                        var errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                        var errorMessages = '';

                        if (errors) {
                            $.each(errors, function(key, value) {
                                errorMessages += value[0] + '<br>';
                            });
                        } else {
                            errorMessages = "Terjadi kesalahan pada server: " + error;
                        }

                        Swal.fire({
                            title: "Gagal!",
                            html: errorMessages,
                            icon: "error"
                        });
                    }
                });
            });
        });
    </script>
@endpush
