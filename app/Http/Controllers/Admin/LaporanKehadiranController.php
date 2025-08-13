<?php

namespace App\Http\Controllers\Admin;

use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class LaporanKehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.laporan_kehadiran', [
            'data' => Karyawan::all(),
        ]);
    }

    public function result(Request $request)
    {
        $tanggal = $request->tanggal;
        $pecah_tanggal = explode(' - ', $tanggal);
        $mulai_tanggal = $pecah_tanggal[0];
        $sampai_tanggal = $pecah_tanggal[1];
        $tipe = $request->tipe;
        $karyawan = $request->karyawan;

        $filter = [
            'tanggal' => $tanggal,
            'mulai_tanggal' => $mulai_tanggal,
            'sampai_tanggal' => $sampai_tanggal,
            'tipe' => $tipe,
            'karyawan' => $karyawan,
            'data_karyawan' => Karyawan::all(),
        ];

        $data = Absensi::leftJoin('karyawans', 'karyawans.id', 'absensis.id_karyawan')
            ->when($mulai_tanggal, function ($query) use ($mulai_tanggal) {
                return $query->where('waktu', '>=', $mulai_tanggal . ' 00:00:00');
            })
            ->when($sampai_tanggal, function ($query) use ($sampai_tanggal) {
                return $query->where('waktu', '<=', $sampai_tanggal . ' 23:59:59');
            })
            ->when($tipe, function ($query) use ($tipe) {
                return $query->where('tipe', $tipe);
            })
            ->when($karyawan, function ($query) use ($karyawan) {
                return $query->where('id_karyawan', $karyawan);
            })
            ->orderBy('waktu', 'ASC')
            ->get();

        $btn = 'filter';
        return view('admin.laporan_kehadiran_result', compact('filter', 'data', 'btn'));
    }

    public function excel() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    public function cetak($jenis)
    {
        if ($jenis == 'masuk') {
            $data = Absensi::leftJoin('karyawans', 'karyawans.id', 'absensis.id_karyawan')->where('tipe', 'masuk')->whereMonth('waktu', date('m'))->whereYear('waktu', date('Y'))->orderBy('waktu', 'ASC')->get();
        } elseif ($jenis == 'keluar') {
            $data = Absensi::leftJoin('karyawans', 'karyawans.id', 'absensis.id_karyawan')->where('tipe', 'keluar')->whereMonth('waktu', date('m'))->whereYear('waktu', date('Y'))->orderBy('waktu', 'ASC')->get();
        } else {
            abort(404, 'Jenis absensi tidak valid');
        }

        $pdf = Pdf::loadView('admin.presensi_pdf', [
            'data' => $data,
            'jenis' => $jenis,
            'bulan' => date('F'),
            'tahun' => date('Y'),
        ]);

        return $pdf->download('Laporan ' . $jenis . ' ' . date('F') . ' ' . date('Y') . ' Presensi.pdf');
    }

    public function cetaks(Request $request)
    {
        $tanggal = $request->tanggal;
        $pecah_tanggal = explode(' - ', $tanggal);
        $mulai_tanggal = $pecah_tanggal[0];
        $sampai_tanggal = $pecah_tanggal[1];
        $tipe = $request->tipe;
        $karyawan = $request->karyawan;

        $data = Absensi::leftJoin('karyawans', 'karyawans.id', 'absensis.id_karyawan')
            ->when($mulai_tanggal, function ($query) use ($mulai_tanggal) {
                return $query->where('waktu', '>=', $mulai_tanggal . ' 00:00:00');
            })
            ->when($sampai_tanggal, function ($query) use ($sampai_tanggal) {
                return $query->where('waktu', '<=', $sampai_tanggal . ' 23:59:59');
            })
            ->when($tipe, function ($query) use ($tipe) {
                return $query->where('tipe', $tipe);
            })
            ->when($karyawan, function ($query) use ($karyawan) {
                return $query->where('id_karyawan', $karyawan);
            })
            ->orderBy('waktu', 'ASC')
            ->get();

        $pdf = Pdf::loadView('admin.presensi_pdf', [
            'data' => $data,
            'tanggal' => $tanggal,
            'tipe' => $tipe,
            'karyawan' => $karyawan,
        ]);

        return $pdf->download('Laporan_Presensi.pdf');
    }
}
