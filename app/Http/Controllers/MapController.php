<?php

namespace App\Http\Controllers;

use App\Models\DataBanjir;
use App\Models\Desa;
use App\Models\HalamanData;
use App\Models\HalamanData2;
use App\Models\Tematik;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $geofile = [];
        $color = [];
        $coor = [];
        $index = 0;
        $index2 = 0;
        $data = DataBanjir::all();
        $tematik = Tematik::all();

        foreach ($tematik as $item) {
            $geofile[$index] = 'storage/' . $item->geojson;
            $index++;
        }
        foreach ($tematik as $item) {
            $color[$item->kecamatan] = $item->warna;
        }
        foreach ($tematik as $item) {
            $id[$item->kecamatan] = $item->id;
        }
        $kecamatan = $tematik->pluck('kecamatan');
        $banjir_tertinggi = DataBanjir::groupBy('tematik_id')->orderBy('ketinggian')->pluck('ketinggian', 'tematik_id');
        $jumlah = DataBanjir::withCount('tematik')->groupBy('tematik_id')->pluck('tematik_count', 'tematik_id');

        foreach ($data as $item) {
            $coor[$index2] = [$item->lat, $item->long, $jumlah[$item->tematik_id], $banjir_tertinggi[$item->tematik_id],$item->alamat];
            $index2++;
        }
        $tahun = new Collection();
        foreach ($tematik as $item) {
            $tahunan = DataBanjir::where('tematik_id', $item->id)->select(DB::raw('YEAR(tanggal) as tahun'))->groupBy('tahun')->pluck('tahun');
            foreach ($tahunan as $value) {
                $tinggi = DataBanjir::where(['tematik_id' => $item->id])->whereYear('tanggal', $value)->max('ketinggian');
                $max = DataBanjir::where(['tematik_id' => $item->id, 'ketinggian' => $tinggi])->whereYear('tanggal', $value)->first();
                if (!isset($tahun[$item->id])) {
                    $tahun[$item->id] = collect();
                }
                if ($max) {
                    $tahun[$item->id]->push('Kecamatan : '.$max->tematik->kecamatan.'<br/>'.'Lokasi : ' . $max->alamat . "<br/> Tahun : " .$value . "<br/> Ketinggian : ". $max->ketinggian . ' cm'.'<br/><hr/><br/>');
                }
            }
        }
        $test = DB::table('data_banjirs')
            ->join('tematiks', 'tematiks.id', '=', 'data_banjirs.tematik_id')
            ->select('data_banjirs.*', 'tematiks.*')
            ->get();
        return view('maps', [
            'geofile' => $geofile,
            'tematik' =>  $kecamatan,
            'color' => $color,
            'data' => $coor,
            'test' => $test,
            'tahun' => $tahun,
            'id' => $id,
        ]);
    }
    public function indexTitik()
    {
        $geofile = [];
        $color = [];
        $coor = [];
        $index = 0;
        $index2 = 0;
        $tematik = Tematik::all();
        $data = DataBanjir::all();

        foreach ($tematik as $item) {
            $geofile[$index] = '/storage/' . $item->geojson;
            $index++;
        }
        foreach ($tematik as $item) {
            $color[$item->kecamatan] = $item->warna;
        }
        foreach ($data as $item) {
            $coor[$index2] = [$item->nama, $item->lat, $item->long];
            $index2++;
        }

        return view('maps_titik', [
            'data' => $coor,
            'geofile' => $geofile,
            'color' => $color,
            'tematik' => $tematik,
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
        //
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
