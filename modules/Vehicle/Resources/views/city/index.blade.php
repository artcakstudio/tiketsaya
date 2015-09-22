@extends('template')


@section('content')
    @parent
    <table class=" table table-bordered" id="city-table">
        <thead>
            <tr>
                <th>City Name</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>    

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCity">Add City</button>
<!--Modal Add City-->
<div class="modal fade" id="addCity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add City</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'vehicle.city.store','METHOD'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data'] )!!}
            <div class="form-group">
              <label class="col-lg-3 control-label">City Name</label>
              <div class="col-lg-8">
                    <input type="text" name="CITY_NAME" class="form-control">
              </div>

            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add City</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
<!--Modal Add City-->


<!--Edit City-->
<script type="text/javascript">
  $("#city-table").on("click","button.btn.btn-primary",function(){
      var button=this;
      var id=$(button).get()[0].id;
      var tr=$(button.closest("tr"));
      var kota=tr[0].firstChild.innerHTML;
      $("#addCity form [name='CITY_NAME']").val(kota);
      $("#addCity form").append('<input type="hidden" name="CITY_ID" value="'+id+'">');
      $("#addCity button.btn.btn-primary").html('Edit City');
      $("#addCity h4.modal-title").html('Edit City');
      $("#addCity form").attr('action',"<?php echo url('vehicle/city/update')?>");
      $("#addCity").modal("show");
  });
</script>
<!--Edit City-->

<!--Delete City-->
<div class="modal fade" id="hapusCity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
        {!!Form::open(['url'=>'vehicle/city/destroy','method'=>'POST'])!!}
        <input type="hidden" value="" name="CITY_ID" >
        <button type="submit" class="btn btn-danger">Hapus</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $("#city-table").on("click","button.btn.btn-danger",function(){
        var button=this;
        var tr=$(button.closest("tr")).get();
        var name=tr[0].firstChild.innerHTML;
      
        $("#hapusCity h2.modalbody").html('Apakah Anda Yakin Menghapus Kota '+name+'?');

        var id=$(button).get()[0].id;  
        $("#hapusCity form input[name='CITY_ID'").val(id);
        $("#hapusCity").modal("show");

  });
</script>
<!--Delete City-->

 <script>
$(function() {
    $('#city-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo url('vehicle/city/getAllCity')?>",
        columns: [
            { data: 'CITY_NAME', name: 'CITY_NAME' },
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