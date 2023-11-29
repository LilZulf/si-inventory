@extends('template')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Data Ruangan</h4>
            </div>

            <div class="card-body">
                <form action="{{ url('/ruangan/tambah') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Kode Ruangan</label>
                                <input type="text" class="form-control" id="basicInput" name="kode_ruangan">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Ruangan</label>
                                <input type="text" class="form-control" id="basicInput" name="ruangan">
                            </div>
                            <div class="form-group">
                                <label for="helperText">PJ</label>
                                <div>
                                    <select class="choices form-select" name="id_pj">
                                        <option value="1">Alex</option>
                                        <option value="2">Yono</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicTextarea">Keterangan</label>
                                <textarea class="form-control" id="basicTextarea" name="keterangan" rows="4">{{ old('keterangan') }}</textarea>
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
