    
<div class="row" style="margin-top:200px; ">
        <div class="col-md-12 left" style="min-height:300px; ">
            <div style="margin-bottom: 20px; background: #fff" >
                <div class="panel-body" style=" padding-left: 0">
                    <div class="col-md-2" >
                        <div class="row sub-menu1">
                            <a href="{{url('rentpartner')}}"><h4>Profile</h4></a>
                        </div>
                        <div class="row sub-menu1">
                            <h4>Rent Management</h4>
                        </div>
                                <div class="row sub-menu1 sub">
                            <a href="{{url('rentpartner/armada')}}"><h4>Armada</h4></a>
                        </div>
                        <div class="row sub-menu1">
                            <h4>Jadwal</h4>
                        </div>
                                <div class="row sub-menu1 sub">
                                   <?php
                                   $date=$date=getdate();
                                   $date=date('Y-m-d',strtotime($date['year'].'-'.$date['mon'].'-1'));
                                   ?>
                                   <a href="<?php echo url('rentpartner/jadwal/'.$date)?>"><h4>Bulanan</h4></a>
                               </div>
                                <div class="row sub-menu1 sub">
                                    <?php
                                    $date=$date=getdate();
                                    $date=date('Y-m-d',strtotime($date['year'].'-'.$date['mon'].'-'.$date['mday']));
                                    ?>
                                    <a href="<?php echo url('rentpartner/jadwal/harian/'.$date)?>"><h4>Harian</h4></a>
                                </div>
                                <div class="row sub-menu1">
                                    <a href="<?php echo url('rentpartner/transaksi')?>"><h4>Transaksi</h4></a>
                                </div>
                                <div class="row sub-menu1">
                                    <a href="<?php echo url('rentpartner/logout')?>"><h4>Logout</h4></a>
                                </div>
                    </div>
                    
                    <div class="col-md-10" style="border-left: 1px solid #eee">