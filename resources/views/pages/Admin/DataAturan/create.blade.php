@extends('layouts.admin')

@section('title', 'Tambah Data Aturan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.data-aturan') }}">Data Aturan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Data Aturan</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tambah Data Aturan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.data-aturan.store') }}" method="POST">
            @csrf

            {{-- Kode Aturan --}}
            <div class="row mb-3">
                <label for="kode_aturan" class="col-sm-3 col-form-label">Kode Aturan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('kode_aturan') is-invalid @enderror" id="kode_aturan" name="kode_aturan" value="{{ old('kode_aturan', '') }}" required>
                    @error('kode_aturan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Range Usia --}}
            <div class="row mb-3">
                <label for="range_usia" class="col-sm-3 col-form-label">Range Usia</label>
                <div class="col-sm-9">
                    <select name="range_usia" id="range_usia" class="form-control @error('range_usia') is-invalid @enderror" required>
                        <option value="" disabled {{ old('range_usia') ? '' : 'selected' }}>Pilih Range Usia</option>
                        <option value="0-6" {{ old('range_usia') == '0-6' ? 'selected' : '' }}>0–6 bulan</option>
                        <option value="6-23" {{ old('range_usia') == '6-23' ? 'selected' : '' }}>6–23 bulan</option>
                        <option value="24-60" {{ old('range_usia') == '24-60' ? 'selected' : '' }}>24–60 bulan</option>
                    </select>
                    @error('range_usia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Faktor Berdasarkan Usia --}}
            @if(isset($faktors) && is_array($faktors))
                @foreach($faktors as $faktor)
                    @if(is_object($faktor) && isset($faktor->kode_faktor))
                    <div class="row mb-3 faktor-item"
     data-range-usia="{{ trim($faktor->range_usia ?? '') }}"
     style="display: none;">

                            <label for="{{ $faktor->kode_faktor }}" class="col-sm-3 col-form-label">{{ $faktor->nama_faktor ?? '' }}</label>
                            <div class="col-sm-9">
                                <select class="form-control @error($faktor->kode_faktor) is-invalid @enderror" id="{{ $faktor->kode_faktor }}" name="{{ $faktor->kode_faktor }}">
                                    <option value="" selected disabled>Pilih {{ $faktor->nama_faktor ?? '' }}</option>
                                    @if(isset($faktor->himpunanFuzzy) && is_iterable($faktor->himpunanFuzzy))
                                        @foreach($faktor->himpunanFuzzy as $himpunan)
                                            @if(is_object($himpunan) && isset($himpunan->nama_himpunan))
                                                <option value="{{ $himpunan->nama_himpunan }}" {{ old($faktor->kode_faktor) == $himpunan->nama_himpunan ? 'selected' : '' }}>
                                                    {{ ucfirst($himpunan->nama_himpunan) }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                @error($faktor->kode_faktor)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif

            {{-- Keputusan --}}
            <div class="row mb-3">
                <label for="keputusan" class="col-sm-3 col-form-label">Keputusan</label>
                <div class="col-sm-9">
                    <select class="form-control @error('keputusan') is-invalid @enderror" id="keputusan" name="keputusan" required>
                        <option value="" disabled selected>Pilih Keputusan</option>
                        <option value="stunting" {{ old('keputusan') == 'stunting' ? 'selected' : '' }}>Stunting</option>
                        <option value="beresiko" {{ old('keputusan') == 'beresiko' ? 'selected' : '' }}>Beresiko</option>
                        <option value="normal" {{ old('keputusan') == 'normal' ? 'selected' : '' }}>Normal</option>
                    </select>
                    @error('keputusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-sm-9 offset-sm-3">
                    <a href="{{ route('admin.data-aturan') }}" class="btn btn-info">CANCEL</a>
                    <button type="submit" class="btn btn-success">SIMPAN</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const usiaSelect = document.getElementById('range_usia');
        const faktorItems = document.querySelectorAll('.faktor-item');

function filterFaktorByUsia(range) {
    faktorItems.forEach(item => {
        const itemUsia = item.getAttribute('data-range-usia')?.trim();
        if (itemUsia == range.trim()) {
            item.style.display = 'flex';
            const select = item.querySelector('select');
            if (select) select.setAttribute('required', 'required');
        } else {
            item.style.display = 'none';
            const select = item.querySelector('select');
            if (select) {
                select.value = '';
                select.removeAttribute('required');
            }
        }
    });
}

        usiaSelect.addEventListener('change', function () {
            filterFaktorByUsia(this.value);
        });

        // Initialize on page load
        if (usiaSelect.value) {
            filterFaktorByUsia(usiaSelect.value);
        }
    });
</script>
@endpush