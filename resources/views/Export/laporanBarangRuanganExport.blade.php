<thead>
    <tr>
        <th>No</th>
        <th>Ruangan</th>
        <th>Barang</th>
        <th>Jumlah Baik</th>
        <th>Jumlah Rusak</th>
        <th>Total</th>
    </tr>
</thead>
<tbody>
    @php
        $nomor = 1;
    @endphp
    @if (isset($data) && !$data->isEmpty())
        @foreach ($data as $item)
            <tr>
                <td>{{ $nomor++ }}</td>
                <td>{{ $item->ruangan }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->jumlah_keluar }}</td>
                <td>
                    @if($item->status == 2)
                        {{ $item->jumlah_rusak }}
                    @else
                        0
                    @endif
                </td>
                <td>
                    @if($item->status == 2)
                        {{ $item->jumlah_keluar + ($item->jumlah_rusak ?? 0) }}
                    @else
                        {{ $item->jumlah_keluar }}
                    @endif
                </td>
            </tr>
        @endforeach
    @else
    @endif
</tbody>