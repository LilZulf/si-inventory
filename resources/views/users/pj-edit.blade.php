@extends('template')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Data PJ Ruangan</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('pj/update/' . $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="basicInput">Nama PJ</label>
                            <input type="text" class="form-control" id="basicInput" name="nama_pj"
                                value="{{ old('nama_pj', $data->nama_pj) }}">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">NIP</label>
                            <input type="text" class="form-control" id="basicInput" name="nip"
                                value="{{ old('nip', $data->nip) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="basicInput" value="{{ old('jenis_kelamin') }}">Jenis Kelamin</label>
                            <select class="choices form-select" name="jenis_kelamin">
                                <option value="Laki-laki"
                                    {{ old('jenis_kelamin', $data->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan"
                                    {{ old('jenis_kelamin', $data->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Alamat</label>
                            <input type="text" class="form-control" id="basicInput" name="alamat"
                                value="{{ old('alamat', $data->alamat) }}">
                        </div>
                        <!-- <div class="form-group">
                            <label for="basicInput">Email</label>
                            <input type="email" class="form-control" id="basicInput" name="email"
                                value="{{ old('email', $data->email) }}">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password"
                                    value="{{ old('password') }}">
                                <span class="input-group-text">
                                    <i class="bi bi-eye" id="togglePassword"></i>
                                </span>
                            </div>
                        </div> -->
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>

    </section>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //untuk icon show hide password
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.classList.toggle('bi-eye');
            togglePassword.classList.toggle('bi-eye-slash');
        });
    </script>
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
