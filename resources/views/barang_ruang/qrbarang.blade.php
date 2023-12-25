<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qr Barang - Detail Barang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
</head>

<body>

    <div class="container mt-5">
        <h3 class="mb-4">Qr Barang - {{ $barangData->nama_barang }}</h3>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Detail Barang</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Kode Barang:</strong> {{ $barangData->kode_barang }}</p>
                        <p><strong>Nama Barang:</strong> {{ $barangData->nama_barang }}</p>
                        <p><strong>Kategori:</strong> {{ $barangData->nama_kategori }}</p>
                        <p><strong>Satuan:</strong> {{ $barangData->satuan }}</p>
                        <p><strong>Jumlah Dalam Ruangan:</strong> {{ $barangData->jumlah_keluar }}
                            {{ $barangData->satuan }}</p>
                        <p><strong>Ruangan:</strong> {{ $barangData->ruangan }} ({{ $barangData->kode_ruangan }})</p>
                        <p><strong>PJ Ruangan:</strong> {{ $barangData->nama_pj }}</p>
                    </div>
                    <div class="col-md-6">
                        {!! $simple !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional: Add your scripts here if needed -->

</body>

</html>
