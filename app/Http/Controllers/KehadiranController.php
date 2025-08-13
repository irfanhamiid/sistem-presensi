<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Absensi;
use App\Models\JamKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('karyawan.kehadiran', [
            'data' => Absensi::where('id_karyawan', Auth::user()->id_karyawan)
                ->whereDate('waktu', date('Y-m-d'))
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($status)
    {
        return view('karyawan.kehadiran_form', [
            'status' => $status,
            'action' => route('presensi-store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jamkerja = JamKerja::where('id', 1)->first();
        $imageData = $request->input('photo');
        $image = str_replace('data:image/png;base64,', '', $imageData);
        $image = str_replace(' ', '+', $image);
        $imageName = time() . '.png';
        $filePath = public_path('presensi/' . $imageName);
        file_put_contents($filePath, base64_decode($image));
        $request_waktu = Carbon::parse($request->waktu);
        $jam_masuk = Carbon::createFromFormat('H:i:s', $jamkerja->jam_masuk);
        $jam_pulang = Carbon::createFromFormat('H:i:s', $jamkerja->jam_pulang);

        if ($request->tipe == 'masuk' && $request_waktu->format('H:i:s') > $jam_masuk->format('H:i:s')) {
            $status = 'Terlambat';
        } elseif ($request->tipe == 'keluar' && $request_waktu->format('H:i:s') < $jam_pulang->format('H:i:s')) {
            $status = 'Lebih Awal';
        } else {
            $status = 'Tepat Waktu';
        }

        $data = new Absensi([
            'id_karyawan' => $request->id_karyawan,
            'keterangan' => $request->keterangan,
            'lokasi' => $request->location,
            'gambar' => $imageName,
            'tipe' => $request->tipe,
            'waktu' => $request->waktu,
            'status' => $status,
        ]);
        $data->save();
        Alert::success('Berhasil', 'Melakukan absensi');
        return redirect(route('karyawan-dashboard'));
    }

    public function rekap()
    {
        return view('karyawan.kehadiran_rekap', [
            'data' => Absensi::where('id_karyawan', Auth::user()->id_karyawan)->get(),
            'btn' => 'no',
        ]);
    }

    public function rekap_result(Request $request)
    {
        $tanggal = $request->tanggal;
        $pecah_tanggal = explode(' - ', $tanggal);
        $mulai_tanggal = $pecah_tanggal[0];
        $sampai_tanggal = $pecah_tanggal[1];
        $tipe = $request->tipe;

        $filter = [
            'tanggal' => $tanggal,
            'mulai_tanggal' => $mulai_tanggal,
            'sampai_tanggal' => $sampai_tanggal,
            'tipe' => $tipe,
        ];

        if ($tipe == null) {
            $data = Absensi::where('id_karyawan', Auth::user()->id_karyawan)
                ->when($mulai_tanggal, function ($query) use ($mulai_tanggal) {
                    return $query->where('waktu', '>=', $mulai_tanggal . ' 00:00:00');
                })
                ->when($sampai_tanggal, function ($query) use ($sampai_tanggal) {
                    return $query->where('waktu', '<=', $sampai_tanggal . ' 23:59:59');
                })
                ->get();
        } else {
            $data = Absensi::where('id_karyawan', Auth::user()->id_karyawan)
                ->when($mulai_tanggal, function ($query) use ($mulai_tanggal) {
                    return $query->where('waktu', '>=', $mulai_tanggal . ' 00:00:00');
                })
                ->when($sampai_tanggal, function ($query) use ($sampai_tanggal) {
                    return $query->where('waktu', '<=', $sampai_tanggal . ' 23:59:59');
                })
                ->where('tipe', $tipe)
                ->get();
        }
        $btn = 'filter';
        return view('karyawan.kehadiran_rekap', compact('filter', 'data', 'btn'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}
