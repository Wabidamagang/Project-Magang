<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Mahasiswa;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = DB::table('dosen')->get();
        return view('admin.dosen.index', compact('dosen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view ('admin.dosen.create');
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
    
        DB::table('dosen')->insert([
            'user_id' => $userId,
            'kode_dosen'=>$request->kode_dosen,
            'nip'=>$request->nip,
            'name'=>$request->name,
        ]);
        return redirect('admin/dosen')->with('success', 'Data Dosen Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('admin.dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        return view ('admin.dosen.edit', compact('dosen'));  
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
        DB::table('dosen')->where('id', $request->id)->update([
            'kode_dosen'=>$request->kode_dosen,
            'nip'=>$request->nip,
            'name'=>$request->name,
        ]);
        return redirect('admin/dosen')->with('success', 'Data Dosen Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('dosen')->where('id', $id)->delete();
        return redirect('admin/dosen')->withSuccess('Berhasil Menghapus Data Dosen!');
    }

    public function showKelas($kelas_id)
    {
    $user = auth()->user();
    $kelas = Kelas::findOrFail($kelas_id);

    // Memeriksa jika dosen adalah dosen biasa dan bukan wali
    if ($user->jenis_dosen == 'biasa') {
        return redirect()->back()->withErrors('Anda tidak memiliki akses ke kelas ini.');
    }
    return view('kelas.show', compact('kelas'));
    }
}
