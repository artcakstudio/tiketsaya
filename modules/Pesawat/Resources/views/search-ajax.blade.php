<?php
$i=0;
foreach ($schedule_search as $row) {
 /*foreach($key as $row) { */?>
  <div class="panel kotakdata" style="border-radius: inherit">
 <h1 style="display:none" class="harga_tiket">{{$row['price']}}</h1>
    <div class="kotak_datatabel" data-toggle="collapse" data-parent="#accordion" data-target="#data<?php echo $i ?>">
        <div class="data_maskapai">
            <div><center><img src="<?php echo url('public/Assets/pesawatlogo/'.$row['airline'].'.png')?>"/></center></div>
        </div>
        <div class="data_maskapai">
            <div><h3 class="id_maskapai">{{$row['plane']}}</h3></div>
        </div>
        <div class="data_maskapai">
            <div>
                <h4 class="waktu_berangkat">{{$row['time'][0]}}</h4>
                <h5>{{$row['ports'][0]}}</h5>
            </div>
        </div>
        <div class="data_maskapai">
            <div>
                 <h4>{{$row['time'][1]}}</h4>
                <h5>{{$row['ports'][1]}}</h5>
            </div>
        </div>
        <div class="data_maskapai">
            <div>
            <?php
             $diff=abs(strtotime($row['time'][1]) - strtotime($row['time'][0]));  
                $jam= intval($diff/3600);
                $menit= intval($diff-3600*$jam)/60;
                echo "<h4>".intval($jam)." J ".$menit;?> m</h4>   
                <h5>Langsung</h5>
            </div>
        </div>
        <div class="data_maskapai2">
            <div><center><img src="<?php echo url('assets/images/facility.png')?>"/></center></div>
        </div>
        <div class="data_maskapai2">
            <div>
                <h2 class="rupiah">IDR {{$row['price']}},-</h2>
                <h6><del>IDR 450.000</del></h6>
            </div>
        </div>
{!!Form::open(['route'=>'pesawat.transaksi.step1', 'method'=>'POST','name'=>'form_jadwal'])!!}
        <?php $data=json_encode($row,true);
        ?>
        <input type="hidden" name="data" value="{{$data}}">
        <div class="button_pesan" >
            <div class="butpesawat"></div>
        </div>
        {!!Form::close()!!}                               </div>
    <div id="data<?php echo $i ?>" class="collapse" >
      <div class="kotak_colaps">
          <div class="row detilpenerbangan_" >
              <div class="col-md-2">
                  <center>

                  <img src="<?php echo url('public/Assets/pesawatlogo/'.$row['airline'].'.png')?>"/>
                  <p class="nama_maskapai">{{$row['airline']}}</p>
                  </center>
              </div>
              <div class="col-md-2" style="text-align: center">
                  <p>Kode Penerbangan</p>
                  <p>{{$row['plane']}}</p>
                  <!-- <p>Boeing 737</p> -->
              </div>
              <div class="col-md-2" style="text-align: center">
                  <p>Surabaya ({{$row['ports'][0]}}) </p>
                  <p>ke</p>
                  <p>Jakarta ({{$row['ports'][1]}}) </p>
              </div>
              
              <div class="col-md-6">
                  <p><?php
                  $data=( $row['input']['value']);
                    /*$hari=explode('~', $data);
                echo $hari." ".date('d-m-Y', strtotime($data[12]))."  | 2 Dewasa 0 Anak 0 Bayi/Balita</p>";*/?>
                  <p>Berangkat : {{date('H:i', strtotime($row['time'][0]))}} WIB </p>
                  <p>Tiba : {{date('H:i', strtotime($row['time'][1]))}} WIB</p>
              </div>
          </div>
      </div>
    </div>
</div>
<?php 
if (!in_array($row['airline'], $airline)){
  array_push($airline, $row['airline']);
}
$i++; 
}?>