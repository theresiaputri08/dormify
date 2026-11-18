@extends('layouts.app')

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">

    <h2 style="color:#1f3c97;">
        @if(auth()->user()->role == 'admin')
            📋 Kelola Laporan
        @else
            📋 Laporan Saya
        @endif
    </h2>

    @if(auth()->user()->role != 'admin')
        <a href="/reports/create"
            class="btn"
            style="background:#1f3c97; color:white; padding:12px 20px; border-radius:10px; text-decoration:none; font-weight:bold;">
            + Buat Laporan
        </a>
    @endif

</div>

@if(session('success'))
    <div style="background:#dcfce7; color:#166534; padding:15px; border-radius:10px; margin-bottom:20px;">
        {{ session('success') }}
    </div>
@endif

@if(auth()->user()->role == 'admin')
    <form action="/reports" method="GET" style="margin-bottom:20px; display:flex; gap:10px;">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="Cari judul, kategori, asrama, atau status..."
               class="form-control"
               style="flex:1; padding:12px; border:1px solid #ddd; border-radius:10px;">

        <select name="status"
                class="form-select"
                style="width:180px; padding:12px; border:1px solid #ddd; border-radius:10px;">
            <option value="">Semua Status</option>
            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
        </select>

        <button type="submit"
                class="btn"
                style="background:#1f3c97; color:white; border:none; padding:12px 20px; border-radius:10px; cursor:pointer;">
            Filter
        </button>

        @if(request('search') || request('status'))
            <a href="/reports"
               class="btn"
               style="background:#777; color:white; padding:12px 20px; border-radius:10px; text-decoration:none;">
                Reset
            </a>
        @endif
    </form>
@endif

<table>
    <tr>
        <th>No</th>

        @if(auth()->user()->role == 'admin')
            <th>Nama Pengirim</th>
        @endif

        <th>Judul</th>
        <th>Kategori</th>
        <th>Asrama</th>
        <th>Status</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>

    @forelse($reports as $report)
        <tr>
            <td>{{ $loop->iteration }}</td>

            @if(auth()->user()->role == 'admin')
                <td>
                    {{ $report->is_anonymous ? 'Anonim' : ($report->sender_name ?? '-') }}
                </td>
            @endif

            <td>{{ $report->title }}</td>

            <td>
                {{ $report->category->name ?? '-' }}
            </td>

            <td>
                {{ $report->dormitory->name ?? '-' }}
            </td>

            <td>
                @if($report->status == 'Pending')
                    <span style="background:orange; color:white; padding:5px 10px; border-radius:10px; font-size:13px;">
                        Pending
                    </span>
                @elseif($report->status == 'Diproses')
                    <span style="background:#3b82f6; color:white; padding:5px 10px; border-radius:10px; font-size:13px;">
                        Diproses
                    </span>
                @else
                    <span style="background:#10b981; color:white; padding:5px 10px; border-radius:10px; font-size:13px;">
                        Selesai
                    </span>
                @endif
            </td>

            <td>{{ $report->created_at->format('d M Y') }}</td>

            <td>
                <div style="display:flex; gap:10px; align-items:center;">
                    <a href="/reports/{{ $report->id }}"
                       style="text-decoration:none; font-size:20px;">
                        👁️
                    </a>

                    @if(auth()->user()->role != 'admin' && $report->status == 'Pending')
                        <a href="/reports/{{ $report->id }}/edit"
                           style="text-decoration:none; font-size:20px;">
                            ✏️
                        </a>
                    @endif

                    @if(auth()->user()->role == 'admin')
                        <form action="/reports/{{ $report->id }}"
                              method="POST"
                              onsubmit="return confirm('Yakin mau hapus laporan ini?')"
                              style="margin:0;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    style="border:none; background:none; cursor:pointer; font-size:20px;">
                                🗑️
                            </button>
                        </form>
                    @endif
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" style="text-align:center;">
                Belum ada laporan.
            </td>
        </tr>
    @endforelse
</table>

<div style="margin-top:20px;">
    {{ $reports->links() }}
</div>

@endsection