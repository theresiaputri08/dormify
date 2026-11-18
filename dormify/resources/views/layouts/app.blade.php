<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dormify</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            background:#f3f4f6;
        }

        .container-main{
            display:flex;
            min-height:100vh;
        }

        .sidebar{
            width:280px;
            background:#1f3c97;
            padding:30px 20px;
            color:white;
        }

        .logo{
            font-size:40px;
            font-weight:bold;
            margin-bottom:50px;
        }

        .menu a{
            display:block;
            color:white;
            text-decoration:none;
            padding:15px;
            margin-bottom:10px;
            border-radius:10px;
            transition:0.3s;
            font-size:18px;
        }

        .menu a:hover{
            background:rgba(255,255,255,0.2);
        }

        .content{
            flex:1;
            padding:40px;
        }

        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        }

        .logout-btn{
            background:red;
            color:white;
            border:none;
            padding:12px 25px;
            border-radius:10px;
            cursor:pointer;
            font-size:16px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            background:white;
            border-radius:15px;
            overflow:hidden;
        }

        th{
            background:#1f3c97;
            color:white;
            padding:15px;
            text-align:left;
        }

        td{
            padding:15px;
            border-bottom:1px solid #eee;
        }

        .card-custom{
            background:white;
            padding:25px;
            border-radius:20px;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="container-main">

    <div class="sidebar">

        <div class="logo">
            Dormify
        </div>

        <div class="menu">

            <a href="/dashboard">🏠 Beranda</a>

            <a href="/dormitories">🏢 Data Asrama</a>

            @if(auth()->user()->role == 'admin')

                <a href="/reports">📋 Manajemen Laporan</a>

                <a href="/categories">📁 Kategori</a>

            @else

                <a href="/reports">📋 Laporan Saya</a>

                <a href="/reports/create">✍️ Buat Laporan</a>

                <a href="/categories">📁 Kategori</a>

            @endif

        </div>

    </div>

    <div class="content">

        <div class="topbar">

            <div>
                <h2 style="color:#1f3c97;">
                    Dashboard Dormify
                </h2>

                <p style="margin-top:10px;">
                    Aktif sebagai:
                    <b>{{ strtoupper(auth()->user()->role) }}</b>
                </p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button class="logout-btn">
                    Logout
                </button>
            </form>

        </div>

        @yield('content')

    </div>

</div>

{{-- BOOTSTRAP JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>