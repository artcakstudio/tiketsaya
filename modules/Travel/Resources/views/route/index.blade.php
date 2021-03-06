@extends('template')


@section('content')
    @parent
    <table class=" table table-bordered" id="route-table">
        <thead>
            <tr>
                <th>Route Departure</th>
                <th>Route Destination</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>    

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addroute">Add Route</button>
<!--Modal Add Route-->
<div class="modal fade" id="addroute" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Route</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'travel.route.store','METHOD'=>'POST','class'=>'form-horizontal'] )!!}
            <div class="form-group">
              <label class="col-lg-3 control-label">Departure</label>
              <div class="col-lg-8">
                  <select name="ROUTE_DEPARTURE" class="form-control depart">
                    @foreach($city as $row)
                      <option value="{{$row['CITY_ID']}}">{{$row['CITY_NAME']}}</option>
                    @endforeach
                  </select>
              </div >
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Destination</label>
              <div class="col-lg-8">
                    <select name="ROUTE_DEST" class="form-control dest" >
                    @foreach($city as $row)
                      <option value="{{$row['CITY_ID']}}">{{$row['CITY_NAME']}}</option>
                    @endforeach
                  </select>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add route</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
<!--Modal Add route-->


<!--Edit Route-->
<script type="text/javascript">
  $("#route-table").on("click","button.btn.btn-primary",function(){
      var button=this;
      var id=$(button).get()[0].id;
      var tr=$(button.closest("tr"));
      var departure=tr[0].cells[0].innerHTML;
      var destination=tr[0].cells[1].innerHTML;
      $("#addroute form select.form-control.depart option:contains("+departure+")").attr('selected','selected');
      $("#addroute form select.form-control.dest option:contains("+destination+")").attr('selected','selected');


      $("#addroute form").append('<input type="hidden" name="ROUTE_ID" value="'+id+'">');
      $("#addroute button.btn.btn-primary").html('Edit Route');
      $("#addroute h4.modal-title").html('Edit Route');
      $("#addroute form").attr('action',"<?php echo url('travel/route/update')?>");
      $("#addroute").modal("show");
  });
</script>
<!--Edit Route-->



<!--Delete Route-->
<div class="modal fade" id="hapusRoute" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
        {!!Form::open(['url'=>'travel/route/destroy','method'=>'POST'])!!}
        <input type="hidden" value="" name="ROUTE_ID" >
        <button type="submit" class="btn btn-danger">Hapus</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $("#link-table").on("click","button.btn.btn-danger",function(){
        var button=this;
        var tr=$(button.closest("tr")).get();
        var name=tr[0].firstChild.innerHTML;
      
        $("#hapusRoute h2.modalbody").html('Apakah Anda Yakin?');

        var id=$(button).get()[0].id;  
        $("#hapusRoute form input[name='ROUTE_ID'").val(id);
        $("#hapusRoute").modal("show");

  });
</script>
<!--Delete Route-->


 <script>
$(function() {
    $('#link-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo url('travel/route/getAllRoute')?>",
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
    \