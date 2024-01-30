@extends('template')

@section('style')
    <link rel="stylesheet" href="{{ asset('dist/assets/extensions/simple-datatables/style.css') }}">


    <link rel="stylesheet" href="{{ asset('dist/assets/compiled/css/table-datatable.css') }}">
@endsection

@section('title')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Dashboard Invento</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
        </div>
    </div>
@endsection

@section('content')
    <div class="hero bg-primary text-white p-5 rounded">
        <div class="hero-inner">
            <h2>Selamat Datang!</h2>
            <p class="lead">Dashboard Pengelolaan Barang dan Ruangan</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Jumlah Barang</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        {{-- Replace 'placeholderItemCount' with the actual variable holding the count of items --}}
                        Jumlah Barang: {{ $data->count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Jumlah Ruangan</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        {{-- Replace 'placeholderRoomCount' with the actual variable holding the count of rooms --}}
                        Jumlah Ruangan: {{ $ruangan->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('dist/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('dist/assets/static/js/pages/simple-datatables.js') }}"></script>
@endsection
