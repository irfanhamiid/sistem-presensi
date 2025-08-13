<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Karyawan::all();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $id = $row['id'];
                    $btn =
                      "<a class='btn btn-info btn-link' href='" . route('karyawan-show', $id) . "'><i class='fa fa-list'></i></a> <a class='btn btn-primary btn-link' href='" . route('karyawan-edit', $id) . "'><i class='fa fa-edit'></i></a>  <a href='karyawan-delete/$id' class='delete btn btn-danger btn-link hapus_data'><i class='fa fa-trash'></i></a>";
                    return $btn;
                })
                ->addColumn('jumlah', function($row){
                     $absensi = Absensi::where('id_karyawan',$row['id'])->where('tipe','masuk')->count();
                    return $absensi;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function index()
    {
        return view('admin.karyawan_list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.karyawan_form',[
            'action' => route('karyawan-store'),
            'btn' => 'add',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Karyawan([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);
        $data->save();

        $user = new User([
            'name' => $request->nama,
            'email' => $request->email,
            'id_karyawan' => $data->id,
            'password' => Hash::make($request->password),
            'role' => 'karyawan'
        ]);
        $user->save();
        Alert::success('Berhasil','Input Data Karyawan');
        return redirect(route('karyawan-list'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('admin.karyawan_show',[
            'data' => Karyawan::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.karyawan_form',[
            'data' => Karyawan::find($id),
            'action' => route('karyawan-update',$id),
            'btn' => 'edit',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Karyawan::find($id);
        $data->nama = $request->nama;
        $data->email = $request->email;
        $data->no_telp = $request->no_telp;
        $data->alamat = $request->alamat;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->agama = $request->agama;
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
        Alert::success('Berhasil','Update Data Karyawan');
        return redirect(route('karyawan-list'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Karyawan::where('id',$id)->delete();
        User::where('id_karyawan',$id)->delete();
        Alert::success('Berhasil','Hapus Data Karyawan');
        return redirect(route('karyawan-list'));
    }
}
