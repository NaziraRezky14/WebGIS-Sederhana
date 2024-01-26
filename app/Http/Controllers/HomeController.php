<?php

namespace App\Http\Controllers;

use App\Models\DataBanjir;
use App\Models\HalamanData;
use App\Models\HalamanData2;
use App\Models\Tematik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $banjir_tertinggi = DataBanjir::select('tematik_id', DB::raw('MAX(ketinggian) as tinggi'))
            ->groupBy('tematik_id')
            ->pluck('tinggi', 'tematik_id');
        $jumlah = DataBanjir::withCount('tematik')->groupBy('tematik_id')->pluck('tematik_count', 'tematik_id');
        foreach ($data as $item) {
            $coor[$index2] = [$item->tematik->kecamatan, $item->lat, $item->long, $jumlah[$item->tematik_id], $banjir_tertinggi[$item->tematik_id]];
            $index2++;
        }
        $chart_label = [];
        $chart_data = [];

        $data2 = Tematik::withCount('data')->get();
        $id = 0;
        foreach ($data2 as $item) {
            $chart_label[$id] = $item->kecamatan;
            $chart_data[$id] = $item->data_count;
            $id += 1;
        }
        $banjir_terbanyak = Tematik::withCount('data')->orderBy('data_count', 'desc')->first();
        $banjir_tertinggi = DataBanjir::select('tematik_id', DB::raw('MAX(ketinggian) as tinggi'))->first();
        $durasi = [];
        $durasi_des = [];
        foreach ($data as $item) {
            $durasi[$item->tematik->kecamatan] = ($item->hari * 1440) + ($item->jam * 60) + $item->menit;
            $durasi_des[$item->tematik->kecamatan] = $item->hari . ' hari ' . $item->jam . ' jam ' . $item->menit . ' menit';
        }
        $durasi_value = max($durasi);
        $durasi_key =  array_search($durasi_value, $durasi);
        $durasi_des = $durasi_des[$durasi_key];
        return view('home', [
            'geofile' => $geofile,
            'color' => $color,
            'data' => $coor,
            'tematik' => $tematik,
            'chart_label' => $chart_label,
            'chart_data' => $chart_data,
            'banjir_terbanyak' => $banjir_terbanyak,
            'banjir_tertinggi' => $banjir_tertinggi,
            'durasi' => $durasi_key,
            'durasi_des'=> $durasi_des
        ]);
    }
}
