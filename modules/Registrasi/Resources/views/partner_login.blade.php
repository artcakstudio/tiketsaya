<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Travelbaik | pelayanan baik dengan harga terbaik</title>
    {!! Html::style('assets/css/bootstrap.min.css')!!}
    {!! Html::style('assets/css/travel.css')!!}
    {!! Html::style('assets/css/style-page.css')!!}
    {!! Html::script('assets/js/script.js')!!}
    {!! Html::script('assets/js/jquery.min.js')!!}
    {!! Html::script('assets/js/bootstrap.min.js')!!}
    {!! Html::script('assets/js/jquery-1.10.2.min.js')!!}
</head>
<body>
    <div class="container-large_">
        <div class="container">
            <!-- HEADER OPEN -->
          @section('header') 
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
            <div class="row">
                <div class="col-md-12" style="margin-bottom:11%"></div>
            </div>            
            <!-- SLIDER CLOSE -->
           
            <div class="row">
                <div class="col-md-8 content_ left">
                  {!!Form::open(['route'=>'register.login','method'=>'POST','class'=>'form-horizontal'])!!}
             
                  <div class="form-group">
                      <label class="col-lg-2">Username</label>
                      <div class="col-lg-6">
                          <input type="text" name="PARTNER_USERNAME" class="form-control">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-lg-2">Password</label>
                      <div class="col-lg-6">
                          <input type="password" name="PARTNER_PASSWORD" class="form-control">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-lg-8 right">
                          <button class="btn btn-primary" style="float:right;margin-right:10%;" type="submit">Login </button>
                          
                      </div>
                     
                  </div>
            {!!Form::close()!!}
                </div>
            </div>   
            
            
            <div class="row subscribe_" style="background: #eee; height: 80px;margin-bottom: 10px;">
                <div class="col-md-6">
                    <h3>Daftarkan email anda sekarang untuk mendapatkan diskon Rp 100.000,-</h3>
                </div>
                <div class="col-md-4">
                    <input type="email" class="form-control remove_border" id="exampleInputEmail3" placeholder="Email"/>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn remove_border themecolor">Subscribe</button>
                </div>
                
            </div>



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
                        <li class="group_list_item_">Tiket Travel Jakarta Bandung</li>
                        <li class="group_list_item_">Tiket Travel Jakarta Jogjakarta</li>
                        <li class="group_list_item_">Tiket Travel Surabaya Malang</li>
                        <li class="group_list_item_">Tiket Travel Malang Surabaya</li>
                        <li class="group_list_item_">Tiket Travel Jakarta Palembang</li>
                        <li class="group_list_item_">Tiket Travel Jakarta Bandung</li>
                        
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="group_list_">
                        <li class="group_list_item_head_">Sewa Mobil Murah</li>
                        <li class="group_list_item_">Sewa Mobil Murah Jakarta</li>
                        <li class="group_list_item_">Sewa Mobil Murah Bandung</li>
                        <li class="group_list_item_">Sewa Mobil Murah Surabaya</li>
                        <li class="group_list_item_">Sewa Mobil Murah Bali</li>
                        <li class="group_list_item_">Sewa Mobil Murah Malang</li>
                        <li class="group_list_item_">Sewa Mobil Murah Balikpapan</li>
                        <li class="group_list_item_">Sewa Mobil Murah Makasar</li>
                        <li class="group_list_item_">Sewa Mobil Murah Mataram</li>
                        <li class="group_list_item_">Sewa Mobil Murah Jogjakarta</li>
                        <li class="group_list_item_">Sewa Mobil Murah Solo</li>
                        
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
</body>
</html>