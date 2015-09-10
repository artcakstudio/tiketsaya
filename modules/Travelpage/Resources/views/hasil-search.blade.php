@extends('page_template')


@section('content')

@section('search-colomn')
  @include('column_search')
 <div class="row">
                <div class="col-md-12 content_">
                    <div class="row head_table">
                        <div class="col-md-4" style="padding-top: 10px; font-weight: bold" >HASIL PENCARIAN</div>
                        <div class="col-md-8" style="padding: 0;" >
                             <button style="float: right" type="button" class="btn remove_border themecolor">Ubah Pencarian</button>
                             @if(sizeof($schedule)>0)
                             <p style="float: right;padding-top: 10px; margin-right: 10px;"> Travel | {{$schedule[0]['ROUTE_DEPARTURE']}} Ke {{$schedule[0]['ROUTE_DEST']}}  | <?php echo date('Y-m-d', strtotime($schedule[0]['TRAVEL_SCHEDULE_DEPARTTIME']))?></p>
                              @endif
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
                            @if(sizeof($schedule)==0)
                            <h1 style="text-align:center">Kota yang anda pilih kosong, silahkan cari di kota atau hari lainnya</h1>
                            @endif
                            <?php $i=0; 
                            foreach ($schedule as$row) { ?>
                            
                            <div class="panel kotakdata" style="border-radius: inherit">
                                <div class="kotak_datatabel" data-toggle="collapse" data-parent="#accordion" data-target="#data<?php echo $row['TRAVEL_SCHEDULE_ID']?>">
                                    
                                    <div class="data_maskapai">
                                       <div><center><img src="<?php echo url('public/Assets\partnerPhoto/'.$row['PARTNER_PHOTO'])?>" width=80 height=55 onError="this.onerror=null;this.src='<?php echo url('assets/images/noimage.png')?>'"/></center></div>
                                    </div>
                                    <div class="data_maskapai2">
                                        <div>
                                            <h4>{{$row['VEHICLE_TYPE_NAME']}}</h4>
                                            <h5>{{$row['VEHICLE_NAME']}}</h5>
                                        </div>
                                    </div>
                                    <div class="data_maskapai2">
                                        <div>
                                            <h4><?php echo date('h:i', strtotime($row['TRAVEL_SCHEDULE_DEPARTTIME']))?></h4>
                                            <h5>{{ $row['ROUTE_DEPARTURE']}}</h5>
                                        </div>
                                    </div>
                                    
                                    <div class="data_maskapai">
                                        <div>
                                            <h4><?php 
                                            $diff=abs(strtotime($row['TRAVEL_SCHEDULE_ARRIVETIME']) - strtotime($row['TRAVEL_SCHEDULE_DEPARTTIME']) );

                                            $jam= $diff/3600;
                                            $menit= $diff%$jam/60;
                                            echo $jam."Hour ".$menit;?> Menit
                                            </h4>
                                            <h5>Estimasi</h5>
                                        </div>
                                    </div>
                                    <div class="data_maskapai2">

                                        <div><center><img src="<?php echo url('assets/images/travelfacility.png')?>" onError="this.onerror=null;this.src='<?php echo url('assets/image/noimage.png')?>'"/></center></div>
                                    </div>
                                    <div class="data_maskapai2">
                                        <div>
                                            <h2>IDR {{$row['TRAVEL_SCHEDULE_PRICE']}},-</h2>
                                            <h6><del>IDR 450.000</del></h6>
                                        </div>
                                    </div>
                                    {!!Form::open(['route'=>'travelpage.transaksi.step1', 'method'=>'POST','name'=>'form_jadwal'])!!}
                                    <input type="hidden" name="TRAVEL_SCHEDULE_ID" value="{{$row['TRAVEL_SCHEDULE_ID']}}">
                                    <div class="button_pesan" >
                                        <div class="buttravel"></div>
                                    </div>
                                    
                                </div>
                                <div id="data<?php echo $row['TRAVEL_SCHEDULE_ID'] ?>" class="collapse" >
                                  <div class="kotak_colaps">
                                      <div class="row detilpenerbangan_" >
                                          <div class="col-md-4">
                                              <center>
                                              <img src="<?php echo url('Public/Assets/vehiclePhoto/'.$row['VEHICLE_PHOTO'])?>" width=300px onError="this.onerror=null;this.src='<?php echo url('assets/image/noimage.png')?>'"/>
                                              </center>
                                          </div>
                                          
                                          <div class="col-md-2" style="text-align: center">
                                              
                                              <p>{{$row['ROUTE_DEPARTURE']}}</p>
                                              <p>ke</p>
                                              <p>{{$row['ROUTE_DEST']}}</p>
                                              
                                          </div>
                                          
                                          <div class="col-md-6">
                                              <p><?php echo date('D',strtotime($row['TRAVEL_SCHEDULE_DEPARTTIME']))."     ".date('d-m-Y',strtotime($row['TRAVEL_SCHEDULE_DEPARTTIME']))?> </p>
                                              <p>Fasilitas : AC, Wifi, Music, Makan 1x</p>
                                              <p>Berangkat : <?php echo date('h:i',strtotime($row['TRAVEL_SCHEDULE_ARRIVETIME']))?> WIB </p>
                                              <p>Estimasi : <?php $diff=abs(strtotime($row['TRAVEL_SCHEDULE_ARRIVETIME']) - strtotime($row['TRAVEL_SCHEDULE_DEPARTTIME']));
                                                            echo $diff/60;?> </p>
                                              
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
<script type="text/javascript">
    $(".button_pesan").click(function(){
        var form=$(this.closest("form"));
        form.submit();
        
    });
</script>
@stop