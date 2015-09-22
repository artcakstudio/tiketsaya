<div class="row" style="margin-top:200px; ">
        <div class="col-md-12 left" style="min-height:300px; ">
            <div style="margin-bottom: 20px; background: #fff" >
                <div class="panel-body" style=" padding-left: 0">
                    <div class="col-md-2" >
                        <div class="row sub-menu1" style="">
                            <a href="{{url('travelpartner')}}"><h4>Profile</h4></a>
                        </div>
                        <div class="row sub-menu1" >
                            <h4>Travel Management</h4>
                        </div>
                        <div class="row sub-menu1 sub">
                            <a href="<?php echo url('travelpartner/route')?>"><h4>Route</h4></a>
                        </div>
                        <div class="row sub-menu1 sub">
                            <a href="{{url('travelpartner/armada')}}"><h4>Armada</h4></a>
                        </div>
                        <div class="row sub-menu1">
                            <h4>Jadwal</h4>
                        </div>
                         <div class="row sub-menu1 sub">
                            <?php
                            $date=$date=getdate();
                            $date=date('Y-m-d',strtotime($date['year'].'-'.$date['mon'].'-1'));
                            ?>
                            <a href="<?php echo url('travelpartner/jadwal/'.$date)?>"><h4>Bulanan</h4></a>
                        </div>
                        <div class="row sub-menu1 sub">
                            <?php
                            $date=$date=getdate();
                            $date=date('Y-m-d',strtotime($date['year'].'-'.$date['mon'].'-'.$date['mday']));
                            ?>
                            <a href="<?php echo url('travelpartner/jadwal/harian/'.$date)?>"><h4>Harian</h4></a>
                        </div>
                        <div class="row sub-menu1 sub">
                            <a href="<?php echo url('travelpartner/jadwal/umum')?>"><h4>Jadwal Umum</h4></a>
                        </div>
                        <div class="row sub-menu1 sub">
                            <a href="<?php echo url('travelpartner/transaksi')?>"><h4>Transaksi</h4></a>
                        </div>
                        <div class="row sub-menu1">
                            <a href="<?php echo url('travelpartner/logout')?>"><h4>Logout</h4></a>
                        </div>
                    </div>
                    
                    <div class="col-md-10" style="border-left: 1px solid #eee; min-height: 400px;">