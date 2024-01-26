@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-4">
            <form action="{{ route('update data2', ['id' => $id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <select class="form-select" name="kecamatan" required>
                                <option value="">Pilih Kecamatan</option>
                                @foreach ($tematik as $kecamatan)
                                    <option {{ $kecamatan->id == $data->tematik->id ? 'selected' : '' }}
                                        value="{{ $kecamatan->id }}">{{ $kecamatan->kecamatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Pelapor</label>
                            <input name="nama_pelapor" value="{{ $data->nama_pelapor }}" type="text" class="form-control" 
                                required>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input value="{{ $data->nama }}" name="lokasi" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input value="{{ $data->alamat }}" name="alamat" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Kejadian</label>
                            <input value="{{ $data->tanggal }}" name="tanggal" type="date" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah korban</label>
                            <input name="ket" type="number" class="form-control" value="{{ $data->ket }}" required>
                        </div>
                         <style>
                            .slider-wrapper input {
                                width: 358px;
                                height: 23px;
                                margin: 0;
                                transform-origin: 319px 71px;
                                transform: rotate(-90deg);
                            }
                        </style>
                       <div class="form-group">
                            <label>Ketinggian Banjir</label>
                            <div class="slider-wrapper text-end" style="background: url({{asset('/storage/level.png')}});background-repeat: no-repeat; background-size:310px 310px;background-position:bottom">
                                <input type="range" class="me-3" name="ketinggian" min="0" max="200" value="100"
                                    step="1" list="level" value="{{$data->ketinggian}}">
                                <datalist id="level" class="d-block mr-5">
                                    <option class="border-1" value="200" label="200 cm"></option>
                                    <option class="border-1" value="190"></option>
                                    <option class="border-1" value="180"></option>
                                    <option class="border-1" value="170"></option>
                                    <option class="border-1" value="160"></option>
                                    <option class="border-1" value="150" label="150 cm"></option>
                                    <option class="border-1" value="140"></option>
                                    <option class="border-1" value="130"></option>
                                    <option class="border-1" value="120"></option>
                                    <option class="border-1" value="110"></option>
                                    <option class="border-1" value="100" label="100 cm"></option>
                                    <option class="border-1" value="90"></option>
                                    <option class="border-1" value="80"></option>
                                    <option class="border-1" value="70"></option>
                                    <option class="border-1" value="60"></option>
                                    <option class="border-1" value="50" label="50 cm"></option>
                                    <option class="border-1" value="40"></option>
                                    <option class="border-1" value="30"></option>
                                    <option class="border-1" value="20"></option>
                                    <option class="border-1" value="10"></option>
                                    <option class="border-1" value="0" label="0 cm"></option>
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Longitude <i class="text-danger">*Silahkan pilih titik lokasi pada map dibawah</i></label>
                            <input id='longitude' name="long" type="text" class="form-control" required
                                value="{{ $data->long }}">
                        </div>
                        <div class="form-group">
                            <label>Latitude <i class="text-danger">*Silahkan pilih titik lokasi pada map dibawah</i></label>
                            <input id='latitude' name="lat" type="text" class="form-control" required
                                value="{{ $data->lat }}">
                        </div>
                        <div class="form-group">
                            <label>Kerusakan yang diakibatkan</label>
                            <input name="kerusakan" type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Durasi banjir</label>
                            <div class="row">
                                <div class="col-md-4 d-flex">
                                    <input type="number" value="{{$data->hari}}" class="form-control" id="hari" name="hari">
                                    <label id="hari" class="mx-2 my-auto">Hari</label>
                                </div>
                                <div class="col-md-4 d-flex">
                                    <input type="number" value="{{$data->jam}}" class="form-control" id="jam" name="jam">
                                    <label id="jam" class="mx-2 my-auto">Jam</label>
                                </div>
                                <div class="col-md-4 d-flex">
                                    <input type="number" value="{{$data->menit}}" class="form-control" id="menit" name="menit">
                                    <label id="menit" class="mx-2 my-auto">Menit</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" cols="30" rows="10">{{ $data->deskripsi }}</textarea>
                        </div>
                       
                    </div>
                    
                </div>
                
                <div class="container mt-4" id="mapid"></div>
                <button class="btn float-end mt-4 text-white" type="submit"
                    style="background-color: #1D5C63">Simpan</button>
            </form>
        </div>
    </div>
@endsection

@section('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <style>
        #mapid {
            min-height: 500px;
        }
    </style>
@endsection

@push('scripts')
    <!-- Leaflet JavaScript -->
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <script>
        let latitude = document.getElementById('latitude').value;
        let longitude = document.getElementById('longitude').value;
        var mapCenter = [
            latitude,
            longitude,
        ];
        var map = L.map('mapid').setView(mapCenter, {{ config('leafletsetup.zoom_level') }});
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        var marker = L.marker(mapCenter).addTo(map);

        function updateMarker(lat, lng) {
            marker
                .setLatLng([lat, lng])
                .bindPopup("Your location :" + marker.getLatLng().toString())
                .openPopup();
            return false;
        };
        map.on('click', function(e) {
            let latitude = e.latlng.lat.toString().substring(0, 15);
            let longitude = e.latlng.lng.toString().substring(0, 15);
            $('#latitude').val(latitude);
            $('#longitude').val(longitude);
            updateMarker(latitude, longitude);
        });
        var updateMarkerByInputs = function() {
            return updateMarker($('#latitude').val(), $('#longitude').val());
        }
        $('#latitude').on('input', updateMarkerByInputs);
        $('#longitude').on('input', updateMarkerByInputs);
    </script>
@endpush
