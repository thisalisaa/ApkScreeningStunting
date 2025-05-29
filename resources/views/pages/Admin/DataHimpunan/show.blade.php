@extends('layouts.admin')

@section('title', 'Detail Data Himpunan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.data-himpunan') }}">Data Himpunan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail Data Himpunan</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card card-round">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0 fw-bold">Detail Data Himpunan</h4>
                        <a href="{{ route('admin.data-himpunan') }}" class="btn btn-info">
                            <i class="ti ti-arrow-left"></i> CANCEL
                        </a>
                    </div>

                    <hr>

                    <h5 class="fw-bold">Informasi Himpunan</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered bg-light">
                            <tbody>
                                <tr>
                                    <th class="w-50">Faktor Risiko Stunting</th>
                                    <td>{{ $dataHimpunan->faktor->nama_faktor }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Himpunan</th>
                                    <td>{{ $dataHimpunan->nama_himpunan }}</td>
                                </tr>
                                <tr>
                                    <th>Satuan</th>
                                    <td>{{ $dataHimpunan->satuan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tipe Fungsi</th>
                                    <td>{{ ucfirst($dataHimpunan->tipe_fungsi) }}</td>
                                </tr>
                                <tr>
                                    <th>Tipe Input</th>
                                    <td>{{ ucfirst($dataHimpunan->tipe_input) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h5 class="fw-bold mt-4">Parameter Fungsi</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered bg-light">
                            <tbody>
                                <tr>
                                    <th class="w-50">Batas Bawah</th>
                                    <td>{{ $dataHimpunan->batas_bawah }}</td>
                                </tr>
                                <tr>
                                    <th>Batas Tengah 1</th>
                                    <td>{{ $dataHimpunan->batas_tengah1 }}</td>
                                </tr>
                                @if($dataHimpunan->tipe_fungsi === 'trapesium')
                                <tr>
                                    <th>Batas Tengah 2</th>
                                    <td>{{ $dataHimpunan->batas_tengah2 }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th>Batas Atas</th>
                                    <td>{{ $dataHimpunan->batas_atas }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
