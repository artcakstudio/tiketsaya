<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Travelbaik | pelayanan baik dengan harga terbaik</title>
    <!-- {!! Html::style('assets/css/bootstrap.min.css')!!} -->
    {!! Html::style('assets/css/bootstrap.css')!!}
    {!! Html::style('assets/css/font-awesome.min.css')!!}
    {!! Html::style('assets/css/jquery.dataTables.css')!!}
    {!! Html::style('assets/css/jquery.dataTables.min.css')!!}
    {!! Html::style('assets/css/jquery-ui.css')!!}
    {!! Html::style('assets/css/partner.css')!!}
    {!! Html::style('assets/css/style-page.css')!!}
    {!! Html::style('assets/css/travel.css')!!}
    {!! Html::script('assets/js/jquery.min.js')!!}
    {!! Html::script('assets/js/script.js')!!}
    {!! Html::script('assets/js/bootstrap.min.js')!!}
    
    {!! HTML::script('assets/js/jquery.dataTables.min.js')!!} <!-- Data tables -->
    {!! HTML::script('assets/js/jquery-ui.js')!!} <!-- jQuery UI -->




</head>
<body>

<?php echo '<script>var token="'.csrf_token().'"</script>';


?>

    <div class="container-large_">
        <div class="container">
            <!-- HEADER OPEN --> 
            <div class="row header_">
                <div class="col-md-4 remove_padding">
                    <a href="<?php echo url('/')?>"> 
                        <img class="logoimg" src="<?php echo url('assets/images/logo-h.png')?>">
                    </a>
                </div>
                <div class="col-md-8 remove_padding">
                    <div class="header-top hidden-sm hidden-xs">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-2">Cara Pemesanan</div>
                            <div class="col-md-3">Cek Pemesanan</div>
                            <div class="col-md-4">(031) 211 355</div>
                        </div>
                    </div>
                    <div class="menu">
                        <div class="row">
                            <div class="col-md-2 col-md-offset-1">Travel</div>
                            <div class="col-md-2">Pesawat</div>
                            <div class="col-md-2">Tour</div>
                            <div class="col-md-2">Sewa Mobil</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- HEADER CLOSE-->
                              <!-- SLIDER -->
            
            <!-- SLIDER CLOSE -->
            @yield('search-colomn')
            <!-- SEARCH BOX OPEN -->
            
            
        
            @yield('content')



            <!--Footer Open-->

            </div>
    </div>
    <div class="footer_large">
        <div class="footer_page">
            <div class="row">
                <div class="col-md-3">
                    <ul class="group_list_">
                        <li class="group_list_item_head_">TIKET PESAWAT MURAH</li>
                        <li class="group_list_item_">Tiket Murah Jakarta Bali</li>
                        <li class="group_list_item_">Tiket Murah Surabaya Jakarta</li>
                        <li class="group_list_item_">Tiket Murah Surabaya Bandung</li>
                        <li class="group_list_item_">Tiket Murah Surabaya Bali</li>
                        <li class="group_list_item_">Tiket Murah Jakarta Bali</li>
                        <li class="group_list_item_">Tiket Murah Surabaya Jakarta</li>
                        <li class="group_list_item_">Tiket Murah Surabaya Bandung</li>
                        <li class="group_list_item_">Tiket Murah Surabaya Bali</li>
                        
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="group_list_">
                        <li class="group_list_item_head_">Tiket Travel Murah</li>
                        <?php
                            $link_travel=DB::select('select LINK_TRAVEL_DEPARTURE,LINK_TRAVEL_DEST ,getCityName(LINK_TRAVEL_DEPARTURE) as DEPARTURE, getCityName(LINK_TRAVEL_DEST) as DEST from LINK_TRAVEL');
                        ?>
                        <?php $tanggal=date('m/d/Y');?>
                        @foreach($link_travel as $row)
                        {!!Form::open(['route'=>'travelpage.search.footer','method'=>'POST'])!!}
                        <input type="hidden" value="{{$row->LINK_TRAVEL_DEPARTURE}}" name="depart">
                        <input type="hidden" value="{{$row->LINK_TRAVEL_DEST}}" name="dest">
                        <input type="hidden" value="{{$tanggal}}" name="TRAVEL_SCHEDULE_DATE">
                        <a href="#"> <li class="group_list_item_">Tiket Travel {{$row->DEPARTURE}} Ke {{$row->DEST}} </li></a>
                        {!!Form::close()!!}
                        @endforeach
                        
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="group_list_">
                        <li class="group_list_item_head_">Sewa Mobil Murah</li>
                        <?php
                            $link_rent=DB::select('select LINK_RENT.* ,getCityName(LINK_RENT_CITY) as CITY_NAME from LINK_RENT');
                        ?>
                        <?php $tanggal=date('m/d/Y');?>
                        @foreach($link_rent as $row)
                        {!!Form::open(['route'=>'rentpage.search.footer','method'=>'POST'])!!}
                        <input type="hidden" value="{{$row->LINK_RENT_CITY}}" name="CITY_ID">
                        <input type="hidden" value="{{$tanggal}}" name="RENT_SCHEDULE_DATE">
                        <a href="#"> <li class="group_list_item_">Tiket Rent {{$row->CITY_NAME}} </li></a>
                        @endforeach
                        {!!Form::close()!!}
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="group_list_">
                        <li class="group_list_item_head_">Paket Tour Wisata</li>
                        <li class="group_list_item_">Paket Tour Bali</li>
                        <li class="group_list_item_">Paket Tour Jogjakarta</li>
                        <li class="group_list_item_">Paket Tour Jakarta Bandung</li>
                        <li class="group_list_item_">Paket Tour Lombok</li>
                        <li class="group_list_item_">Paket Tour Jogjakarta</li>
                        <li class="group_list_item_">Paket Tour Jakarta Bandung</li>
                        <li class="group_list_item_">Paket Tour Lombok</li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(".group_list_item_").click(function(){

        var form=$(this.closest("Form"));
        
        form.submit();
        
    });
    $(".datepicker").datepicker({changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd", 
        minDate: 0
    });
    </script>
</body>
</html>