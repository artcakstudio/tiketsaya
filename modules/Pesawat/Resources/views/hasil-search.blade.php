@extends('page_template')

@section('search-colomn')
    @parent
        @include('column_search_hidden')
    @stop
@section('content')

<?php

$hari=explode('~', $schedule['AIRASIA']['depart'][0]['input']['value']);
$tanggal=date('d-m-Y', strtotime('-3 Day', strtotime($hari[12])));
$hari=date('D',strtotime($tanggal));
?>
<!-- CONTENT OPEN -->
            <div class="row">
                <div class="col-md-12 content_">
                    <div class="row head_table">
                        <div class="col-md-4" style="padding-top: 10px; font-weight: bold" >HASIL PENCARIAN</div>
                        <div class="col-md-8" style="padding: 0;" >
                             <button style="float: right" type="button" data-target="#pencarian_data_tabel" data-toggle="collapse" aria-expanded="true" class="btn remove_border themecolor">Ubah Pencarian</button>
                            
                        </div>
                    </div>
                    
                    <div class="row">
                    <div class="row" style="margin-top: 5px; height: 50px;">
                        @for($i=1; $i <= 7; $i++)
                        <div class="kotakrekom">
                            @if($i==4)
                            <div class="rekom_harga_selected">
                            @else
                            <div class="rekom_harga">
                            @endif
                            <?php
                            $hari=date('D',strtotime($tanggal));
                            $tanggal=date('d-m-Y',strtotime('+1 day', strtotime($tanggal)));?>
                                <h4>{{$hari}}, {{$tanggal}}</h4>
                                <!-- <h5>Rp. 199.000,-</h5> -->
                            </div>
                        </div>
                        @endfor
                        
                    </div>
                    
                    
                    <div class="row" style="margin-top: 15px;">
                        
                        <div class="kotakfilter">
                            <div class="filter_data">
                                <h4>Pilih Pemberhentian</h4>
                            </div>
                        </div>
                        <div class="kotakfilter">
                            <div class="filter_data">
                                <h4>Pilih Waktu</h4>
                            </div>
                        </div>
                        <div class="kotakfilter">
                            <div class="filter_data">
                                <h4>Pilih Maskapai</h4>
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
                        
                    </div>
                    <div class="row" style="margin-top: 30px;">
                       
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        
                            <?php
                            $i=0;
                            foreach ($schedule as $key) {
                             foreach($key['depart'] as $row) { ?>
                              <div class="panel kotakdata" style="border-radius: inherit">
                                <div class="kotak_datatabel" data-toggle="collapse" data-parent="#accordion" data-target="#data<?php echo $i ?>">
                                    <div class="data_maskapai">
                                        <div><center><img src="<?php echo url('public/Assets/pesawatlogo/'.$row['airline'].'.png')?>"/></center></div>
                                    </div>
                                    <div class="data_maskapai">
                                        <div><h3>{{$row['plane']}}</h3></div>
                                    </div>
                                    <div class="data_maskapai">
                                        <div>
                                            <h4>{{$row['time'][0]}}</h4>
                                            <h5>{{$row['ports'][0]}}</h5>
                                        </div>
                                    </div>
                                    <div class="data_maskapai">
                                        <div>
                                             <h4>{{$row['time'][1]}}</h4>
                                            <h5>{{$row['ports'][1]}}</h5>
                                        </div>
                                    </div>
                                    <div class="data_maskapai">
                                        <div>
                                        <?php
                                         $diff=abs(strtotime($row['time'][1]) - strtotime($row['time'][0]));
                           
                                            $jam= intval($diff/3600);
                                            $menit= intval($diff-3600*$jam)/60;
                                            echo "<h4>".intval($jam)." J ".$menit;?> m</h4>   
                                            <h5>Langsung</h5>
                                        </div>
                                    </div>
                                    <div class="data_maskapai2">
                                        <div><center><img src="<?php echo url('assets/images/facility.png')?>"/></center></div>
                                    </div>
                                    <div class="data_maskapai2">
                                        <div>
                                            <h2>IDR {{$row['price']}},-</h2>
                                            <h6><del>IDR 450.000</del></h6>
                                        </div>
                                    </div>
                                    <div class="button_pesan" >
                                        <div></div>
                                    </div>
                                </div>
                                <div id="data<?php echo $i ?>" class="collapse" >
                                  <div class="kotak_colaps">
                                      <div class="row detilpenerbangan_" >
                                          <div class="col-md-2">
                                              <center>
                                              <img src="<?php echo url('public/Assets/pesawatlogo/'.$row['airline'].'.png')?>"/>
                                              <p>{{$row['airline']}}</p>
                                              </center>
                                          </div>
                                          <div class="col-md-2" style="text-align: center">
                                              <p>Kode Penerbangan</p>
                                              <p>{{$row['plane']}}</p>
                                              <!-- <p>Boeing 737</p> -->
                                          </div>
                                          <div class="col-md-2" style="text-align: center">
                                              <p>Surabaya ({{$row['ports'][0]}}) </p>
                                              <p>ke</p>
                                              <p>Jakarta ({{$row['ports'][1]}}) </p>
                                          </div>
                                          
                                          <div class="col-md-6">
                                              <p><?php
                                              $data=( $row['input']['value']);
                                                /*$hari=explode('~', $data);
                                            echo $hari." ".date('d-m-Y', strtotime($data[12]))."  | 2 Dewasa 0 Anak 0 Bayi/Balita</p>";*/?>
                                              <p>Berangkat : {{date('H:i', strtotime($row['time'][0]))}} WIB </p>
                                              <p>Tiba : {{date('H:i', strtotime($row['time'][1]))}} WIB</p>
                                          </div>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            <?php 
                            $i++; } 
                            }?>
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