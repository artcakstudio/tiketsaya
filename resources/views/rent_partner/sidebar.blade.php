    <div class="row" style="margin-top:10%;">
        <div class="col-md-12 left" style="height:800px">
            <div class="panel panel-default" style="height:100%">
                <div class="panel-body">
                	<div class="panel-left col-md-3">
                		<div class="row sub-menu">
                			<a href="{{url('rentpartner')}}"><h4>Profile</h4></a>
                		</div>
                		<div class="row sub-menu">
                			<h4>Rent Management</h4>
                		</div>
                        <div class="row sub-menu sub">
                			<a href="{{url('rentpartner/armada')}}"><h4>Armada</h4></a>
                		</div>
                		<div class="row sub-menu">
                			<h4>Jadwal</h4>
                		</div>
                         <div class="row sub-menu sub">
                            <?php
                            $date=$date=getdate();
                            $date=date('Y-m-d',strtotime($date['year'].'-'.$date['mon'].'-1'));
                            ?>
                            <a href="<?php echo url('rentpartner/jadwal/'.$date)?>"><h4>Bulanan</h4></a>
                        </div>
                        <div class="row sub-menu sub">
                            <?php
                            $date=$date=getdate();
                            $date=date('Y-m-d',strtotime($date['year'].'-'.$date['mon'].'-'.$date['mday']));
                            ?>
                            <a href="<?php echo url('rentpartner/jadwal/harian/'.$date)?>"><h4>Harian</h4></a>
                        </div>
                          <div class=" sub-menu sub">
                            <a href="<?php echo url('rentpartner/jadwal/umum')?>"><h4>Jadwal Umum</h4></a>
                        </div>
                        <div class="sub-menu">
                            <a href="<?php echo url('rentpartner/transaksi')?>"><h4>Transaksi</h4></a>
                        </div>
                        <div class="row sub-menu">
                            <a href="<?php echo url('rentpartner/logout')?>"><h4>Logout</h4></a>
                        </div>
                	</div>