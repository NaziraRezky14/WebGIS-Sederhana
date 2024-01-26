<?php

namespace App\Http\Controllers;

use App\Imports\Terdampak;
use App\Models\DataBanjir;
use App\Models\Tematik;
use App\Models\Terdampak as ModelsTerdampak;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TerdampakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($year = null)
    {
        $geofile = [];
        $color = [];
        $index = 0;
        $tematik = Tematik::all();

        foreach ($tematik as $item) {
            $geofile[$index] = '/storage/' . $item->geojson;
            $index++;
        }
        foreach ($tematik as $item) {
            $color[$item->kecamatan] = $item->warna;
        }
        foreach ($tematik as $item) {
            $id[$item->kecamatan] = $item->id;
        }
        $terdampak = [];
        foreach ($tematik as $item) {
            $models = ModelsTerdampak::where('tematik_id', $item->id)->whereYear('created_at',$year)->get();
            foreach ($models as $value) {
                if (!isset($terdampak[$item->id])) {
                    $terdampak[$item->id] = collect();
                }

                $terdampak[$item->id] =
                    '<div class="row">' .
                    '<div class="col-sm-8">' .
                    'Rumah Terendam' .
                    '</div>' .
                    '<div class="col">: ' .
                    $value->rmh_terandam .
                    '</div>' .
                    '</div>' .
                    '<div class="row">' .
                    '<div class="col-sm-8">' .
                    'Korban Terdampak KK' .
                    '</div>' .
                    '<div class="col">: ' .
                    $value->t_kk .
                    '</div>' .
                    '</div>' .
                    '<div class="row">' .
                    '<div class="col-sm-8">' .
                    'Terdampak Jiwa' .
                    '</div>' .
                    '<div class="col">: ' .
                    $value->t_jiwa .
                    '</div>' .
                    '</div>' .
                    '<div class="row">' .
                    '<div class="col-sm-8">' .
                    'Korban Mengungsi KK' .
                    '</div>' .
                    '<div class="col">: ' .
                    $value->m_mengungsi .
                    '</div>' .
                    '</div>' .
                    '<div class="row">' .
                    '<div class="col-sm-8">' .
                    'Korban Mengungsi Jiwa' .
                    '</div>' .
                    '<div class="col">: ' .
                    $value->m_jiwa .
                    '</div>' .
                    '</div>' .
                    '<div class="row">' .
                    '<div class="col-sm-8">' .
                    'Korban Sakit' .
                    '</div>' .
                    '<div class="col">: ' .
                    $value->sakit .
                    '</div>' .
                    '</div>' .
                    '<div class="row">' .
                    '<div class="col-sm-8">' .
                    'Korban Meninggal' .
                    '</div>' .
                    '<div class="col">: ' .
                    $value->meninggal .
                    '</div>' .
                    '</div>' .
                    '<div class="row">' .
                    '<div class="col-sm-8">' .
                    'Korban Hilang' .
                    '</div>' .
                    '<div class="col">: ' .
                    $value->hilang .
                    '</div>' .
                    '</div>';
            }
        }
        $kecamatan = $tematik->pluck('kecamatan');
        $tahunList = ModelsTerdampak::select(DB::raw('YEAR(created_at) as tanggal'))->groupby('tanggal')->get();
        return view("terdampak", [
            'data' => ModelsTerdampak::orderBy('created_at', 'DESC')->get(),
            'geofile' => $geofile,
            'color' => $color,
            'tematik' => $kecamatan,
            'id' => $id,
            'terdampak' => $terdampak,
            'tahunList' => $tahunList,
            'tahun' => $year
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Excel::import(new Terdampak, $request->file('file')->store('temp'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
