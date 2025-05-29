@extends('layouts.petugas_puskesmas')

@section('title', 'APK-Screening')

@section('content')

<!-- Bagian Welcome Card -->
<div class="row mb-8">
    <div class="col-md-12">
        <div class="container-fluid px-0">
            <div class="card card-round bg-white" style="width: 100%;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title mb-1">Welcome!</h3>
                        <p class="card-text text-muted">Selamat datang di dashboard APK-Screening. Anda dapat memantau data balita, statistik, dan lainnya di sini.</p>
                        <a href="#" class="btn btn-primary btn-round">
                            <i class="fas fa-rocket me-1"></i> Mulai Sekarang
                        </a>
                    </div>
                    <div class="d-none d-md-block">
                        <img src="{{ asset('image/doctor.png') }}" alt="Welcome Image" class="img-fluid" style="max-height: 150px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bagian Statistik -->
<div class="row">
    @php
        $stats = [
            [
                'icon' => 'fas fa-users', 
                'color' => 'primary', 
                'category' => 'Data Balita', 
                'value' => '1,294'
            ],
            [
                'icon' => 'fas fa-user-check', 
                'color' => 'primary', 
                'category' => 'Balita Normal', 
                'value' => '1,303'
            ],
            [
                'icon' => 'fas fa-user-shield', 
                'color' => 'primary', 
                'category' => 'Balita Stunting', 
                'value' => '1,345'
            ],
        ];
    @endphp
    
    @foreach ($stats as $stat)
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-{{ $stat['color'] }} bubble-shadow-small">
                                <i class="{{ $stat['icon'] }}"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">{{ $stat['category'] }}</p>
                                <h4 class="card-title">{{ $stat['value'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Bagian Grafik Statistik -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-round">
            <div class="card-header">
                <div class="card-head-row d-flex justify-content-between align-items-center">
                    <div class="card-title">Grafik Data Stunting</div>
                    <div class="card-tools">
                        <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                            <span class="btn-label">
                                <i class="fa fa-pencil"></i>
                            </span>
                            Export
                        </a>
                        <a href="#" class="btn btn-label-info btn-round btn-sm">
                            <span class="btn-label">
                                <i class="fa fa-print"></i>
                            </span>
                            Print
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container" style="position: relative; height: 375px; width: 100%">
                    <canvas id="statisticsChart"></canvas>
                </div>
                <div id="myChartLegend" class="d-flex justify-content-center mt-3"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        var ctx = document.getElementById('statisticsChart').getContext('2d');
        
        var statisticsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [
                    {
                        label: "Data Balita",
                        borderColor: "#1a73e8",
                        pointBackgroundColor: "#1a73e8",
                        pointRadius: 3,
                        pointStyle: 'circle',
                        backgroundColor: 'rgba(26, 115, 232, 0.1)',
                        fill: true,
                        borderWidth: 2,
                        tension: 0.4,
                        data: [542, 480, 510, 780, 895, 810, 1000, 1140, 1070, 1200, 1380, 1294]
                    },
                    {
                        label: "Balita Stunting",
                        borderColor: "#00b3ff",
                        pointBackgroundColor: "#00b3ff",
                        pointRadius: 3,
                        pointStyle: 'circle',
                        backgroundColor: 'rgba(0, 179, 255, 0.1)',
                        fill: true,
                        borderWidth: 2,
                        tension: 0.4,
                        data: [412, 460, 530, 590, 760, 720, 920, 1010, 1120, 1160, 1230, 1303]
                    },
                    {
                        label: "Balita Normal",
                        borderColor: "#28a745",
                        pointBackgroundColor: "#28a745",
                        pointRadius: 3,
                        pointStyle: 'circle',
                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                        fill: true,
                        borderWidth: 2,
                        tension: 0.4,
                        data: [450, 510, 580, 690, 745, 820, 950, 1100, 1170, 1250, 1310, 1345]
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endpush