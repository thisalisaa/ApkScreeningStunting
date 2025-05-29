@extends('layouts.petugas_posyandu')

@section('title', 'APK-Screening')

@section('content')

    <!-- Bagian Welcome Card -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="container-fluid px-0">
                <div class="card card-round bg-white" style="width: 100%;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="card-title mb-1">Selamat datang, {{ Auth::user()->nama }}!</h3>
                            <p class="card-text text-muted">
                                Gunakan dashboard ini untuk mencatat hasil pengukuran, memantau pertumbuhan balita, dan
                                melihat hasil screening.
                            </p>
                            <a href="{{ route('petugas-posyandu.data-pengukuran') }}" class="btn btn-primary btn-round">
                                <i class="fas fa-notes-medical me-1"></i> Mulai Sekarang
                            </a>
                        </div>

                        <div class="d-none d-md-block">
                            <img src="{{ asset('image/doctor.png') }}" alt="Welcome Image" class="img-fluid"
                                style="max-height: 150px;">
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
                    'value' => $totalBalita ?? '0',
                ],
                [
                    'icon' => 'fas fa-user-check',
                    'color' => 'primary',
                    'category' => 'Balita Normal',
                    'value' => $balitaNormal ?? '0',
                ],
                [
                    'icon' => 'fas fa-user-shield',
                    'color' => 'primary',
                    'category' => 'Balita Berisko',
                    'value' => $balitaBeresiko ?? '0',
                ],
                [
                    'icon' => 'fas fa-exclamation-triangle',
                    'color' => 'primary',
                    'category' => 'Balita Stunting',
                    'value' => $balitaStunting ?? '0',
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const normal = [450, 480, 500, 520, 540, 560, 580, 600, 620, 640, 660, 680];
        const berisiko = [100, 120, 140, 160, 180, 200, 220, 240, 260, 280, 300, 320];
        const stunting = [60, 80, 90, 110, 130, 140, 150, 160, 170, 180, 190, 200];

        // Hitung total per bulan dan cari nilai maksimum
        const totalPerBulan = normal.map((val, i) => val + berisiko[i] + stunting[i]);
        const maxY = Math.max(...totalPerBulan);
        const step = 100; // Atur agar tetap rapi
        const adjustedMaxY = Math.ceil(maxY / step) * step; // Bulatkan ke atas agar kelipatan 100

        const ctx = document.getElementById('statisticsChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [
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
                        data: normal
                    },
                    {
                        label: "Balita Berisiko",
                        borderColor: "#ffc107",
                        pointBackgroundColor: "#ffc107",
                        pointRadius: 3,
                        pointStyle: 'circle',
                        backgroundColor: 'rgba(255, 193, 7, 0.1)',
                        fill: true,
                        borderWidth: 2,
                        tension: 0.4,
                        data: berisiko
                    },
                    {
                        label: "Balita Stunting",
                        borderColor: "#dc3545",
                        pointBackgroundColor: "#dc3545",
                        pointRadius: 3,
                        pointStyle: 'circle',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        fill: true,
                        borderWidth: 2,
                        tension: 0.4,
                        data: stunting
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
                        suggestedMax: adjustedMaxY,
                        ticks: {
                            stepSize: step
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
                }
            }
        });
    });
</script>
@endpush


