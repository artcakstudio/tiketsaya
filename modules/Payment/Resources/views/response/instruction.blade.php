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
        <div class="row head_table">
            <div class="col-md-4" style="padding-top: 0px"><h4><b>PROSES PEMESANAN</b></h4></div>
        </div>
        <div class="container">
            <h2>Kami telah mengirimkan petunjuk transfer ke e-mail Anda.</h2>
            <h2>E-mail: {!! Session::get('DATA_COSTUMER')['COSTUMER_EMAIL'] !!}</h2>
        </div>
    </div>
</div>
@stop