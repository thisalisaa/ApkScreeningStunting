@extends('layouts.admin')

@section('title', 'APK-Screening')

@section('content')

<!-- Welcome Card -->
<div class="row mb-8">
    <div class="col-md-12">
        <div class="container-fluid px-0">
            <div class="card card-round bg-white" style="width: 100%;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title mb-1">Welcome, Admin!</h3>
                        <p class="card-text text-muted">Selamat Datang di Dashboard Admin. Lihat laporan, kelola pengguna, dan optimalkan sistem!</p>
                    </div>
                    <div class="d-none d-md-block">
                        <img src="{{ asset('image/doctor.png') }}" alt="Welcome Image" class="img-fluid" style="max-height: 150px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row">
    <!-- Puskesmas Data -->
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center bg-primary bubble-shadow-small rounded-3">
                            <i class="fas fa-hospital text-white"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Puskesmas</p>
                            <h4 class="card-title">24</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Data -->
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center bg-primary bubble-shadow-small rounded-3">
                            <i class="fas fa-users-cog text-white"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Data User</p>
                            <h4 class="card-title">142</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stunting Cases -->
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center bg-primary bubble-shadow-small rounded-3">
                            <i class="fas fa-user-shield text-white"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Kasus Stunting</p>
                            <h4 class="card-title">1,303</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Normal Cases -->
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center bg-primary bubble-shadow-small rounded-3">
                            <i class="fas fa-user-check text-white"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Balita Normal</p>
                            <h4 class="card-title">3,145</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Data Section -->
<div class="row mt-4">
   <!-- Distribution Chart Card -->
<div class="col-md-6">
    <div class="card card-round shadow-sm">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Distribusi Kasus Stunting</h5>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="chartDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="chartDropdown">
                        <li><h6 class="dropdown-header">Tampilan Data</h6></li>
                        <li>
                            <select id="timeFilter" class="form-select form-select-sm mx-2 w-auto">
                                <option value="yearly">Tahunan</option>
                                <option value="monthly">Bulanan</option>
                            </select>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><h6 class="dropdown-header">Ekspor</h6></li>
                        <li><a class="dropdown-item" href="#" id="exportPNG"><i class="fas fa-image me-2"></i>Gambar (PNG)</a></li>
                        <li><a class="dropdown-item" href="#" id="exportCSV"><i class="fas fa-file-csv me-2"></i>Data (CSV)</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="chart-container" style="position: relative; height: 300px;">
                <canvas id="stuntingTrendChart"></canvas>
            </div>
            
            <!-- Legend -->
            <div class="chart-legend mt-3 d-flex justify-content-center flex-wrap" id="chartLegend"></div>
            
            <!-- Summary Cards -->
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="card card-sm bg-light-danger">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <div class="bg-danger rounded-circle p-2 me-2">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold">Kasus Tertinggi</p>
                                    <h6 class="mb-0" id="highestCase">Puskesmas A (120)</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-sm bg-light-success">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <div class="bg-success rounded-circle p-2 me-2">
                                    <i class="fas fa-check-circle text-white"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold">Perbaikan Terbaik</p>
                                    <h6 class="mb-0" id="bestImprovement">Puskesmas C (-25%)</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Recent Users -->
    <div class="col-md-6">
        <div class="card card-round">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Petugas Terbaru</div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Puskesmas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Dr. Siti Aisyah</td>
                                <td>aisyah@puskesmas.id</td>
                                <td>Puskesmas Lohbener</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Dr. Budi Santoso</td>
                                <td>budi@puskesmas.id</td>
                                <td>Puskesmas Jatibarang</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sample Data
        const yearlyData = {
            labels: ['2020', '2021', '2022', '2023'],
            datasets: [
                {
                    label: 'Kasus Stunting',
                    data: [450, 380, 320, 280],
                    backgroundColor: 'rgba(220, 53, 69, 0.8)',
                    borderColor: 'rgba(220, 53, 69, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Balita Normal',
                    data: [1200, 1350, 1420, 1500],
                    backgroundColor: 'rgba(25, 135, 84, 0.8)',
                    borderColor: 'rgba(25, 135, 84, 1)',
                    borderWidth: 1
                }
            ]
        };

        const monthlyData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [
                {
                    label: 'Kasus Stunting 2023',
                    data: [25, 28, 22, 20, 18, 15, 23, 25, 20, 18, 15, 10],
                    backgroundColor: 'rgba(220, 53, 69, 0.8)',
                    borderColor: 'rgba(220, 53, 69, 1)',
                    borderWidth: 1,
                    type: 'line',
                    tension: 0.3,
                    fill: false
                }
            ]
        };

        // Chart Configuration
        const config = {
            type: 'bar',
            data: yearlyData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 12,
                            padding: 20,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${context.raw} kasus`;
                            }
                        }
                    },
                    datalabels: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Kasus'
                        },
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    intersect: false
                }
            },
            plugins: [ChartDataLabels]
        };

        // Initialize Chart
        const ctx = document.getElementById('stuntingTrendChart').getContext('2d');
        const stuntingChart = new Chart(ctx, config);

        // Time Filter Handler
        document.getElementById('timeFilter').addEventListener('change', function() {
            if(this.value === 'yearly') {
                stuntingChart.data = yearlyData;
                stuntingChart.options.scales.x.title = { display: false };
                document.getElementById('highestCase').textContent = 'Puskesmas A (120)';
                document.getElementById('bestImprovement').textContent = 'Puskesmas C (-25%)';
            } else {
                stuntingChart.data = monthlyData;
                stuntingChart.options.scales.x.title = { 
                    display: true, 
                    text: 'Bulan (2023)' 
                };
                document.getElementById('highestCase').textContent = 'Februari (28 kasus)';
                document.getElementById('bestImprovement').textContent = 'November (-33%)';
            }
            stuntingChart.update();
        });

        // Export Handlers
        document.getElementById('exportPNG').addEventListener('click', function(e) {
            e.preventDefault();
            const url = stuntingChart.toBase64Image();
            const link = document.createElement('a');
            link.href = url;
            link.download = 'distribusi-stunting.png';
            link.click();
        });

        document.getElementById('exportCSV').addEventListener('click', function(e) {
            e.preventDefault();
            // Implement CSV export logic here
            alert('Export CSV functionality would be implemented here');
        });
    });
</script>
@endpush

@endsection