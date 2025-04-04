@extends('layouts.petugas_kesehatan')

@section('title', 'APK-Screening - Rekapitulasi')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Rekapitulasi</li>
@endsection

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="card-title">Rekapitulasi Status Gizi</div>
            <div class="d-flex align-items-center">
                <button class="btn btn-danger me-2 text-white" title="Export PDF">
                    <i class="fas fa-file-pdf"></i> PDF
                </button>
                <button class="btn btn-success me-2" title="Export Excel">
                    <i class="fas fa-file-excel"></i> EXCEL
                </button>
                <button class="btn btn-primary" title="Filter" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <i class="fas fa-filter"></i> FILTER
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <!-- Table 1: Rekapitulasi Status Gizi -->
        <div class="table-responsive mb-5">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 30%;">Kategori</th>
                        <th style="width: 20%;">Jumlah Balita</th>
                        <th style="width: 20%;">Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Stunting</td>
                        <td>15</td>
                        <td>25%</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Normal</td>
                        <td>40</td>
                        <td>66.67%</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Beresiko</td>
                        <td>5</td>
                        <td>8.33%</td>
                    </tr>
                    <tr class="table-secondary fw-bold">
                        <td colspan="2">Total</td>
                        <td>60</td>
                        <td>100%</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Table 2: Detail Status Gizi per Indikator -->
        <h5 class="mb-3">Detail Status Gizi per Indikator</h5>
        <div class="table-responsive mb-5">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th rowspan="2" style="width: 5%;">No</th>
                        <th rowspan="2" style="width: 20%;">Indikator</th>
                        <th colspan="3" style="width: 45%;">Kategori</th>
                        <th rowspan="2" style="width: 15%;">Jumlah Balita</th>
                        <th rowspan="2" style="width: 15%;">Persentase</th>
                    </tr>
                    <tr>
                        <th>Sangat Pendek/Pendek</th>
                        <th>Normal</th>
                        <th>Sangat Kurus/Kurus</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>TB/U (Tinggi Badan menurut Umur)</td>
                        <td>12</td>
                        <td>48</td>
                        <td>-</td>
                        <td>60</td>
                        <td>100%</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>BB/U (Berat Badan menurut Umur)</td>
                        <td>-</td>
                        <td>45</td>
                        <td>15</td>
                        <td>60</td>
                        <td>100%</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Table 3: Distribusi Berdasarkan Umur -->
        <h5 class="mb-3">Distribusi Status Gizi Berdasarkan Umur</h5>
        <div class="table-responsive mb-5">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Rentang Umur (bulan)</th>
                        <th style="width: 15%;">Total Balita</th>
                        <th style="width: 15%;">Stunting</th>
                        <th style="width: 15%;">Normal</th>
                        <th style="width: 15%;">Beresiko</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>0-6</td>
                        <td>8</td>
                        <td>1</td>
                        <td>6</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>7-12</td>
                        <td>10</td>
                        <td>2</td>
                        <td>7</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>13-24</td>
                        <td>15</td>
                        <td>4</td>
                        <td>10</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>25-36</td>
                        <td>12</td>
                        <td>3</td>
                        <td>8</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>37-48</td>
                        <td>9</td>
                        <td>3</td>
                        <td>5</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>49-60</td>
                        <td>6</td>
                        <td>2</td>
                        <td>4</td>
                        <td>0</td>
                    </tr>
                    <tr class="table-secondary fw-bold">
                        <td colspan="2">Total</td>
                        <td>60</td>
                        <td>15</td>
                        <td>40</td>
                        <td>5</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Table 4: Distribusi Berdasarkan Jenis Kelamin -->
        <h5 class="mb-3">Distribusi Status Gizi Berdasarkan Jenis Kelamin</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Jenis Kelamin</th>
                        <th style="width: 15%;">Total Balita</th>
                        <th style="width: 15%;">Stunting</th>
                        <th style="width: 15%;">Normal</th>
                        <th style="width: 15%;">Beresiko</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Laki-laki</td>
                        <td>32</td>
                        <td>9</td>
                        <td>20</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Perempuan</td>
                        <td>28</td>
                        <td>6</td>
                        <td>20</td>
                        <td>2</td>
                    </tr>
                    <tr class="table-secondary fw-bold">
                        <td colspan="2">Total</td>
                        <td>60</td>
                        <td>15</td>
                        <td>40</td>
                        <td>5</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Filter -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="filterBulan" class="form-label">Bulan</label>
                        <select class="form-select" id="filterBulan">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="filterTahun" class="form-label">Tahun</label>
                        <input type="number" class="form-control" id="filterTahun" min="2000" max="2099" value="{{ date('Y') }}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-bs-dismiss="modal">CANCEL</button>
                <button type="button" class="btn btn-primary">FILTER</button>
            </div>
        </div>
    </div>
</div>
@endsection