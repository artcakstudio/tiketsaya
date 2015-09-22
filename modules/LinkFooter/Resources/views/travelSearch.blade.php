@extends('template')


@section('content')
    @parent
    <table class=" table table-bordered" id="link-table">
        <thead>
            <tr>
                <th>Departure</th>
                <th>Destination</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>    

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahLink">Add Link</button>
<div class="modal fade" id="tambahLink" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Vehicle</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'linkfooter.travel.store','METHOD'=>'POST','class'=>'form-horizontal'] )!!}
            <div class="form-group">
              <label class="col-lg-3 control-label">Departure</label>
              <div class="col-lg-8">
              	<select name="LINK_TRAVEL_DEPARTURE" class="form-control">
              		@foreach($city as $row)
              		<option value="{{$row['CITY_ID']}}">{{$row['CITY_NAME']}}</option>
              		@endforeach
              	</select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Destination</label>
              <div class="col-lg-8">
                    <select name="LINK_TRAVEL_DEST" class="form-control">
              		@foreach($city as $row)
              		<option value="{{$row['CITY_ID']}}">{{$row['CITY_NAME']}}</option>
              		@endforeach
              	</select>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit"  class="btn btn-sm btn-primary">Add Link</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    {!!Form::close()!!}
    </div>
  </div>
</div>


<!--Delete Route-->
<div class="modal fade" id="deleteLink" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
        {!!Form::open(['route'=>'linkfooter.travel.destroy','method'=>'POST'])!!}
        <input type="hidden" value="" name="LINK_TRAVEL_ID" >
        <button type="submit" class="btn btn-danger">Hapus</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $("#link-table").on("click","button.btn-danger",function(){
        var button=this;
        var tr=$(button.closest("tr")).get();
        $("#deleteLink h2.modalbody").html('Apakah Anda Yakin?');
        var id=$(button).get()[0].id;  
        $("#deleteLink form input[name='LINK_TRAVEL_ID'").val(id);
        $("#deleteLink").modal("show");

  });
</script>
<!--Delete Route-->

 <script>
$(function() {
    $('#link-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo url('linkfooter/gettravelsearch')?>",
        columns: [
            { data: 'ROUTE_DEPARTURE', name: 'ROUTE_DEPARTURE' },
            { data: 'ROUTE_DEST', name: 'ROUTE_DEST' },
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