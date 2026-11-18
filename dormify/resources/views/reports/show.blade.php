@extends('layouts.app')

@section('content')

<a href="/reports" style="text-decoration:none; color:#555; font-size:18px;">
    ← Kembali
</a>

<div style="display:flex; gap:30px; margin-top:25px; align-items:flex-start;">

    <div style="background:white; padding:30px; border-radius:20px; width:58%;">

        <h2 style="color:#1f3c97; margin-bottom:30px;">
            Detail Laporan
        </h2>

        <table>
            <tr>
                <td>Judul</td>
                <td>{{ $report->title }}</td>
            </tr>

            <tr>
                <td>Kategori</td>
                <td>{{ $report->category->name ?? '-' }}</td>
            </tr>

            <tr>
                <td>Asrama</td>
                <td>{{ $report->dormitory->name ?? '-' }}</td>
            </tr>

            <tr>
                <td>Status</td>
                <td>
                    @if($report->status == 'Pending')
                        <span style="background:orange; color:white; padding:5px 10px; border-radius:10px;">
                            Pending
                        </span>
                    @elseif($report->status == 'Diproses')
                        <span style="background:#3b82f6; color:white; padding:5px 10px; border-radius:10px;">
                            Diproses
                        </span>
                    @else
                        <span style="background:#10b981; color:white; padding:5px 10px; border-radius:10px;">
                            Selesai
                        </span>
                    @endif
                </td>
            </tr>

            <tr>
                <td>Tanggal</td>
                <td>{{ $report->created_at->format('d M Y H:i') }}</td>
            </tr>
        </table>

        <h3 style="margin-top:30px;">
            Deskripsi
        </h3>

        <div style="background:#f5f5f5; padding:20px; border-radius:12px; margin-top:10px;">
            {{ $report->description }}
        </div>

        <h3 style="margin-top:30px;">
            Bukti Laporan
        </h3>

        @if($report->proof_image)
            <img src="/uploads/{{ $report->proof_image }}"
                 style="width:300px; margin-top:15px; border-radius:15px;">
        @else
            <p style="margin-top:10px;">
                Tidak ada bukti.
            </p>
        @endif

    </div>

    <div style="width:35%;">

        <div style="background:white; padding:30px; border-radius:20px; margin-bottom:25px;">

            <h3 style="color:#1f3c97; margin-bottom:25px;">
                Riwayat Status
            </h3>

            <div style="display:flex; flex-direction:column; gap:20px;">

                <div style="display:flex; align-items:flex-start; gap:15px;">
                    <div style="width:18px; height:18px; border-radius:50%; margin-top:5px; background:orange;"></div>

                    <div>
                        <h4 style="margin-bottom:5px;">Pending</h4>
                        <p style="color:#777; font-size:14px;">
                            Laporan berhasil dikirim.
                        </p>
                    </div>
                </div>

                <div style="display:flex; align-items:flex-start; gap:15px;">
                    <div style="
                        width:18px;
                        height:18px;
                        border-radius:50%;
                        margin-top:5px;
                        {{ in_array($report->status, ['Diproses','Selesai']) ? 'background:#3b82f6;' : 'background:#ddd;' }}
                    "></div>

                    <div>
                        <h4 style="margin-bottom:5px;">Diproses</h4>
                        <p style="color:#777; font-size:14px;">
                            Admin sedang memproses laporan.
                        </p>
                    </div>
                </div>

                <div style="display:flex; align-items:flex-start; gap:15px;">
                    <div style="
                        width:18px;
                        height:18px;
                        border-radius:50%;
                        margin-top:5px;
                        {{ $report->status == 'Selesai' ? 'background:#10b981;' : 'background:#ddd;' }}
                    "></div>

                    <div>
                        <h4 style="margin-bottom:5px;">Selesai</h4>
                        <p style="color:#777; font-size:14px;">
                            Laporan telah selesai ditangani.
                        </p>
                    </div>
                </div>

            </div>

        </div>

        <div style="background:white; padding:30px; border-radius:20px;">

            <h3 style="color:#1f3c97; margin-bottom:20px;">
                Tanggapan Admin
            </h3>

            @if(session('success'))
                <div style="background:#dcfce7; color:#166534; padding:12px; border-radius:10px; margin-bottom:15px;">
                    {{ session('success') }}
                </div>
            @endif

            @if(auth()->user()->role == 'admin')

                <form action="/reports/{{ $report->id }}/update-status" method="POST">
                    @csrf

                    <div style="margin-bottom:20px;">
                        <label>Status</label>

                        <select name="status"
                                class="form-select"
                                style="width:100%; padding:12px; margin-top:10px; border:1px solid #ddd; border-radius:10px;">

                            <option value="Pending" {{ $report->status == 'Pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="Diproses" {{ $report->status == 'Diproses' ? 'selected' : '' }}>
                                Diproses
                            </option>

                            <option value="Selesai" {{ $report->status == 'Selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>

                        </select>
                    </div>

                    <div style="margin-bottom:20px;">
                        <label>Tanggapan Baru</label>

                        <textarea name="response"
                                  rows="5"
                                  placeholder="Tulis tanggapan admin..."
                                  class="form-control"
                                  style="width:100%; padding:12px; margin-top:10px; border:1px solid #ddd; border-radius:10px;"></textarea>
                    </div>

                    <button type="submit"
                            class="btn"
                            style="background:#1f3c97; color:white; border:none; padding:14px; width:100%; border-radius:10px; cursor:pointer;">
                        Update Status
                    </button>
                </form>

                <hr style="margin:25px 0; border:none; border-top:1px solid #eee;">

            @endif

            <h4 style="margin-bottom:15px;">
                Riwayat Tanggapan
            </h4>

            @forelse($responses as $response)
                <div style="background:#f5f5f5; padding:15px; border-radius:12px; margin-bottom:12px;">
                    <p style="margin-bottom:8px;">
                        {{ $response->response }}
                    </p>

                    <small style="color:#777;">
                        {{ $response->created_at->format('d M Y H:i') }}
                    </small>
                </div>
            @empty
                <div style="background:#f5f5f5; padding:20px; border-radius:12px;">
                    Belum ada tanggapan admin.
                </div>
            @endforelse

        </div>

    </div>

</div>

@endsection