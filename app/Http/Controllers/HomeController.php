<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;

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

    public function indexSoal()
    {
        $select = [
            'tr_data.*',
            'tbl_matkul.nama_matkul',
            'tbl_dosen.nama_dosen'
        ];
        $data = DB::table('tr_data')
            ->select($select)
            ->leftJoin('tbl_matkul', 'tbl_matkul.kode_matkul', '=', 'tr_data.kode_matkul')
            ->leftJoin('tbl_dosen', 'tbl_dosen.kode_dosen', '=', 'tr_data.kode_dosen')
            ->get();
        for ($i = 0; $i < count($data); $i++) {
            $check = DB::table('tr_jawaban_data')
                ->where('tr_data_code', $data[$i]->tr_data_code)
                ->where('id_user', Auth::user()->id)
                ->first();
            $first_soal = DB::table('tr_soal')
                ->where('tr_data_code', $data[$i]->tr_data_code)
                ->orderBy('created_at', 'ASC')
                ->first();
            $tr_soal_code = '';
            if (!empty($first_soal)) {
                $tr_soal_code = $first_soal->tr_soal_code;
            }

            if (!empty($check)) {
                $data[$i]->status_pengerjaan = $check->status_pengerjaan;
                $data[$i]->nilai = $check->nilai;
                $data[$i]->data_jawaban_code = $check->data_jawaban_code;
                $data[$i]->tr_soal_code = $tr_soal_code;
            } else {
                $data[$i]->status_pengerjaan = '';
                $data[$i]->nilai = 0;
                $data[$i]->data_jawaban_code = '';
                $data[$i]->tr_soal_code = $tr_soal_code;
            }
        }

        // dd($data);
        if (Auth::user()->role == 'mahasiswa') {
            return view('soal.index_mahasiswa', compact('data'));
        }

        return view('soal.index', compact('data'));
    }

    public function addSoal()
    {
        $matkul = DB::table('tbl_matkul')->get();
        $dosen = DB::table('tbl_dosen')->get();

        return view('soal.add', compact('matkul', 'dosen'));
    }

    public function addSoalAction(Request $request)
    {
        $data = [
            'tr_data_code' => 'SOAL-' . rand(0, 1000),
            'nama_ujian' => $request->nama_ujian,
            'kode_matkul' => $request->kode_matkul,
            'kode_dosen' => $request->kode_dosen,
            'tahun_akademik' => $request->tahun_akademik,
            'semester' => $request->semester,
            'kelas' => $request->kelas,
            'tipe_soal' => $request->tipe_soal,
        ];
        DB::table('tr_data')->insert($data);

        return redirect('/soal');
    }

    public function listSoal($kode_soal)
    {
        $data = DB::table('tr_soal')->where('tr_data_code', $kode_soal)->get();

        return view('soal.list_soal', compact('data', 'kode_soal'));
    }

    public function addListSoalAction(Request $request)
    {
        $data = [
            'tr_soal_code' => 'P-' . rand(0, 1000),
            'tr_data_code' => $request->tr_data_code,
            'desc_soal' => $request->desc_soal,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'option_e' => $request->option_e,
            'kunci_jawaban' => $request->kunci_jawaban,
        ];
        DB::table('tr_soal')->insert($data);

        return redirect('/soal/list/' . $request->tr_data_code);
    }

    public function kerjakanSoal($tr_data_code, $data_jawaban_code, $tr_soal_code)
    {
        $index = 0;
        $list_soal = DB::table('tr_soal')->where('tr_data_code', $tr_data_code)->get();
        for ($i = 0; $i < count($list_soal); $i++) {
            $check_jawaban = DB::table('tr_jawaban')
                ->where('data_jawaban_code', $data_jawaban_code)
                ->where('tr_soal_code', $list_soal[$i]->tr_soal_code)
                ->first();

            if (!empty($check_jawaban)) {
                $list_soal[$i]->jawaban = $check_jawaban->jawaban;
                $list_soal[$i]->terjawab = true;
            } else {
                $list_soal[$i]->jawaban = '';
                $list_soal[$i]->terjawab = false;
            }

            if ($tr_soal_code == $list_soal[$i]->tr_soal_code) {
                $index = $i;
            }
        }

        $detail_jawaban = DB::table('tr_jawaban_data')->where('data_jawaban_code', $data_jawaban_code)->first();

        $select = [
            'tr_data.*',
            'tbl_matkul.nama_matkul',
            'tbl_dosen.nama_dosen'
        ];
        $detail_soal = DB::table('tr_data')
            ->select($select)
            ->leftJoin('tbl_matkul', 'tbl_matkul.kode_matkul', '=', 'tr_data.kode_matkul')
            ->leftJoin('tbl_dosen', 'tbl_dosen.kode_dosen', '=', 'tr_data.kode_dosen')
            ->first();
        $detail_soal_now = DB::table('tr_soal')->where('tr_soal_code', $tr_soal_code)->first();
        if (!empty($detail_soal_now)) {
            $check_jawaban = DB::table('tr_jawaban')
                ->where('data_jawaban_code', $data_jawaban_code)
                ->where('tr_soal_code', $tr_soal_code)
                ->first();

            if (!empty($check_jawaban)) {
                $detail_soal_now->jawaban = $check_jawaban->jawaban;
                $detail_soal_now->terjawab = true;
            } else {
                $detail_soal_now->jawaban = '';
                $detail_soal_now->terjawab = false;
            }
        }

        return view('soal.kerjakan', compact('list_soal', 'detail_jawaban', 'detail_soal', 'detail_soal_now', 'tr_data_code', 'data_jawaban_code', 'tr_soal_code', 'index'));
    }

    public function kerjakanSoalAction(Request $request)
    {
        $data_jawaban_code = 'JWB-' . rand(0, 10000);
        $data = [
            'data_jawaban_code' => $data_jawaban_code,
            'id_user' => Auth::user()->id,
            'tr_data_code' => $request->tr_data_code,
            'nilai' => 0
        ];
        DB::table('tr_jawaban_data')->insert($data);

        $soal = DB::table('tr_soal')->where('tr_data_code', $request->tr_data_code)->orderBy('created_at', 'ASC')->first();

        return redirect('/kerjakan/' . $request->tr_data_code . '/' . $data_jawaban_code . '/' . $soal->tr_soal_code);
    }

    public function simpanJawaban(Request $request)
    {
        $soal = DB::table('tr_soal')->where('tr_data_code', $request->tr_data_code)->get();
        if (empty($request->jawaban)) {
            return redirect('/kerjakan/' . $request->tr_data_code . '/' . $request->data_jawaban_code . '/' . $soal[$request->index + 1]->tr_soal_code);
        }

        $status = 0;
        $check = DB::table('tr_soal')
            ->where('tr_soal_code', $request->tr_soal_code)
            ->where('kunci_jawaban', $request->jawaban)
            ->exists();
        if ($check) {
            $status = 1;
        }

        $data = [
            'data_jawaban_code' => $request->data_jawaban_code,
            'tr_soal_code' => $request->tr_soal_code,
            'jawaban' => $request->jawaban,
            'status' => $status,
        ];
        $check_jawaban = DB::table('tr_jawaban')
            ->where('data_jawaban_code', $request->data_jawaban_code)
            ->where('tr_soal_code', $request->tr_soal_code)
            ->exists();
        if ($check_jawaban) {
            DB::table('tr_jawaban')
                ->where('data_jawaban_code', $request->data_jawaban_code)
                ->where('tr_soal_code', $request->tr_soal_code)
                ->update(['jawaban' => $request->jawaban, 'status' => $status]);
        } else {
            DB::table('tr_jawaban')->insert($data);
        }

        if (count($soal) == $request->index + 1) {
            $nilai_per_soal = 100 / count($soal);
            $check_benar = DB::table('tr_jawaban')
                ->where('data_jawaban_code', $request->data_jawaban_code)
                ->where('status', 1)
                ->count();

            $nilai = $check_benar * $nilai_per_soal;

            DB::table('tr_jawaban_data')
                ->where('data_jawaban_code', $request->data_jawaban_code)
                ->update(['status_pengerjaan' => 'finish', 'nilai' => $nilai]);

            return redirect('/hasil/' . $request->tr_data_code . '/' . $request->data_jawaban_code);
        }

        return redirect('/kerjakan/' . $request->tr_data_code . '/' . $request->data_jawaban_code . '/' . $soal[$request->index + 1]->tr_soal_code);
    }

    public function hasilUjian($tr_data_code, $data_jawaban_code)
    {
        $data_jawaban = DB::table('tr_jawaban_data')->where('data_jawaban_code', $data_jawaban_code)->first();
        $jml_soal = DB::table('tr_soal')->where('tr_data_code', $tr_data_code)->count();
        $benar = DB::table('tr_jawaban')->where('data_jawaban_code', $data_jawaban_code)->where('status', 1)->count();
        $salah = DB::table('tr_jawaban')->where('data_jawaban_code', $data_jawaban_code)->where('status', 0)->count();
        $tidak_dijawab = $jml_soal - ($benar + $salah);

        return view('soal.hasil', compact('data_jawaban', 'jml_soal', 'benar', 'salah', 'tidak_dijawab'));
    }
}
