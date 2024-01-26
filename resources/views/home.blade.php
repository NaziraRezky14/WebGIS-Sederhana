<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB GIS</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

     <script src="https://unpkg.com/esri-leaflet@3.0.10/dist/esri-leaflet.js"></script>

     <style>#map { height: 500px; }</style>
</head>
<body>
    <div id="map"></div>
</body>

<script>
    var map = L.map('map').setView([5.5543824, 95.316496], 18);
    L.esri.basemapLayer('Imagery').addTo(map);

    //street
    // L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
    //      maxZoom: 20,
    //      subdomains:['mt0','mt1','mt2','mt3']
    // }).addTo(map);
</script>

<link rel="stylesheet" href="{{ asset('storage/css/halaman-data.css') }}">
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Data <b>Tematik</b></h2>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a href="{{ route('tambah tematik') }}" class="btn"
                                style="background-color: #417D7A"><i class="material-icons">&#xE147;</i> <span>Masukkan Data
                                    Baru</span></a>

                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover" id="table">
                    <thead>
                        <tr>
                            <th>
                                no
                            </th>
                            <th>Kecamatan</th>
                            <th>Warna</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ $item->kecamatan }}</td>
                                <td><input type="color" disabled value="{{ $item->warna }}"></td>
                                <td class="w-25">

                                    <form action="{{ route('delete tematik', ['id' => $item->id]) }}" method="get">
                                        <a href="{{ route('edit tematik', ['id' => $item->id]) }}"
                                            class="edit"><i class="material-icons" data-toggle="tooltip"
                                                title="Edit">&#xE254;</i></a>
                                        <button type="submit" class="delete show_confirm border-0 p-0 bg-transparent"><i
                                                class="material-icons" data-toggle="tooltip"
                                                title="Delete">&#xE872;</i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    </div>
    <!-- Delete Modal HTML -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Anda yakin ingin menghapus data ini?`,
                    text: "Jika kamu menghapus, data akan hilang parmanen.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
</html>