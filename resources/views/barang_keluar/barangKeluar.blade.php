@extends('template')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endsection
@section('title')
    <h3>Daftar Barang Keluar</h3>
@endsection
@section('content')
    <div class="table-responsive">
        <a class="btn btn-primary mb-4 mt-2" href="/barang/keluar/tambah" role="button">Tambah Barang</a>
        {{-- <a class="btn btn-success mb-2" href="/barang/import" role="button">Import Excel</a> --}}
        <table id="example" class="table table-striped table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Quantity</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                @if (!$barangs->isEmpty())
                    @foreach ($barangs as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_barang }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->nama_kategori }}</td>
                            <td>{{ $item->satuan }}</td>
                            <td>{{ $item->jumlah_keluar }}</td>
                            @if ($item->status == 'validate')
                                <td>
                                    <a class="btn btn-success disabled" href="" role="button">Validated</a>
                                </td>
                            @else
                                <td><a class="btn btn-warning" href="/barang/keluar/edit/{{ $item->id_barang_keluar }}"
                                        role="button">Ubah</a>
                                    <a class="btn btn-danger" href="/barang/keluar/delete/{{ $item->id_barang_keluar }}"
                                        role="button">Hapus</a>
                                    <a id="confirm" class="btn btn-primary validasi"
                                        href="/barang/keluar/validasi/{{ $item->id_barang_keluar }}"
                                        role="button">Validate</a>

                                </td>
                            @endif

                        </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Quantity</th>
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
    </script>
@endsection
