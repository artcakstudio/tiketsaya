@extends('template')


@section('content')
<?php echo '<script> var token="'.csrf_token().'"</script>'?>
<script type="text/javascript">
function AddUser() {
  $( "#formAddUser" ).dialog({
    width:800,
    height:300,
    resizable: false
  });
};

function hapusUser(id)
{
    $("#hapusUser form input").val(id);
    $("#hapusUser form").append('<input type="hidden" name="_token" value="'+token+'" >');
    $("#hapusUser").dialog({
        buttons: {
            "Cancel": function() {
            $(this).dialog("close");
            myCancelFunction();
            }
        }
    });
}

</script>
    @parent
    <table class=" table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>    

<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#addUser">Add User</button>

<!-- Modal -->
<div class="modal fade" id="addUser" tabindex="0" role="dialog" aria-labelledby="myModalLabel" style="z-index:1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add User</h4>
      </div>
      <div class="modal-body">
       {!!Form::open(['route'=>'usermanagement..store', 'METHOD'=>'POST','class'=>'form-horizontal'] )!!}
          <div class="form-group">
            <label class="col-lg-2 control-label">Nama User</label>
            <div class="col-lg-5">
              <input type="text" class="form-control" placeholder="Nama User" name="USERS_NAME">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Username</label>
            <div class="col-lg-5">
              <input type="text" class="form-control" placeholder="Username" name="USERS_USERNAME">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Password</label>
            <div class="col-lg-5">
              <input type="password" class="form-control" placeholder="Password" name="USERS_PASSWORD">
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-lg-2 control-label">Email</label>
            <div class="col-lg-5">
              <input class="form-control" placeholder="email" name="USERS_EMAIL" type="email">
            </div>
          </div>    
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add User</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    {!!Form::close()!!}    
    </div>
  </div>
</div>


<!-- Modal Hapus User -->
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
        {!!Form::open(['url'=>'usermanagement/hapus','method'=>'POST'])!!}
        <input type="hidden" value="" name="USERS_ID" >
        <button type="submit" class="btn btn-danger">Hapus</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>


 <script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('datatables') !!}',
        columns: [
            { data: 'USERS_NAME', name: 'USERS_NAME' },
            { data: 'USERS_EMAIL', name: 'USERS_EMAIL' },
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
  $("#users-table").on("click","button.btn.btn-danger",function(){
    var button=this;
    var tr=$(button.closest("tr")).get();
    var name=tr[0].firstChild.innerHTML;
  
    $("#hapusUser h2.modalbody").html('Apakah Anda Yakin Menghapus User '+name+'?');
    var id=$(button).get()[0].id;  
    $("#hapusUser form input[name='USERS_ID'").val(id);
    $("#hapusUser").modal("show");

  });

</script>


    @stop