@extends('template')


@section('content')
    @parent
    <table class=" table table-bordered" id="partner-table">
        <thead>
            <tr>
                <th>Partner Name</th>
                <th>Address</th>
                <th>Telp</th>
                <th>Description</th>
                <th>Username</th>
                <th>Email</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>    

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPartner">Add Partner</button>

<!--Modal Add Partner-->
<div class="modal fade" id="addPartner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Partner</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'vehicle.partner.store','METHOD'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data'] )!!}
            <div class="form-group">
              <label class="col-lg-3 control-label">Partner Name</label>
              <div class="col-lg-8">
                    <input type="text" name="Partner_NAME" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Partner Address</label>
              <div class="col-lg-8">
                    <input type="text" name="PARTNER_ADDRESS" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Partner Telp</label>
              <div class="col-lg-8">
                    <input type="text" name="PARTNER_TELP" class="form-control">
              </div>
            </div>
            <div class="form-group">
                  <label class="col-lg-2 control-label">Partner Description</label>
                  <div class="col-lg-5">
                      <textarea name="PARTNER_DESCRIPTION" class="form-control form-group" style="margin-left:0px"></textarea>
                  </div>
                </div>

            <div class="form-group">
              <label class="col-lg-3 control-label">Partner Photo</label>
              <div class="col-lg-8">
                    <input type="file" name="PARTNER_PHOTO" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Partner Username</label>
              <div class="col-lg-8">
                    <input type="text" name="PARTNER_USERNAME" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Partner Email</label>
              <div class="col-lg-8">
                    <input type="text" name="PARTNER_EMAIL" class="form-control">
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Partner</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
<!--Modal Add Partner-->


<!--Delete Partner-->
<div class="modal fade" id="hapusPartner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
        {!!Form::open(['url'=>'vehicle/partner/destroy','method'=>'POST'])!!}
        <input type="hidden" value="" name="PARTNER_ID" >
        <button type="submit" class="btn btn-danger">Hapus</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $("#partner-table").on("click","button.btn.btn-danger",function(){
        var button=this;
        var tr=$(button.closest("tr")).get();
      
        $("#hapusPartner h2.modalbody").html('Apakah Anda Yakin Menghapus ?');

        var id=$(button).get()[0].id;  
        $("#hapusPartner form input[name='PARTNER_ID'").val(id);
        $("#hapusPartner").modal("show");

  });
</script>
<!--Delete Partner-->



 <script>
$(function() {
    $('#partner-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo url('vehicle/partner/getAllPartner')?>",
        columns: [
            { data: 'PARTNER_NAME', name: 'PARTNER_NAME' },
            { data: 'PARTNER_ADDRESS', name: 'PARTNER_ADDRESS' },
            { data: 'PARTNER_TELP', name: 'PARTNER_TELP' },
            { data: 'PARTNER_DESCRIPTION', name: 'PARTNER_DESCRIPTION' },
            { data: 'PARTNER_USERNAME', name: 'PARTNER_USERNAME' },
            { data: 'PARTNER_EMAIL', name: 'PARTNER_EMAIL' },
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