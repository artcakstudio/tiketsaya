<?php
 function dateFormat($tanggal)
{
    $month=["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus", "September","Oktober","Nopember","Desember"];
    $bulan=substr($tanggal, 4,2);
    $tanggal=substr($tanggal, 0,2)." ".$month[$bulan-1]." ".substr($tanggal, 6,4);
    return $tanggal;
};?>
              <!-- SLIDER -->
            <div class="row">
                <div class="col-md-12 slider"></div>
            </div>            
            <!-- SLIDER CLOSE --> 
            <div class="row" style="margin-top:5px; margin-bottom:10px">
                        <div id="pencarian_data_tabel" class="collapse out" aria-expanded="true">
  
                           <div class="col-md-12 searchbox" style="">                
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav_" >
                                    <li ><a href="#pesawat" data-toggle="tab">PESAWAT</a></li>
                                    <li  class="active"><a href="#travel" data-toggle="tab">TRAVEL</a></li>
                                    <li ><a href="#sewamob" data-toggle="tab">SEWA MOBIL</a></li>
                                    <li ><a href="#tour" data-toggle="tab">PAKET TOUR</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent_">
                                    <!---------------------PESAWAT SEARCH TAB----------------------- -->
                                  <div class="tab-pane active" id="pesawat">
                              <div class="row">
                    {!!Form::open(['url'=>'pesawat/hasil-search', 'method'=>'post'])!!}
                                  <div class="col-md-4 padding10">
                                      <div class="konten3_">
                                          <div class="head_konten3">Kota Asal</div>
                                          <div class="input-group isi_konten3">
                                            <select class="form-control remove_border" name="origin">
                                                    @foreach($datashare['Bandara'] as $row)
                                                        <option value="{{$row['Code']}}" class="remove_border">{{$row['DisplayName']}}</option>
                                                    @endforeach
                                            </select>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn dropdown-toggle themecolor"  aria-haspopup="true" aria-expanded="false">Pilih <span class="caret"></span></button>
                                            </div><!-- /btn-group -->
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4 padding10">
                                      <div class="konten3_">
                                          <div class="head_konten3">Kota Tujuan</div>
                                          <div class="input-group isi_konten3">
                                            <select class="form-control remove_border" name="destination">
                                                    @foreach($datashare['Bandara'] as $row)
                                                        <option value="{{$row['Code']}}" class="remove_border">{{$row['DisplayName']}}</option>
                                                    @endforeach
                                            </select>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn dropdown-toggle themecolor"  aria-haspopup="true" aria-expanded="false">Pilih <span class="caret"></span></button>
                                            </div><!-- /btn-group -->
                                          </div>
                                      </div>
                                  </div>
<input type=hidden name="return" value="one_way">
<input type=hidden name="date_flexibility" value="must_travel">
                                  <div class="col-md-4 padding10">
                                      <div class="konten3_">
                                          <div class="head_konten3">Tanggal Keberangkatan</div>
                                          <div class="input-group isi_konten3">
                                            <input type="text" class="form-control remove_border datepicker" name="depart_date" />
                                            <div class="input-group-btn">
                                                <button type="button" class="btn dropdown-toggle themecolor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih <span class="caret"></span></button>
                                            </div><!-- /btn-group -->
                                          </div>
                                      </div>
                                  </div>
                              </div>
<input type=hidden name="return_date" value="2016-03-02">
                              <div class="row" style="padding: 10px">
                                  <div class="col-md-4 ">
                                          <div class="row">
                                              <div class="col-md-4">
                                                  <div class="input-group" >
                                                    <input type="text" class="form-control remove_border" name="adult" value=1>
                                                    <div class="input-group-btn">
                                                    </div><!-- /btn-group -->
                                                  </div>
                                              </div>
                                              <div class="col-md-4">
                                                  <div class="input-group ">
                                                    <input type="text" class="form-control remove_border" name="children" value=0>
                                                    <div class="input-group-btn">
                                                   </div><!-- /btn-group -->
                                                  </div>
                                              </div>
                                              <div class="col-md-4">
                                                  <div class="input-group ">
                                                    <input type="text" class="form-control remove_border" name="infant" value=0>
                                                    <div class="input-group-btn">
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
                                            <button type="submit" class="btn remove_border themecolor">Cari Penerbangan</button>
                                     {!!Form::close()!!}
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
                                                    @foreach($datashare['City'] as $row)
                                                        <option value="{{$row['CITY_ID']}}" class="remove_border">{{$row['CITY_NAME']}}</option>
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
                                                    @foreach($datashare['City'] as $row)
                                                        <option value="{{$row['CITY_ID']}}" class=" remove_border">{{$row['CITY_NAME']}}</option>
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
                                            <input class="form-control remove_border datepicker" type="text" name="TRAVEL_SCHEDULE_DATE" />
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
                                                    @foreach($datashare['City'] as $row)
                                                        <option value="{{$row['CITY_ID']}}" class="remove_border">{{$row['CITY_NAME']}}</option>
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
                                          <div class="head_konten3">Tanggal Sewa</div>
                                          <div class="input-group isi_konten3">
                                            <input type="text" class="form-control remove_border datepicker" name="DATE" />
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
<?php
if (Session::has('search')){
  if (Session::get('search')['type']=='travel'){
    echo '<script type="text/javascript">var type="'.Session::get("search")["type"].'"; var date="'.Session::get("search")["date"].'"; var dest='.Session::get("search")["dest"].'; var depart='.Session::get("search")["depart"].';'?>
 $("#"+type+" form select[name='depart']").val(depart);
 $("#"+type+" form select[name='dest']").val(dest);
 console.log(date);
 $("#"+type+" form input[name='TRAVEL_SCHEDULE_DATE']").val(date);
</script>
 <?php }
 else if(Session::get('search')['type']=='sewamob'){ 
   echo '<script type="text/javascript">var type="'.Session::get("search")["type"].'"; var date="'.Session::get("search")["date"].'"; var city='.Session::get("search")["city"].'; var duration='.Session::get("duration").';'?>
 $("#"+type+" form select[name='CITY_ID']").val(city);
 $("#"+type+" form select[name='DURATION']").val(duration);
 console.log(date);
 $("#"+type+" form input[name='DATE']").val(date);
 <?php }
 
}; 

?>
</script>
<script type="text/javascript">
/* $(document).ready(function(){
     $('a[href=#' + type + ']').tab('show');
});*/
</script>
            <!-- SEARCH BOX CLOSE -->
