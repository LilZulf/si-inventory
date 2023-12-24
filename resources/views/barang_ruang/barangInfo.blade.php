@extends('template')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endsection
@section('title')
    <h3 class="mb-5">Daftar Barang</h3>
@endsection
@section('content')
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Quantity</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->kode_barang }}</td>
                        <td>{{ $data->nama_barang }}</td>
                        <td>{{ $data->nama_kategori }}</td>
                        <td>{{ $data->satuan }}</td>
                        <td>{{ $data->jumlah_keluar }}</td>
                        <td>{{ $data->created_at_formatted }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Quantity</th>
                    <th>Tanggal</th>
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
        $(document).ready(function() {
            new DataTable('#example');
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