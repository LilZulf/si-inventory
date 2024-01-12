@extends('template')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Data Rusak Dalam</h4>
            </div>

        <div class="card-body">
            <form action="{{ url('/rusak/dalam/update/' . $datas->id_rusak_dalam) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="helperText">Penginput</label>
                            <div>
                                <select class="choices form-select" name="id_pj">
                                    @foreach ($pjs as $pj)
                                        <option value="{{ $pj->id }}" {{ $datas->id_pj == $pj->id ? 'selected' : '' }}>
                                            {{ $pj->nama_pj }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="helperText">Nama Barang</label>
                                <div>
                                    <select class="choices form-select" name="id_barang">
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id_barang }}" {{ $datas->id_barang == $barang->id_barang ? 'selected' : '' }}>
                                                {{ $barang->nama_barang }}</option>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="basicInput">Jumlah Rusak</label>
                                <input type="text" class="form-control" id="basicInput" name="jumlah_rusak"
                                    value="{{ $datas->jumlah_rusak }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                                <label for="helperText">Ruangan</label>
                                <div>
                                    <select class="choices form-select" name="id_ruangan">
                                        @foreach ($ruangs as $ruang)
                                            <option value="{{ $ruang->id }}" {{ $datas->id_ruangan == $ruang->id ? 'selected' : '' }}>
                                                {{ $ruang->ruangan }}</option>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                            <div class="form-group">
                                <label for="basicInput">Tanggal Rusak</label>
                                <input type="date" class="form-control" id="tanggal_rusak" name="tanggal_rusak"
                                    value="{{ $datas->tanggal_rusak }}">
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>

    </section>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            @if (session('errors'))
                var errors = @json(session('errors')->all());
                var errorMessage = errors;
                var indonesianMessages = {
                    'The id_pj field is required.': 'Penginput Harus Di Isi',
                    'The id_barang field is required.': 'Nama Barang Harus Di Isi',
                    'The jumlah_rusak field is required.': 'Jumlah Rusak Harus Di Isi',
                    'The id_ruangan field is required.': 'Ruangan Harus Di Isi',
                    'The tanggal_rusak field is required.': 'Tanggal Rusak Harus Di Isi',
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
@endsection
