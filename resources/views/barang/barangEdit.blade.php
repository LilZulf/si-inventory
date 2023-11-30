@extends('template')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Data Barang</h4>
            </div>

            <div class="card-body">
                <form action="{{ url('/barang/update/' . $barangs->id_barang) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Kode Barang</label>
                                <input type="text" class="form-control" id="basicInput" name="kode"
                                    value="{{ $barangs->kode_barang }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="helperText">Kategori</label>
                                <div>
                                    <select class="choices form-select" name="kategori">
                                        @foreach ($kategoris as $item)
                                            <option value="{{ $item->id_kategori }}"
                                                {{ $barangs->id_kategori == $item->id_kategori ? 'selected' : '' }}>
                                                {{ $item->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="helperText">Lokasi</label>
                                <div>
                                    <select class="choices form-select" name="lokasi">
                                        @foreach ($ruangs as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $barangs->id_ruangan == $item->id ? 'selected' : '' }}>
                                                {{ $item->ruangan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Nama Barang</label>
                                <input type="text" class="form-control" id="basicInput" name="nama"
                                    value="{{ $barangs->nama_barang }}">
                            </div>
                            <div class="form-group">
                                <label for="helpInputTop">Tahun Pengadaan</label>
                                <input type="text" class="form-control" name="tahun" id="helpInputTop"
                                    value="{{ $barangs->tahun_pengadaan }}">
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
