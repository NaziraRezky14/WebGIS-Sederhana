@extends('layouts.app')

@section('content')
    <a href="{{ route('login') }}" class="text-decoration-none text-white position-absolute m-4 py-1 btn btn-outline-success">
        <h4>Log in</h4>
    </a>
    <section class="first-section ">
        <div class="container " >
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content " >
                        <h2>WEBGIS RAWAN BANJIR KABUPATEN ACEH UTARA</h2>
                        <div class="line-dec"></div>
                        <span>Selamat Datang di WebGIS Rawan Banjir Kabupaten Aceh Utara</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="second-section">
        <div class="container">
            <div class="row mx-auto">
                <div class="col" >
                    <a href="{{ route('maps') }}" class="btn btn-outline-success py-2">
                        <div class="service-item">
                            <div class="icon" >
                                <i class="fa-solid fa-map-location h1"></i>
                            </div>
                            <h4 style="color:#EFD345"><b>MAPS</b></h4>
                            <p>Menampilkan informasi terkini terkait banjir di Kabupaten Aceh Utara 
                                berdasarkan kecamatan dan total kejadian banjir.</p>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('heatmap') }}" class="btn btn-outline-success py-2">
                        <div class="service-item">
                            <div class="icon">
                                <i class="fa-solid fa-map h1"></i>
                            </div>
                            <h4 style="color:#EFD345"><b>HEATMAPS</b></h4>
                            <p>Menampilkan informasi kawasan bahaya banjir sekaligus titik lokasi yang telah terjadi banjir.</p>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('halaman data2') }}" class="btn btn-outline-success py-2">
                        <div class="service-item">
                            <div class="icon">
                                <i class="fa-solid fa-database h1"></i>
                            </div>
                            <h4 style="color:#EFD345"><b>LAPOR BANJIR</b></h4>
                            <p>Anda dapat melihat data banjir dan dapat melapor 
                                kejadian banjir saat kejadian pada menu yang tersedia.</p>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('terdampak') }}" class="btn btn-outline-success py-2">
                        <div class="service-item">
                            <div class="icon">
                                <i class="fa-solid fa-database h1"></i>
                            </div>
                            <h4 style="color:#EFD345"><b>TERDAMPAK</b></h4>
                            <p>Anda dapat melihat data kejadian banjir beserta dampak yang diakibatkan oleh kejadian banjir 
                                berdasarkan kecamatan dan tahun kejadian.</p>
                        </div>
                    </a>
                </div>
                <div class="col" >
                    <a href="{{ route('panduan') }}" class="btn btn-outline-success py-2">
                        <div class="service-item" >
                            <div class="icon">
                                <i class="fa-solid fa-book h1"></i>
                            </div>
                            <h4 style="color:#EFD345"><b>PANDUAN</b></h4>
                            <p>Panduan agar dapat mengetahui cara mendapatkan informasi yang ada pada WebGIS ini.</p>
                        </div>
                    </a>
                </div>

            </div>
        </div>
        <div class="row mt-4 mx-4">
            <div class="col">
                <!-- small box -->
                <div class="card text-white text-center h-100" style="background-color: #4E944F">

                    <div class="card-body">
                        <p class="info-box-text" style="font-size:16px !important" >Banjir Terbanyak Kecamatan</p>
                         @if ($banjir_terbanyak)
                        <span>{{$banjir_terbanyak->kecamatan}} Jumlah Banjir {{$banjir_terbanyak->data_count}}</span>
                        @endif
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col">
                <!-- small box -->
                <div class="card text-white text-center h-100" style="background-color: #4E944F">
                    <div class="card-body">
                        <p class="info-box-text" style="font-size:16px !important">Durasi banjir terlama</p>
                        <p>{{$durasi}}</p>
                        <p>{{$durasi_des}}</p>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col">
                <!-- small box -->
                <div class="card text-white text-center h-100" style="background-color: #4E944F">
                    <div class="card-body">
                        <p class="info-box-text" style="font-size:16px !important">Kecamatan Dengan Banjir Tertinggi</p>
                        @if ($banjir_tertinggi->tematik)
                        <p>{{$banjir_tertinggi->tematik->kecamatan}} ({{$banjir_tertinggi->tinggi}}cm)</p>
                            
                        @endif
                    </div>
                </div>
            </div>
            <!-- ./col -->

        </div>
        <div class="row mt-5 mx-4">
            <section class="col-md-6">
                <div class="card" style="background-color: #A2B38B">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            Maps
                        </h3>

                    </div>
                    <div class="card-body">
                        <div id="map" style="height: 350px; width: 100%;"></div>
                    </div>

                </div>
            </section>

            <div class="col-md-6">
                
                <div class="d-flex flex-column">
                    <!-- small box -->
                  
                    <!-- ./col -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Grafik
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body" style="background-color: #A2B38B">
                            <div class="tab-content p-0">
                                <div class="chart" style="position: relative; height: 300px;">
                                    <canvas id="grafik" height="300" style="height: 300px;"></canvas>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>



   
