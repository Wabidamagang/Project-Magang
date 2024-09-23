<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Dosen;

class MahasiswaController extends Controller
{
    public function index()
    {
        $user = auth()->user();

    // Hanya mengizinkan kaprodi untuk melihat daftar mahasiswa
    if ($user->role === 'kaprodi') {
        $mahasiswa = Mahasiswa::with('kelas')->get();
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    // Dosen bisa melihat dan melakukan CRUD data mahasiswa
    if ($user->role === 'dosen') {
        $dosen = $user->dosen;
        if ($dosen) {
            // Mengambil mahasiswa sesuai kelas yang diajar oleh dosen
            $mahasiswa = Mahasiswa::with('kelas')->where('kelas_id', $dosen->kelas_id)->get();
        } else {
            $mahasiswa = Mahasiswa::with('kelas')->get();
        }
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    // Mahasiswa bisa melihat semua data mahasiswa tetapi tidak CRUD
    if ($user->role === 'mahasiswa') {
        $mahasiswa = Mahasiswa::with('kelas')->get();
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    return abort(403); // Akses ditolak untuk role lain
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view ('admin.mahasiswa.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|max:45',
            'name' => 'required|max:45',
            'tempat_lahir' => 'required|max:250',
            'tanggal_lahir' => 'required|max:250',
            'kelas_id' => 'required|exists:kelas,id',
        ],
        [
            'nim.required' => 'nim wajib diisi',
            'name.required' => 'name wajib diisi',
            'tempat_lahir.required' => 'tempat lahir harus diisi',
            'tanggal_lahir.required' => 'tanggal lahir harus diisi',
            'kelas_id.required' => 'Kelas harus dipilih',
            'kelas_id.exists' => 'Kelas tidak valid', 
        ]);

        // Mengambil user_id yang baru saja dibuat (jika data pengguna sudah ada)
        $userId = $request->input('user_id');

        $kelas = Kelas::findOrFail($request->kelas_id);

        // Memeriksa apakah kelas sudah penuh
        if ($kelas->mahasiswa()->count() >= 10) {
            return redirect()->back()->withInput()->withErrors(['kelas_id' => 'Kelas sudah penuh.']);
        }
    
        DB::table('mahasiswa')->insert([
            'user_id' => $userId,
            'kelas_id'=>$request->kelas_id,
            'nim'=>$request->nim,
            'name'=>$request->name,
            'tempat_lahir'=>$request->tempat_lahir,
            'tanggal_lahir'=>$request->tanggal_lahir,
        ]);
        return redirect('admin/mahasiswa')->with('success', 'Data Mahasiswa Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('admin.mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        // Mengecek apakah user yang login adalah mahasiswa tersebut
        if (!(auth()->user()->dosen || auth()->user()->id == $mahasiswa->user_id)) {

        return redirect()->route('admin.mahasiswa.index')->withErrors('Akses ditolak!');
        }

        $kelas = Kelas::all();
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'kelas'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Mencari data mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Mengambil kelas yang sedang diupdate
        $kelasBaru = $request->input('kelas_id');
        $kelasLama = $mahasiswa->kelas_id;

        // Jika mahasiswa pindah kelas, mengecek kapasitas kelas baru
        if ($kelasBaru != $kelasLama) {
        $kelas = Kelas::findOrFail($kelasBaru);

        // Mengecek jika kapasitas kelas baru penuh
        if ($kelas->mahasiswa()->count() >= 10) {
            return redirect()->back()->withErrors('Kelas ini sudah penuh!');
        }
    }
        $request->validate([
            'nim' => 'required|max:45',
            'name' => 'required|max:45',
            'tempat_lahir' => 'required|max:250',
            'tanggal_lahir' => 'required|max:250',
            'kelas_id' => 'required|exists:kelas,id',
        ],
        [
            'nim.required' => 'nim wajib diisi',
            'name.required' => 'name wajib diisi',
            'tempat_lahir.required' => 'tempat lahir Harus diisi',
            'tanggal_lahir.required' => 'tanggal lahir Harus diisi',
            'kelas_id.required' => 'Kelas harus dipilih',
            'kelas_id.exists' => 'Kelas tidak valid',  
        ]);

        DB::table('mahasiswa')->where('id', $request->id)->update([
            'kelas_id'=>$request->kelas_id,
            'nim'=>$request->nim,
            'name'=>$request->name,
            'tempat_lahir'=>$request->tempat_lahir,
            'tanggal_lahir'=>$request->tanggal_lahir,
            'edit' => 2,
        ]);
        return redirect('admin/mahasiswa')->with('success', 'Data Mahasiswa Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = auth()->user();

        // Mengecek apakah user yang login adalah dosen wali dari mahasiswa tersebut atau admin
        if ($user->dosen_id !== $mahasiswa->kelas->dosen_wali_id && !$user->is_admin) {
            return redirect()->route('mahasiswa.index')->withErrors('Akses ditolak!');
    }

        // Menghapus data mahasiswa
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->withSuccess('Berhasil Menghapus Data!');
    }

}
