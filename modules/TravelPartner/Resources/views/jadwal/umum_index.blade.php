@extends('page_template')
@section('content')
@parent
	@include('travel_partner.sidebar')
    <?php $bulan=['JANUARY','FEBRUARY','MARCH','APRIL','MAY','JUNE','JULY','AUGUST','SEPTEMBER','OCTOBER','NOVEMBER','DECEMBER'];?>
                 <div class="header_backend">JADWAL UMUM</div>
                    <table class=" table table-bordered" id="schedule-table">
                            <thead>
                                <tr>
                                    <th>Armada</th>
                                    <th>Departure</th>
                                    <th>Destination</th>
                                    <th>Harga</th>
                                    <th>Start</th>
                                    <th>Stop</th>
                                    <th>Photo</th>
                                    <th style="min-width:60px">Action</th>
                                </tr>
                            </thead>
                        </table>    
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="editSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Schedule</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'travel..store','METHOD'=>'POST','class'=>'form-horizontal'])!!} 
            <input type="hidden" name="date" value="{{$tanggal}}">
            <input type="hidden" name="TRAVEL_SCHEDULE_GROUP">
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
                <input type="text" name="depart_date" class="form-control datepicker" placeholder="HH" value="{{$tanggal}}" disabled="disabled">
              </div>
              <div class="col-lg-2">
                  <input type="text" name="depart_hour" class="form-control" placeholder="HH">
              </div>
              <div class="col-lg-2">
                    <input type="text" name="depart_minute" class="form-control" placeholder="MM">
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
    $("#schedule-table").on("click","button.btn.btn-warning",function(){
        
    })
</script>


 <script>
$(function() {
    $('#schedule-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo url('travelpartner/jadwal-umum/bulanan')?>",
        columns: [
            { data: 'VEHICLE_NAME', name: 'VEHICLE_NAME' },
            { data: 'ROUTE_DEPARTURE', name: 'ROUTE_DEPARTURE' },
            { data: 'ROUTE_DEST', name: 'ROUTE_DEST' }, 
            { data: 'TRAVEL_SCHEDULE_PRICE', name: 'TRAVEL_SCHEDULE_PRICE' }, 
            { data: 'min', name: 'min' },
            { data: 'max', name: 'max' }, 
            { data: 'photo', name: 'photo' }, 
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

$("#schedule-table").on("click","button.btn-primary",function(){
  var id=$(this).get()[0].id;
  var button=this;
  $.ajax({
    url : "{{url('travelpartner/jadwal/mingguan_detail')}}",
    type : "POST",
    datatype : "JSON",
    data : {"TRAVEL_SCHEDULE_UMUM_ID":id,"_token":token},
    success:function(data){
      data=jQuery.parseJSON(data);
      console.log(data);
      console.log(data[0].TRAVEL_SCHEDULE_UMUM_FROM.replace(/-/g,"/"));
      $("#editScheduleMingguan").modal("show");

    
    }
  });
});
</script>

@stop