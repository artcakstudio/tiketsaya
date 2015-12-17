@extends('template')


@section('content')

    @parent
    <table class=" table table-bordered" id="roles-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>    

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRoles">Add Roles</button>


<!--FORM HIDDEN ADDroles -->
<div class="modal fade" id="addRoles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Roles</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'usermanagement.roles.add','METHOD'=>'POST','class'=>'form-horizontal'] )!!}
            <div class="form-group">
              <label class="col-lg-3 control-label">Roles Name</label>
              <div class="col-lg-8">
                    <input type="text" name="ROLES_NAME" class="form-control">
              </div>

            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Roles</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="hapusRole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Warning</h4>
      </div>
      <div class="modal-body">
        <h3 class="modalbody" style="text-aligment:center"></h3>
      </div>
      <div class="modal-footer">
        {!!Form::open(['route'=>'roles.delete','method'=>'POST'])!!}
        <input type="hidden" value="" name="ROLES_ID" >
        <button type="submit" class="btn btn-danger">Hapus</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $("#roles-table").on("click","button.btn-danger",function(){
        var button=this;
        var tr=$(button.closest("tr")).get();
        var name=tr[0].firstChild.innerHTML;
      
        $("#hapusRole h3.modalbody").html('Apakah Anda Yakin Menghapus Roles '+name+'?');

        var id=$(button).get()[0].id;  
        $("#hapusRole form input[name='ROLES_ID'").val(id);
        $("#hapusRole").modal("show");

  });
</script>


 <script>
$(function() {
    $('#roles-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!!url("usermanagement/roles/listRoles")!!}',
        columns: [
            { data: 'ROLES_NAME', name: 'ROLES_NAME' },
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