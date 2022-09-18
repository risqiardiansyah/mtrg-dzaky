<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

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
        $data = DB::table('tbl_matkul')->get();

        return view('home', compact('data'));
    }

    public function tambahMatkul()
    {
        return view('matkul.add');
    }

    public function tambahMatkulAction(Request $request)
    {
        $data = [
            'kode_matkul' => $request->kodeMatkul,
            'nama_matkul' => $request->namaMatkul,
        ];

        DB::table('tbl_matkul')->insert($data);

        return redirect('/home');
    }

    public function editMatkul($id)
    {
        $data = DB::table('tbl_matkul')->where('id', $id)->first();

        return view('matkul.edit', compact('id', 'data'));
    }

    public function editMatkulAction(Request $request)
    {
        $data = [
            'kode_matkul' => $request->kodeMatkul,
            'nama_matkul' => $request->namaMatkul,
        ];

        DB::table('tbl_matkul')->where('id', $request->id)->update($data);

        return redirect('/home');
    }

    public function deleteMatkulAction($id)
    {
        DB::table('tbl_matkul')->where('id', $id)->delete();

        return redirect('/home');
    }

    public function indexTransaksi()
    {
        $select = [
            'tbl_laporan.*',
            'tbl_matkul.nama_matkul',
            'tbl_dosen.nama_dosen',
        ];

        $data = DB::table('tbl_laporan')
            ->select($select)
            ->leftJoin('tbl_matkul', 'tbl_matkul.kode_matkul', '=', 'tbl_laporan.kode_matkul')
            ->leftJoin('tbl_dosen', 'tbl_dosen.kode_dosen', '=', 'tbl_laporan.kode_dosen')
            ->get();

        $dosen = DB::table('tbl_dosen')->get();

        return view('transaksi.index', compact('data', 'dosen'));
    }

    public function addTransaksi(Request $request)
    {
        $matkul = DB::table('tbl_matkul')->get();
        $dosen = DB::table('tbl_dosen')->get();

        return view('transaksi.add', compact('matkul', 'dosen'));
    }

    public function addTransaksiAction(Request $request)
    {
        $data = [
            'kode_matkul' => $request->kode_matkul,
            'kode_dosen' => $request->kode_dosen,
            'tahun_akademik' => $request->tahun_akademik,
            'semester' => $request->semester,
            'kelas' => $request->kelas
        ];
        DB::table('tbl_laporan')->insert($data);

        return redirect('/transaksi');
    }


    public function cetakLaporan(Request $request)
    {
        $filename = 'laporan.pdf';

        $select = [
            'tbl_laporan.*',
            'tbl_matkul.nama_matkul',
            'tbl_dosen.nama_dosen',
        ];

        $data = DB::table('tbl_laporan')
            ->select($select)
            ->leftJoin('tbl_matkul', 'tbl_matkul.kode_matkul', '=', 'tbl_laporan.kode_matkul')
            ->leftJoin('tbl_dosen', 'tbl_dosen.kode_dosen', '=', 'tbl_laporan.kode_dosen');
        if (!empty($request->kode_dosen)) {
            $data = $data->where('tbl_laporan.kode_dosen', $request->kode_dosen);
        }
        $data = $data->get();

        $pdf = PDF::loadView('laporan', compact('data'))->setPaper('A4', 'potrait');

        return $pdf->download();
    }
}
