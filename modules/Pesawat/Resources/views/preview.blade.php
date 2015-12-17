@extends('page_template')
@section('content')
    @parent
    <?php
$pesawat=Session::get('PESAWAT');

?>
                <div class="row">
                <div class="col-md-12 slider"></div>
            </div>            
<!-- CONTENT OPEN -->
            <div class="row">

                <div class="col-md-12 content_">
                    <div class="row head_table">
                        <div class="col-md-4" style="padding-top: 0px"><h4><b>PROSES PEMESANAN</b><h4></div>
                        <div class="col-md-8" style="padding: 0;">
                             <p style="float: right;padding-top: 10px; margin-right: 10px;"> Pesawat |   <?php echo $pesawat['DATA_PESAWAT']['ports'][0]." Ke ".$pesawat['DATA_PESAWAT']['ports'][1];?>|  <?php echo '<span class="tanggal">'.$pesawat['input']['depart_date'].'</span>'?></p>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 5px; height: 50px;">
                        <div class="kotak_step">
                            <div class="step">
                                <h4>Isi Data<h4>
                            </div>
                        </div>
                        <div class="kotak_step">
                            <div class="step_selected">
                                <h4>Review<h4>
                            </div>
                        </div>
                        <div class="kotak_step">
                            <div class="step">
                                <h4>Pembayaran<h4>
                            </div>
                        </div>
                        <div class="kotak_step">
                            <div class="step">
                                <h4>Konfirmasi<h4>
                            </div>
                        </div>
                        <div class="kotak_step">
                            <div class="step">
                                <h4>e-Tiket<h4>
                            </div>
                        </div>
                    </div>
                    <div class="row col-md-4">
                        <div class="row" style="margin-top:50px">
                            <!-- Info No.Pesanan Pojok Kiri Atas -->
                            <div class="col-md-4 remove_padding"  style="background-color:#eee;border: 1px solid #ddd; border-left: 4px solid #00cd00; width:320px">
                                <div class="tulisan_no_pesanan" style="padding-left:10px; padding-top:10px">
                                    <p>No. Pesanan</p>
                                </div>
                                <div class="no_pesanan" style="margin-left:220px; margin-top:-28px">
                                    <p><b>{{Session::get('PESAWAT')['DATA_COSTUMER']['NO_PEMESANAN']}}</b></p>
                                </div>
                            </div>
                         </div>

                         <!-- Info Lanjut Ke Pembayaran -->
                        <div class="row">
                            <div class="col-md-4 remove padding" style ="background-color:#eee; margin-top:15px; width:320px">
                                <div class="tulisan_lanjut" style="margin-top: -10px; margin-bottom:15px; ,margin-left:-5px">
                                    <h3>Lanjut Ke Pembayaran</h3>
                                </div>
                                <div class="desc_lanjut" style="margin-bottom:15px">
                                    <p>Dengan mengklik tombol di bawah, Anda menyetujui <u>Syarat & Ketentuan</u> dan <u>Kebijakan Privasi</u> Traveloka</p>
                                </div>
                                <div class="logo_lanjut" style="margin-bottom:15px">
                                     <a href="{!! url('payment') !!}"><img src="<?php echo url('assets/images/lanjut_bayar.png')?>"></a>
                                </div>
                            </div>
                        </div>

                        <!-- Info Penting -->
                        <div class="row">
                            <div class="col-md-4 remove padding" style ="background-color:#5a5a5a; margin-top:15px; color:#fff; width:320px">
                                <div class="logo_penting" style="padding-top:15px">
                                    <img src="<?php echo url('assets/images/logo_info_2.png')?>">
                                </div>
                                <div class="tulisan_penting" style="margin-left:30px; margin-top:-45px">
                                    <h3>Penting</h3>
                                </div>
                                <div class="desc_penting">
                                    <p>Anda perlu <b>memindahkan bagasi</b> dan kembali check-in saat transit sebelum lanjut terbang dengan maskapai berbeda. Mohon periksa jadwal ini dengan teliti</p>
                                </div>
                            </div>
                        </div>

                        <!-- Notes_Harga -->
                        <div class="row">
                            <div class="col-md-4 remove_padding" style="background-color:#fff; border: 1px solid #ddd; border-left: 4px solid #00cd00;margin-top: 10px; width:320px">
                                <div class="notes_harga" style="padding:10px">
                                    <p>Harga di samping telah final dan dikonfirmasi oleh maskapai. Potongan dari kupon promo dapat digunakan di halaman pemesanan</p>
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
                    </div>
                        <!-- Rincian Penerbangan-->
                        <div class="col-md-8" style="padding-left:50px; ">
                            <div class="tulisan_rincian_penerbangan">
                                <h2>Rincian Penerbangan</h2>
                            </div>
                            <!-- Kotak Data Rincian Penerbangan -->
                            <div class="box_rincian_penerbangan" style="background-color:#fff;border: 1px solid #ddd; border-left: 4px solid #00cd00; padding:20px">
                                <!-- Kotak_1 -->
                                <div class="box_tanggal_rincian_penerbangan" style="background-color:#eee;border: 1px solid #ddd; border-left: 4px solid #00cd00; width:320px; margin-bottom:10px">
                                    <div class="tulisan_tanggal_rincian_penerbangan" style="padding:10px">
                                        Penerbangan :
                                        <p><b><?php echo date('D',strtotime($pesawat['input']['depart_date']))." , <span class='tanggal'>".$pesawat['input']['depart_date'].'</span>'?></b></p>
                                    </div>
                                </div>
                                <!-- Penerbangan_1 -->
                                <div class="rincian_penerbangan_1">
                                    <div class="logo_jangkauan">
                                        <img src="<?php echo url('assets/images/gambar_jangkauan.png')?>">
                                    </div>
                                    <div class="konten_rincian_penerbangan_1" style="margin-left:25px; margin-top:-85px; margin-bottom:10px">
                                        <table class="baris_rincian_penerbangan_1">
                                            <tbody>
                                                <tr>
                                                    <td class="kota_asal_1" >
                                                        <b>{{$pesawat['DATA_PESAWAT']['ports']['0']}}</b>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="box_logo_penerbangan_asal">
                                                        <div class="logo_penerbangan_asal">
                                                            <img src="<?php echo url('public/Assets/pesawatlogo/'.$pesawat['DATA_PESAWAT']['airline'].'.png')?>">
                                                        </div>
                                                    </td>
                                                    <td class="kode_penerbangan_asal_1">
                                                        {{$pesawat['DATA_PESAWAT']['plane']}}
                                                    </td>
                                                    <td class="waktu_penerbangan_asal_1">
                                                        <b>{{$pesawat['DATA_PESAWAT']['time'][0]}}</b> 
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td class="waktu_penerbangan_tujuan_1">
                                                        <div class="tulisan_waktu_tujuan_1">
                                                            <b>{{$pesawat['DATA_PESAWAT']['time'][1]}}</b> 
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="kota_tujuan_1">
                                                         
                                                         <b> <?php echo $pesawat['DATA_PESAWAT']['ports'][1];?></b>
                                                        
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Kotak_2 -->
                                <div class="box_tanggal_rincian_penerbangan" style="background-color:#eee;border: 1px solid #ddd; border-left: 4px solid #00cd00; width:320px; margin-bottom:10px">
                                    <div class="tulisan_tanggal_rincian_penerbangan" style="padding:10px">
                                        Penerbangan :
                                        <p><b>{{date('D',strtotime(Session::get('PESAWAT')['input']['depart_date']))}},<span class="tanggal">{{Session::get('PESAWAT')['input']['depart_date']}}</b></p>
                                    </div>
                                </div>

                                <!-- Penerbangan_2 -->
                                <!-- <div class="rincian_penerbangan_2">
                                    <div class="logo_jangkauan">
                                        <img src="<?php echo url('assets/images/gambar_jangkauan.png')?>">
                                    </div>
                                    <div class="konten_rincian_penerbangan_2" style="margin-left:25px; margin-top:-85px; margin-bottom:10px">
                                        <table class="baris_rincian_penerbangan_2">
                                            <tbody>
                                                <tr>
                                                    <td class="kota_asal_2" >
                                                        <b>Jakarta</b>
                                                        (CGK)
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="box_logo_penerbangan_asal">
                                                        <div class="logo_penerbangan_asal">
                                                            <img src="<?php echo url('assets/images/lion_logo.png')?>">
                                                        </div>
                                                    </td>
                                                    <td class="kode_penerbangan_asal_2">
                                                        JT-554
                                                    </td>
                                                    <td class="waktu_penerbangan_asal_2">
                                                        <b>17:00</b> | Kamis
                                                    </td>                      
                                                </tr>
                                                <tr>
                                                    <td class="waktu_penerbangan_tujuan_2">
                                                        <b>07.15</b> | Kamis
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="kota_tujuan_2">
                                                        <b>Yogyakarta</b>
                                                        (YOG)
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> -->
                                <!-- Keterangan Waktu -->
                                <div class="keterangan_waktu" style="margin-left:20px; color:#bbb">
                                <p>Semua waktu adalah waktu lokal Bandara</p>
                                </div>
                            </div>
                        </div>
                        <!-- Rincian Harga Total -->
                        <div class="col-md-4 remove_padding"  style="background-color:#eee; margin-top: 30px; margin-left: 50px;">
                            <div class="row tulisan_rincian_harga"><h3>Rincian Harga<h3>
                            </div>
                            <div class="row col-md-7">
                                    
                                <div class="rincian_harga" style="padding-left:10px">
                                    <div class="rincian_harga_1_a">
                                        <p>{{$pesawat['DATA_PESAWAT']['airline']}} (Dewasa) x {{$pesawat['input']['adult']}}:</p>
                                    </div>
                                    <div class="rincian_harga_2_a">
                                        <p>Bagasi {{$pesawat['DATA_PESAWAT']['ports']['0']}} - {{$pesawat['DATA_PESAWAT']['ports']['1']}}</p>
                                    </div>
                                    <!-- <div class="rincian_harga_1_b">
                                        <p>Lion Air (Dewasa) x1:</p>
                                    </div>
                                    <div class="rincian_harga_2_b">
                                        <p>Bagasi CGK - JOG</p>
                                    </div> -->
                                    <div class="rincian_harga_3">
                                        <p>Convenience Fee</p>
                                    </div>
                                    <div class="pembatas_rincian_harga">
                                    </div>
                                    <div class="rincian_harga_4">
                                        <p>Total:</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 daftar_harga_total" style="width:45%;; padding-right:10px ">
                                <div class="harga_1_a">
                                    <span style="float:left">Rp</span><p><b class="">{{$pesawat['DATA_PESAWAT']['price']}}</b></p>
                                </div>
                                <div class="harga_2_a">
                                    <span style="float:left">Rp</span><p><b>0</b></p>
                                </div>
                                <!-- <div class="harga_1_b">
                                    <span style="float:left">Rp</span><p><b>436.600</b></p>
                                </div>
                                <div class="harga_2_b">
                                    <span style="float:left">Rp</span><p><b>0</b></p>
                                </div>
                                 --><div class="harga_3">
                                    <span style="float:left"></span><p><b>0</b></p>
                                </div>
                                
                                <div class="harga_4" style="font-size:16px">
                                    <span style="float:left"><b></b></span><p><b><span id="harga_total" class=""><?php echo (Session::get('PESAWAT')['input']['adult']+Session::get('PESAWAT')['input']['infant']+Session::get('PESAWAT')['input']['children'] )*Session::get('PESAWAT')['DATA_PESAWAT']['price'] ?></span></b></p>
                                </div>
                            </div>
                        </div>
                        <!-- Detail Daftar Penumpang -->
                        <div class="col-md-4 remove_padding" style="float:right; width:30%; margin-top:20px">
                            <div class="tulisan_daftar_penumpang"><h3>Daftar Penumpang<h3>
                            </div>

                            <!-- Kotak Daftar Penumpang -->
                            <div class="box_daftar_penumpang" style="background-color:#fff;border: 1px solid #ddd; border-left: 4px solid #00cd00">
                            @for($i=0; $i < sizeof($pesawat['DATA_COSTUMER']['PASSENGER_DETAIL_BAGGAGE']); $i++)
                                <div class="rincian_daftar_penumpang" style="padding:10px">
                                    <div class="rincian_daftar_penumpang_1 col-md-4">
                                        <span style="float:left; padding-right:10px"><b>{{$i+1}}</b></span>{{$pesawat['DATA_COSTUMER']['PASSENGER_DETAIL_TITTLE'][$i]}}
                                    </div>
                                    <div class="rincian_daftar_penumpang_2" style="padding-left:20px">
                                        <b>{{$pesawat['DATA_COSTUMER']['PASSENGER_DETAIL_NAME'][$i]}}</b>
                                    </div>
                                    <div class="rincian_daftar_penumpang_3" style="padding-left:20px; margin-bottom:10px">
                                        Dewasa
                                    </div>
                                    <div class="gambar_batas_daftar_penumpang">
                                    </div>
                                    <div class="rincian_daftar_penumpang_bagasi_1" style="padding-left:20px">
                                        Bagasi Ke Jakarta<span style="float:right"><b>{{$pesawat['DATA_COSTUMER']['PASSENGER_DETAIL_BAGGAGE'][$i]}}</b></span>
                                    </div>

                                    <!-- <div class="rincian_daftar_penumpang_bagasi_2" style="padding-left:20px">
                                        Bagasi ke Yogya<span style="float:right"><b>20</b></span>
                                    </div> -->
                                </div>
                                @endfor
                            </div>
                        </div>
                       <!--  <div class="Tombol_Next" style="float:right; margin-top:40px; margin-right:15px; margin-bottom: 10px; padding:10px; position:center">
                            <button type="button" class="btn remove_border themecolor">Lanjutkan</button>
                        </div> -->
                    </div>
            <!-- CONTENT CLOSE -->

            <div class="row subscribe_" style="background: #eee; height: 80px;margin-bottom: 10px; margin-top:10px">
                <div class="col-md-6">
                    <h3>Daftarkan email anda sekarang untuk mendapatkan diskon Rp 100.000,-</h3>
                </div>
                <div class="col-md-4">
                    <input type="email" class="form-control remove_border" id="exampleInputEmail3" placeholder="Email"/>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn remove_border themecolor">Subscribe</button>
                </div>
                
            </div>
@stop
