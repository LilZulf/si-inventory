@extends('template')
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Ubah Data Kategori</h4>
        </div>

        <div class="card-body">
            <form action="{{url('/kategori/edit/'.$kategori->id_kategori)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                        <div class="form-group">
                            <label for="basicInput">Nama Kategori</label>
                            <input type="text" class="form-control" id="basicInput" name="nama" value="{{$kategori->nama_kategori}}">
                    </div>
                </div>
            </div>
            <button class="btn btn-success" type="submit">Ubah</button>
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
                    'The id_kategori has already been taken.': 'ID Kategori sudah terdaftar.',
                    'The id_kategori field is required.': 'ID Kategori Harus Di Isi',
                    'The nama_kategori field is required.': 'Nama Kategori Harus Di Isi',
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