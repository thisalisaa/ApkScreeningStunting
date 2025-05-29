<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Balita - {{ $balita->nama_balita }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            color: #000;
            margin: 20px;
            padding: 0;
            background-color: #fff;
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header-table {
            border-collapse: collapse;
            border: none;

        }

        .header-table td {
            border: none;

        }

        .title {
            width: 80%;
            text-align: left;
            padding-left: 50px;
        }


        .logo {
            width: 150px;
            margin-right: 20px;
        }

        .judul {
            flex-grow: 1;
            text-align: center;
        }

        .judul h1 {
            margin: 0;
            font-size: 18pt;
            line-height: 1.2;
        }

        .judul h2 {
            margin: 2px 0;
            font-size: 12pt;
            font-weight: normal;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table td {
            padding: 5px 8px;
            border: 1px solid #ddd;
            font-size: 11pt;
        }

        .label {
            width: 35%;
            font-weight: bold;
            background-color: #f2f2f2;
        }

        .section-header {
            background-color: #e0e0e0;
            font-weight: bold;
            text-align: left;
            padding: 6px;
            font-size: 11pt;
        }

        .footer {
            text-align: right;
            font-size: 9pt;
            margin-top: 15px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }

        @page {
            size: A4;
            margin: 1cm;
        }

        body {
            height: 95%;
        }
    </style>
</head>

<body>

    <table class="header-table">
        <tr>
            <td style="width: 80px;">
                <img src="{{ public_path('image/logo_indramayu.png') }}" width="150">
            </td>
            <td class="title">
                <h2>DATA BIODATA BALITA</h2>
                <p>Posyandu: Posyandu Anggrek</p>
                <p>Alamat: Jl Raya Balongan Kec Balongan</p>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td colspan="2" class="section-header">I. Data Balita</td>
        </tr>
        <tr>
            <td class="label">Nama Balita</td>
            <td>{{ $balita->nama_balita }}</td>
        </tr>
        <tr>
            <td class="label">NIK Balita</td>
            <td>{{ $balita->nik_balita }}</td>
        </tr>
        <tr>
            <td class="label">Tempat,Tanggal Lahir</td>
            <td>{{ $balita->tempat_lahir }} ,
                {{ \Carbon\Carbon::parse($balita->tanggal_lahir)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Jenis Kelamin</td>
            <td>{{ ucfirst($balita->jenis_kelamin) }}</td>
        </tr>
        <tr>
            <td class="label">Berat Badan Lahir</td>
            <td>{{ rtrim(rtrim($balita->berat_badan_lahir, '0'), '.') }} kg</td>
        </tr>
        <tr>
            <td class="label">Panjang Badan Lahir</td>
            <td>{{ rtrim(rtrim($balita->panjang_badan_lahir, '0'), '.') }} cm</td>
        </tr>
        <tr>
            <td class="label">Alamat</td>
            <td>{{ $balita->alamat }}</td>
        </tr>

        <tr>
            <td colspan="2" class="section-header">II. Data Orang Tua</td>
        </tr>
        <tr>
            <td class="label">Nama Ayah</td>
            <td>{{ $balita->orangTua->nama_ayah }}</td>
        </tr>
        <tr>
            <td class="label">Pekerjaan Ayah</td>
            <td>{{ $balita->orangTua->pekerjaan_ayah }}</td>
        </tr>
        <tr>
            <td class="label">Pendidikan Ayah</td>
            <td>{{ $balita->orangTua->pendidikan_ayah }}</td>
        </tr>
        <tr>
            <td class="label">Tinggi Badan Ayah</td>
            <td>{{ $balita->orangTua->tinggi_badan_ayah }} cm</td>
        </tr>
        <tr>
            <td class="label">Nama Ibu</td>
            <td>{{ $balita->orangTua->nama_ibu }}</td>
        </tr>
        <tr>
            <td class="label">Pekerjaan Ibu</td>
            <td>{{ $balita->orangTua->pekerjaan_ibu }}</td>
        </tr>
        <tr>
            <td class="label">Pendidikan Ibu</td>
            <td>{{ $balita->orangTua->pendidikan_ibu }}</td>
        </tr>
        <tr>
            <td class="label">Tinggi Badan Ibu</td>
            <td>{{ $balita->orangTua->tinggi_badan_ibu }} cm</td>
        </tr>
        <tr>
            <td class="label">Pendapatan Keluarga</td>
            <td>{{ $balita->orangTua->pendapatan_keluarga }}</td>
        </tr>
        <tr>
            <td class="label">No. Telepon</td>
            <td>{{ $balita->orangTua->no_telepon }}</td>
        </tr>

        <tr>
            <td colspan="2" class="section-header">III. Data Kesehatan</td>
        </tr>
        <tr>
            <td class="label">Riwayat Penyakit</td>
            <td>{{ $balita->dataKesehatan->riwayat_penyakit }}</td>
        </tr>
        @if ($balita->dataKesehatan->riwayat_penyakit == 'Ya')
            <tr>
                <td class="label">Keterangan</td>
                <td>{{ $balita->dataKesehatan->keterangan_riwayat_penyakit }}</td>
            </tr>
        @endif
        <tr>
            <td class="label">Alergi</td>
            <td>{{ $balita->dataKesehatan->alergi }}</td>
        </tr>
        @if ($balita->dataKesehatan->alergi == 'Ya')
            <tr>
                <td class="label">Keterangan</td>
                <td>{{ $balita->dataKesehatan->keterangan_alergi }}</td>
            </tr>
        @endif
        <tr>
            <td class="label">Rumah Bebas Asap Rokok</td>
            <td>{{ $balita->dataKesehatan->bebas_asap_rokok }}</td>
        </tr>
        <tr>
            <td class="label">Sumber Air Bersih</td>
            <td>{{ $balita->dataKesehatan->sumber_air_bersih }}</td>
        </tr>
    </table>

    <p class="footer">
        Dibuat pada: {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('d F Y H:i') }}<br>
        Dokumen ini dicetak secara otomatis untuk keperluan arsip dan laporan resmi.
    </p>
</body>

</html>
