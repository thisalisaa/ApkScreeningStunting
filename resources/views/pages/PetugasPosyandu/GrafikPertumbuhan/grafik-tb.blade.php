@extends('layouts.petugas_posyandu')

@section('title', 'Grafik Pertumbuhan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas-posyandu.grafik-pertumbuhan') }}">Grafik Pertumbuhan</a></li>
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
                                <img src="{{ asset('image/child.png') }}" alt="Foto Balita" class="rounded-circle"
                                    style="width: 50px; height: 50px;">
                            </div>
                            <div>
                                <h4 class="mb-1">{{ $balita->nama_balita }}</h4>
                            </div>
                        </div>

                        <div class="d-flex">
                            <a href="{{ route('petugas-posyandu.showGrafikTinggiBadan', $balita->id) }}"
                                class="btn btn-label-primary btn-round btn-sm me-2">
                                Tinggi Badan
                            </a>
                            <a href="{{ route('petugas-posyandu.showGrafikBeratBadan', $balita->id) }}"
                                class="btn btn-label-success btn-round btn-sm me-2">
                                Berat Badan
                            </a>
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
                    <div class="chart-container" style="position: relative; height: 500px; width: 100%;">
                        <canvas id="dataPertumbuhan"></canvas>
                    </div>
                    <div id="myChartLegend" class="d-flex justify-content-center mt-3"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const dataPertumbuhan = @json($standar);
        const dataPengukuran = @json($pengukuran);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const labels = dataPertumbuhan.map(item => item.usia);

        const ctx = document.getElementById('dataPertumbuhan').getContext('2d');


        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'SD3',
                        data: dataPertumbuhan.map(item => item.SD3),
                        borderColor: 'black',
                        fill: false,
                        pointRadius: 0,
                        borderWidth: 2
                    },
                    {
                        label: 'SD2',
                        data: dataPertumbuhan.map(item => item.SD2),
                        borderColor: 'red',
                        fill: false,
                        pointRadius: 0,
                        borderWidth: 2
                    },
                    {
                        label: 'SD0',
                        data: dataPertumbuhan.map(item => item.SD0),
                        borderColor: '#2ecc71',
                        fill: false,
                        pointRadius: 0,
                        borderWidth: 2
                    },
                    {
                        label: 'SD2-',
                        data: dataPertumbuhan.map(item => item.SD2neg),
                        borderColor: 'red',
                        fill: false,
                        pointRadius: 0,
                        borderWidth: 2
                    },
                    {
                        label: 'SD3-',
                        data: dataPertumbuhan.map(item => item.SD3neg),
                        borderColor: 'black',
                        fill: false,
                        pointRadius: 0,
                        borderWidth: 2
                    },
                    {
                        label: 'Hasil Pengukuran',
                        data: dataPengukuran.map(item => ({
                            x: item.usia_bulan,
                            y: item.tinggi_badan
                        })),
                        borderColor: '#3498db',
                        backgroundColor: '#3498db',
                        borderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        fill: false,
                        tension: 0.1,
                        showLine: true
                    },



                ]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'nearest',
                    intersect: false
                },
                plugins: {
                    tooltip: {
                        enabled: true,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.formattedValue + ' cm';
                            }
                        }
                    }
                },

                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Usia (bulan)'
                        },
                        min: 0,
                        max: 24
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Tinggi Badan (cm)'
                        },
                        min: 45,
                        max: 95,
                        ticks: {
                            stepSize: 5
                        }
                    }
                }
            }
        });
    </script>


@endsection
