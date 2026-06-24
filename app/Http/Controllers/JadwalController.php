<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Dosen;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
    $query = Jadwal::with(['mataKuliah', 'dosen']);

    if ($request->search) {
        $query->whereHas('mataKuliah', function($q) use ($request) {
            $q->where('nama_matakuliah', 'like', '%' . $request->search . '%');
        })->orWhereHas('dosen', function($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->hari) {
        $query->where('hari', $request->hari);
    }

    $jadwals = $query->latest()->paginate(10)->withQueryString();
    return view('admin.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        $mataKuliahs = MataKuliah::all();
        return view('admin.jadwal.create', compact('dosens', 'mataKuliahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|exists:mata_kuliahs,kode_matakuliah',
            'nidn' => 'required|exists:dosens,nidn',
            'kelas' => 'required|string|max:1',
            'hari' => 'required|string',
            'jam' => 'required|string',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit(Jadwal $jadwal)
    {
        $dosens = Dosen::all();
        $mataKuliahs = MataKuliah::all();
        return view('admin.jadwal.edit', compact('jadwal', 'dosens', 'mataKuliahs'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'kode_matakuliah' => 'required|exists:mata_kuliahs,kode_matakuliah',
            'nidn' => 'required|exists:dosens,nidn',
            'kelas' => 'required|string|max:1',
            'hari' => 'required|string',
            'jam' => 'required|string',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil diupdate');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus');
    }

    public function indexMahasiswa()
    {
        $jadwals = Jadwal::with(['mataKuliah', 'dosen'])->get();
        return view('mahasiswa.jadwal.index', compact('jadwals'));
    }
}