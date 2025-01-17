@extends('template')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Data Admin</h4>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/tambah') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Nama Admin</label>
                                <input type="text" class="form-control" id="basicInput" name="nama"
                                    value="{{ old('nama_pj') }}">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">NIP</label>
                                <input type="text" class="form-control" id="basicInput" name="nip"
                                    value="{{ old('nip') }}">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Alamat</label>
                                <input type="text" class="form-control" id="basicInput" name="alamat"
                                    value="{{ old('alamat') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput" value="{{ old('jenis_kelamin') }}">Jenis Kelamin</label>
                                <select class="choices form-select" name="jenis_kelamin">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Email</label>
                                <input type="email" class="form-control" id="basicInput" name="email"
                                    value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                        value="{{ old('email') }}">
                                    <span class="input-group-text">
                                        <i class="bi bi-eye" id="togglePassword"></i>
                                    </span>
                                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <script>
        // $(document).ready(function() {
        //     @if (session('errors'))
        //         var errors = @json(session('errors')->all());
        //         var errorMessage = errors;
        //         var indonesianMessages = {
        //             'The email has already been taken.': 'Email sudah terdaftar.',
        //             'The nama_pj field is required.': 'Nama PJ Harus Di Isi',
        //             'The nip field is required.': 'NIP Harus Di Isi',
        //             'The alamat field is required.': 'Alamat Harus Di Isi',
        //             'The jenis_kelamin field is required.': 'Jenis Kelamin Harus Di Isi',
        //             'The email field is required.': 'Email Harus Di Isi',
        //             'The password field is required.': 'Password Harus Di Isi',
        //         };
        //         for (var key in indonesianMessages) {
        //             if (indonesianMessages.hasOwnProperty(key) && errorMessage.includes(key)) {
        //                 errorMessage = indonesianMessages[key];
        //                 break;
        //             }
        //         }

        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Error',
        //             text: errorMessage,
        //         });
        //     @endif
        // });
        $(document).ready(function() {
            @if (session('errors'))
                var errors = @json(session('errors')->all());
                var errorMessage = errors;
                var indonesianMessages = {
                    'The email has already been taken.': 'Email sudah terdaftar.',
                    'The nama field is required.': 'Nama Admin Harus Di Isi',
                    'The nip field is required.': 'NIP Harus Di Isi',
                    'The alamat field is required.': 'Alamat Harus Di Isi',
                    'The jenis_kelamin field is required.': 'Jenis Kelamin Harus Di Isi',
                    'The email field is required.': 'Email Harus Di Isi',
                    'The password field is required.': 'Password Harus Di Isi',
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
                    showCancelButton: false,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Fokus pada input yang tidak valid pertama
                        var firstErrorInput = $('.is-invalid:first');
                        if (firstErrorInput.length) {
                            firstErrorInput.focus();
                        }

                        // Kosongkan hanya input yang tidak valid
                        $('.is-invalid').each(function() {
                            if ($(this).val() === '') {
                                $(this).val($(this).attr('name')).trigger('input');
                            }
                        });

                        // Bersihkan pesan error Laravel
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();
                    }
                });
            @endif
        });

        $(document).ready(function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: '{{ session('success') }}',
                });
            @endif

            @if (session('errors'))
                var errors = @json(session('errors')->all());
                var errorMessage = errors;
                var indonesianMessages = {
                    'The email has already been taken.': 'Email sudah terdaftar.',
                    'The nama field is required.': 'Nama Admin Harus Di Isi',
                    'The nip field is required.': 'NIP Harus Di Isi',
                    'The alamat field is required.': 'Alamat Harus Di Isi',
                    'The jenis_kelamin field is required.': 'Jenis Kelamin Harus Di Isi',
                    'The email field is required.': 'Email Harus Di Isi',
                    'The password field is required.': 'Password Harus Di Isi',
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
                    showCancelButton: false,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Fokus pada input yang tidak valid pertama
                        var firstErrorInput = $('.is-invalid:first');
                        if (firstErrorInput.length) {
                            firstErrorInput.focus();
                        }

                        // Kosongkan hanya input yang tidak valid
                        $('.is-invalid').each(function() {
                            if ($(this).val() === '') {
                                $(this).val($(this).attr('name')).trigger('input');
                            }
                        });

                        // Bersihkan pesan error Laravel
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();
                    }
                });
            @endif
        });


        //untuk melihat password
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.classList.toggle('bi-eye');
            togglePassword.classList.toggle('bi-eye-slash');
        });
    </script>
@endsection
