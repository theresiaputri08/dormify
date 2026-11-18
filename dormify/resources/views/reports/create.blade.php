@extends('layouts.app')

@section('content')

<div style="
    background:white;
    padding:30px;
    border-radius:20px;
    max-width:900px;
">

    <h2 style="
        margin-bottom:30px;
        color:#1f3c97;
    ">
        ✍️ Buat Laporan Baru
    </h2>

    @if($errors->any())
        <div style="
            background:#fee2e2;
            color:#991b1b;
            padding:15px;
            border-radius:10px;
            margin-bottom:20px;
        ">
            <ul style="margin:0; padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="/reports/store"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <div id="namaPengirimBox" style="margin-bottom:20px;">
            <label style="font-weight:bold;">
                Nama Pengirim
            </label>

            <input
                type="text"
                id="sender_name"
                name="sender_name"
                value="{{ old('sender_name') }}"
                placeholder="Masukkan nama Anda"
                class="form-control"
                style="
                    width:100%;
                    padding:14px;
                    margin-top:10px;
                    border:1px solid #ddd;
                    border-radius:12px;
                    font-size:16px;
                ">
        </div>

        <div style="margin-bottom:25px;">
            <input
                type="checkbox"
                id="is_anonymous"
                name="is_anonymous"
                value="1"
                {{ old('is_anonymous') ? 'checked' : '' }}>

            <label for="is_anonymous">
                Kirim secara Anonim
            </label>
        </div>

        <div style="margin-bottom:20px;">
            <label style="font-weight:bold;">
                Judul Laporan
            </label>

            <input
                type="text"
                name="title"
                value="{{ old('title') }}"
                placeholder="Masukkan judul laporan"
                class="form-control"
                style="
                    width:100%;
                    padding:14px;
                    margin-top:10px;
                    border:1px solid #ddd;
                    border-radius:12px;
                    font-size:16px;
                ">
        </div>

        <div style="margin-bottom:20px;">
            <label style="font-weight:bold;">
                Kategori
            </label>

            <select
                name="category_id"
                class="form-select"
                style="
                    width:100%;
                    padding:14px;
                    margin-top:10px;
                    border:1px solid #ddd;
                    border-radius:12px;
                    font-size:16px;
                ">

                <option value="">
                    -- Pilih Kategori --
                </option>

                @foreach($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <div style="margin-bottom:20px;">
            <label style="font-weight:bold;">
                Asrama
            </label>

            <select
                name="dormitory_id"
                class="form-select"
                style="
                    width:100%;
                    padding:14px;
                    margin-top:10px;
                    border:1px solid #ddd;
                    border-radius:12px;
                    font-size:16px;
                ">

                <option value="">
                    -- Pilih Asrama --
                </option>

                @foreach($dormitories as $dormitory)
                    <option
                        value="{{ $dormitory->id }}"
                        {{ old('dormitory_id') == $dormitory->id ? 'selected' : '' }}>
                        {{ $dormitory->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <div style="margin-bottom:20px;">
            <label style="font-weight:bold;">
                Deskripsi
            </label>

            <textarea
                name="description"
                rows="6"
                placeholder="Tuliskan detail laporan..."
                class="form-control"
                style="
                    width:100%;
                    padding:14px;
                    margin-top:10px;
                    border:1px solid #ddd;
                    border-radius:12px;
                    font-size:16px;
                    resize:none;
                ">{{ old('description') }}</textarea>
        </div>

        <div style="margin-bottom:30px;">
            <label style="font-weight:bold;">
                Upload Bukti
            </label>

            <br><br>

            <input
                type="file"
                name="proof_image"
                class="form-control">

            <p style="
                color:#666;
                font-size:14px;
                margin-top:10px;
            ">
                Format: JPG, JPEG, PNG (maksimal 2MB)
            </p>
        </div>

        <button
            type="submit"
            class="btn"
            style="
                background:#1f3c97;
                color:white;
                border:none;
                padding:16px;
                width:100%;
                border-radius:12px;
                font-size:17px;
                font-weight:bold;
                cursor:pointer;
            ">

            Kirim Laporan

        </button>

    </form>

</div>

<script>
    const checkbox = document.getElementById('is_anonymous');
    const namaBox = document.getElementById('namaPengirimBox');
    const namaInput = document.getElementById('sender_name');

    function toggleAnonymous() {
        if (checkbox.checked) {
            namaBox.style.display = 'none';
            namaInput.value = '';
        } else {
            namaBox.style.display = 'block';
        }
    }

    checkbox.addEventListener('change', toggleAnonymous);
    toggleAnonymous();
</script>

@endsection