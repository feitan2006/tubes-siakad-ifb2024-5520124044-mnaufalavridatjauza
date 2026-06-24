<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
    {
    $query = Dosen::query();

    if ($request->search) {
        $query->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('nidn', 'like', '%' . $request->search . '%');
    }

    $dosens = $query->latest()->paginate(10)->withQueryString();
    return view('admin.dosen.index', compact('dosens'));
    }

    public function create()
    {
        return view('admin.dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|string|max:10|unique:dosens',
            'nama' => 'required|string|max:50',
        ]);

        Dosen::create($request->all());

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil ditambahkan');
    }

    public function show(Dosen $dosen)
    {
        return view('admin.dosen.show', compact('dosen'));
    }

    public function edit(Dosen $dosen)
    {
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nidn' => 'required|string|max:10|unique:dosens,nidn,' . $dosen->id,
            'nama' => 'required|string|max:50',
        ]);

        $dosen->update($request->all());

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil diupdate');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil dihapus');
    }
}