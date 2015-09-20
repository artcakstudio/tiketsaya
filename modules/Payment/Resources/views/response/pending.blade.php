@extends('page_template')

@section('content')
        <!-- SLIDER -->
<div class="row">
    <div class="col-md-12 slider"></div>
</div>
<!-- SLIDER CLOSE -->
<!-- CONTENT OPEN -->
<div class="row">
    <div class="col-md-12 content_">
        <div class="container">
            <h2>Maaf, pembayaran Anda untuk Nomor Pemesanan: {{ $order_id }} belum kami terima.</h2>
        </div>
    </div>
</div>
@stop