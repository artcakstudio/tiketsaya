@extends('template')


@section('content')
    @parent
    <table class=" table table-bordered" id="list_booking-table">
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

 <script>
$(function() {
    $('#list_booking-table').DataTable({
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