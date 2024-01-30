<thead>
    <tr>
        <th>No</th>
        <th>Barang</th>
        <th>Jumlah</th>
        <th>Tanggal Rusak</th>
        <th>Status</th>
    </tr>
</thead>
<tbody>
    @if (isset($data) && !$data->isEmpty())
        @foreach ($data as $item)
            @if ($item->status > 1)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->jumlah_rusak }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_rusak)->format('d-m-Y') }}</td>
                <td>
                    @if($item->status == 2 )
                        <span class="badge bg-primary">Rusak</span>
                    @elseif($item->status == 3)
                        <span class="badge bg-secondary">Sudah Diperbaiki</span>
                    @endif
                </td>
            </tr>
            @endif
        @endforeach
    @else
       
    @endif
</tbody>