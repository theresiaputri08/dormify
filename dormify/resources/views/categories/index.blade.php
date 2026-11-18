@extends('layouts.app')

@section('content')

<h2 style="color:#1f3c97; margin-bottom:30px;">
    📁 Kategori Laporan
</h2>

<div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:20px;">

    <div style="background:white; padding:25px; border-radius:15px;">
        <h3>🔧 Fasilitas</h3>
        <p>Untuk laporan kerusakan AC, lampu, kamar mandi, kasur, lemari, meja, dan fasilitas lainnya.</p>
    </div>

    <div style="background:white; padding:25px; border-radius:15px;">
        <h3>🛡️ Keamanan</h3>
        <p>Untuk laporan kehilangan barang, keributan, tamu mencurigakan, atau gangguan keamanan.</p>
    </div>

    <div style="background:white; padding:25px; border-radius:15px;">
        <h3>🧹 Kebersihan</h3>
        <p>Untuk laporan sampah menumpuk, kamar mandi kotor, area asrama tidak bersih, dan sejenisnya.</p>
    </div>

    <div style="background:white; padding:25px; border-radius:15px;">
        <h3>📌 Lainnya</h3>
        <p>Untuk laporan lain yang tidak termasuk fasilitas, keamanan, atau kebersihan.</p>
    </div>

</div>

@endsection