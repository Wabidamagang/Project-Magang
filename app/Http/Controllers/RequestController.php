<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use App\Models\Request as RequestEdit;

class RequestController extends Controller
{
    public function index()
    {
        // Menampilkan semua permintaan yang diajukan oleh mahasiswa
        $request = RequestEdit::with('mahasiswa')->get();
        return view('admin.request.index', compact('request'));
    }

    public function store(Request $request)
    {
        // Mengecek apakah mahasiswa sudah mengajukan permintaan
        $existingRequest = RequestEdit::where('mahasiswa_id', $request->mahasiswa_id)->first();
        
        if ($existingRequest) {
            return redirect()->back()->with('error', 'Anda sudah mengajukan permintaan.');
        }

        // Menyimpan permintaan baru
        RequestEdit::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'keterangan' => 'Permintaan akses edit',
        ]);

        return redirect()->back()->with('success', 'Permintaan akses edit telah diajukan.');
    }

    public function approve($id)
    {
        // Menyetujui permintaan mahasiswa
        $request = RequestEdit::findOrFail($id);
        $mahasiswa = Mahasiswa::findOrFail($request->mahasiswa_id);
        $dosen = auth()->user()->dosen;

        // Memeriksa apakah dosen yang login mengajar di kelas mahasiswa tersebut
        if ($mahasiswa->kelas_id != $dosen->kelas_id) {
            return redirect()->back()->withErrors('Anda tidak memiliki izin untuk menyetujui permintaan dari mahasiswa ini.');
        }
        
        // Update izin edit oleh mahasiswa
        $mahasiswa->update(['edit' => 1]);

        // Menghapus request setelah disetujui
        $request->delete();

        return redirect()->back()->with('success', 'Izin edit telah diberikan kepada ' . $mahasiswa->name);
    }

    public function reject($id)
    {
        // Menolak permintaan mahasiswa dan hapus dari tabel request
        $request = RequestEdit::findOrFail($id);
        $mahasiswa = Mahasiswa::findOrFail($request->mahasiswa_id);
        $dosen = auth()->user()->dosen;

        // Memeriksa apakah dosen yang login mengajar di kelas mahasiswa tersebut
        if ($mahasiswa->kelas_id != $dosen->kelas_id) {
            return redirect()->back()->withErrors('Anda tidak memiliki izin untuk menyetujui permintaan dari mahasiswa ini.');
        } 

        // Update status mahasiswa menjadi ditolak
        $mahasiswa->update(['edit' => -1]);

        // Menghapus request setelah ditolak
        $request->delete();

        return redirect()->back()->with('success', 'Permintaan dari ' . $mahasiswa->name . ' telah ditolak.');
    }
}
