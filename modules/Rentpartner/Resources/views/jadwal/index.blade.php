@extends('page_template')
@section('content')
@parent
  @include('rent_partner.sidebar')
    <?php 
    $bulan=['JANUARY','FEBRUARY','MARCH','APRIL','MAY','JUNE','JULY','AUGUST','SEPTEMBER','OCTOBER','NOVEMBER','DECEMBER'];?>

                          
                        <div class="row"> 
                         <div class="header_backend">JADWAL RENTAL BULANAN</div>
                    <div class="col-md-12" style="padding-right: 0px;width: 100%;">
                    <div class="col-md-3">      
                      <a href="<?php echo date('Y-m-d', strtotime(' -1 month',strtotime($date)))?>"><img onError="this.onerror=null;this.src='<?php echo url('assets/image/noimage.png')?>'" src="<?php echo url('assets/images/back.png')?>"></a>
                      <h4>back</h4>
                    </div>
                    <div  class="col-md-5">
                        <h2 style="text-align:center">   <?php echo $bulan[date('m', strtotime($date))-1]?> {{date('Y')}}</h2>
                    </div>

                    <div class="col-md-3" style="float:right" >
                    <div style="float:right">
                      <a href="<?php echo date('Y-m-d', strtotime(' +1 month',strtotime($date)))?>"><img onError="this.onerror=null;this.src='<?php echo url('assets/image/noimage.png')?>'" src="<?php echo url('assets/images/next.png')?>"></a>
                      <h4>Next</h4>      
                    </div>
                    </div>
                    <div style="height: 665px;overflow: auto;width: 100%; margin-bottom:20px">
                      
                    
                     <table class="table table-striped" id="jadwal_bulanan" style="overflow:auto">
                     <thead>
                       <tr>
                         <td>Sunday</td>
                         <td>Monday</td>
                         <td>Tuesday</td>
                         <td>Wednesday</td>
                         <td>Thursday</td>
                         <td>Friday</td>
                         <td>Saturday</td>
                       </tr>
                     </thead>
                     <tr>
                       <?php  
                          $awal=date('N', strtotime(date('l',strtotime($date))));
                          $date_awal=date('Y-m-d',strtotime('-'.$awal.'day', strtotime($date)));
                          
                          while(date('m',strtotime($date_awal)) <= date('m',strtotime($date)))
                          {
                            $tanggal=date('d',strtotime($date_awal));
                            if (date('m',strtotime($date_awal))==date('m',strtotime($date)))
                             {
                              $link=url('rentpartner/jadwal/harian');
                              echo '<td><a href="'.$link.'/'.$date_awal.'" >'.$tanggal.'</a>';
                              foreach ($jadwal as $row) 
                              {
                                if($row['RENT_SCHEDULE_DATE']==$date_awal)
                                {
                                  echo "<br><h6 class='jadwal_harian' id='".$row['RENT_SCHEDULE_ID']."'>".$row['VEHICLE_NAME']." Price: ".$row['RENT_SCHEDULE_PRICE'];"</h6>";
                                }
                              }
                              echo "</td>";
                            }
                            else echo '<td></td>';
                            if (date('N', strtotime($date_awal))==6)echo '</tr><tr>';
                            $date_awal=date('Y-m-d',strtotime('+1 day',strtotime($date_awal)));
                          }
                      ?>
                            
                        </tr> 
                     </table>
                     <button class="btn btn-primary" id="schedule_bulanan" >Tambah Schedule</button>
                     <button class="btn btn-primary"  data-toggle="modal" data-target="#addScheduleMingguan">Tambah Schedule Mingguan</button>
                     </div>       
                     </div>
                     </div>
                     <div class="col-md-8" style="margin-left:25%">
                       
                     </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="addSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Schedule</h4>
      </div>
      <div class="row modal-body">
            <div class="form-group">
              <table class="table">
              <tr>
              <?php
                $awal=date('N', strtotime(date('l',strtotime($date))));
                $date_awal=date('Y-m-d',strtotime('-'.$awal.'day', strtotime($date)));
                while(date('m',strtotime($date_awal)) <= date('m',strtotime($date))){
                  if (date('m',strtotime($date_awal))==date('m',strtotime($date))) echo '<td class="">'.$date_awal.'</td>';
                  else echo '<td></td>';
                  if (date('N', strtotime($date_awal))==6)echo '</tr><tr>';
                  $date_awal=date('Y-m-d',strtotime('+1 day',strtotime($date_awal)));
                }
                ?>
              </table>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Vehicle</label>
                <div class="col-md-9">
                  <select name="VEHICLE_ID" class="form-control">
                    @foreach($vehicle as $row)
                      <option value="{{$row['VEHICLE_ID'] }}">{{$row['VEHICLE_NAME']}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Price</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="RENT_SCHEDULE_PRICE" value="0">
              </div>
            </div>
      </div>
      <div class="modal-footer" style="margin-top:10px">
        <button class="btn btn-primary">Add Schedule</button>
        <button  class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--modal detail_jadwal-->
<div class="modal fade" id="detail_jadwal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detail Jadwal</h4>
      </div>
      <div class="modal-body">
            <div class="form-group">
             <table class="table table-strip">
                <thead>
                  <tr>
                    <td>Kota</td>
                    <td>Mobil</td>
                    <td>Tanggal Sewa</td>
                    <td>Photo</td>                    
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    
                  </tr>
                </tbody>
             </table>

            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

  var jadwal_bulan=[];
  $("#schedule_bulanan").click(function(){
    $("#addSchedule").modal("show");
  });
  $("#addSchedule").on("click","table tr td", function(){
    var td=$(this).get();
    var tanggal= td[0].innerHTML;
    if (jadwal_bulan.indexOf(tanggal)>=0 ){
        jadwal_bulan.splice(jadwal_bulan.indexOf(tanggal),1);
        $(this).css("background-color","");
    }
    else{
      jadwal_bulan.push(tanggal);
      $(this).css("background-color","red"); 
    }

    console.log(jadwal_bulan);
  });

  $("#addSchedule button.btn-primary").click(function(){
    var route=$("#addSchedule  select[name='ROUTE_ID']").val();
    var vehicle=$("#addSchedule  select[name='VEHICLE_ID']").val();
    var hour_depart=$("#addSchedule  input[name='hour_depart']").val();
    var minute_depart=$("#addSchedule  input[name='minute_depart']").val();
    var hour_estimate=$("#addSchedule  input[name='hour_estimate']").val();
    var minute_estimate=$("#addSchedule  input[name='minute_estimate']").val();
    var price=$("#addSchedule  input[name='RENT_SCHEDULE_PRICE']").val();
    $.ajax({
      type : "post",
      url : "<?php echo url('rentpartner/jadwal/add')?>",
      data : {"tanggal":jadwal_bulan,"ROUTE_ID":route,'_token':token, "hour_depart":hour_depart,"minute_depart":minute_depart,"hour_estimate":hour_estimate,"minute_estimate":minute_estimate, "RENT_SCHEDULE_PRICE":price,"VEHICLE_ID":vehicle},
      datatype : "JSON",
      success:function(data){       
      window.location = window.location.href;
      }
    });
  });
  $("#jadwal_bulanan").on("click","h6.jadwal_harian",function(){
    var jadwal=$(this).get();
    var id=jadwal[0].id;
    $.ajax({
      url : "<?php echo url('rentpartner/detail_jadwal')?>",
      type : "post",
      datatype : "JSON",
      data : {"_token":token, "RENT_SCHEDULE_ID":id},
      success:function(data){
        data=jQuery.parseJSON(data);
        console.log(data);
        var path="<?php echo url('public/Assets/vehiclePhoto/')?>";
        var path=path+'/'+data[0].VEHICLE_PHOTO;
        $("#detail_jadwal table tbody tr").append('<td>'+data[0].CITY_NAME+'</td><td>'+data[0].VEHICLE_NAME+'</td><td>'+data[0].RENT_SCHEDULE_DATE+'</td><td><img src="'+path+'" width=90 height=50');
        $("#detail_jadwal").modal("show");
      }
    });
    console.log(jadwal);

  });
</script>

@include('rentpartner::jadwal.mingguan')
@stop