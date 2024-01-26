@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('storage/css/halaman-data.css') }}">
    <div class="container-xl">
        <div class="table-responsive" style="background-color: white">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Data Banjir</h2>
                        </div>
                        <div class="col-sm-6 text-end">
                            @auth
                                <a href="{{ route('export') }}" class="btn btn-primary">Print</a>
                            @endauth
                            <a href="{{ route('tambah data2') }}" class="btn" style="background-color: #A2B38B"><i
                                    class="material-icons">&#xE147;</i>
                                <span>Lapor Banjir</span></a>
                        </div>
                    </div>

                </div>
                <table class="table table-striped table-hover" id="table">
                    <thead>
                        <tr>
                            <th>no</th>
                            <th>Kecamatan</th>
                            <th>Nama Lokasi</th>
                            <th>Alamat</th>
                            <th>Tanggal</th>
                            @auth
                                <th>Nama Pelapor</th>
                            @endauth
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ $item->tematik->kecamatan }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->tanggal }}</td>
                                @auth
                                    <td>{{ $item->nama_pelapor }}</td>
                                @endauth
                                <td class="w-25">

                                    <form action="{{ route('delete data2', ['id' => $item->id]) }}" method="get">
                                        <a href="{{ route('detail map', ['id' => $item->id]) }}" class="edit"
                                            data-toggle="tooltip" title="Detail"><i
                                                class="fas fa-map-marker-alt text-danger"></i></a>
                                        @auth

                                            <a href="{{ route('edit data2', ['id' => $item->id]) }}" class="edit"><i
                                                    class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                            <button type="submit" class="delete show_confirm border-0 p-0 bg-transparent"><i
                                                    class="material-icons" data-toggle="tooltip"
                                                    title="Delete">&#xE872;</i></button>
                                        @endauth
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
@endsection
