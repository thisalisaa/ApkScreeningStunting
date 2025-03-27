@extends('layouts.petugas_kesehatan')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas.grafikpertumbuhan') }}">Grafik Pertumbuhan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail Grafik Pertumbuhan</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 mb-3"> 
        <div class="card card-round">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <img src="{{ asset('image/child.png') }}" alt="Foto Balita" class="rounded-circle" style="width: 50px; height: 50px;">
                        </div>
                        <div>
                            <h4 class="mb-1">Muhammad Faqih</h4>
                            <p class="mb-1">24 bulan (2 tahun)</p>
                            <p class="mb-0 text-muted">Balita ini memiliki pertumbuhan yang normal sesuai dengan usianya.</p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <button id="showTinggiBadan" class="btn btn-label-primary btn-round btn-sm me-2">
                            Tinggi Badan
                        </button>
                        <button id="showBeratBadan" class="btn btn-label-success btn-round btn-sm me-2">
                            Berat Badan
                        </button>
                        <button id="showLingkarKepala" class="btn btn-label-info btn-round btn-sm">
                            Lingkar Kepala
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card card-round">
            <div class="card-header">
                <div class="card-head-row d-flex justify-content-between align-items-center">
                    <div class="card-title">Grafik Pertumbuhan</div>
                    <div class="card-tools">
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('statisticsChart').getContext('2d');

        const bulan = [0, 6, 12, 18, 24, 30, 36, 42, 48, 54, 60]; 
        const tinggiBadan = [50, 67, 74, 80, 85, 89, 93, 96, 99, 102, 105]; 
        const beratBadan = [3.3, 7.5, 9.5, 11, 12.5, 13.5, 14.5, 15.5, 16.5, 17.5, 18.5];
        const lingkarKepala = [35, 43, 46, 47, 48, 49, 50, 50.5, 51, 51.5, 52]; 

        let statisticsChart = new Chart(ctx, {
            type: 'line', 
            data: {
                labels: bulan, 
                datasets: [
                    {
                        label: 'Tinggi Badan (cm)',
                        data: tinggiBadan,
                        borderColor: '#36A2EB', 
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', 
                        borderWidth: 2,
                        fill: true,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Usia (Bulan)',
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Nilai',
                        },
                        beginAtZero: true,
                    },
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                    },
                },
            },
        });

        function updateChart(dataset) {
            statisticsChart.data.datasets = [dataset];
            statisticsChart.update();
        }

        document.getElementById('showTinggiBadan').addEventListener('click', function () {
            updateChart({
                label: 'Tinggi Badan (cm)',
                data: tinggiBadan,
                borderColor: '#36A2EB',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderWidth: 2,
                fill: true,
            });
        });

        document.getElementById('showBeratBadan').addEventListener('click', function () {
            updateChart({
                label: 'Berat Badan (kg)',
                data: beratBadan,
                borderColor: '#FF6384',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderWidth: 2,
                fill: true,
            });
        });

        document.getElementById('showLingkarKepala').addEventListener('click', function () {
            updateChart({
                label: 'Lingkar Kepala (cm)',
                data: lingkarKepala,
                borderColor: '#4BC0C0',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
                fill: true,
            });
        });
    });
</script>
@endsection