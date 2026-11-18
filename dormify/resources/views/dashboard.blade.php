@extends('layouts.app')

@section('content')

<h2 style="color:#1f3c97; margin-bottom:25px;">
    👋 Selamat Datang, {{ auth()->user()->name }}
</h2>

<div style="display:grid; grid-template-columns:repeat(4, 1fr); gap:20px; margin-bottom:35px;">

    <div style="background:white; padding:25px; border-radius:18px;">
        <p>Total Laporan</p>
        <h1 style="color:#1f3c97;">{{ $total }}</h1>
    </div>

    <div style="background:white; padding:25px; border-radius:18px;">
        <p>Pending</p>
        <h1 style="color:orange;">{{ $pending }}</h1>
    </div>

    <div style="background:white; padding:25px; border-radius:18px;">
        <p>Diproses</p>
        <h1 style="color:#3b82f6;">{{ $diproses }}</h1>
    </div>

    <div style="background:white; padding:25px; border-radius:18px;">
        <p>Selesai</p>
        <h1 style="color:#10b981;">{{ $selesai }}</h1>
    </div>

</div>

<div style="display:grid; grid-template-columns:2fr 1fr; gap:25px;">

    <div style="background:white; padding:25px; border-radius:18px;">

        <h3 style="color:#1f3c97; margin-bottom:20px;">
            🆕 Laporan Terbaru
        </h3>

        <table>

            <tr>
                <th>No</th>
                <th>Nama Pengirim</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Asrama</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>

            @forelse($reports as $report)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        @if($report->is_anonymous)
                            Anonim
                        @else
                            {{ $report->sender_name ?? '-' }}
                        @endif
                    </td>

                    <td>
                        {{ $report->title }}
                    </td>

                    <td>
                        {{ $report->category->name ?? '-' }}
                    </td>

                    <td>
                        {{ $report->dormitory->name ?? '-' }}
                    </td>

                    <td>

                        @if($report->status == 'Pending')

                            <span style="
                                background:orange;
                                color:white;
                                padding:5px 10px;
                                border-radius:10px;
                            ">
                                Pending
                            </span>

                        @elseif($report->status == 'Diproses')

                            <span style="
                                background:#3b82f6;
                                color:white;
                                padding:5px 10px;
                                border-radius:10px;
                            ">
                                Diproses
                            </span>

                        @else

                            <span style="
                                background:#10b981;
                                color:white;
                                padding:5px 10px;
                                border-radius:10px;
                            ">
                                Selesai
                            </span>

                        @endif

                    </td>

                    <td>
                        {{ $report->created_at->format('d M Y') }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" style="text-align:center;">
                        Belum ada laporan.
                    </td>
                </tr>

            @endforelse

        </table>

    </div>

    <div style="background:white; padding:25px; border-radius:18px;">

        <h3 style="color:#1f3c97; margin-bottom:20px;">
            📌 Informasi Sistem
        </h3>

        @if(auth()->user()->role == 'admin')

            <p style="margin-bottom:15px;">
                Kamu login sebagai <b>Admin</b>.
            </p>

            <p style="margin-bottom:15px;">
                Admin dapat melihat semua laporan, mengubah status, memberi tanggapan, dan menghapus laporan.
            </p>

            <a href="/reports"
               class="btn"
               style="
                    display:block;
                    background:#1f3c97;
                    color:white;
                    padding:12px;
                    border-radius:10px;
                    text-align:center;
                    text-decoration:none;
                    margin-top:20px;
               ">

                Kelola Laporan

            </a>

        @else

            <p style="margin-bottom:15px;">
                Kamu login sebagai <b>User</b>.
            </p>

            <p style="margin-bottom:15px;">
                Kamu dapat membuat laporan dan melihat status laporan yang telah dikirim.
            </p>

            <a href="/reports/create"
               class="btn"
               style="
                    display:block;
                    background:#1f3c97;
                    color:white;
                    padding:12px;
                    border-radius:10px;
                    text-align:center;
                    text-decoration:none;
                    margin-top:20px;
               ">

                Buat Laporan

            </a>

        @endif

    </div>

</div>

@endsection