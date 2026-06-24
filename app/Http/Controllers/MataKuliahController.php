<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index(Request $request)
    {
    $query = MataKuliah::query();

    if ($request->search) {
        $query->where('nama_matakuliah', 'like', '%' . $request->search . '%')
              ->orWhere('kode_matakuliah', 'like', '%' . $request->search . '%');
    }

    if ($request->sks) {
        $query->where('sks', $request->sks);
    }

    $mataKuliahs = $query->latest()->paginate(10)->withQueryString();
    return view('admin.mata-kuliah.index', compact('mataKuliahs'));
    }

    public function create()
    {
        return view('admin.mata-kuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|string|max:8|unique:mata_kuliahs',
            'nama_matakuliah' => 'required|string|max:50',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        MataKuliah::create($request->all());

        return redirect()->route('admin.mata-kuliah.index')
            ->with('success', 'Data mata kuliah berhasil ditambahkan');
    }

    public function show(MataKuliah $mataKuliah)
    {
        return view('admin.mata-kuliah.show', compact('mataKuliah'));
    }

    public function edit(MataKuliah $mataKuliah)
    {
        return view('admin.mata-kuliah.edit', compact('mataKuliah'));
    }

    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $request->validate([
            'kode_matakuliah' => 'required|string|max:8|unique:mata_kuliahs,kode_matakuliah,' . $mataKuliah->id,
            'nama_matakuliah' => 'required|string|max:50',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        $mataKuliah->update($request->all());

        return redirect()->route('admin.mata-kuliah.index')
            ->with('success', 'Data mata kuliah berhasil diupdate');
    }

    public function destroy(MataKuliah $mataKuliah)
    {
        $mataKuliah->delete();

        return redirect()->route('admin.mata-kuliah.index')
            ->with('success', 'Data mata kuliah berhasil dihapus');
    }
}