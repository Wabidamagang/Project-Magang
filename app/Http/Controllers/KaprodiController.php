<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Kaprodi;

class KaprodiController extends Controller
{
    public function index()
    {
        $kaprodi = DB::table('kaprodi')->get();
        return view('admin.kaprodi.index', compact('kaprodi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.kaprodi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_dosen' => 'required|max:45',
            'nip' => 'required|max:45',
            'name' => 'required|max:250',
        ],
        [
            'kode_dosen.required' => 'kode dosen wajib diisi',
            'nip.required' => 'nip wajib diisi',
            'name.required' => 'name harus diisi',   
        ]);

        // Mengambil user_id yang baru saja dibuat (jika data pengguna sudah ada)
        $userId = $request->input('user_id');
    
        DB::table('kaprodi')->insert([
            'user_id' => $userId,
            'kode_dosen'=>$request->kode_dosen,
            'nip'=>$request->nip,
            'name'=>$request->name,
        ]);
        return redirect('admin/kaprodi')->with('success', 'Data Kaprodi Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kaprodi = Kaprodi::findOrFail($id);
        return view('admin.kaprodi.show', compact('kaprodi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kaprodi = Kaprodi::findOrFail($id);
        return view ('admin.kaprodi.edit', compact('kaprodi'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_dosen' => 'required|max:45',
            'nip' => 'required|max:45',
            'name' => 'required|max:250',
        ],
        [
           'kode_dosen.required' => 'kode dosen wajib diisi',
            'nip.required' => 'nip wajib diisi',
            'name.required' => 'name Harus diisi',  
        ]);
        DB::table('kaprodi')->where('id', $request->id)->update([
            'kode_dosen'=>$request->kode_dosen,
            'nip'=>$request->nip,
            'name'=>$request->name,
        ]);
        return redirect('admin/kaprodi')->with('success', 'Data Kaprodi Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('kaprodi')->where('id', $id)->delete();
        return redirect('admin/kaprodi')->withSuccess('Berhasil Menghapus Data Kaprodi!');
    }

}
