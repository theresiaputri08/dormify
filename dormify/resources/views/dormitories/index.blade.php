@extends('layouts.app')

@section('content')

<h2 style="color:#1f3c97; margin-bottom:10px;">
    🏢 Informasi Gedung & Detail Kamar
</h2>

<p style="color:#666; margin-bottom:30px;">
    Data lengkap mengenai kapasitas dan distribusi kamar di asrama.
</p>

<div style="background:white; padding:25px; border-radius:15px; margin-bottom:30px;">
    <h3 style="color:#1f3c97; margin-bottom:20px;">
        📌 Ringkasan Kategori
    </h3>

    <table>
        <tr>
            <th>ID Gedung</th>
            <th>Kategori Asrama</th>
            <th>Alamat</th>
            <th>Total Kapasitas</th>
        </tr>

        <tr>
            <td>G-01</td>
            <td><strong>Asrama Putri</strong></td>
            <td>Jl. Ahmad Yani</td>
            <td>120 Mahasiswi</td>
        </tr>

        <tr>
            <td>G-02</td>
            <td><strong>Asrama Putra</strong></td>
            <td>Jl. HOS Cokroaminoto</td>
            <td>100 Mahasiswa</td>
        </tr>
    </table>
</div>

<div style="background:white; padding:25px; border-radius:15px; margin-bottom:30px;">
    <h3 style="color:#1f3c97; margin-bottom:20px;">
        🛏️ Detail Kamar: Asrama Putri
    </h3>

    <table>
        <tr>
            <th>Category</th>
            <th>Jumlah Kamar</th>
            <th>Kapasitas Kamar</th>
            <th>Fasilitas</th>
        </tr>

        <tr>
            <td>Single</td>
            <td>24</td>
            <td>1 Orang</td>
            <td>AC, Lemari, Meja Belajar</td>
        </tr>

        <tr>
            <td>Double</td>
            <td>39</td>
            <td>2 Orang</td>
            <td>AC, Lemari, Meja Belajar</td>
        </tr>
    </table>
</div>

<div style="background:white; padding:25px; border-radius:15px;">
    <h3 style="color:#1f3c97; margin-bottom:20px;">
        🛏️ Detail Kamar: Asrama Putra
    </h3>

    <table>
        <tr>
            <th>Category</th>
            <th>Jumlah Kamar</th>
            <th>Kapasitas Kamar</th>
            <th>Fasilitas</th>
        </tr>

        <tr>
            <td>Single</td>
            <td>20</td>
            <td>1 Orang</td>
            <td>Kipas, Lemari, Meja Belajar</td>
        </tr>

        <tr>
            <td>Double</td>
            <td>40</td>
            <td>2 Orang</td>
            <td>Kipas, Lemari, Meja Belajar</td>
        </tr>
    </table>
</div>

@endsection