@extends('template')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endsection

@section('title')
    <h3>Daftar Barang Rusak Luar Ruangan</h3>
@endsection

@section('content')
    <div class="table-responsive">
        <a class="btn btn-primary mb-4 mt-2" href="/rusak/luar/tambah" role="button">Tambah Data</a>
        {{-- <a class="btn btn-success mb-2" href="/barang/import" role="button">Import Excel</a> --}}
        <table id="example" class="table table-striped table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Penginput</th>
                    <th>Barang</th>
                    <th>Jumlah Rusak</th>
                    <th>Tanggal Rusak</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (!$rusakluars->isEmpty())
                    @foreach ($rusakluars as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_pj }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->jumlah_rusak }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_rusak)->format('d-m-Y') }}</td>
                            <td>
                                @if($item->status == 1 )
                                    <span class="badge bg-primary">Waiting</span>
                                @elseif($item->status == 2 )
                                    <span class="badge bg-danger">Rusak</span>
                                @elseif($item->status == 3)
                                    <span class="badge bg-success">Sudah Diperbaiki</span>
                                @endif
                            </td>
                            <td>
                                @if($item->status == 1 )
                                <a class="btn btn-warning" href="/rusak/luar/edit/{{ $item->id_rusak_luar }}"
                                    role="button">Ubah</a>
                                <a class="btn btn-danger" href="/rusak/luar/delete/{{ $item->id_rusak_luar }}"
                                    role="button">Hapus</a>
                                <a id="confirm" class="btn btn-primary validasi"
                                    href="/rusak/luar/validasi/{{ $item->id_rusak_luar }}"
                                    role="button">Validate</a>
                                @elseif($item->status == 2 )
                                <form action="{{ url('/rusak/luar/saveStatus') }}" method="post" class="btn p-0" name="input-form" id="input-form">
                                    {{ csrf_field() }}
                                    <input type="text" id="id_rusak_luar" value="{{$item->id_rusak_luar}}" name="id_rusak_luar" hidden>
                                    <button type="submit" onclick="submitForm(event)" class="btn icon btn-success" ><i class="bi bi-check"></i></button>
                                </form>
                                @else
                                <a class="btn btn-danger" href="/rusak/luar/delete/{{ $item->id_rusak_luar }}"
                                    role="button">Hapus</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Penginput</th>
                    <th>Barang</th>
                    <th>Jumlah Rusak</th>
                    <th>Tanggal Rusak</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.7.0.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        new DataTable('#example');
    </script>
    <script>
        $('.btn-danger').on('click', function(e) {
            e.preventDefault();
            var href = $(this).attr('href');

            Swal.fire({
                title: "Are you sure?",
                text: "Yakin Hapus Data?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
        function submitForm(event) {
            event.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "Apakah Barang Selesai Diperbaiki?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Sudah!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.getElementById('input-form');
                    form.submit();
                }
            });
        }
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        @endif
    </script>
    <script>
        $('.validasi').on('click', function(e) {
            e.preventDefault();
            var href = $(this).attr('href');

            Swal.fire({
                title: "Are you sure?",
                text: "Yakin Validasi data?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya,Validasi!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        @endif
        @if (session('Gagal'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('Gagal') }}',
            });
        @endif
    </script>
@endsection
