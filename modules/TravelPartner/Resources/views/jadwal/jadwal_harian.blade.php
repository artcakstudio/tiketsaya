@extends('page_template')
@section('content')
@parent
    @include('travel_partner.sidebar')
      <?php $bulan=['JANUARY','FEBRUARY','MARCH','APRIL','MAY','JUNE','JULY','AUGUST','SEPTEMBER','OCTOBER','NOVEMBER','DECEMBER'];?>
                 <div class="row main-body col-md-9">        
                    <div class="row col-md-12">

                    <div class="col-md-3">      
                      <a href="<?php echo date('Y-m-d', strtotime(' -1 day',strtotime($tanggal)))?>"><img onError="this.onerror=null;this.src='<?php echo url('assets/image/noimage.png')?>'" src="<?php echo url('assets/images/back.png')?>"></a>
                      <h4>back</h4>
                    </div>
                    <div class="col-md-5">
                        <h2 style="text-align:center"><?php echo date('d',strtotime($tanggal))." ".$bulan[date('m',strtotime($tanggal))-1]?> </h2>
                    </div>
                    <div class="col-md-3" style="float:right">
                    <div style="float:right">
                      <a href="<?php echo date('Y-m-d', strtotime(' +1 day',strtotime($tanggal)))?>"><img onError="this.onerror=null;this.src='<?php echo url('assets/image/noimage.png')?>'" src="<?php echo url('assets/images/next.png')?>"></a>
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
                                    <th>Sisa Penumpang</th>
                                    <th style="min-width:60px">Action</th>
                                </tr>
                            </thead>
                        </table>    
                    </div>
                    <div class="col-md-8" style="margin-left:5%">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSchedule">Add Schedule</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="addSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Schedule</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'travel..store','METHOD'=>'POST','class'=>'form-horizontal'])!!} 
            <input type="hidden" name="date" value="{{$tanggal}}">
            <input type="hidden" name="TRAVEL_SCHEDULE_ID">
            <div class="form-group">
              <label class="col-lg-3 control-label">Travel Route</label>
              <div class="col-lg-8">
                    <select class="form-control" name="ROUTE_ID">
                      @foreach($route as $row)
                        <option value="{{$row['ROUTE_ID']}}">{{$row['ROUTE_DEPARTURE']}} Ke {{$row['ROUTE_DEST']}} </option>
                        @endforeach
                    </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Vehicle</label>
              <div class="col-lg-8">
                    <select class="form-control" name="VEHICLE_ID">
                      @foreach($vehicle as $row)
                        <option value="{{$row['VEHICLE_ID']}}">{{$row['VEHICLE_NAME']}}</option>
                        @endforeach
                    </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Price</label>
              <div class="col-lg-8">
                    <input type="text" name="TRAVEL_SCHEDULE_PRICE" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Depart Time</label>
              <div class="col-lg-4">
                <input type="date" name="depart_date" class="form-control" placeholder="HH" value="{{$tanggal}}" disabled="disabled">
              </div>
              <div class="col-lg-2">
                  <input type="text" name="depart_hour" class="form-control" placeholder="HH">
              </div>
              <div class="col-lg-2">
                    <input type="text" name="depart_minute" class="form-control" placeholder="MM">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Estimation Time</label>
              <div class="col-md-9">
                <div class="col-md-3">
                  <input type="text" class="form-control" name="hour_estimate" placeholder="HH">
                </div>
                <div class="col-md-3"><input type="text" class="form-control" name="minute_estimate" placeholder="MM"></div>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Schedule</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="editSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Schedule</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'travel..update','METHOD'=>'POST','class'=>'form-horizontal'])!!} 
            <input type="hidden" name="date" value="{{$tanggal}}">
            <input type="hidden" name="TRAVEL_SCHEDULE_ID">
            <div class="form-group">
              <label class="col-lg-3 control-label">Travel Route</label>
              <div class="col-lg-8">
                    <select class="form-control" name="ROUTE_ID">
                      @foreach($route as $row)
                        <option value="{{$row['ROUTE_ID']}}">{{$row['ROUTE_DEPARTURE']}} Ke {{$row['ROUTE_DEST']}} </option>
                        @endforeach
                    </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Vehicle</label>
              <div class="col-lg-8">
                    <select class="form-control" name="VEHICLE_ID">
                      @foreach($vehicle as $row)
                        <option value="{{$row['VEHICLE_ID']}}">{{$row['VEHICLE_NAME']}}</option>
                        @endforeach
                    </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Price</label>
              <div class="col-lg-8">
                    <input type="text" name="TRAVEL_SCHEDULE_PRICE" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Depart Time</label>
              <div class="col-lg-4">
                <input type="date" name="depart_date" class="form-control" placeholder="HH" value="{{$tanggal}}" disabled="disabled">
              </div>
              <div class="col-lg-2">
                  <input type="text" name="depart_hour" class="form-control" placeholder="HH">
              </div>
              <div class="col-lg-2">
                    <input type="text" name="depart_minute" class="form-control" placeholder="MM">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Estimation Time</label>
              <div class="col-md-9">
                <div class="col-md-3">
                  <input type="text" class="form-control" name="hour_estimate" placeholder="HH">
                </div>
                <div class="col-md-3"><input type="text" class="form-control" name="minute_estimate" placeholder="MM"></div>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Edit Schedule</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>

 <script>
