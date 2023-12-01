@extends('template')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endsection
@section('title')
    <h3>Daftar Barang</h3>
@endsection
@section('content')
    <div class="table-responsive">
        <a class="btn btn-primary mb-4 mt-2" href="/barang/tambah" role="button">Tambah Barang</a>
        {{-- <a class="btn btn-success mb-2" href="/barang/import" role="button">Import Excel</a> --}}
        <table id="example" class="table table-striped table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Tahun Pengadaan</th>
                    <th>Ruangan</th>
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
                            <td>{{ $item->tahun_pengadaan }}</td>
                            <td>{{ $item->ruangan }}</td>
                            <td><a class="btn btn-warning" href="/barang/edit/{{ $item->id_barang }}"
                                    role="button">Ubah</a>
                                <a class="btn btn-danger" href="/barang/delete/{{ $item->id_barang }}"
                                    role="button">Hapus</a>
                            </td>
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
                    <th>Tahun Pengadaan</th>
                    <th>Ruangan</th>
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
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        @endif
    </script>
@endsection