@endsection
@section('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <style>
        .leaflet-control-attribution {
            display: none !important
        }

        .info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            font-color:#EDE6DB;
            background: #EDE6DB;
            background: #EDE6DB;
            box-shadow: 0 0 15px rgba(0, 0, 1.2, 1.2);
            border-radius: 5px;
        }

        .info h5 {
            margin: 0 0 5px;
            color: #777;
        }

        .legend {
            text-align: left;
            line-height: 18px;
            color: #555;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }
    </style>
@endsection
@push('scripts')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"
        integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var labels = {!! json_encode($chart_label) !!}
        const data = {
            labels: labels,
            datasets: [{
                label: '',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: {!! json_encode($chart_data) !!},

            }],
        };
        const plugin = {
            id: 'custom_canvas_background_color',
            beforeDraw: (chart) => {
                const ctx = chart.canvas.getContext('2d');
                ctx.save();
                ctx.globalCompositeOperation = 'destination-over';
                ctx.fillStyle = 'white';
                ctx.fillRect(0, 0, chart.width, chart.height);
                ctx.restore();
            }
        };
        const config = {
            type: 'line',
            data: data,
            plugins: [plugin],
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        min: 0,
                        ticks: {
                            stepSize: 5
                        }
                    }
                }
            }
        };
        const myChart = new Chart(
            document.getElementById('grafik'),
            config
        );
    </script>
    <!-- Leaflet JavaScript -->
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.1.0/leaflet.ajax.min.js"
        integrity="sha512-Abr21JO2YqcJ03XGZRPuZSWKBhJpUAR6+2wH5zBeO4wAw4oksr8PRdF+BKIRsxvCdq+Mv4670rZ+dLnIyabbGw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-search@2.3.7/dist/leaflet-search.src.css" />
    <script src="https://unpkg.com/leaflet-search@2.3.7/dist/leaflet-search.src.js"></script>
    <script type="text/javascript">
        var s = [4.9786, 97.2221];
        var color = {!! json_encode($color) !!};
        var datamap = {!! json_encode($data) !!}
        var test = {!! json_encode($test) !!}
        var map = L.map('map').setView(
            s, 11
        );


        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);


        var info = L.control();

        info.onAdd = function(map) {
            this._div = L.DomUtil.create('div', 'info');
            this.update();
            return this._div;
        };
        //menampilkan pop up info tematik
        info.update = function(props) {

        };

        info.addTo(map);

        function style(feature) {
            return {
                weight: 2,
                opacity: 1,
                color: 'black',
                dashArray: '3',
                fillOpacity: 0.9,
                fillColor: color[feature.properties.NAMOBJ]
            };

        }
        //memunculkan highlight pada peta
        function highlightFeature(e) {
            var layer = e.target;

            layer.setStyle({
                weight: 5,
                color: '#666',
                dashArray: '',
                fillOpacity: 0.7
            });

            if (!L.Browser.ie && !L.Browser.opera) {
                layer.bringToFront();
            }

            info.update(layer.feature.properties);
        }

        var geojson;

        function resetHighlight(e) {
            geojsonLayer.resetStyle(e.target);
            info.update();
        }

        function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds());
        }

        function onEachFeature(feature, layer) {
            layer.bindTooltip(feature.properties.NAMOBJ, {
                    permanent: true,
                    direction: 'center',
                    className: 'bg-transparent border-0 text-white shadow-none font-weight-bold'
                });
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
            });
        }
        var geojsonLayer = new L.GeoJSON.AJAX({!! json_encode($geofile) !!}, {
            style: style,
            onEachFeature: onEachFeature
        });
        geojsonLayer.addTo(map);

        var legend = L.control({
            position: 'bottomright'
        });


        var markersLayer = new L.LayerGroup(); //layer contain searched elements
        map.addLayer(markersLayer);
        var controlSearch = new L.Control.Search({
            position: 'topleft',
            layer: markersLayer,
            initial: false,
            zoom: 12,
            marker: false,
            autoType: false
        });
        map.addControl(controlSearch);
        for (var i = 0; i < datamap.length; i++) {
            // var title = datamap[i][0], //value searched
            var title = datamap[i][0] + "<br> Total Jumlah Banjir "+datamap[i][3] + "<br> Ketinggian Banjir Tertinggi "+datamap[i][4]+" cm",
                loc = [datamap[i][1], datamap[i][2]], //position found
                marker = new L.Marker(new L.latLng(loc), {
                    title: title
                }); //se property searched
            marker.bindPopup(title);
            markersLayer.addLayer(marker);
        }
    </script>
@endpush
