<table>
    <thead>
        <tr>
        <th>No</th>
        <th>Barang</th>
        <th>Jumlah</th>
        <th>Tanggal Masuk</th>
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
            <td>{{ $item->jumlah_masuk }}</td>
            <td>{{ $item->formatted_updated_at }}</td>
        </tr>
         @endif
         @empty
         <td>Datanya kosong XD</td>
         @endforelse
    </tbody>
</table>