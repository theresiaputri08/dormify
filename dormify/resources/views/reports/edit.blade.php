@extends('layouts.app')

@section('content')

<a href="/reports" style="text-decoration:none; color:#555; font-size:18px;">
    ← Kembali
</a>

<h2 style="color:#1f3c97; margin:25px 0;">
    ✏️ Edit Laporan
</h2>

<div style="background:white; padding:30px; border-radius:20px; max-width:900px;">

    @if($errors->any())
        <div style="background:#fee2e2; color:#991b1b; padding:15px; border-radius:10px; margin-bottom:20px;">
            <ul style="margin:0; padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/reports/{{ $report->id }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom:20px;">
            <label style="font-weight:bold;">Judul Laporan</label>

            <input type="text"
                   name="title"
                   value="{{ old('title', $report->title) }}"
                   class="form-control"
                   style="width:100%; padding:14px; margin-top:10px; border:1px solid #ddd; border-radius:12px;">
        </div>

        <div style="margin-bottom:20px;">
            <label style="font-weight:bold;">Kategori</label>

            <select name="category_id"
                    class="form-select"
                    style="width:100%; padding:14px; margin-top:10px; border:1px solid #ddd; border-radius:12px;">

                <option value="">-- Pilih Kategori --</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $report->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <div style="margin-bottom:20px;">
            <label style="font-weight:bold;">Asrama</label>

            <select name="dormitory_id"
                    class="form-select"
                    style="width:100%; padding:14px; margin-top:10px; border:1px solid #ddd; border-radius:12px;">

                <option value="">-- Pilih Asrama --</option>

                @foreach($dormitories as $dormitory)
                    <option value="{{ $dormitory->id }}"
                        {{ old('dormitory_id', $report->dormitory_id) == $dormitory->id ? 'selected' : '' }}>
                        {{ $dormitory->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <div style="margin-bottom:25px;">
            <label style="font-weight:bold;">Deskripsi</label>

            <textarea name="description"
                      rows="6"
                      class="form-control"
                      style="width:100%; padding:14px; margin-top:10px; border:1px solid #ddd; border-radius:12px; resize:none;">{{ old('description', $report->description) }}</textarea>
        </div>

        <button type="submit"
                class="btn"
                style="background:#1f3c97; color:white; border:none; padding:15px; width:100%; border-radius:12px; cursor:pointer; font-weight:bold;">
            Update Laporan
        </button>
    </form>

</div>

@endsection