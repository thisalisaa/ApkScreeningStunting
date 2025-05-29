<div class="modal fade" id="editFaktorModal" tabindex="-1" aria-labelledby="editFaktorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFaktorModalLabel">Edit Faktor Resiko</h5>
            </div>
            <form id="editFaktorForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_kode_faktor" class="form-label">Kode Faktor</label>
                        <input type="text" class="form-control" id="edit_kode_faktor" name="kode_faktor">
                        @error('kode_faktor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="edit_nama_faktor" class="form-label">Nama Faktor</label>
                        <input type="text" class="form-control" id="edit_nama_faktor" name="nama_faktor">
                        @error('nama_faktor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.btn-edit-faktor');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const kode = this.dataset.kode;
                    const nama = this.dataset.nama;

                    document.getElementById('edit_id').value = id;
                    document.getElementById('edit_kode_faktor').value = kode;
                    document.getElementById('edit_nama_faktor').value = nama;

                    const formAction = `/admin/data-faktor/update/${id}`;
                    document.getElementById('editFaktorForm').action = formAction;
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('#editFaktorForm').submit(function(e) {
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
                        console.log('Success update:', response);
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data berhasil diperbarui.",
                            icon: "success"
                        }).then(function() {
                            $('#editFaktorModal').modal('hide');
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
