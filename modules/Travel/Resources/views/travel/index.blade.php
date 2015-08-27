@extends('template')


@section('content')
    @parent
  <?php $bulan=['JANUARY','FEBRUARY','MARCH','APRIL','MAY','JUNE','JULY','AUGUST','SEPTEMBER','OCTOBER','NOVEMBER','DECEMBER'];?>
<div class="col-lg-5">
  <select class="bulan">
    @for($i=0; $i < 11; $i++)
      <option value="{{$i}}" <?php if( ($i+1)==date('m')) { echo 'selected : selected';}?>>{{$bulan[$i]}}</option>
      @endfor
  </select>

</div>
    <table class="table table-bordered">
      <?php 
      for($i=1; $i<=5; $i++){
        ?><tr><?php
        for($j=1; $j<=6; $j++){ ?>
        <td class="tanggal" >
          <div class="col-lg-8">
            <h3><?php 
            $tanggal= $j*$i; echo $tanggal;?></h3>
          </div>
          <div class="col-lg-8">
            <button class="btn btn-primary addschedule">Add Schedule</button>
          </div>
          <div class="col-lg-8">
      <!--       {!!Form::open(['url'=>'travel/show', 'METHOD'=>'POST'])!!}
            <input type="hidden" value="" name="month">
            <input type="hidden" value="<?php echo $tanggal?>" name="date"> -->
            <button class="btn btn-warning listschedule">List Schedule</button>
            <!-- {!!Form::close()!!} -->
          </div>
         </td>
        <?php } ?>
        </tr>
        <?php } ?>
    </table>
<!--Add Schedule-->
<div class="modal fade" id="addSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Schedule</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'travel..store','METHOD'=>'POST','class'=>'form-horizontal'])!!} 
            <input type="hidden" name="date">
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
                <input type="date" name="depart_date" class="form-control" placeholder="HH">
              </div>
              <div class="col-lg-2">
                  <input type="text" name="depart_hour" class="form-control" placeholder="HH">
              </div>
              <div class="col-lg-2">
                    <input type="text" name="depart_minute" class="form-control" placeholder="MM">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Arrive Time</label>
              <div class="col-lg-4">
                <input type="date" name="arrive_date" class="form-control" placeholder="HH">
              </div>
              <div class="col-lg-2">
                <input type="text" name="arrive_hour" class="form-control" placeholder="HH">
              </div>
              <div class="col-lg-2">
                    <input type="text" name="arrive_minute" class="form-control" placeholder="MM">
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
<!--Add Schedule-->

    <script type="text/javascript">
      $("button.btn.addschedule").click(function(){
        var td=$(this.closest("td"));
        var tanggal=td[0].children[0].children[0].innerHTML;
        if(tanggal<10){
          tanggal="0"+tanggal;
        }
        var bulan=parseInt($("select.bulan").val())+1;
        if (bulan<10){
          bulan="0"+bulan;
        }
        var depart_date="2015-"+bulan+"-"+tanggal;
        $("#addSchedule form [name='date']").val(depart_date);
        $("#addSchedule form [name='depart_date']").val(depart_date);
        $("#addSchedule form [name='depart_date']").attr('disabled','disabled');
        $("#addSchedule").modal("show");

      });

      $(document).ready(function(){
        var month=$("select.bulan").val();
        $("table input[name='month']").val(month);
      });

      $("button.listschedule").click(function(){
        var tanggal=$(this.closest("td"));
        tanggal=tanggal[0].children[0].children[0].innerHTML;
        if(tanggal<10){
          tanggal="0"+tanggal;
        }
        var bulan=parseInt($("select.bulan").val())+1;
        if (bulan<10){
          bulan="0"+bulan;
        }
        tanggal="2015-"+bulan+"-"+tanggal
        location.href="<?php echo url('travel/show/"+tanggal+"')?>" ;
      });
    </script>
  @stop 