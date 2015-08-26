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
                <div class="col-md-12 slider"></div>
            </div>            
            <!-- SLIDER CLOSE -->
            
            <!-- SEARCH BOX OPEN -->
            @section('search-colomn')
            <div class="row">
                <div class="col-md-12 searchbox" >
                
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav_" >
                            <li class="active"><a href="#pesawat" data-toggle="tab">PESAWAT</a></li>
                            <li ><a href="#travel" data-toggle="tab">TRAVEL</a></li>
                            <li ><a href="#sewamob" data-toggle="tab">SEWA MOBIL</a></li>
                            <li ><a href="#tour" data-toggle="tab">PAKET TOUR</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent_">
                            <!---------------------PESAWAT SEARCH TAB----------------------- -->
                          <div class="tab-pane active" id="pesawat">
                              <div class="row">
                                  <div class="col-md-4 padding10">
                                      <div class="konten3_">
                                          <div class="head_konten3">Kota Asal</div>
                                          <div class="input-group isi_konten3">
                                            <input type="text" class="form-control remove_border"/>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn dropdown-toggle themecolor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">Surabaya</a></li>
                                                    <li><a href="#">Jakarta</a></li>
                                                  </ul>
                                            </div><!-- /btn-group -->
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4 padding10">
                                      <div class="konten3_">
                                          <div class="head_konten3">Kota Tujuan</div>
                                          <div class="input-group isi_konten3">
                                            <input type="text" class="form-control remove_border"/>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn dropdown-toggle themecolor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih <span class="caret"></span></button>
                                            </div><!-- /btn-group -->
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4 padding10">
                                      <div class="konten3_">
                                          <div class="head_konten3">Tanggal Keberangkatan</div>
                                          <div class="input-group isi_konten3">
                                            <input type="text" class="form-control remove_border" />
                                            <div class="input-group-btn">
                                                <button type="button" class="btn dropdown-toggle themecolor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih <span class="caret"></span></button>
                                            </div><!-- /btn-group -->
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="row" style="padding: 10px">
                                  <div class="col-md-4 ">
                                          <div class="row">
                                              <div class="col-md-4">
                                                  <div class="input-group" >
                                                    <input type="text" class="form-control remove_border" />
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn dropdown-toggle themecolor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">2 <span class="caret"></span></button>
                                                    </div><!-- /btn-group -->
                                                  </div>
                                              </div>
                                              <div class="col-md-4">
                                                  <div class="input-group ">
                                                    <input type="text" class="form-control remove_border" />
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn dropdown-toggle themecolor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">1 <span class="caret"></span></button>
                                                    </div><!-- /btn-group -->
                                                  </div>
                                              </div>
                                              <div class="col-md-4">
                                                  <div class="input-group ">
                                                    <input type="text" class="form-control remove_border" />
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn dropdown-toggle themecolor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">0 <span class="caret"></span></button>
                                                    </div><!-- /btn-group -->
                                                  </div>
                                              </div>
                                          </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div style="float: right" class="btn-group" role="group" aria-label="...">
                                            <button type="button" class="btn remove_border themecolor">Sekali Jalan</button>
                                            <button type="button" class="btn remove_border">Pulang Pergi</button>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div style="float: right; padding-right: 0px;" >
                                            <button type="button" class="btn remove_border themecolor">Cari Penerbangan</button>
                                            
                                      </div>
                                  </div>
                              </div>


                          </div>
                          <div class="tab-pane" id="travel">
                              <!---------------------TRAVEL SEARCH TAB----------------------- -->
                            
                              <div class="row">
                              {!!Form::open(['route'=>'travelpage.search','method'=>'POST'])!!}
                                  <div class="col-md-4 padding10">
                                      <div class="konten3_">
                                          <div class="head_konten3">Kota Berangkat</div>
                                          <div class="input-group isi_konten3">
                                            <select class="form-control remove_border" name="depart">
                                                    @foreach($city as $row)
                                                        <option value="{{$row['CITY_ID']}}" class=" form-control remove_border">{{$row['CITY_NAME']}}</option>
                                                    @endforeach
                                            </select>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn dropdown-toggle themecolor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih <span class="caret"></span></button>
                                                <ul class="dropdown-menu">

                                                  </ul>
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4 padding10">
                                      <div class="konten3_">
                                          <div class="head_konten3">Kota Tujuan</div>
                                          <div class="input-group isi_konten3">
                                            <select class="form-control remove_border" name="dest">
                                                    @foreach($city as $row)
                                                        <option value="{{$row['CITY_ID']}}" class=" form-control remove_border">{{$row['CITY_NAME']}}</option>
                                                    @endforeach
                                            </select>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn dropdown-toggle themecolor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih <span class="caret"></span></button>
                                            </div><!-- /btn-group -->
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4 padding10">
                                      <div class="konten3_">
                                          <div class="head_konten3">Tanggal </div>
                                          <div class="input-group isi_konten3">
                                            <input class="form-control remove_border" type="date" name="TRAVEL_SCHEDULE_DATE" />
                                            <div class="input-group-btn">
                                                <button type="button" class="btn dropdown-toggle themecolor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih <span class="caret"></span></button>
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="row" style="padding: 10px">
                                  <div class="col-md-4 ">
                                         
                                  </div>
                                  <div class="col-md-4">
                                      
                                  </div>
                                  <div class="col-md-4">
                                      <div style="float: right; padding-right: 0px;" >
                                            <button type="submit" class="btn remove_border themecolor">Cari Travel</button>
                                            
                                      </div>
                                  </div>
                              </div>
                              {!!Form::close()!!}
                          </div>
                          <div class="tab-pane" id="sewamob">
                            <!---------------------MOBIL SEARCH TAB----------------------- -->
                            
                              <div class="row">
                              {!!Form::open(['route'=>'rent.search','Method'=>'post'])!!}
                                  <div class="col-md-4 padding10">
                                      <div class="konten3_">
                                          <div class="head_konten3">Kota Pencarian</div>
                                          <div class="input-group isi_konten3">
                                            <!-- <input type="text" class="form-control remove_border"/> -->
                                                  <select class="form-control remove_border" name="CITY_ID">
                                                    @foreach($city as $row)
                                                        <option value="{{$row['CITY_ID']}}" class=" form-control remove_border">{{$row['CITY_NAME']}}</option>
                                                    @endforeach
                                                  </select>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn dropdown-toggle themecolor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih <span class="caret"></span></button>
                                                <!-- ul class="dropdown-menu">
                                                    @foreach($city as $row)
                                                    <li><a href="#" id="city_{{$row['CITY_ID']}}">{{$row['CITY_NAME']}}</a></li>
                                                    @endforeach
                                                  </ul> -->
                                            </div><!-- /btn-group -->
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4 padding10">
                                      <div class="konten3_">
                                          <div class="head_konten3">Tanggal Sewa</div>
                                          <div class="input-group isi_konten3">
                                            <input type="date" class="form-control remove_border" name="DATE" />
                                            <div class="input-group-btn">
                                                <button type="button" class="btn dropdown-toggle themecolor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih <span class="caret"></span></button>
                                            </div><!-- /btn-group -->
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4 padding10">
                                      <div class="konten3_">
                                          <div class="head_konten3">Lama Sewa </div>
                                          <div class="input-group isi_konten3">
                                              <select class="form-control remove_border" name="DURATION">
                                              @for($i=1; $i < 10; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                              </select>
                                            <!-- <input type="text" class="form-control remove_border" /> -->
                                            <div class="input-group-btn">
                                                <button type="button" class="btn dropdown-toggle themecolor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih <span class="caret"></span></button>
                                            </div><!-- /btn-group -->
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="row" style="padding: 10px">
                                  <div class="col-md-4 ">
                                         
                                  </div>
                                  <div class="col-md-4">
                                      <div style="float: right" class="btn-group" role="group" aria-label="...">
                                            <button type="button" class="btn remove_border themecolor">Dengan Sopir</button>
                                            <button type="button" class="btn remove_border">Tanpa Sopir</button>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div style="float: right; padding-right: 0px;" >
                                            <button type="submit" class="btn remove_border themecolor">Cari Mobil</button>
                                            
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="tab-pane" id="tour">
                          {!!Form::close()!!}
                          </div>
                        </div>
                    </div>
            </div>            
            
            <!-- SEARCH BOX CLOSE -->
            
        
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