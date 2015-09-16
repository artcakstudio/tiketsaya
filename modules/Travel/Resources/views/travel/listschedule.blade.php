@extends('template')


@section('content')
    @parent
     <div class="row col-md-12" style="margin-bottom:20px">
    <div class="col-md-6">      
      <a href="<?php echo date('Y-m-d', strtotime(' -1 day',strtotime($tanggal)))?>"><img onError="this.onerror=null;this.src='<?php echo url('assets/image/noimage.png')?>'" src="<?php echo url('assets/images/back.png')?>"></a>
    </div>
    <div class="col-md-6" >
    <div style="float:right">
      <a href="<?php echo date('Y-m-d', strtotime(' +1 day',strtotime($tanggal)))?>"><img onError="this.onerror=null;this.src='<?php echo url('assets/image/noimage.png')?>'" src="<?php echo url('assets/images/next.png')?>"></a>
      <h4>Next</h4>      
    </div>

    </div>
    </div>
    <table class=" table table-bordered" id="schedule-table">
        <thead>
            <tr>
                <th>Departure</th>
                <th>Destination</th>
                <th>Depart Time</th>
                <th>Arrive Time</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>    

    <button type="button" class="btn btn-primary schedule">Add Schedule</button>



<!--Add Schedule-->
<div class="modal fade" id="addSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Schedule</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'travel..store','METHOD'=>'POST','class'=>'form-horizontal'])!!} 
            <input type="hidden" name="date">
            <input type="hidden" name="TRAVEL_SCHEDULE_ID">
            <div class="form-group">
              <label class="col-lg-3 control-label">Travel Route</label>
              <div class="col-lg-8">
                    <select class="form-control" name="ROUTE_ID">
                      @foreach($route as $row)
                        <option value="{{$row['ROUTE_ID']}}">{{$row['ROUTE_DEPARTURE']}} Ke {{$row['ROUTE_DEST']}} </option>
                        @endforeach
                    </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Vehicle</label>
              <div class="col-lg-8">
                    <select class="form-control" name="VEHICLE_ID">
                      @foreach($vehicle as $row)
                        <option value="{{$row['VEHICLE_ID']}}">{{$row['VEHICLE_NAME']}}</option>
                        @endforeach
                    </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Price</label>
              <div class="col-lg-8">
                    <input type="text" name="TRAVEL_SCHEDULE_PRICE" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Depart Time</label>
              <div class="col-lg-4">
                <input type="text" name="depart_date" class="form-control datepicker" placeholder="HH">
              </div>
              <div class="col-lg-2">
                  <input type="text" name="depart_hour" class="form-control" placeholder="HH">
              </div>
              <div class="col-lg-2">
                    <input type="text" name="depart_minute" class="form-control" placeholder="MM">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Arrive Time</label>
              <div class="col-lg-4"> 
                <input type="text" name="arrive_date" class=" datepicker form-control ">
              </div>
              <div class="col-lg-2">
                <input type="text" name="arrive_hour" class="form-control" placeholder="HH">
              </div>
              <div class="col-lg-2">
                    <input type="text" name="arrive_minute" class="form-control" placeholder="MM">
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Schedule</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>

 <script type="text/javascript">
      $("button.btn.schedule").click(function(){
        var depart_date="<?php echo $tanggal?>";
        $("#addSchedule form [name='date']").val(depart_date);
        $("#addSchedule form [name='depart_date']").val(depart_date);
        $("#addSchedule form [name='arrive_date']").val(depart_date);
        $("#addSchedule form [name='depart_date']").attr('disabled','disabled');
        $("#addSchedule").modal("show");

      });
</script>
<!--Add Schedule-->

<!--Edit Schedule-->
  <script type="text/javascript">
  $("#schedule-table").on("click","button.btn.edit",function(){
    var tr=$(this.closest("tr")).get();
    var depart_date="<?php echo $tanggal?>";
    $("#addSchedule form [name='TRAVEL_SCHEDULE_PRICE']").val(tr[0].cells[4].innerHTML);    
    $("#addSchedule form option:contains("+tr[0].cells[0].innerHTML+" Ke "+tr[0].cells[1].innerHTML+")").attr('selected','selected');
    $("#addSchedule form [name='date']").val(depart_date);
    $("#addSchedule form [name='depart_date']").val(depart_date);
    $("#addSchedule form [name='depart_date']").attr('disabled','disabled');
    $("#addSchedule form").attr('action',"<?php echo url('travel/update')?>");
    $("#addSchedule form button.btn.btn-primary").html(" Edit Schedule");
    $("#addSchedule form input[name='TRAVEL_SCHEDULE_ID']").val($(this).get()[0].id);
    $("#addSchedule h4.modal-title").html(" Edit Schedule");
    $("#addSchedule").modal("show");
  });
  
  </script>
<!--Edit Schedule-->

<!--Hapus Schedule-->
<div class="modal fade" id="hapusSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Warning</h4>
      </div>
      <div class="modal-body">
        <h2 class="modalbody" style="text-aligment:center"></h2>
      </div>
      <div class="modal-footer">
        {!!Form::open(['url'=>'travel/destroy','method'=>'POST'])!!}
        <input type="hidden" value="" name="TRAVEL_SCHEDULE_ID" >
        <button type="submit" class="btn btn-danger">Hapus</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $("#schedule-table").on("click","button.btn.btn-danger",function(){
        var button=this;
        
        $("#hapusSchedule h2.modalbody").html('Apakah Anda Yakin?');

        var id=$(button).get()[0].id;  
        $("#hapusSchedule form input[name='TRAVEL_SCHEDULE_ID'").val(id);
        $("#hapusSchedule").modal("show");

  });
</script>
<!--Hapus Schedule-->
   </div>
  </div>
</div>
 <script>
$(function() {
    $('#schedule-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo url('travel/getScheduleDay/'.$tanggal)?>",
        columns: [
            { data: 'ROUTE_DEPARTURE', name: 'ROUTE_DEPARTURE' },
            { data: 'ROUTE_DEST', name: 'ROUTE_DEST' },
            { data: 'TRAVEL_SCHEDULE_DEPARTTIME', name: 'TRAVEL_SCHEDULE_DEPARTTIME' },
            { data: 'TRAVEL_SCHEDULE_ARRIVETIME', name: 'TRAVEL_SCHEDULE_ARRIVETIME' },
            { data: 'TRAVEL_SCHEDULE_PRICE', name: 'TRAVEL_SCHEDULE_PRICE' }, 
            { data: 'action', name: 'action',orderable: false, searchable: false}
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column.search(val ? val : '', true, false).draw();
                });
            });
        }   
    });
    
});

</script>


    @stop