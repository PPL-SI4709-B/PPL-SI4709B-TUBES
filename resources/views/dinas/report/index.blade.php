<!DOCTYPE html>
<html>
<head>
    <title>Daftar Laporan</title>
</head>
<body>
    <h1>Daftar Laporan</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <a href="/dinas/report/1">Detail</a>
    |
    <a href="{{ route('dinas.evaluation.create', 1) }}">Evaluasi</a>
</body>
</html>
