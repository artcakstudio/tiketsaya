@extends('page_template')
@section('content')
@parent
	@include('travel_partner.sidebar')
    <?php $bulan=['JANUARY','FEBRUARY','MARCH','APRIL','MAY','JUNE','JULY','AUGUST','SEPTEMBER','OCTOBER','NOVEMBER','DECEMBER'];?>
                 <div class="header_backend">JADWAL UMUM DETAIL</div>
                 <h3 style="text-align:center ">Jadwal dari {{$data[0]['ROUTE_DEPARTURE']}} Ke {{$data[0]['ROUTE_DEST']}} </h3>
                    <div class="row col-md-11" style="margin:auto;float:none">
                        @foreach($data as $row)
                        <div class="col-md-3 detail_bulan">
                            {{$row['TRAVEL_SCHEDULE_DEPARTTIME']}}
                            <button class="btn  btn-xs btn-danger hapus" id="{{$row['TRAVEL_SCHEDULE_ID']}}"><i class="fa fa-times"></i></button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
    $("button.hapus").click(function(){
        var id=$(this)[0].id;
        div=this;
        $.ajax({
            url : "<?php echo url('travel/destroy')?>",
            type : "POST",
            datatype : "JSON",
            data : {"_token":token, "TRAVEL_SCHEDULE_ID":id},
            success:function(data){
                 div=$(div).closest("div");
                div.remove();
                alert('schedule berhasil di hapus');
            }
        });

    });
    </script>
@stop
