@extends('page_template')
@section('content')
    @parent
        @include('column_search_hidden')
   <div class="row">
<?php
$day=["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"]
?>
                <div class="col-md-12 content_">
                    <div class="row head_table">
                        <div class="col-md-4" style="padding-top: 0px; font-weight: bold" ><h4><b>PROSES PEMESANAN</b><h4></div>
                        <div class="col-md-8" style="padding: 0">
                             <button style="float: right" type="button" data-target="#pencarian_data_tabel" data-toggle="collapse" aria-expanded="true" class="btn remove_border themecolor">Ubah Pencarian</button>
                             <p style="float: right;padding-top: 10px; margin-right: 10px;"> Rent | {{Session::get('DATA_RENT')['CITY_NAME']}}| <?php echo dateFormat(date('d-m-Y', strtotime(Session::get('DATA_RENT')['RENT_SCHEDULE_DATE'])))?></p>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 5px; height: 50px; margin-bottom:10px">
                        <div class="kotak_step_travel">
                            <div class="step_selected">
                                <h4>Isi Data<h4>
                            </div>
                        </div>
                        <div class="kotak_step_travel">
                            <div class="step">
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

                    <div class="row" style="margin-top:90px">
                        <!-- Info Maskapai Pojok Kiri Atas -->
                        <div class="col-md-4 remove_padding"  style="background-color:#fff;border: 1px solid #ddd; border-left: 5px solid #00cd00">
                            <div class="info_logo_merk_travel">
                                <img onError="this.onerror=null;this.src='<?php echo url('assets/image/noimage.png')?>'" src="<?php echo url('public/Assets/partnerPhoto/'.Session::get('DATA_RENT')['PARTNER_PHOTO'].'')?>" width=92 height=50></img>
                            </div>
                            <div clas="info_logo_kendaraan_travel" style="margin-left:170px; margin-top:-50px">
                                <img onError="this.onerror=null;this.src='<?php echo url('assets/image/noimage.png')?>'" src="<?php echo url('public/Assets/vehiclePhoto/'.Session::get('DATA_RENT')['VEHICLE_PHOTO'].'')?>" width=92 height=56></img>
                            </div>
                            <div class="info_travel" style="background-color: #fff; margin-top:10px; padding-left:20px">
                                <p>{{Session::get('DATA_RENT')['ROUTE_DEPARTURE']}} ke {{Session::get('DATA_RENT')['ROUTE_DEST']}}</p>
                                <p>Fasilitas : AC, Wifi, Musik, Makan 1x</p>
                                <p>{{dateFormat(date('d-m-Y', strtotime(Session::get('DATA_RENT')['RENT_SCHEDULE_DATE'])))}}   {{Session::get('DATA_RENT')['CITY_NAME']}}</p>                                
                            </div>
                        </div>
                        <!-- Isian  Data Penumpang -->
                        {!!Form::open(['route'=>'rentpage.transaksi.preview','method'=>'post'])!!}
                        <div class="col-md-8"style=" padding-left:30px; margin-top:-10px;z-index:1000">
                            <div class="judul">
                                <h4>Isi data pemesan yang dapat dihubungi<h4>
                            </div>
                            <input type="hidden" name="RENT_SCHEDULE_ID" value="{{$id_schedule}}">
                            <input type="hidden" id="totalHargaHidden" name="RENT_TRANSACTION_PRICE" value="{{Session::get('DATA_RENT')['RENT_SCHEDULE_PRICE']}}">
                            <div class="form_data_penumpang" style="padding-top:10px">
                                <label>Nama</label>
                                <div class="kotak_nama">
                                    <input type="text" name="COSTUMER_NAME" style="width:90%" >
                                    <p>Sesuai KTP/Paspor/SIM (tanpa tanda baca atau gelar)</p>
                                </div>
                            </div>
                            <div class="form_data_penumpang">
                                <label>No HP Pemesan (Kontak)</label>
                                <div class="kotak_nohp">
                                    <input type="tel" name="nohp_prefix" style="width:10%" value="+62">
                                    <input type="tel" name="COSTUMER_TELP" style="width:35%">
                                </div>
                                <div class="desc_nohp remove_padding" style="color:#bbb; margin-top:-35px;margin-left:280px; margin-right:50px">
                                    <p>Contoh: +628123456789, untuk Kode Negara (+62) dan No.Handphone 08123456789</p>
                                </div>
                            </div>
                            <div class="form_data_penumpang" style="margin-top:-20px">
                                <label>Email</label>
                                <div class="kotak_email">
                                    <input type="email" name="COSTUMER_EMAIL" style="width:46%">
                                </div>
                                <div class="desc_email remove_padding" style="color:#bbb; margin-top:-35px;margin-left:280px; margin-right:98px">
                                    <p>Contoh: email@example.com kami akan mengirimkan konfirmasi ke email Anda</p>
                                </div>
                            </div>
                        </div>
                        <!-- Rincian Harga -->
                        <div class="col-md-4 remove_padding"  style="background-color:#eee; margin-top:20%; position:absolute">
                            <div class="tulisan_rincian_harga "><h3>Rincian Harga<h3>
                            </div>
                            <div class="rincian_harga col-md-7" style="padding-left:10px">
                                <div class="rincian_harga_1">
                                    <p>{{Session::get('DATA_RENT')['VEHICLE_NAME']}} x {{Session::get('duration')}} Hari :</p>
                                </div>
                                <div class="rincian_harga_2">
                                    <p>Harga Bagasi:</p>
                                </div>
                                <div class="rincian_harga_3" style="color:#00b400">
                                    <p>Biaya Transaksi:</p>
                                </div>
                                <div class="pembatas_rincian_harga">
                                </div>
                                <div class="rincian_harga_4">
                                    <p>Total:</p>
                                </div>
                            </div>
                            <div class="daftar_harga col-md-5" style="width:45%;position:absolute;margin-left:55%; padding-right:10px ">
                                <div class="harga_1">
                                    <span style="float:left">Rp</span><p><b id="harga">{{Session::get('DATA_RENT')['RENT_SCHEDULE_PRICE']}}</b></p>
                                </div>
                                <div class="harga_2">
                                    <span style="float:left">Rp</span><p><b>0</b></p>
                                </div>
                                <div class="harga_3" style="color:#00b400">
                                    <p>0<p>
                                </div>
                                <div class="harga_4" style="font-size:16px">
                                    <span style="float:left"><b>Rp</b></span><p><b id="totalharga">{{Session::get('DATA_RENT')['RENT_SCHEDULE_PRICE']*Session::get('duration')}}</b></p>
                                </div>
                            </div>
                        </div>
                     </div>
                     <div class="row" style="">
                        <!-- Notes_1 -->
                        <!-- Data Tambahan Penumpang-->
                        <div class="col-md-8" style="margin-left:325px; margin-top:-150px; margin-bottom:20px">
                            <!-- <div class="tulisan_data_penumpang">
                                <h3>Data Penumpang<h3>
                            </div> -->
                            <div class="notes_data_tambahan_penumpang" style="background-color:#ffff9a; font-size: 16px; margin-top:27%">
                                <!-- <p>Perhatian: Nama Penumpang rute Internasional <b>harus</b> tepat dan sesuai Paspor,
                                sedangkan domestik dapat sesuai KTP / SIM / Paspor. Data Penumpang tidak dapat diubah setelah halaman berpindah<p> -->
                                <ul><h4><b>Tambahan: </b></h4>
                                  <li>Pihak Rental tetap dapat meng-update harga. Harga final akan Anda dapatkan di halaman review pembayaran</li>
                                  <li>Anda akan membayar dalam mata uang yang Anda pilih: <u>IDR</u></li>
                              </ul>
                            </div>
                <div class="Tombol_Next" style="float:right; padding:10px; margin-top:30px">
                    <button type="submit" class="btn remove_border themecolor">Lanjutkan</button>
                </div>
            </div>
            {!!Form::close()!!}
            <!-- CONTENT CLOSE -->
            
            
            <div class="row subscribe_" style="background: #eee; height: 100px;margin-bottom: 10px; margin-top:205px">
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
<script type="text/javascript">
    function updateHarga () {
        var harga=$("select[name='RENT_TRANSACTION_PASSENGER']").val();
        harga=parseInt(harga)*parseInt($("#harga")[0].innerHTML);
        $("#totalharga").html(harga);
        $("#totalHargaHidden").val(harga);
    }
</script>
@stop