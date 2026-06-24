<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
    $query = Mahasiswa::query();

    if ($request->search) {
        $query->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('npm', 'like', '%' . $request->search . '%');
    }

    $mahasiswas = $query->latest()->paginate(10)->withQueryString();
    return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'npm' => 'required|string|max:10|unique:mahasiswas',
            'nama' => 'required|string|max:50',
        ]);

        Mahasiswa::create($request->all());

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'npm' => 'required|string|max:10|unique:mahasiswas,npm,' . $mahasiswa->id,
            'nama' => 'required|string|max:50',
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diupdate');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus');
    }
}