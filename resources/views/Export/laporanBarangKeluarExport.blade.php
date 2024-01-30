<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Tujuan</th>
            <th>Tanggal Keluar</th>
        </tr>
    </thead>
    <tbody>
        @php
        $nomor = 1;
        @endphp
        @forelse ($data as $item)    
        @if ($item->status == 'validate')
        <tr>
            <td>{{ $nomor++ }}</td>
            <td>{{ $item->nama_barang }}</td>
            <td>{{ $item->jumlah_keluar }}</td>
            <td>{{ $item->ruangan }}</td>
            <td>{{ $item->formatted_created_at }}</td>
        </tr>
         @endif
         @empty
         <td>Datanya kosong XD</td>
         @endforelse
    </tbody>
</table>