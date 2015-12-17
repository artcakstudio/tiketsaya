<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style>
        table {
            color: #333;
            border-spacing: 0;
        }

        td {
            border: 1px solid transparent; /* No more visible border */
            height: 30px;
            transition: all 0.3s;  /* Simple transition for hover effect */
        }

        th {
            background: #DFDFDF;  /* Darken header a bit */
            font-weight: bold;
        }

        td {
            background: #FAFAFA;
            text-align: center;
        }

        /* Cells in even rows (2,4,6...) are one color */
        tr:nth-child(even) td { background: #F1F1F1; }

        /* Cells in odd rows (1,3,5...) are another (excludes header cells)  */
        tr:nth-child(odd) td { background: #FEFEFE; }

        .right {
            text-align: right;
        }

        .left {
            text-align: left;
            min-width: 100px;
        }
    </style>
</head>
<body>
<b>Invoice ini juga berfungsi sebagai tiket.</b>
<b>Harap dicetak dan dibawa sebelum berangkat.</b>
@if(Session::has('DATA_TRAVEL'))
    <h3>Detil Customer</h3>
    <hr>
    <table>
        <tr><td class="right">Nama Customer :</td>
            <td class="left">{!! Session::get('DATA_COSTUMER')['COSTUMER_NAME'] !!}</td></tr>
        <tr><td class="right">No. Telepon :</td>
            <td class="left">{!! Session::get('DATA_COSTUMER')['nohp_prefix'] !!}
                {!! Session::get('DATA_COSTUMER')['COSTUMER_TELP'] !!} </td></tr>
        <tr><td class="right">E-mail :</td>
            <td class="left">{!! Session::get('DATA_COSTUMER')['COSTUMER_EMAIL'] !!} </td></tr>
    </table>
    <br>
    <h3>Detil Pemesanan</h3>
    <hr>
    <table>
        <tr><td class="right">Nomor Tiket :</td>
            <td class="left">{!! Session::get('NO_PEMESANAN') !!} </td></tr>
        <tr><td class="right">Asal :</td>
            <td class="left">{!! Session::get('DATA_TRAVEL')['ROUTE_DEPARTURE'] !!} </td></tr>
        <tr><td class="right">Tujuan :</td>
            <td class="left">{!! Session::get('DATA_TRAVEL')['ROUTE_DEST'] !!}</td></tr>
        <tr><td class="right">Jam Berangkat :</td>
            <td class="left">{!! Session::get('DATA_TRAVEL')['TRAVEL_SCHEDULE_ARRIVETIME'] !!}</td></tr>
        <tr><td class="right">Jam Sampai :</td>
            <td class="left">{!! Session::get('DATA_TRAVEL')['TRAVEL_SCHEDULE_DEPARTTIME'] !!}</td></tr>
        <tr><td class="right">Kendaraan :</td>
            <td class="left">{!! Session::get('DATA_TRAVEL')['VEHICLE_NAME'] !!}</td></tr>
        <tr><td class="right">Pemilik Kendaraan :</td>
            <td class="left">{!! Session::get('DATA_TRAVEL')['PARTNER_NAME'] !!}</td></tr>
    </table>
@elseif(Session::has('DATA_RENT'))
    <h3>Detil Customer</h3>
    <hr>
    <table>
        <tr><td class="right">Nama Customer :</td>
            <td class="left">{!! Session::get('DATA_COSTUMER')['COSTUMER_NAME'] !!}</td></tr>
        <tr><td class="right">No. Telepon :</td>
            <td class="left">{!! Session::get('DATA_COSTUMER')['nohp_prefix'] !!}
                {!! Session::get('DATA_COSTUMER')['COSTUMER_TELP'] !!} </td></tr>
        <tr><td class="right">E-mail :</td>
            <td class="left">{!! Session::get('DATA_COSTUMER')['COSTUMER_EMAIL'] !!} </td></tr>
    </table>
    <br>
    <h3>Detil Pemesanan</h3>
    <hr>
    <table>
        <tr><td class="right">Nomor Tiket :</td>
            <td class="left">{!! Session::get('NO_PEMESANAN') !!} </td></tr>
        <tr><td class="right">Kota :</td>
            <td class="left">{!! Session::get('DATA_RENT')['CITY_NAME'] !!} </td></tr>
        <tr><td class="right">Tanggal :</td>
            <td class="left">{!! Session::get('DATA_RENT')['RENT_SCHEDULE_DATE'] !!}</td></tr>
        <tr><td class="right">Kendaraan :</td>
            <td class="left">{!! Session::get('DATA_RENT')['VEHICLE_NAME'] !!}</td></tr>
        <tr><td class="right">Pemilik Kendaraan :</td>
            <td class="left">{!! Session::get('DATA_RENT')['PARTNER_NAME'] !!}</td></tr>
    </table>
@else
    <h3>Detil Customer</h3>
    <hr>
    <table>
        <tr><td class="right">Nama Customer :</td>
            <td class="left">{!! $query->COSTUMER_NAME !!}</td></tr>
        <tr><td class="right">No. Telepon :</td>
            <td class="left">{!! $query->COSTUMER_TELP !!}</td></tr>
        <tr><td class="right">E-mail :</td>
            <td class="left">{!! $query->COSTUMER_EMAIL !!} </td></tr>
    </table>
    <br>
    <h3>Detil Pemesanan</h3>
    <hr>
    @if($data_type == "TRAVEL")
    <table>
        <tr><td class="right">Nomor Tiket :</td>
            <td class="left">{!! $query->TRAVEL_TRANSACTION_CODE !!} </td></tr>
        <tr><td class="right">Asal :</td>
            <td class="left">{!! $depart->CITY_NAME !!} </td></tr>
        <tr><td class="right">Tujuan :</td>
            <td class="left">{!! $arrive->CITY_NAME !!} </td></tr>
        <tr><td class="right">Jam Berangkat :</td>
            <td class="left">{!! $query->TRAVEL_SCHEDULE_DEPARTTIME !!} </td></tr>
        <tr><td class="right">Jam Sampai :</td>
            <td class="left">{!! $query->TRAVEL_SCHEDULE_ARRIVETIME !!} </td></tr>
        <tr><td class="right">Kendaraan :</td>
            <td class="left">{!! $query->VEHICLE_NAME !!}</td></tr>
        <tr><td class="right">Partner :</td>
            <td class="left">{!! $query->PARTNER_NAME !!}</td></tr>
    </table>
    @elseif($data_type == "RENT")
        <table>
            <tr><td class="right">Nomor Tiket :</td>
                <td class="left">{!! $query->RENT_TRANSACTION_CODE !!} </td></tr>
            <tr><td class="right">Kota :</td>
                <td class="left">{!! $query->CITY_NAME !!} </td></tr>
            <tr><td class="right">Tanggal :</td>
                <td class="left">{!! $query->RENT_SCHEDULE_DATE !!} </td></tr>
            <tr><td class="right">Kendaraan :</td>
                <td class="left">{!! $query->VEHICLE_NAME !!}</td></tr>
            <tr><td class="right">Partner :</td>
                <td class="left">{!! $query->PARTNER_NAME !!}</td></tr>
        </table>
    @endif
@endif

@if($result['payment_type'] == "credit_card")
    <br>
    <h3>Detil Pembayaran</h3>
    <hr>
    <table>
        <tr><td class="right">Masked Card :</td>
            <td class="left">{!! $result['masked_card'] !!}</td></tr>
        <tr><td class="right">Metode Pembayaran :</td>
            <td class="left">{!! $result['payment_type'] !!} </td></tr>
        <tr><td class="right">Waktu Transaksi :</td>
            <td class="left">{!! $result['transaction_time'] !!} </td></tr>
        <tr><td class="right">Nominal Transaksi :</td>
            <td class="left">{!! $result['gross_amount'] !!} </td></tr>
    </table>
    <br>
    <p style="margin-left: 100px;">
        <strong>Status : LUNAS</strong></p>

@elseif($result['payment_type'] == "bank_transfer")
    <br>
    <h3>Detil Pembayaran</h3>
    <hr>
    <table>
        <tr><td class="right">Metode Pembayaran :</td>
            <td class="left">{!! $result['payment_type'] !!} </td></tr>
        <tr><td class="right">Waktu Transaksi :</td>
            <td class="left">{!! $result['transaction_time'] !!} </td></tr>
        <tr><td class="right">Nominal Transaksi :</td>
            <td class="left">{!! $result['gross_amount'] !!} </td></tr>
    </table>
    <br>
    <p style="margin-left: 100px;">
        <strong>Status : LUNAS</strong></p>
@endif
</body>
</html>