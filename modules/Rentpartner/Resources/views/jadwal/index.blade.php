@extends('page_template')
@section('content')
@parent
	@include('rent_partner.sidebar')
                <?php $bulan=['JANUARY','FEBRUARY','MARCH','APRIL','MAY','JUNE','JULY','AUGUST','SEPTEMBER','OCTOBER','NOVEMBER','DECEMBER'];?>
                 <div class="row main-body col-md-8">
           
                    <div class="row col-md-12" style="padding-right: 0px;width: 100%;">

                    <div class="col-md-3">      
                      <a href="<?php echo date('Y-m-d', strtotime(' -1 month',strtotime($date)))?>"><img src="<?php echo url('assets/images/back.png')?>"></a>
                      <h4>back</h4>
                    </div>
                    <div  class="col-md-5">
                        <h2 style="text-align:center">   <?php echo $bulan[date('m')*1]?> {{date('Y')}}</h2>
                    </div>

                    <div class="col-md-3" style="float:right" >
                    <div style="float:right">
                      <a href="<?php echo date('Y-m-d', strtotime(' +1 month',strtotime($date)))?>"><img src="<?php echo url('assets/images/next.png')?>"></a>
                      <h4>Next</h4>      
                    </div>
                    </div>
                                      
                     <table class="table table-striped">
                      <thead>
                       <tr>
                         <td>Sunday</td>
                         <td>Monday</td>
                         <td>Tuesday</td>
                         <td>Wednesday</td>
                         <td>Thursday</td>
                         <td>Friday</td>
                         <td>Saturday</td>
                       </tr>
                     </thead>
                     <tr>
                       <?php  
                          $awal=date('N', strtotime(date('l',strtotime($date))));
                          $date_awal=date('Y-m-d',strtotime('-'.$awal.'day', strtotime($date)));
                        
                          while(date('m',strtotime($date_awal)) <= date('m',strtotime($date)))
                          {
                            $tanggal=date('d',strtotime($date_awal));
                            if (date('m',strtotime($date_awal))==date('m',strtotime($date)))
                             {
                              $link=url('rentpartner/jadwal/harian');
                              echo '<td><a href="'.$link.'/'.$date_awal.'" >'.$tanggal.'</a>';
                              foreach ($jadwal as $row) 
                              {
                                if($row['RENT_SCHEDULE_DATE']==$date_awal)
                                {
                                  echo "<br>".$row['VEHICLE_NAME']." Price: ".$row['RENT_SCHEDULE_PRICE'];
                                }
                              }
                              echo "</td>";
                            }
                            else echo '<td></td>';
                            if (date('N', strtotime($date_awal))==6)echo '</tr><tr>';
                            $date_awal=date('Y-m-d',strtotime('+1 day',strtotime($date_awal)));
                          }
                      ?>
                            
                        </tr> 
                     </table>
                     </div>
                     <button class="btn btn-primary"  data-toggle="modal" data-target="#addSchedule">Tambah Schedule</button>
                     <button class="btn btn-primary"  data-toggle="modal" data-target="#addScheduleMingguan">Tambah Schedule Mingguan</button>
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
      <div class="row modal-body">
            <div class="form-group">
              <table class="table">
              <tr>
              <?php
                $awal=date('N', strtotime(date('l',strtotime($date))));
                $date_awal=date('Y-m-d',strtotime('-'.$awal.'day', strtotime($date)));
                while(date('m',strtotime($date_awal)) <= date('m',strtotime($date))){
                  if (date('m',strtotime($date_awal))==date('m',strtotime($date))) echo '<td class="">'.$date_awal.'</td>';
                  else echo '<td></td>';
                  if (date('N', strtotime($date_awal))==6)echo '</tr><tr>';
                  $date_awal=date('Y-m-d',strtotime('+1 day',strtotime($date_awal)));
                }
                ?>
              </table>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Vehicle</label>
                <div class="col-md-9">
                  <select name="VEHICLE_ID" class="form-control">
                    @foreach($vehicle as $row)
                      <option value="{{$row['VEHICLE_ID'] }}">{{$row['VEHICLE_NAME']}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Price</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="RENT_SCHEDULE_PRICE" value="0">
              </div>
            </div>
      </div>
      <div class="modal-footer" style="margin-top:10px">
        <button class="btn btn-primary">Add Schedule</button>
        <button  class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var jadwal=[];
  $("#addSchedule").on("click","table tr td", function(){
    var td=$(this).get();
    var tanggal= td[0].innerHTML;
    if (jadwal.indexOf(tanggal)>=0 ){
        jadwal.splice(jadwal.indexOf(tanggal),1);
        $(this).css("background-color","");
    }
    else{
      jadwal.push(tanggal);
      $(this).css("background-color","red"); 
    }

    console.log(jadwal);
  });

  $("#addSchedule button.btn-primary").click(function(){
    var vehicle=$("#addSchedule  select[name='VEHICLE_ID']").val();
    var price=$("#addSchedule  input[name='RENT_SCHEDULE_PRICE']").val();
    $.ajax({
      type : "post",
      url : "<?php echo url('rentpartner/jadwal/add')?>",
      data : {"tanggal":jadwal,"VEHICLE_ID":vehicle,'_token':token, "RENT_SCHEDULE_PRICE":price},
      datatype : "JSON",
      success:function(data){       
      window.location = window.location.href;
      }
    });
  });
</script>
@include('rentpartner::jadwal.mingguan')
@stop