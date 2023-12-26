@extends('template')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Data Barang</h4>
            </div>

            <div class="card-body">
                <form action="{{ url('/barang/tambah') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Kode Barang</label>
                                <input type="text" class="form-control" id="basicInput" name="kode">
                            </div>

                            <div class="form-group">
                                <label for="helperText">Kategori</label>
                                <div>
                                    <select class="choices form-select" name="kategori">
                                        @foreach ($kategoris as $item)
                                            <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                                        @endforeach
                                        {{-- <option value="1">Square</option>
                                        <option value="2">Rectangle</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="helpInputTop">Jumlah</label>
                                <input type="text" class="form-control" name="jumlah" id="helpInputTop">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Nama Barang</label>
                                <input type="text" class="form-control" id="basicInput" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="helpInputTop">Satuan</label>
                                <input type="text" class="form-control" name="satuan" id="helpInputTop">
                            </div>

                        </div>
                    </div>
            </div>
            <button class="btn btn-success" type="submit">Tambah</button>
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
                    'The nisn has already been taken.': 'Email sudah terdaftar.',
                    'The nama field is required.': 'Nama Harus Di Isi',
                    'The nisn field is required.': 'NIP Harus Di Isi',
                    'The kelas field is required.': 'Alamat Harus Di Isi',
                    'The jenis_kelamin field is required.': 'Jenis Kelamin Harus Di Isi',

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
