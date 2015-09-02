<div class="modal fade" id="addScheduleMingguan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add City</h4>
      </div>
      <div class="modal-body">
            <div class="form-group">
            <label class="control-label col-md-3" for="inputEmail">Kendaraan</label>
            <div class="col-md-9">
              <select class="form-group form-control " name="VEHICLE_ID" style="margin-left:15px">
                @foreach($vehicle as $row)
                  <option value="{{$row['VEHICLE_ID']}}">{{$row['VEHICLE_NAME']}}</option>
                @endforeach
              </select>
            </div>
          </div>
            
            <div class="form-group">
              <label class="control-label col-md-3">Price</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="RENT_SCHEDULE_PRICE" value="0" style="margin-left:15px">
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
                  <input type="date" class="form-control" name="date_start"  style="margin-left:15px">
                </div>
              <div class="col-md-6">
                <label class="control-label col-md-12">To</label>
                <div class="col-md-12">
                  <input type="date" class="form-control" name="date_finish" style="margin-left:15px">
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
  
    var vehicle=$("#addScheduleMingguan  select[name='VEHICLE_ID']").val();
    var price=$("#addScheduleMingguan  input[name='RENT_SCHEDULE_PRICE']").val();
    var start=$("#addScheduleMingguan input[name='date_start']").val();
    var stop=$("#addScheduleMingguan input[name='date_finish']").val();
    $.ajax({
      type : "post",
      url : "<?php echo url('rentpartner/jadwal/mingguan/')?>",
      data : {"tanggal":jadwal,'_token':token, "RENT_SCHEDULE_PRICE":price,"VEHICLE_ID":vehicle,"start":start, "stop":stop},
      datatype : "JSON",
      success:function(data){       
       window.location = window.location.href;
      }
    }); 
  });
</script>