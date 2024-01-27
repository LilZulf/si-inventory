<thead>
    <tr>
        <th>No</th>
        <th>Nama Peminjam</th>
        <th>Barang</th>
        <th>Jumlah</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
    </tr>
</thead>
<tbody>
    @php
        $nomor = 1;
    @endphp
    @if (isset($data) && !$data->isEmpty())
        @foreach ($data as $item)
            @if ($item->status == 'returned' || $item->status == 'borrowed')
                <tr>
                    <td>{{ $nomor++ }}</td>
                    <td>{{ $item->peminjam }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->jumlah_pinjam }}</td>
                    <td>
                        @if($item->status == 'returned' )
                            {{ $item->formatted_updated_at }}
                        @elseif($item->status == 'borrowed')
                            -
                        @endif
                    </td>
                    <td>
                        @if($item->status == 'returned' )
                            Dikembalikan
                        @elseif($item->status == 'borrowed')
                            Dipinjam
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
    @else
    @endif
</tbody>