<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Kaprodi;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/home';
    protected $redirectTo = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:kaprodi,dosen,mahasiswa'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

    // Menambahkan data ke tabel kaprodi
    if ($data['role'] === 'kaprodi') {
        Kaprodi::create([
            'user_id' => $user->id,
            'kode_dosen' => 'K001',
            'nip' => '123',
            'name' => $user->username,
        ]);
    }

    // Menambahkan data ke tabel dosen
    if ($data['role'] === 'dosen') {
        Dosen::create([
            'user_id' => $user->id,
            'kelas_id' => null, 
            'kode_dosen' => 'D001',
            'nip' => '456',
            'name' => $user->username,
            'jenis_dosen' => null,
        ]);
    }

    // Menambahkan data ke tabel mahasiswa
    if ($data['role'] === 'mahasiswa') {
        Mahasiswa::create([
            'user_id' => $user->id,
            'kelas_id' => null, 
            'nim' => 'M001',
            'name' => $user->username,
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => now(),
            'edit' => 0,
        ]);
    }

    return $user;
    }

    protected function registered(Request $request, $user)
    {
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
