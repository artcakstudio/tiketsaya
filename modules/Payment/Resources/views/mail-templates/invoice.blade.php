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

@else
    {{--{#453 ?--}}
    {{--+"TRAVEL_TRANSACTION_ID": 39--}}
    {{--+"MEMBER_ID": null--}}
    {{--+"TRAVEL_TRANSACTION_STATUS_ID": 3--}}
    {{--+"TRAVEL_TRANSACTION_NAME": null--}}
    {{--+"TRAVEL_TRANSACTION_CREATE": "2015-09-20 07:09:31"--}}
    {{--+"TRAVEL_TRANSACTION_UPDATE": "0000-00-00 00:00:00"--}}
    {{--+"TRAVEL_TRANSACTION_PRICE": 200000--}}
    {{--+"TRAVEL_TRANSACTION_CODE": "T00F82A"--}}
    {{--+"COSTUMER_ID": 54--}}
    {{--+"TRAVEL_SCHEDULE_ID": null--}}
    {{--+"TRAVEL_TRANSACTION_PASSENGER": null--}}
    {{--+"COSTUMER_NAME": "Reyhan"--}}
    {{--+"COSTUMER_EMAIL": "hentongmaster@gmail.com"--}}
    {{--+"COSTUMER_TELP": "+628123456789"--}}
    {{--+"TRAVEL_TRANSACTION_STATUS_NAME": "success"--}}
    {{--+"TRAVEL_TRANSACTION_STATUS_CREATE": "2015-09-20 07:45:36"--}}
    {{--+"TRAVEL_TRANSACTION_STATUS_UPDATE": "0000-00-00 00:00:00"--}}
    {{--+"TRAVEL_TRANSACTION_STATUS_UPDATEBY": null--}}
    {{--+"TRAVEL_TRANSACTION_STATUS_CREATEBY": null--}}
    {{--}--}}
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
    {{--<br>--}}
    {{--<h3>Detil Pemesanan</h3>--}}
    {{--<hr>--}}
    {{--<table>--}}
        {{--<tr><td class="right">Nomor Tiket :</td>--}}
            {{--<td class="left">{!! $query->TRAVEL_TRANSACTION_CODE !!} </td></tr>--}}
        {{--<tr><td class="right">Asal :</td>--}}
            {{--<td class="left">{!! $query->TRAVEL_TRANSACTION_CODE !!} </td></tr>--}}
        {{--<tr><td class="right">Tujuan :</td>--}}
            {{--<td class="left">{!! Session::get('DATA_TRAVEL')['ROUTE_DEST'] !!}</td></tr>--}}
        {{--<tr><td class="right">Jam Berangkat :</td>--}}
            {{--<td class="left">{!! Session::get('DATA_TRAVEL')['TRAVEL_SCHEDULE_ARRIVETIME'] !!}</td></tr>--}}
        {{--<tr><td class="right">Jam Sampai :</td>--}}
            {{--<td class="left">{!! Session::get('DATA_TRAVEL')['TRAVEL_SCHEDULE_DEPARTTIME'] !!}</td></tr>--}}
        {{--<tr><td class="right">Kendaraan :</td>--}}
            {{--<td class="left">{!! Session::get('DATA_TRAVEL')['VEHICLE_NAME'] !!}</td></tr>--}}
        {{--<tr><td class="right">Pemilik Kendaraan :</td>--}}
            {{--<td class="left">{!! Session::get('DATA_TRAVEL')['PARTNER_NAME'] !!}</td></tr>--}}
    {{--</table>--}}
@endif

@if($result->payment_type == "credit_card")
    <br>
    <h3>Detil Pembayaran</h3>
    <hr>
    <table>
        <tr><td class="right">Masked Card :</td>
            <td class="left">{!! $result->masked_card !!}</td></tr>
        <tr><td class="right">Metode Pembayaran :</td>
            <td class="left">{!! $result->payment_type !!} </td></tr>
        <tr><td class="right">Waktu Transaksi :</td>
            <td class="left">{!! $result->transaction_time !!} </td></tr>
        <tr><td class="right">Nominal Transaksi :</td>
            <td class="left">{!! $result->gross_amount !!} </td></tr>
    </table>
    <br>
    <p style="margin-left: 100px;">
        <strong>Status : LUNAS</strong></p>

@elseif($result->payment_type == "bank_transfer")
    <br>
    <h3>Detil Pembayaran</h3>
    <hr>
    <table>
        <tr><td class="right">Metode Pembayaran :</td>
            <td class="left">{!! $result->payment_type !!} </td></tr>
        <tr><td class="right">Waktu Transaksi :</td>
            <td class="left">{!! $result->transaction_time !!} </td></tr>
        <tr><td class="right">Nominal Transaksi :</td>
            <td class="left">{!! $result->gross_amount !!} </td></tr>
    </table>
    <br>
    <p style="margin-left: 100px;">
        <strong>Status : LUNAS</strong></p>
@endif
</body>
</html>