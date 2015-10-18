@extends('page_template')

@section('content')
@parent
  @include('travel_partner.sidebar')
          <div class="header_backend">ARMADA TRAVEL</div>
            <table class=" table table-bordered" id="list_booking-table">
              <thead>
                    <tr>
                      <th>Kode Transaksi</th>
                      <th>Total Pembayaran</th>
                      <th>Nama Pemesan</th>
                      <th>Telepon Pemesan</th>
                      <th>Email Pemesan</th>
                      <th>Status</th>
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
});

 <script>
$(function() {
    $('#list_booking-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo url('ticketpartner/get_list_booking')?>",
        columns: [
            { data: 'TICKET_TRANSACTION_CODE', name: 'TICKET_TRANSACTION_CODE' },
            { data: 'TICKET_TRANSACTION_PRICE', name: 'TICKET_TRANSACTION_PRICE' },
            { data: 'COSTUMER_NAME', name: 'COSTUMER_NAME' },
            { data: 'COSTUMER_TELP', name: 'COSTUMER_TELP' },
            { data: 'COSTUMER_EMAIL', name: 'COSTUMER_EMAIL' },
            { data: 'TICKET_TRANSACTION_STATUS_NAME', name: 'TICKET_TRANSACTION_STATUS_NAME' },
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