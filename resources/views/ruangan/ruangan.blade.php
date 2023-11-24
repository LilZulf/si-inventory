@extends('template')

@section('style')
    <link rel="stylesheet" href="{{asset('dist/assets/extensions/simple-datatables/style.css')}}">


    <link rel="stylesheet" href="{{asset('dist/assets/compiled/css/table-datatable.css')}}">
@endsection

@section('title')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Ruangan</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Master</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ruangan</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Data Ruangan
            </h5>
            <a class="btn btn-primary mb-2" href="/siswa/tambah" role="button">Tambah Siswa</a>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Ruangan</th>
                        <th>Ruangan</th>
                        <th>PJ</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tBody>
                    @foreach ($datas as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->kode_ruangan}}</td>
                            <td>{{$item->ruangan}}</td>
                            <td>{{$item->id_pj}}</td>
                            <td>{{$item->keterangan}}</td>
                            <td>Edit | Delete</td>
                        </tr>
                    @endforeach
                </tBody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('dist/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('dist/assets/static/js/pages/simple-datatables.js') }}"></script>
@endsection
