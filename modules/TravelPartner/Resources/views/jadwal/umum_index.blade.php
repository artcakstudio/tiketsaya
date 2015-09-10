@extends('page_template')
@section('content')
@parent
	@include('travel_partner.sidebar')
    <?php $bulan=['JANUARY','FEBRUARY','MARCH','APRIL','MAY','JUNE','JULY','AUGUST','SEPTEMBER','OCTOBER','NOVEMBER','DECEMBER'];?>
                 <div class="row main-body col-md-8">
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>    
                </div>
            </div>
        </div>
    </div>
  
  @include('travelpartner::jadwal.mingguan_edit')
 <script>
$(function() {
    $('#schedule-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo url('travelpartner/jadwal/umum_mingguan/')?>",
        columns: [
            { data: 'VEHICLE_NAME', name: 'VEHICLE_NAME' },
            { data: 'ROUTE_DEPARTURE', name: 'ROUTE_DEPARTURE' },
            { data: 'ROUTE_DEST', name: 'ROUTE_DEST' }, 
            { data: 'TRAVEL_SCHEDULE_PRICE', name: 'TRAVEL_SCHEDULE_PRICE' }, 
            { data: 'TRAVEL_SCHEDULE_UMUM_FROM', name: 'TRAVEL_SCHEDULE_UMUM_FROM' },
            { data: 'TRAVEL_SCHEDULE_UMUM_TO', name: 'TRAVEL_SCHEDULE_UMUM_TO' }, 
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