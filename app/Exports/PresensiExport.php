<?php

namespace App\Exports;

use App\Models\Absensi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class PresensiExport implements FromView
{
    private $mulai_tanggal;
    private $sampai_tanggal;
    private $karyawan;
    private $tipe;

    public function __construct($mulai_tanggal, $sampai_tanggal, $karyawan, $tipe)
    {
        $this->mulai_tanggal = $mulai_tanggal;
        $this->sampai_tanggal = $sampai_tanggal;
        $this->karyawan = $karyawan;
        $this->tipe = $tipe;
    }

    public function view(): View
    {
        if ($this->tipe == null && $this->karyawan == null) {
            $data = Absensi::leftJoin('karyawans', 'karyawans.id', 'absensis.id_karyawan')
                ->whereBetween('created_at', [$this->mulai_tanggal . ' 00:00:00', $this->sampai_tanggal . ' 23:59:59'])
                ->orderBy('waktu', 'ASC')
                ->get();
        } elseif ($this->tipe != null && $this->karyawan == null) {
            $data = Absensi::leftJoin('karyawans', 'karyawans.id', 'absensis.id_karyawan')
                ->whereBetween('created_at', [$this->mulai_tanggal . ' 00:00:00', $this->sampai_tanggal . ' 23:59:59'])
                ->where('tipe', $this->tipe)
                ->orderBy('waktu', 'ASC')
                ->get();
        } elseif ($this->tipe == null && $this->karyawan != null) {
            $data = Absensi::leftJoin('karyawans', 'karyawans.id', 'absensis.id_karyawan')
                ->whereBetween('created_at', [$this->mulai_tanggal . ' 00:00:00', $this->sampai_tanggal . ' 23:59:59'])
                ->where('id_karyawan', $this->karyawan)
                ->orderBy('waktu', 'ASC')
                ->get();
        } else {
            $data = Absensi::leftJoin('karyawans', 'karyawans.id', 'absensis.id_karyawan')
                ->whereBetween('created_at', [$this->mulai_tanggal . ' 00:00:00', $this->sampai_tanggal . ' 23:59:59'])
                ->where('tipe', $this->tipe)
                ->where('id_karyawan', $this->karyawan)
                ->orderBy('waktu', 'ASC')
                ->get();
        }
        return view('admin.presensi_excel', [
            'data' => $data,
        ]);
    }
}
