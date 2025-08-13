<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('karyawan.index');
    }

    public function profile()
    {
        return view('karyawan.profile',[
            'data' => Karyawan::where('id',Auth::user()->id_karyawan)->first()
        ]);
    }

    public function profile_update($id, Request $request)
    {
        $data = Karyawan::where('id',$id)->first();
        $data->nama = $request->nama;
        $data->email = $request->email;
        $data->no_telp = $request->no_telp;
        $data->alamat = $request->alamat;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->tanggal_lahir = $request->tanggal_lahir;
        $data->save();

        $user = User::where('id_karyawan',$id)->first();
        $user->name = $request->nama;
        $user->email = $request->email;
        if (request('password') != null) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        Alert::success('Berhasil','Update Profile');
        return redirect(route('karyawan-profile'));
    }


}
