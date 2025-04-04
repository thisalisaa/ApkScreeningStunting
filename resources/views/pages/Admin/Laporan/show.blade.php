@extends('layouts.admin')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.laporan') }}">Laporan</a></li>
    <li class="breadcrumb-item active">Detail Laporan Puskesmas</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Detail Data Stunting - Puskesmas Lohbener</h5>
                <a href="{{ route('admin.laporan') }}" class="btn btn-info">
                CANCEL
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card card-stats">
                        <div class="card-body">
                            <h6 class="card-category">Total Balita</h6>
                            <h3 class="card-title">445</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-stats">
                        <div class="card-body">
                            <h6 class="card-category">Prevalensi Stunting</h6>
                            <h3 class="card-title">28.1%</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Distribusi Usia Balita Stunting</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="ageChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Data per Desa</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Desa</th>
                                            <th>Stunting</th>
                                            <th>Normal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Lohbener</td>
                                            <td>45</td>
                                            <td>120</td>
                                        </tr>
                                        <tr>
                                            <td>Segeran</td>
                                            <td>32</td>
                                            <td>85</td>
                                        </tr>
                                        <tr>
                                            <td>Waru</td>
                                            <td>28</td>
                                            <td>75</td>
                                        </tr>
                                        <tr>
                                            <td>Anjatan</td>
                                            <td>20</td>
                                            <td>40</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           
        </div>
    </div>

    @push('scripts')
    <script>
        // Grafik distribusi usia
        const ageCtx = document.getElementById('ageChart').getContext('2d');
        new Chart(ageCtx, {
            type: 'bar',
            data: {
                labels: ['0-6 Bulan', '7-12 Bulan', '1-2 Tahun', '2-5 Tahun'],
                datasets: [{
                    label: 'Jumlah Stunting',
                    data: [15, 35, 45, 30],
                    backgroundColor: 'rgba(255, 99, 132, 0.7)'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    @endpush
@endsection