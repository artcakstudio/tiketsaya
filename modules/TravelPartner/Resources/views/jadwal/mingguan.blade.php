<div class="modal fade" id="addScheduleMingguan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Schedule</h4>
      </div>
      <div class="row modal-body">
            <div class="form-group">
              <label class="control-label col-md-3">Route</label>
              <div class="col-md-9">
                <select class="form-group form-control " name="ROUTE_ID" style="margin-left:15px">
                  @foreach($route as $row)
                    <option value="{{$row['ROUTE_ID']}}">{{$row['ROUTE_DEPARTURE']}} Ke {{$row['ROUTE_DEST']}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
            <label class="control-label col-md-3" for="inputEmail">Armada</label>
            <div class="col-md-9">
              <select class="form-group form-control " name="VEHICLE_ID" style="margin-left:15px">
                @foreach($vehicle as $row)
                  <option value="{{$row['VEHICLE_ID']}}">{{$row['VEHICLE_NAME']}}</option>
                @endforeach
              </select>
            </div>
          </div>
            <div class="form-group">
              <label class="control-label col-md-3" >Depart Time</label>
              <div class="col-md-9">
                <div class="col-md-3">
                  <input type="text" class="form-control" name="hour_depart" placeholder="HH">
                </div>
                <div class="col-md-3"><input type="text" class="form-control" name="minute_depart" placeholder="MM"></div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Estimation Time</label>
              <div class="col-md-9">
                <div class="col-md-3">
                  <input type="text" class="form-control" name="hour_estimate" placeholder="HH">
                </div>
                <div class="col-md-3"><input type="text" class="form-control" name="minute_estimate" placeholder="MM"></div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Price</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="TRAVEL_SCHEDULE_PRICE" value="0" style="margin-left:15px">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Looping Every</label>
              <div class="col-md-9">
                <table >
                  <tr>
                    <?php
                    $day=["Monday", "Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
                     for ($i=0; $i<7; $i++){

                      echo '<td class="jadwal">'.$day[$i].'</td>';
                    }?>
                  </tr>
                </table>
              </div>
            </div>
            <div class="row form-group col-md-12">
              <div class="col-md-6">
                <label class=" col-md-12">From</label>
                  <input type="text" class="form-control datepicker" name="date_start"  style="margin-left:15px">
                </div>
              <div class="col-md-6">
                <label class="control-label col-md-12">To</label>
                <div class="col-md-12">
                  <input type="text" class="form-control datepicker" name="date_finish" style="margin-left:15px">
                </div>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button  class="btn btn-primary">Add Schedule</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<script>
 var jadwal=[];
 var day=["Monday", "Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
  $("#addScheduleMingguan").on("click","table tr td", function(){
    var td=$(this).get();
    var tanggal= td[0].innerHTML;
    var indeks=day.indexOf(tanggal);
    if (jadwal.indexOf(indeks)>=0 ){
        jadwal.splice(jadwal.indexOf(indeks),1);
        $(this).css("background-color","");
    }
    else{
      jadwal.push(indeks);
      $(this).css("background-color","green"); 
    }

    console.log(jadwal);
  });

  $("#addScheduleMingguan button.btn.btn-primary").click(function(){
    var route=$("#addScheduleMingguan  select[name='ROUTE_ID']").val();
    var vehicle=$("#addScheduleMingguan  select[name='VEHICLE_ID']").val();
    var hour_depart=$("#addScheduleMingguan  input[name='hour_depart']").val();
    var minute_depart=$("#addScheduleMingguan  input[name='minute_depart']").val();
    var hour_estimate=$("#addScheduleMingguan  input[name='hour_estimate']").val();
    var minute_estimate=$("#addScheduleMingguan  input[name='minute_estimate']").val();
    var price=$("#addScheduleMingguan  input[name='TRAVEL_SCHEDULE_PRICE']").val();
    var start=$("#addScheduleMingguan input[name='date_start']").val();
    var stop=$("#addScheduleMingguan input[name='date_finish']").val();
    $.ajax({
      type : "post",
      url : "<?php echo url('travelpartner/jadwal/mingguan/')?>",
      data : {"tanggal":jadwal,"ROUTE_ID":route,'_token':token, "hour_depart":hour_depart,"minute_depart":minute_depart,"hour_estimate":hour_estimate,"minute_estimate":minute_estimate, "TRAVEL_SCHEDULE_PRICE":price,"VEHICLE_ID":vehicle,"start":start, "stop":stop},
      datatype : "JSON",
      success:function(data){       
        window.location = window.location.href;
      }
    }); 
  });
</script>