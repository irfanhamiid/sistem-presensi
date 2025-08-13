<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\JamKerja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $masuk = Absensi::leftJoin('karyawans', 'karyawans.id', 'absensis.id_karyawan')->where('tipe', 'masuk')->whereMonth('waktu', date('m'))->whereYear('waktu', date('Y'))->orderBy('waktu', 'ASC')->get();
        $pulang = Absensi::leftJoin('karyawans', 'karyawans.id', 'absensis.id_karyawan')->where('tipe', 'keluar')->whereMonth('waktu', date('m'))->whereYear('waktu', date('Y'))->orderBy('waktu', 'ASC')->get();

        return view('admin.index', [
            'karyawan' => Karyawan::count(),
            'masuk' => $masuk,
            'pulang' => $pulang,
        ]);
    }

    public function profile()
    {
        return view('admin.profile', [
            'data' => User::where('id', Auth::user()->id)->first(),
        ]);
    }

    public function profile_update($id, Request $request)
    {
        $data = User::where('id', $id)->first();
        $data->name = $request->nama;
        $data->email = $request->email;
        if (request('password') != null) {
            $data->password = Hash::make($request->password);
        }
        $data->save();
        Alert::success('Berhasil', 'Update Profile');
        return redirect(route('admin-profile'));
    }

    public function jamkerja()
    {
        return view('admin.jam_kerja',[
            'data' => JamKerja::where('id',1)->first()
        ]);
    }

    public function update_jamkerja($id,Request $request)
    {
        $data = JamKerja::find($id);
        $data->jam_masuk = $request->jam_masuk;
        $data->jam_pulang = $request->jam_pulang;
        $data->save();
        return redirect(route('jam-kerja'));
    }
}
