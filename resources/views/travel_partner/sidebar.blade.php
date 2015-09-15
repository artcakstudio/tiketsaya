    <div class="row" style="margin-top:10%;">
        <div class="col-md-12 left" style="height:800px">
            <div class="panel panel-default" style="height:100%">
                <div class="panel-body">
                	<div class="row panel-left col-md-3">
                		<div class=" sub-menu" style="margin-top:10px">
                			<a href="{{url('travelpartner')}}"><h4>Profile</h4></a>
                		</div>
                		<div class=" sub-menu" >
                			<h4>Travel Management</h4>
                		</div>
                		<div class=" sub-menu sub">
                			<a href="<?php echo url('travelpartner/route')?>"><h4>Route</h4></a>
                		</div>
                        <div class=" sub-menu sub">
                			<a href="{{url('travelpartner/armada')}}"><h4>Armada</h4></a>
                		</div>
                		<div class=" sub-menu">
                			<h4>Jadwal</h4>
                		</div>
                         <div class=" sub-menu sub">
                            <?php
                            $date=$date=getdate();
                            $date=date('Y-m-d',strtotime($date['year'].'-'.$date['mon'].'-1'));
                            ?>
                            <a href="<?php echo url('travelpartner/jadwal/'.$date)?>"><h4>Bulanan</h4></a>
                        </div>
                        <div class=" sub-menu sub">
                            <?php
                            $date=$date=getdate();
                            $date=date('Y-m-d',strtotime($date['year'].'-'.$date['mon'].'-'.$date['mday']));
                            ?>
                            <a href="<?php echo url('travelpartner/jadwal/harian/'.$date)?>"><h4>Harian</h4></a>
                        </div>
                        <div class=" sub-menu sub">
                            <a href="<?php echo url('travelpartner/jadwal/umum')?>"><h4>Jadwal Umum</h4></a>
                        </div>
                        <div class="sub-menu">
                            <a href="<?php echo url('travelpartner/transaksi')?>"><h4>Transaksi</h4></a>
                        </div>
                        <div class=" sub-menu">
                            <a href="<?php echo url('travelpartner/logout')?>"><h4>Logout</h4></a>
                        </div>
                	</div>