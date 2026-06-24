<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Export KRS</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; color: #16a34a; }
        p { text-align: center; color: #666; margin-top: -10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        thead tr { background-color: #16a34a; color: white; }
        th, td { border: 1px solid #ddd; padding: 8px 10px; text-align: left; }
        tbody tr:nth-child(even) { background-color: #f0fdf4; }
        .footer { margin-top: 20px; text-align: right; font-size: 11px; color: #888; }
    </style>
</head>
<body>
    <h2>🎓 SIAKAD - Laporan KRS</h2>
    <p>Dicetak pada: {{ now()->format('d-m-Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NPM</th>
                <th>Nama Mahasiswa</th>
                <th>Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($krs as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->npm }}</td>
                <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                <td>{{ $item->kode_matakuliah }}</td>
                <td>{{ $item->mataKuliah->nama_matakuliah ?? '-' }}</td>
                <td>{{ $item->mataKuliah->sks ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center">Belum ada data KRS</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">Total: {{ $krs->count() }} data</div>
</body>
</html>