@extends('page_template')
@section('content')
@parent
    @include('rent_partner.sidebar')
                 <div class="row main-body col-md-9">        
                    <div class="row col-md-12">

                    <div class="col-md-6">      
                      <a href="<?php echo date('Y-m-d', strtotime(' -1 day',strtotime($tanggal)))?>"><img src="<?php echo url('assets/images/back.png')?>"></a>
                      <h4>back</h4>
                    </div>
                    <div class="col-md-6" >
                    <div style="float:right">
                      <a href="<?php echo date('Y-m-d', strtotime(' +1 day',strtotime($tanggal)))?>"><img src="<?php echo url('assets/images/next.png')?>"></a>
                      <h4>Next</h4>      
                    </div>
                    </div>
                       <table class=" table table-bordered" id="schedule-table">
                            <thead>
                                <tr>
                                    <th>Departure</th>
                                    <th>Destination</th>
                                    <th>Depart Time</th>
                                    <th>Arrive Time</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>    
                    </div>
                </div>
            </div>
        </div>
    </div>

 <script>
$(function() {
    $('#schedule-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo url('rentpartner/jadwal/jadwalharian/'.$tanggal)?>",
        columns: [
            { data: 'ROUTE_DEPARTURE', name: 'ROUTE_DEPARTURE' },
            { data: 'ROUTE_DEST', name: 'ROUTE_DEST' },
            { data: 'TRAVEL_SCHEDULE_DEPARTTIME', name: 'TRAVEL_SCHEDULE_DEPARTTIME' },
            { data: 'TRAVEL_SCHEDULE_ARRIVETIME', name: 'TRAVEL_SCHEDULE_ARRIVETIME' },
            { data: 'TRAVEL_SCHEDULE_PRICE', name: 'TRAVEL_SCHEDULE_PRICE' }, 
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