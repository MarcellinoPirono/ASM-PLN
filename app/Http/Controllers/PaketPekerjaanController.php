<?php

namespace App\Http\Controllers;

use App\Models\PaketPekerjaan;
use App\Models\RincianInduk;
use App\Models\Khs;
use App\Http\Requests\StorePaketPekerjaanRequest;
use App\Http\Requests\UpdatePaketPekerjaanRequest;
use Illuminate\Http\Request;
// use Yajra\DataTables\Services\DataTable;

use Yajra\DataTables\Facades\DataTables;
// use DataTables;

class PaketPekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jenis_khs(Request $request)
    {
        $jenis_khs = $request->jenis_khs;
        // dd($jenis_khs);
        $khs_id = Khs::where('jenis_khs', $jenis_khs)->value('id');
        $nama_paket = PaketPekerjaan::select('nama_paket')->where('khs_id', $khs_id)->groupBy('nama_paket')->get();



        // $sasa = PaketPekerjaan::where('khs_id', $khs_id)->get();
        // dd($sasa);



        return view('paket-pekerjaan.paket_pekerjaan', [
            'title' => 'Paket Pekerjaan KHS '.$jenis_khs.'',
            'pakets' => PaketPekerjaan::where('khs_id', $khs_id)->get(),
            'jenis_khs' => $jenis_khs,
            'nama_paket' => $nama_paket
        ]);
    }


    public function DataTable(Request $request)
    {
        $jenis_khs = $request->jenis_khs;
        $khs_id = Khs::where('jenis_khs', $jenis_khs)->value('id');
        $items = RincianInduk::where('khs_id', $khs_id)->orderBy('id', 'DESC')->get();
        // $count_item =;

        // if ($request->ajax()) {
            // dd($jenis_khs);

            // $khs_id = Khs::where('jenis_khs', $jenis_khs)->value('id');
            // $items = RincianInduk::where('khs_id', $khs_id)->get();
            // $data =RincianInduk::where('khs_id', $khs_id)->join('satuans', 'rincian_induks.satuan_id', 'satuans.id')->select('rincian_induks.*', 'satuans.singkatan')->get();

            // return Datatables::of($data)->addIndexColumn()
            // ->addColumn('action', function($data){
            //     $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
            //     $button .= '   <button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
            //     return $button;
            // })
            // ->addColumn('checkbox', '<input type="checkbox" name="item_id[]" class="" value="{{$id}}" />')
            // ->rawColumns(['checkbox','action'])
            // ->make(true);
        // }
        // dd($jenis_khs);
        // $jenis_khs = $request->jenis_khs;

        return view(
            'paket-pekerjaan.buat_paket_pekerjaan',
            [
                'title' => 'Buat Paket Pekerjaan ',
                'active' => 'Paket-Pekerjaan',
                'active1' => 'Tambah Paket Pekerjaan ',
                'jenis_khs' => $khs_id,
                'items' => $items
            ],
        );
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Request $request)
    // {
    //     $jenis_khs = $request->jenis_khs;
    //     $khs_id = Khs::where('jenis_khs', $jenis_khs)->value('id');
    //     $items = RincianInduk::where('khs_id', $khs_id)->get();

    //     return view(
    //         'paket-pekerjaan.buat_paket_pekerjaan',
    //         [
    //             'title' => 'Buat Paket Pekerjaan '.$jenis_khs.'',
    //             'active' => 'Paket-Pekerjaan',
    //             'active1' => 'Tambah Paket Pekerjaan '.$jenis_khs.'',
    //             'items' => $items
    //         ]
    //     );

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaketPekerjaanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaketPekerjaanRequest $request)
    {
        // $jenis_khs = $request->jenis_khs;
        // dd($request);

        $request->validate([

            'nama_paket' => 'required|max:250',
            'item_id' => 'required',
            'khs_id' => 'required',
            'volume' => 'required',
            'jumlah_harga' => 'required',


        ]);

        $banyak_item = count($request->item_id);


        for($j=0; $j < $banyak_item; $j++){
            $paket_pekerjaan_data = [
                "nama_paket"=>$request->nama_paket,
                "khs_id"=>$request->khs_id,
                "item_id"=>$request->item_id[$j],
                "volume"=>$request->volume[$j],
                "jumlah_harga"=>$request->jumlah_harga[$j]
            ];
            PaketPekerjaan::create($paket_pekerjaan_data);
        }


        return response()->json();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaketPekerjaan  $paketPekerjaan
     * @return \Illuminate\Http\Response
     */
    public function show(PaketPekerjaan $paketPekerjaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaketPekerjaan  $paketPekerjaan
     * @return \Illuminate\Http\Response
     */
    public function edit(PaketPekerjaan $paketPekerjaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaketPekerjaanRequest  $request
     * @param  \App\Models\PaketPekerjaan  $paketPekerjaan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaketPekerjaanRequest $request, PaketPekerjaan $paketPekerjaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaketPekerjaan  $paketPekerjaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaketPekerjaan $paketPekerjaan)
    {
        //
    }

    public function getPaketPekerjaan(Request $request){
        $paketPekerjaan = PaketPekerjaan::all();

        return response()->json($paketPekerjaan);
    }



}
