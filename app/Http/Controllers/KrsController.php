<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    public function indexAdmin()
    {
        $krs = Krs::with(['mahasiswa', 'mataKuliah'])->latest()->paginate(10);
        return view('admin.krs.index', compact('krs'));
    }

    public function indexMahasiswa()
    {
        $mahasiswa = Mahasiswa::where('npm', auth()->user()->npm)->first();

        if (!$mahasiswa) {
            return view('mahasiswa.krs.index', ['krs' => collect(), 'mataKuliahs' => collect(), 'mahasiswa' => null]);
        }

        $krs = Krs::with('mataKuliah')->where('npm', $mahasiswa->npm)->get();
        $ambil = $krs->pluck('kode_matakuliah')->toArray();
        $mataKuliahs = MataKuliah::whereNotIn('kode_matakuliah', $ambil)->get();

        return view('mahasiswa.krs.index', compact('krs', 'mataKuliahs', 'mahasiswa'));
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('npm', auth()->user()->npm)->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan');
        }

        $request->validate([
            'kode_matakuliah' => 'required|exists:mata_kuliahs,kode_matakuliah',
        ]);

        $sudahAmbil = Krs::where('npm', $mahasiswa->npm)
            ->where('kode_matakuliah', $request->kode_matakuliah)
            ->exists();

        if ($sudahAmbil) {
            return redirect()->back()->with('error', 'Mata kuliah sudah diambil');
        }

        Krs::create([
            'npm' => $mahasiswa->npm,
            'kode_matakuliah' => $request->kode_matakuliah,
        ]);

        return redirect()->route('mahasiswa.krs.index')
            ->with('success', 'Mata kuliah berhasil diambil');
    }

    public function destroy($id)
    {
        $krs = Krs::findOrFail($id);
        $mahasiswa = Mahasiswa::where('npm', auth()->user()->npm)->first();

        if ($krs->npm !== $mahasiswa->npm) {
            abort(403);
        }

        $krs->delete();

        return redirect()->route('mahasiswa.krs.index')
            ->with('success', 'Mata kuliah berhasil di-drop');
    }

    // Export PDF
    public function exportPdf()
    {
        $krs = Krs::with(['mahasiswa', 'mataKuliah'])->get();
        $pdf = Pdf::loadView('admin.krs.pdf', compact('krs'));
        return $pdf->download('krs-' . now()->format('d-m-Y') . '.pdf');
    }

    // Export Excel manual (tanpa library)
    public function exportExcel()
    {
        $krs = Krs::with(['mahasiswa', 'mataKuliah'])->get();

        $filename = 'krs-' . now()->format('d-m-Y') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($krs) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['No', 'NPM', 'Nama Mahasiswa', 'Kode MK', 'Nama Mata Kuliah', 'SKS']);

            foreach ($krs as $i => $item) {
                fputcsv($file, [
                    $i + 1,
                    $item->npm,
                    $item->mahasiswa->nama ?? '-',
                    $item->kode_matakuliah,
                    $item->mataKuliah->nama_matakuliah ?? '-',
                    $item->mataKuliah->sks ?? '-',
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}