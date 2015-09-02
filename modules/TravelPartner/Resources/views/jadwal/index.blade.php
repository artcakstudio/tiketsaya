@extends('page_template')
@section('content')
@parent
	@include('travel_partner.sidebar')
                 <div class="row main-body col-md-9">
           
                    <div class="row col-md-12">

                    <div class="col-md-6">      
                      <a href="<?php echo date('Y-m-d', strtotime(' -1 month',strtotime($date)))?>"><img src="<?php echo url('assets/images/back.png')?>"></a>
                      <h4>back</h4>
                    </div>
                    <div class="col-md-6" >
                    <div style="float:right">
                      <a href="<?php echo date('Y-m-d', strtotime(' +1 month',strtotime($date)))?>"><img src="<?php echo url('assets/images/next.png')?>"></a>
                      <h4>Next</h4>      
                    </div>
                    </div>
                     <table class="table table-striped">
                     <tr>
                       <?php  
                          $awal=date('N', strtotime(date('l',strtotime($date))));
                          $date_awal=date('Y-m-d',strtotime('-'.$awal.'day', strtotime($date)));
                        
                          while(date('m',strtotime($date_awal)) <= date('m',strtotime($date)))
                          {
                            if (date('m',strtotime($date_awal))==date('m',strtotime($date)))
                             {
                              $link=url('travelpartner/jadwal/harian');
                              echo '<td><a href="'.$link.'/'.$date_awal.'" >'.$date_awal.'</a>';
                              foreach ($jadwal as $row) 
                              {
                                if($row['DATE']==$date_awal)
                                {
                                  echo "<br>".$row['ROUTE_DEPARTURE']." ke ".$row['ROUTE_DEST']." : ".$row['TIME'];
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
                     </div>
                     <button class="btn btn-primary"  data-toggle="modal" data-target="#addSchedule">Tambah Schedule</button>
                     <button class="btn btn-primary"  data-toggle="modal" data-target="#addScheduleMingguan">Tambah Schedule Mingguan</button>
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
      <div class="modal-body">
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
              <label class="control-label col-lg-3">Route</label>
              <div class="col-lg-9">
                <select class="form-group form-control " name="ROUTE_ID" style="margin-left:15px">
                  @foreach($route as $row)
                    <option value="{{$row['ROUTE_ID']}}">{{$row['ROUTE_DEPARTURE']}} Ke {{$row['ROUTE_DEST']}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
            <label class="control-label col-lg-3" for="inputEmail">Armada</label>
            <div class="col-lg-9">
              <select class="form-group form-control " name="VEHICLE_ID" style="margin-left:15px">
                @foreach($vehicle as $row)
                  <option value="{{$row['VEHICLE_ID']}}">{{$row['VEHICLE_NAME']}}</option>
                @endforeach
              </select>
            </div>
          </div>
            <div class="form-group">
              <label class="control-label col-lg-3" >Depart Time</label>
              <div class="col-lg-9">
                <div class="col-md-3">
                  <input type="text" class="form-control" name="hour_depart" placeholder="HH">
                </div>
                <div class="col-md-3"><input type="text" class="form-control" name="minute_depart" placeholder="MM"></div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-3">Arrive Time</label>
              <div class="col-lg-9">
                <div class="col-md-3">
                  <input type="text" class="form-control" name="hour_arrive" placeholder="HH">
                </div>
                <div class="col-md-3"><input type="text" class="form-control" name="minute_arrive" placeholder="MM"></div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-3">Price</label>
              <div class="col-lg-9">
                <input type="text" class="form-control" name="TRAVEL_SCHEDULE_PRICE" value="0" style="margin-left:15px">
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
<script type="text/javascript">
  var jadwal=[];
  $("#addSchedule").on("click","table tr td", function(){
    var td=$(this).get();
    var tanggal= td[0].innerHTML;
    if (jadwal.indexOf(tanggal)>=0 ){
        jadwal.splice(jadwal.indexOf(tanggal),1);
        $(this).css("background-color","");
    }
    else{
      jadwal.push(tanggal);
      $(this).css("background-color","red"); 
    }

    console.log(jadwal);
  });

  $("#addSchedule button.btn-primary").click(function(){
    var route=$("#addSchedule  select[name='ROUTE_ID']").val();
    var vehicle=$("#addSchedule  select[name='VEHICLE_ID']").val();
    var hour_depart=$("#addSchedule  input[name='hour_depart']").val();
    var minute_depart=$("#addSchedule  input[name='minute_depart']").val();
    var hour_arrive=$("#addSchedule  input[name='hour_arrive']").val();
    var minute_arrive=$("#addSchedule  input[name='minute_arrive']").val();
    var price=$("#addSchedule  input[name='TRAVEL_SCHEDULE_PRICE']").val();
    $.ajax({
      type : "post",
      url : "<?php echo url('travelpartner/jadwal/add')?>",
      data : {"tanggal":jadwal,"ROUTE_ID":route,'_token':token, "hour_depart":hour_depart,"minute_depart":minute_depart,"hour_arrive":hour_arrive,"minute_arrive":minute_arrive, "TRAVEL_SCHEDULE_PRICE":price,"VEHICLE_ID":vehicle},
      datatype : "JSON",
      success:function(data){       
      window.location = window.location.href;
      }
    });
  });
</script>
@include('travelpartner::jadwal.mingguan')
@stop