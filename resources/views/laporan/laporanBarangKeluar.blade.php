@extends('template')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Laporan Barang Keluar</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-5">
                        <form action="{{ url('/laporan/barangKeluar') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jam">Tanggal Awal</label>
                                        <input id="helpInputTop" class="form-control" type="date" name="tanggalawal">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jam">Tanggal Akhir</label>
                                        <input id="helpInputTop" class="form-control" type="date" name="tanggalakhir">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit" name="action" value="filter">Filter</button>
                            <button class="btn btn-success" type="submit" name="action" value="excel">
                                <i class="bi bi-file-excel"></i> Export Excel</button>
                            <button class="btn btn-danger" type="submit" name="action" value="pdf">
                                <i class="bi bi-file-pdf"></i> Export PDF</button>
                        </form>
                    </div>
                    <div class="col">
                        <table id="example" class="table table-striped table-bordered datatables" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Tujuan</th>
                                    <th>Tanggal Keluar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nomor = 1;
                                @endphp
                                @if (isset($barangKeluar) && !$barangKeluar->isEmpty())
                                    @foreach ($barangKeluar as $item)
                                        @if ($item->status == 'validate' || $item->status == 'returned')
                                            <tr>
                                                <td>{{ $nomor++ }}</td>
                                                <td>{{ $item->nama_barang }}</td>
                                                <td>{{ $item->jumlah_keluar }}</td>
                                                <td>{{ $item->ruangan }}</td>
                                                <td>{{ $item->formatted_created_at }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                @endif
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Tujuan</th>
                                    <th>Tanggal Keluar</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.7.0.js" type="text/javascript"></script> --}}
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            @if (session('errors'))
                var errors = @json(session('errors')->all());
                var errorMessage = errors;
                var indonesianMessages = {
                    'The tanggalawal field is required.': 'Tanggal Awal Harus Di Isi',
                    'The tanggalakhir field is required.': 'Tanggal Akhir Harus Di Isi'

                };
                for (var key in indonesianMessages) {
                    if (indonesianMessages.hasOwnProperty(key) && errorMessage.includes(key)) {
                        errorMessage = indonesianMessages[key];
                        break;
                    }
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                });
            @endif
        });
    </script>

    <script>
        new DataTable('#example');
    </script>
@endsection
