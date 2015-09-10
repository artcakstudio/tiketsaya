@extends('page_template')
@section('class_header','container-large_1')
@section('content')
    @parent
   <div class="row">
<?php
$day=["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"]
?>
            <!-- SLIDER -->
            <div class="row">
                <div class="col-md-12 slider"></div>
            </div>            
            <!-- SLIDER CLOSE -->
	        <div class="row">
                <div class="col-md-12 content_">
                    <div class="row head_table">
                        <div class="col-md-4" style="padding-top: 0px"><h4><b>PROSES PEMESANAN</b><h4></div>
                        <div class="col-md-8" style="padding: 0;">
                             <p style="float: right;padding-top: 10px; margin-right: 10px;"> Travel | {{Session::get('DATA_TRAVEL')['ROUTE_DEPARTURE']}} ke {{Session::get('DATA_TRAVEL')['ROUTE_DEST']}} | <?php echo $day[date('N',strtotime('D', strtotime(Session::get('DATA_TRAVEL')['TRAVEL_SCHEDULE_DEPARTTIME'])))-1]; echo " ".date('d-m-Y', strtotime(Session::get('DATA_TRAVEL')['TRAVEL_SCHEDULE_DEPARTTIME']))?></p>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 5px; height: 50px; margin-bottom: 50px">
                        <div class="kotak_step_travel">
                            <div class="step">
                                <h4>Isi Data<h4>
                            </div>
                        </div>
                        <div class="kotak_step_travel">
                            <div class="step_selected">
                                <h4>Review<h4>
                            </div>
                        </div>
                        <div class="kotak_step_travel">
                            <div class="step">
                                <h4>Pembayaran<h4>
                            </div>
                        </div>
                        <div class="kotak_step_travel">
                            <div class="step">
                                <h4>Konfirmasi<h4>
                            </div>
                        </div>
                    </div>

                    <!-- Info Penting -->
                    <div class="row">
                        <div class="col-md-4 remove padding" style ="background-color:#5a5a5a; margin-top:15px; color:#fff; width:320px">
                            <div class="logo_penting col-md-2" style="padding-top:15px">
                                <img src="<?php echo url('assets/images/logo_info.png')?>">
                            </div>
                            <div class="tulisan_penting" style="margin-left:30px; margin-top:10px">
                                <h3>Penting</h3>
                            </div>
                            <div class="desc_penting">
                                <p>Anda perlu <b>menunggu tepat waktu</b> karena travel akan berangkat sesuai dengan jam yang tertera dijadwal</p>
                            </div>
                        </div>
                    </div>

                    <!-- Notes_Harga -->
                    <div class="row">
                        <div class="col-md-4 remove_padding" style="background-color:#fff; border: 1px solid #ddd; border-left: 4px solid #00cd00;margin-top: 10px; width:320px">
                            <div class="notes_harga" style="padding:10px">
                                <p>Harga di samping telah final dan dikonfirmasi oleh pihak travel. Potongan dari kupon promo dapat digunakan di halaman pemesanan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Notes_Harga -->
                    <div class="row">
                        <div class="col-md-4 remove_padding" style="background-color:#fff;border: 1px solid #ddd; border-left: 4px solid #00cd00; margin-top: 10px; width:320px">
                            <div class="notes_mata_uang" style="padding:10px">
                                <p>Anda akan membayar dalam mata uang yang Anda pilih: <b>IDR</b></p>
                            </div>
                        </div>
                    </div>

                     <div class="row">
                        <!-- Rincian Travel-->
                        <div class="col-md-8" style="padding-left:30px; margin-top:-35%; margin-left:325px;">
                            <div class="tulisan_rincian_penerbangan" style="text-align:center">
                                <h2>Rincian Travel</h2>
                            </div>
                            <!-- Kotak Data Rincian Penerbangan -->
                            <div class="row col-md-12" style="background-color:#fff;border: 4px dotted #ddd; padding:20px">
                            	<div class="row col-md-7" style="background-color:#fff">
                                
	                                <div class="box_tanggal_rincian_travel" style="background-color:#eee;border: 1px solid #ddd; padding:10px; margin-bottom:10px">
                                        <!-- No_Pesanan -->
                                        <div class="tulisan_no_pesanan">
                                            <p>No. Pesanan :<span><b>{{Session::get('NO_PEMESANAN')}}</b></span></p>
                                        </div>
                                        <!-- Jadwal_berangkat -->
	                                    <div class="tulisan_jadwal_berangkat_travel">
	                                        <p>Jadwal Berangkat :<span><b><?php echo $day[date('N',strtotime('D', strtotime(Session::get('DATA_TRAVEL')['TRAVEL_SCHEDULE_DEPARTTIME'])))-1]; echo ", ".date('d-m-Y', strtotime(Session::get('DATA_TRAVEL')['TRAVEL_SCHEDULE_DEPARTTIME']))?></b></span></p>
	                                    </div>
                                        <!-- Nama_Penumpang -->
                                        <div class="tulisan_nama_penumpang_travel">
                                            <p>Nama Penumpang :<span><b>{{Session::get('DATA_COSTUMER')['COSTUMER_NAME']}}</b></span></p>
                                        </div>
                                        <!-- No_Telepon -->
                                        <div class="tulisan_notelp_penumpang_travel">
                                            <p>No Telepon :<span><b>{{Session::get('DATA_COSTUMER')['nohp_prefix']}}{{Session::get('DATA_COSTUMER')['COSTUMER_TELP']}}</b></span></p>              
                                        </div>
                                        <!-- Total_Penumpang -->
                                        <div class="tulisan_total_penumpang_travel">
                                            <p>Total Penumpang :<span><b>{{Session::get('DATA_COSTUMER')['TRAVEL_TRANSACTION_PASSENGER']}} Orang</b></span></p> 
                                        </div>
                                            
                                            <!-- <table>
                                            <tr>
                                                <td>Nama Penumpang</td>
                                                <td>:</td>
                                                <td>{{Session::get('DATA_COSTUMER')['COSTUMER_NAME']}}</td>
                                            </tr>
                                            <tr>
                                                <td>No Telepon</td>
                                                <td>:</td>
                                                <td>{{Session::get('DATA_COSTUMER')['nohp_prefix']}}{{Session::get('DATA_COSTUMER')['COSTUMER_TELP']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Penumpang</td>
                                                <td>:</td>
                                                <td>{{Session::get('DATA_COSTUMER')['TRAVEL_TRANSACTION_PASSENGER']}} Orang</td>
                                            </tr>
                                            </table> -->
	                                </div>
	                                
	                            </div>
	                            <!--Data Penumpang-->
	                            <div class="row col-md-4" style="padding-left:50px; padding-top:20px">
                                    <!-- Rute_Travel -->
                                    <div class="rincian_penerbangan_1">
                                        <div class="logo_jangkauan">
                                            <img src="<?php echo url('assets/images/gambar_jangkauan.png')?>">
                                        </div>
                                        <div class="konten_rincian_penerbangan_1" style="margin-left:25px; margin-top:-90px; margin-bottom:10px">
                                            <table class="baris_rincian_penerbangan_1">
                                                <tbody>
                                                    <tr>
                                                        <td class="kota_asal_1" >
                                                            <b>{{Session::get('DATA_TRAVEL')['ROUTE_DEPARTURE']}}</b>
                                                        </td>
                                                        <td class="waktu_penerbangan_asal_1">
                                                            <b><?php echo date('h:i', strtotime(Session::get('DATA_TRAVEL')['TRAVEL_SCHEDULE_DEPARTTIME']))?></b><?php echo $day[date('N',strtotime('D', strtotime(Session::get('DATA_TRAVEL')['TRAVEL_SCHEDULE_DEPARTTIME'])))-1]?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="box_logo_penerbangan_asal">
                                                            <div class="logo_penerbangan_asal">
                                                                <img src="<?php echo url('public\Assets\partnerPhoto/'.Session::get('DATA_TRAVEL')['PARTNER_PHOTO'].'')?>" width=90 height=52>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="kota_tujuan_1">
                                                            <b>{{Session::get('DATA_TRAVEL')['ROUTE_DEST']}}</b>
                                                        </td>
                                                        <td class="waktu_penerbangan_tujuan_1">
                                                            <div class="tulisan_waktu_tujuan_1">
                                                                <b><?php echo date('h:i', strtotime(Session::get('DATA_TRAVEL')['TRAVEL_SCHEDULE_ARRIVETIME']))?></b><?php echo $day[date('N',strtotime('D', strtotime(Session::get('DATA_TRAVEL')['TRAVEL_SCHEDULE_ARRIVETIME'])))-1]?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
	                            </div>
                                <!-- Keterangan Waktu -->
                               <div class="row keterangan_waktu col-md-12" style="color:#bbb">
	                                <p>Harap Datang 30 menit sebelum keberangkatan</p>
	                          </div>
                            </div>
                        </div>
                        <!-- Rincian Harga Total -->
                        <div class="col-md-4 remove_padding"  style="background-color:#eee; margin-left: 340px; margin-bottom:10px; width:580px">
                            <div class="tulisan_rincian_harga" style="text-align:center; margin-bottom:10px">
                                <h2>Rincian Harga<h2>
                            </div>
                            <div class="rincian_harga col-md-4" style=" width:28%;padding-left:10px">
                                <div class="rincian_harga_1_a">
                                    <p><b>{{Session::get('DATA_TRAVEL')['VEHICLE_NAME']}}</b> (Dewasa) x {{Session::get('DATA_COSTUMER')['TRAVEL_TRANSACTION_PASSENGER']}} :</p>
                                </div>
                                <div class="rincian_harga_2_a">
                                    <p>Biaya Tambahan 1</p>
                                </div>
                                <div class="rincian_harga_3" style="color:#00b400">
                                    <p>Convenience Fee</p>
                                </div>
                                <div class="pembatas_rincian_harga">
                                </div>
                                <div class="rincian_harga_4">
                                    <p>Total:</p>
                                </div>

                            </div>
                            <div class="daftar_harga_total col-md-3" style="width:25%;  border-right: 2px dashed #bbb; ">
                                <div class="harga_1_a">
                                    <span style="float:left">Rp</span><p><b>571.300</b></p>
                                </div>
                                <div class="harga_2_a">
                                    <span style="float:left">Rp</span><p><b>0</b></p>
                                </div>
                                <div class="harga_3" style="color:#00b400">
                                    <span style="float:left">Rp</span><p><b>-321</b></p>
                                </div>
                                <div class="harga_4" style="font-size:16px">
                                    <span style="float:left"><b>Rp</b></span><p><b>{{Session::get('DATA_COSTUMER')['TRAVEL_TRANSACTION_PRICE']}}</b></p>
                                </div>
                            </div>
                            <!-- Tulisan Lanjut Ke Pembayaran -->
                            <div class="col-md-4 remove padding" style ="background-color:#eee; float:right; width:270px">
                            <!-- <div class="tulisan_lanjut" style="margin-top: -10px; margin-bottom:15px; ,margin-left:-5px">
                                <h3>Lanjut Ke Pembayaran</h3>
                            </div> -->
                            <div class="desc_lanjut" style="margin-bottom:15px">
                                <p>Dengan mengklik tombol di bawah, Anda menyetujui <u>Syarat & Ketentuan</u> dan <u>Kebijakan Privasi</u> Travebaik</p>
                            </div>
                            <div class="logo_lanjut" style="margin-bottom:15px">
                                <input type="image" value="submit "src="<?php echo url('assets/images/lanjut_ke_pembayaran.png')?>">
                            </div>
                        </div>
                        </div>
                    </div>
	@stop