@extends('page_template')

@section('content')
@parent
  @include('travel_partner.sidebar')
          <div class="header_backend">ARMADA TRAVEL</div>
            <table class=" table table-bordered" id="vehicle-table">
              <thead>
                    <tr>
                      <th>Vehicle Name</th>
                      <th>Vehicle Type</th>
                      <th>Vehicle Description</th>
                      <th>Vehicle Capacity</th>
                      <th>City</th>
                      <th>Vehicle Status</th>
                      <th>Photo</th>
                      <th>Action</th>
                    </tr>
                </thead>
            </table>    
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahVehicle">Add Vehicle</button>
                    </div>
            <div class="row col-md-5" style="margin-left:5%; margin-top:1%">
            </div>
                </div>
            </div>
        </div>
    </div>





<!-- Modal Hapus Vehicle -->
<div class="modal fade" id="hapusUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
        {!!Form::open(['url'=>'vehicle/hapus','method'=>'POST'])!!}
        <input type="hidden" value="" name="VEHICLE_ID" >
        <button type="submit" class="btn btn-danger">Hapus</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $("#vehicle-table").on("click","button.btn.btn-danger",function(){
        var button=this;
        var tr=$(button).closest("tr");
        var name=tr[0].firstChild.innerHTML;
      
        $("#hapusUser h2.modalbody").html('Apakah Anda Yakin Menghapus Vehicle '+name+'?');

        var id=$(button).get()[0].id;  
        
        $("#hapusUser form input[name='VEHICLE_ID'").val(id);
        $("#hapusUser").modal("show");

  });
</script>
<!--Modal Hapus Vehicle-->

<!--Modal Tambah Vehicle--> 
<div class="modal fade" id="tambahVehicle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Vehicle</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'vehicle..store','METHOD'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data'] )!!}
            <div class="form-group">
              <label class="col-lg-3 control-label">Vehicle Name</label>
              <div class="col-lg-8">
                    <input type="text" name="VEHICLE_NAME" class="form-control">
              </div>
            </div>
            <input type="hidden" name="PARTNER_ID" value="{{Session::get('id')}}">
            <div class="form-group">
              <label class="col-lg-3 control-label">Vehicle Capacity</label>
              <div class="col-lg-8">
                    <input type="text" name="VEHICLE_CAPACITY" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-3 control-label">Vehicle Description</label>
              <div class="col-lg-8">
                    <textarea name="VEHICLE_DESCRIPTION" class="form-control form-group" style="margin-left:0px"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Vehicle Photo</label>
              <div class="col-lg-8">
                    <input type="file" name="VEHICLE_PHOTO" class="form-control">
              </div>
            </div>
            

            <div class="form-group">
              <label class="col-lg-3 control-label">City</label>
              <div class="col-lg-8">
                    <select name="CITY_ID" class="form-control">
                    @foreach($city as $row)
                        <option value="{{$row['CITY_ID']}}">{{$row['CITY_NAME']}}</option>
                    @endforeach
                    </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-3 control-label">Type</label>
              <div class="col-lg-8">
                    <select name="VEHICLE_TYPE_ID" class="form-control">
                    @foreach($type as $row)
                        <option value="{{$row['VEHICLE_TYPE_ID']}}">{{$row['VEHICLE_TYPE_NAME']}}</option>
                    @endforeach
                    </select>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit"  class="btn btn-sm btn-primary">Add Vehicle</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    {!!Form::close()!!}
    </div>
  </div>
</div>
<!--Modal Tambah Vehicle-->

<script>
$("#vehicle-table").on("click","button.btn.btn-primary",function(){
  var tr=$(this).closest("tr");

  $("#tambahVehicle form input[name='VEHICLE_NAME']").val(tr[0].cells[0].innerHTML);
  $("#tambahVehicle form input[name='VEHICLE_CAPACITY']").val(tr[0].cells[3].innerHTML);
  $("#tambahVehicle form textarea[name='VEHICLE_DESCRIPTION']").html(tr[0].cells[2].innerHTML);
  $("#tambahVehicle form input[name='VEHICLE_NAME']").val(tr[0].cells[0].innerHTML);
  $("#tambahVehicle form select[name='CITY_ID'] option:contains("+tr[0].cells[4].innerHTML+")").attr('selected','selected');
  $("#tambahVehicle form select[name='VEHICLE_TYPE_ID'] option:contains("+tr[0].cells[1].innerHTML+")").attr('selected','selected');
  $("#tambahVehicle  button.btn.btn-sm.btn-primary").html("Edit Vehicle");
  $("#tambahVehicle form").append("<input type='hidden' value='"+$(this).get()[0].id+"' name='VEHICLE_ID'>");
  $("#tambahVehicle form").attr("action","<?php echo url('vehicle/edit')?>");
  $("#tambahVehicle").modal("show");
});
</script>>

 <script>
$(function() {
    $('#vehicle-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo url('travelpartner/armada/getarmada')?>",
        columns: [
            { data: 'VEHICLE_NAME', name: 'VEHICLE_NAME' },
            { data: 'VEHICLE_TYPE_NAME', name: 'VEHICLE_TYPE_NAME' },
            { data: 'VEHICLE_DESCRIPTION', name: 'VEHICLE_DESCRIPTION' },
            { data: 'VEHICLE_CAPACITY', name: 'VEHICLE_CAPACITY' },
            { data: 'CITY_NAME', name: 'CITY_NAME' },
            { data: 'VEHICLE_STATUS_NAME', name: 'VEHICLE_STATUS_NAME' },
            { data: 'photo', name: 'photo' ,orderable: false, searchable: false},
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