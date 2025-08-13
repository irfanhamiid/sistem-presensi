<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.lupas');
    }

    public function kirim(Request $request)
    {
        $data = Karyawan::where('email', $request->email)->where('no_telp', $request->no_telp)->first();

        if ($data) {
            $token = Str::random(64);
            $data->reset_token = $token;
            $data->save();

            return redirect()->route('reset-password', ['token' => $token]);
        } else {
            Alert::error('Gagal', 'Akun Tidak Ditemukan');
            return redirect()->route('lupa-password');
        }
    }

    public function reset_password($token)
    {
        $data = Karyawan::where('reset_token', $token)->first();
        return view('auth.reset', ['data' => $data]);
    }

    public function store($token,Request $request)
    {
        $data = Karyawan::where('reset_token',$token)->first();
        $user = User::where('id_karyawan',$data->id)->first();
        $password = $request->password;
        $konfirmasi_password = $request->password1;
        if($password != $konfirmasi_password)
        {
            Alert::error('Maaf','Password dan Konfirmasi Password Tidak Sama');
            return redirect()->route('reset-password',$token);
        }else{
            $user->password = Hash::make($password);
            $user->save();
            Alert::success('Berhasil','Reset Password');
            return redirect('/');
        }
    }
}
