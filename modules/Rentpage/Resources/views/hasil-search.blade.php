@extends('page_template')

@section('search-column')
@section('content')
            

<!-- CONTENT OPEN -->
            <div class="row">
                <div class="col-md-12 content_">
                    <div class="row head_table">
                        <div class="col-md-4" style="padding-top: 10px; font-weight: bold" >HASIL PENCARIAN</div>
                        <div class="col-md-8" style="padding: 0;" >
                             <button style="float: right" type="button" class="btn remove_border themecolor">Ubah Pencarian</button>
                             <p style="float: right;padding-top: 10px; margin-right: 10px;"> Sewa Mobil | {{$vehicle[0]['CITY_NAME']}}| {{$vehicle[0]['RENT_SCHEDULE_DATE']}}</p>
                           
                        </div>
                    </div>
                    
                    
                    
                    <div class="row" style="margin-top: 15px;">
                        
                        <div class="kotakfilter">
                            <div class="filter_data">
                                <h4>Pilih Travel</h4>
                            </div>
                        </div>
                        <div class="kotakfilter">
                            <div class="filter_data">
                                <h4>Pilih Waktu</h4>
                            </div>
                        </div>
                        <div class="kotakfilter">
                            <div class="filter_data">
                                <h4>Pilih Tanggal</h4>
                            </div>
                        </div>
                        <div class="kotakfilter">
                            <div class="filter_data">
                                <h4>Pilih Harga</h4>
                            </div>
                        </div>
                        <div class="kotakfilter">
                            <div class="filter_data">
                               
                            </div>
                        </div>
                        
                    </div>
                    <div class="row" style="margin-top: 30px;">
                       
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            
                            <?php foreach ($vehicle as $row) { ?>
                            <div class="panel kotakdata" style="border-radius: inherit">
                                <div class="kotak_datatabel" data-toggle="collapse" data-parent="#accordion" data-target="#data<?php echo $row['RENT_SCHEDULE_ID'] ?>">
                                    
                                    <div class="data_maskapai">
                                        <div><center><img src="<?php echo url('public\Assets\partnerPhoto/'.$row['PARTNER_PHOTO'])?>" width=80 height=60/></center></div>
                                    </div>
                                    <div class="data_maskapai2">
                                        <div>
                                            <img src="<?php echo url('public\Assets\vehiclePhoto/'.$row['VEHICLE_PHOTO'])?>" width=250 height=160/>
                                        </div>
                                    </div>
                                    <div class="data_maskapai2">
                                       
                                    </div>
                                    
                                    <div class="data_maskapai">
                                         <div>
                                            <h4>{{$row['VEHICLE_TYPE_NAME']}}</h4>
                                            <h5>{{$row['VEHICLE_NAME']}}</h5>
                                        </div>
                                    </div>
                                    <div class="data_maskapai2">
                                        <div>
                                            <h4>{{$duration}} Hari</h4>
                                            <h5>Lama Sewa</h5>
                                        </div>
                                    </div>
                                    <div class="data_maskapai2">
                                        <div>
                                            <h2>IDR {{$row['VEHICLE_PRICE']}}/Day</h2>
                                            <h6><del>IDR 450.000</del></h6>
                                        </div>
                                    </div>
                                    <div class="button_pesan" >
                                        <a href="<?php echo url('rentpage/transaksi/'.$row['RENT_SCHEDULE_ID'])?>"><div class="buttravel"></div>
                                    </div>
                                    
                                </div>
                                <div id="data<?php echo $row['RENT_SCHEDULE_ID'] ?>" class="collapse" >
                                  <div class="kotak_colaps">
                                      <div class="row detilpenerbangan_" >
                                          <div class="col-md-4">
                                              <center>
                                              
                                              </center>
                                          </div>
                                          
                                          <div class="col-md-2" style="text-align: center">
                                              
                                              <p>{{$row['CITY_NAME']}}</p>
                                              
                                          </div>
                                          
                                          <div class="col-md-6">
                                               <p><?php echo date('D',strtotime($row['RENT_SCHEDULE_DATE']))."     ".date('d-m-Y',strtotime($row['RENT_SCHEDULE_DATE']))?> </p>
                                              <p>Fasilitas : AC, Wifi, Music, Makan 1x</p>
                                              <p>Berangkat : <?php echo date('h:i',strtotime($row['RENT_SCHEDULE_DATE']))?> WIB </p>
                                              
                                          </div>
                                          
                                      </div>
                                  </div>
                                </div>
                            </div>
                            <?php } ?>
                          </div> 
                    </div>
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
@stop