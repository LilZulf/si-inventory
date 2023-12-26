@extends('template')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Data Barang Keluar</h4>
            </div>

            <div class="card-body">
                <form action="{{ url('/barang/keluar/update/' . $barangs->id_barang_keluar) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="helperText">Nama Barang</label>
                                <div>
                                    <select class="choices form-select" name="barang">
                                        @foreach ($listbarang as $item)
                                            <option value="{{ $item->id_barang }}"
                                                {{ $barangs->id_barang == $item->id_barang ? 'selected' : '' }}>
                                                {{ $item->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="helperText">Tujuan</label>
                                <div>
                                    <select class="form-select" name="ruang">
                                        @foreach ($listRuang as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $barangs->id_ruang == $item->id ? 'selected' : '' }}>
                                                {{ $item->ruangan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="helpInputTop">Jumlah</label>
                                <input type="text" class="form-control" name="jumlah" id="helpInputTop"
                                    value="{{ $barangs->jumlah_keluar }}">
                            </div>
                        </div>
                    </div>
            </div>
            <button class="btn btn-success" type="submit">Edit</button>
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
                    'The jumlah field is required.': 'Jumlah Harus Di Isi',

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