$(function() {
    $('#schedule-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo url('travelpartner/jadwal/jadwalharian/'.$tanggal)?>",
        columns: [
            { data: 'ROUTE_DEPARTURE', name: 'ROUTE_DEPARTURE' },
            { data: 'ROUTE_DEST', name: 'ROUTE_DEST' },
            { data: 'TRAVEL_SCHEDULE_DEPARTTIME', name: 'TRAVEL_SCHEDULE_DEPARTTIME' },
            { data: 'TRAVEL_SCHEDULE_ARRIVETIME', name: 'TRAVEL_SCHEDULE_ARRIVETIME' },
            { data: 'TRAVEL_SCHEDULE_PRICE', name: 'TRAVEL_SCHEDULE_PRICE' }, 
            { data: 'penumpang', name: 'penumpang' }, 
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


$("#schedule-table").on("click","button.btn-primary",function(){
    var tr=$(this.closest("tr")).get();
    var depart_date="<?php echo $tanggal?>";

    $("#addSchedule form [name='TRAVEL_SCHEDULE_PRICE']").val(tr[0].cells[4].innerHTML);    
    $("#addSchedule form option:contains("+tr[0].cells[0].innerHTML+" Ke "+tr[0].cells[1].innerHTML+")").attr('selected','selected');
    $("#addSchedule form [name='date']").val(depart_date);
    
    $("#addSchedule form").attr('action',"<?php echo url('travel/update')?>");
    $("#addSchedule form button.btn.btn-primary").html(" Edit Schedule");
    $("#addSchedule form input[name='TRAVEL_SCHEDULE_ID']").val($(this).get()[0].id);
    $("#addSchedule h4.modal-title").html(" Edit Schedule");
    $("#addSchedule").modal("show");
});
</script>


<!--Hapus Schedule-->
<div class="modal fade" id="hapusSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
        {!!Form::open(['route'=>'travel..delete','method'=>'POST'])!!}
        <input type="hidden" value="" name="TRAVEL_SCHEDULE_ID" >
        <button type="submit" class="btn btn-danger">Hapus</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $("#schedule-table").on("click","button.btn.btn-danger",function(){
        var button=this;
        
        $("#hapusSchedule h2.modalbody").html('Jika anda menghapus schedule maka semua transaksi dari schedule ini juga dihapus, Apakah Anda Yakin?');

        var id=$(button).get()[0].id;  
        $("#hapusSchedule form input[name='TRAVEL_SCHEDULE_ID'").val(id);
        $("#hapusSchedule").modal("show");

  });
</script>
<!--Hapus Schedule-->

<!--Tambah Penumpang Schedule-->
<div class="modal fade" id="tambahPenumpangSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Penumpang</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'travelpage.transaksi','method'=>'POST','class'=>'form-horizontal'])!!}
        <div class="form-group">
              <label class="col-lg-3 control-label">Total Penumpang</label>
              <div class="col-lg-8">
                    <select name="TRAVEL_TRANSACTION_PASSENGER" class="form-group form-control" style="margin-left:0px">

                    </select>
              </div>
          </div>
          <div class="form-group">
              <label class="col-lg-3 control-label">Nama Penumpang</label>
              <div class="col-lg-8">
                    <input type="text" name="COSTUMER_NAME" class="form-control"> 
              </div>
          </div>
          <div class="form-group">
              <label class="col-lg-3 control-label">Email Penumpang</label>
              <div class="col-lg-8">
                    <input type="text" name="COSTUMER_EMAIL" class="form-control">
              </div>
          </div>
          <div class="form-group">
              <label class="col-lg-3 control-label">Telepon Penumpang</label>
              <div class="col-lg-8">
                    <input type="text" name="COSTUMER_TELP" class="form-control">
              </div>
          </div>
          <div class="form-group">
              <label class="col-lg-3 control-label">Harga</label>
              <div class="col-lg-8">
                    <input type="text" name="harga" disabled="disabled" class="form-control">
              </div>
          </div>
          <input type="hidden" name="TRAVEL_TRANSACTION_PRICE">
          <input type="hidden" name="TRAVEL_SCHEDULE_ID">
          <input type="hidden" name="flag" value="1">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Tambah Penumpang</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $("#schedule-table").on("click","button.btn.btn-warning",function(){
        var button=$(this.closest("tr"));
        console.log(button);
        var price=button[0].cells[4].innerHTML;
        var sisa=parseInt(button[0].cells[5].innerHTML);
        var id=$(this).get()[0].id;  
        console.log(sisa);
        $("#tambahPenumpangSchedule form input[name='harga']").val(price);
        $("#tambahPenumpangSchedule form input[name='TRAVEL_TRANSACTION_PRICE']").val(price);
        for(i=1; i<=sisa; i++){
          $("#tambahPenumpangSchedule form select[name='TRAVEL_TRANSACTION_PASSENGER']").append('<option value='+i+'>'+i+' Orang</option>');
        }
        $("#tambahPenumpangSchedule form input[name='TRAVEL_SCHEDULE_ID']").val(id);
        $("#tambahPenumpangSchedule").modal("show");
  });
    $("#tambahPenumpangSchedule").on('hidden.bs.modal',function(){
      $("#tambahPenumpangSchedule form select[name='TRAVEL_SCHEDULE_PASSENGER']").empty();
    });
</script>
<!--Tambah Penumpang Schedule-->
@stop