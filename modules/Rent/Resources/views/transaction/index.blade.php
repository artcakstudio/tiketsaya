@extends('template')


@section('content')
    @parent
    <table class=" table table-bordered" id="transaction-table">
        <thead>
            <tr>
                <th>Transaction Code</th>
                <th>Costumer Name</th>
                <th>Date Of Rent</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>    





<!--Detail Transaction-->
<div class="modal fade" id="detailTransaksi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detail</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered detail">
          <thead>
            <tr>
              <td>Date</td>
              <td>Car</td>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary  " data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $("#transaction-table").on("click","button.btn.detail", function(){
    var button=this;
    var id=$(button).get()[0].id;

    $.ajax({
      url : 'transaction/detail/'+id,
      type : "GET",
      datatype : 'json',
      success:function(data){       
        data=jQuery.parseJSON(data);
        console.log(data);
        for(i=0; i<data.length; i++)
        {
          $("#detailTransaksi table thead").append('<tr><td>'+data[i].RENT_SCHEDULE_DATE+'</td><td>'+data[i].VEHICLE_NAME+'</td></tr>');
        }
        var code= $(button.closest("tr")).get()[0].cells[0].innerHTML;
        $("#detailTransaksi h4.modal-title").html('Detail '+code);
        $("#detailTransaksi").modal("show");
      }
    });
  });
</script>
<!--Detail Transaction-->

 <script>
$(function() {
    $('#transaction-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo url('rent/transaction/getAllTransaction')?>",
        columns: [
            { data: 'RENT_TRANSACTION_CODE', name: 'RENT_TRANSACTION_CODE' },
            { data: 'MEMBER_NAME', name: 'MEMBER_NAME' },
            { data: 'RENT_TRANSACTION_DATE', name: 'RENT_TRANSACTION_DATE' },
            { data: 'STATUS_TRANSACTION_RENT_NAME', name: 'STATUS_TRANSACTION_RENT_NAME' },
            { data: 'RENT_TRANSACTION_PRICE', name: 'RENT_TRANSACTION_PRICE' },
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