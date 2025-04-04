@extends('layouts.admin')

@section('title', 'APK-Screening - Data Stunting')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Laporan</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-title">Laporan Data Stunting</div>
                <div>
                    <button type="button" class="btn btn-danger">
                        <i class="fas fa-file-pdf"></i> EXPORT
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <label for="showEntries" class="me-2">Show</label>
                    <select class="form-select form-select-sm w-auto" id="showEntries">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="ms-2">entries</span>
                </div>

                <div class="input-group w-25">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari...">
                    <button class="btn btn-info" type="button" id="searchButton">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Puskesmas</th>
                            <th>Balita Stunting</th>
                            <th>Balita Normal</th>
                            <th>Total Balita</th>
                            <th>Prevalensi Stunting</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dummy Data -->
                        <tr>
                            <td>1</td>
                            <td>Puskesmas Lohbener</td>
                            <td>125</td>
                            <td>320</td>
                            <td>445</td>
                            <td>28.1%</td>
                            <td>
                            <a href="{{ route('admin.laporan.show') }}" class="btn btn-sm btn-primary" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Puskesmas Indramayu</td>
                            <td>98</td>
                            <td>412</td>
                            <td>510</td>
                            <td>19.2%</td>
                            <td>
                                <a href="{{ route('admin.laporan.show') }}" class="btn btn-sm btn-primary" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Puskesmas Jatibarang</td>
                            <td>87</td>
                            <td>285</td>
                            <td>372</td>
                            <td>23.4%</td>
                            <td>
                                <a href="{{ route('admin.laporan.show') }}" class="btn btn-sm btn-primary" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Puskesmas Kandanghaur</td>
                            <td>112</td>
                            <td>298</td>
                            <td>410</td>
                            <td>27.3%</td>
                            <td>
                                <a href="{{ route('admin.laporan.show') }}" class="btn btn-sm btn-primary" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Puskesmas Sliyeg</td>
                            <td>76</td>
                            <td>324</td>
                            <td>400</td>
                            <td>19.0%</td>
                            <td>
                                <a href="{{ route('admin.laporan.show') }}" class="btn btn-sm btn-primary" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Puskesmas Anjatan</td>
                            <td>134</td>
                            <td>356</td>
                            <td>490</td>
                            <td>27.3%</td>
                            <td>
                                <a href="{{ route('admin.laporan.show') }}" class="btn btn-sm btn-primary" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Puskesmas Balongan</td>
                            <td>92</td>
                            <td>408</td>
                            <td>500</td>
                            <td>18.4%</td>
                            <td>
                                <a href="{{ route('admin.laporan.show') }}" class="btn btn-sm btn-primary" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                Showing <span>1</span> to <span>7</span> of <span>7</span> entries
            </div>

            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-end">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item">
                        <a class="page-link text-primary" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection