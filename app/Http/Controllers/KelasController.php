<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('admin.kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dosen = Dosen::all(); // List dosen untuk plotting
        $mahasiswa = Mahasiswa::all(); // List mahasiswa untuk plotting
        return view ('admin.kelas.create', compact('dosen','mahasiswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:45',
            'jumlah' => 'required|max:45',
        ],
        [
            'name.required' => 'name wajib diisi',
            'jumlah.required' => 'jumlah wajib diisi', 
        ]);
    
        DB::table('kelas')->insert([
            'name'=>$request->name,
            'jumlah'=>$request->jumlah,
        ]);

        return redirect('admin/kelas')->with('success', 'Data Kelas Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kelas = Kelas::with(['dosen', 'mahasiswa'])->findOrFail($id);
        return view('admin.kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $dosen = Dosen::all();
        $mahasiswa = Mahasiswa::all();
        return view ('admin.kelas.edit', compact('kelas','dosen','mahasiswa'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:45',
            'jumlah' => 'required|max:45',
        ],
        [
            'name.required' => 'name wajib diisi',
            'jumlah.required' => 'jumlah wajib diisi',  
        ]);
        DB::table('kelas')->where('id', $request->id)->update([
            'name'=>$request->name,
            'jumlah'=>$request->jumlah,
        ]);

        $kelas = Kelas::findOrFail($id);

        return redirect('admin/kelas')->with('success', 'Data Kelas Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('kelas')->where('id', $id)->delete();
        return redirect('admin/kelas')->withSuccess('Berhasil Menghapus Data Kelas!');
    }

    public function plot(Request $request, $kelasId)
    {
        $request->validate([
            'dosen_id' => 'required|exists:dosen,id',
            'mahasiswa_id' => 'required|array',
            'mahasiswa_id.*' => 'exists:mahasiswa,id',
        ]);

        $kelas = Kelas::with(['dosen.mahasiswaPivot'])->findOrFail($kelasId);
    
        // Mengirim dosen ke kelas
        $kelas->dosen()->syncWithoutDetaching($request->dosen_id);

        // Mengirim mahasiswa ke kelas dan dosen
        foreach ($request->mahasiswa_id as $mahasiswaId) {
            DB::table('kelas_mahasiswa')->insert([
                'kelas_id' => $kelasId,
                'mahasiswa_id' => $mahasiswaId,
                'dosen_id' => $request->dosen_id,
            ]);
        }
        return redirect('admin/kelas')->withSuccess('Berhasil Mengplot!');

    }

    public function showPlotForm($id)
    {
        $kelas = Kelas::findOrFail($id);
        $dosen = Dosen::all();
        $mahasiswa = Mahasiswa::all();

        return view('admin.kelas.plot', compact('kelas', 'dosen', 'mahasiswa'));
    }

}
