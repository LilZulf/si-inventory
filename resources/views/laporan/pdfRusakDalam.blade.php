<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Barang Rusak Dalam</title>

    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: left;
        /* text-align: right; */
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
    @php
    {{
        $tanggal = date("d-m-Y");
    }}
    @endphp
    <center>
    <h2>Laporan Barang Rusak Dalam</h2>
    </center>       
    <label>Dicetak: {{$tanggal}}</label>  
        <table cellpadding="0" cellspacing="0" id="myTable">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ public_path('dist/assets/compiled/png/logo_smk.png') }}" alt="logo" width="150px">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                SMK AL-ISHLAHIYAH<br>
                                Jl. Kramat No.81, Pangetan, Singosari<br>
                                Kab. Malang, Jawa Timur 65153
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td width="15%">
                    Barang
                </td>
                <td width="5%">
                    Jumlah
                </td>
                <td width="10%">
                    Tanggal Rusak
                </td>
                <td width="10%">
                    Status
                </td>
            </tr>

            @if($rusakDalam->count())
            @foreach($rusakDalam as $item)
                @if ($item->status > 1)
                    <tr class="item">
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->jumlah_rusak }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_rusak)->format('d-m-Y') }}</td>
                        <td>{{ $item->status == 2 ? 'Rusak' : 'Sudah Diperbaiki'}}</td>
                    </tr>
                @endif
            @endforeach
            @endif
        </table>
        <br>
        <br>
        <br>
        <br>

        <div class="signature">
            <label>_________________________</label>
            <br>
            <label>Signature</label>
        </div>
    </div>
</body>
</html>
