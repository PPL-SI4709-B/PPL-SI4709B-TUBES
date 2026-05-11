<!DOCTYPE html>
<html>
<head>
    <title>Detail Laporan</title>
</head>
<body>
    <h1>Detail Laporan</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/dinas/report/1" method="POST">
        @csrf
        @method('PUT')
        
        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="">Pilih Status</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
        </select>
        
        <label for="feedback">Feedback</label>
        <input type="text" name="feedback" id="feedback">
        
        <button type="submit">Simpan/Update</button>
    </form>
</body>
</html>
