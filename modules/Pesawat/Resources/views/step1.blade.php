@extends('page_template')
@section('content')
    @parent
        @include('column_search_hidden')
   <div class="row">
<?php
$day=["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"];

?>
 {!!Form::open(['route'=>'pesawat.transaksi.preview','method'=>'post','id'=>'form_data_penumpang'])!!}
    <div class="col-md-12 content_">
                    <div class="row head_table">
                        <div class="col-md-4" style="padding-top: 0px; font-weight: bold" ><h4><b>PROSES PEMESANAN</b><h4></div>
                        <div class="col-md-8" style="padding: 0">
                             <button style="float: right" type="button" data-target="#pencarian_data_tabel" data-toggle="collapse" aria-expanded="true" class="btn remove_border themecolor">Ubah Pencarian</button>
                             <p style="float: right;padding-top: 10px; margin-right: 10px;"> Pesawat Booking  <?php echo "|  ".$datashare['Bandara'][Session::get('PESAWAT')['DATA_PESAWAT']['ports'][0]]['DisplayName']." | <span class='tanggal'>".date('d-m-Y').'</span>'?></p>
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
                                <img onError="this.onerror=null;this.src='<?php echo url('assets/images/noimage.png')?>'" src="<?php echo url('public/Assets/pesawatlogo/'.Session::get('PESAWAT')['DATA_PESAWAT']['airline'].'.png')?>" width=92 height=50></img>
                            </div>
                            <div class="info_travel" style="background-color: #fff; margin-top:10px; padding-left:20px">
                                <p>{{$datashare['Bandara'][Session::get('PESAWAT')['DATA_PESAWAT']['ports'][0]]['DisplayName'] }} Ke {{$datashare['Bandara'][Session::get('PESAWAT')['DATA_PESAWAT']['ports'][1]]['DisplayName'] }}</p>
                                <p>Fasilitas : AC, Wifi, Musik, Makan 1x</p>
                                <p>{{date('H:i', strtotime(Session::get('PESAWAT')['DATA_PESAWAT']['time'][0]))}}  {{Session::get('PESAWAT')['DATA_PESAWAT']['ports'][0]}}</p>
                                <p>{{date('H:i', strtotime(Session::get('PESAWAT')['DATA_PESAWAT']['time'][1]))}}  {{Session::get('PESAWAT')['DATA_PESAWAT']['ports'][1]}}</p>
                            </div>
                        </div>
                        <!-- Isian  Data Penumpang -->

                        <div class="col-md-8 data_pemesan" style=" padding-left:30px; margin-top:-10px;z-index:1000">
                            <div class="judul">
                                <h4>Isi data pemesan yang dapat dihubungi<h4>
                            </div>
                            <input type="hidden" name="plane" value="{{Session::get('PESAWAT')['DATA_PESAWAT']['plane']}}">
                            <input type="hidden" id="totalHargaHidden" name="TICKET_TRANSACTION_PRICE" value="{{Session::get('PESAWAT')['DATA_PESAWAT']['price']}}">
                            <div class="form_data_penumpang" style="padding-top:10px">
                                <label>Nama</label>
                                <div class="kotak_nama">
                                    <input type="text" name="COSTUMER_NAME" style="width:90%" >
                                </div>
                                    <p>Sesuai KTP/Paspor/SIM (tanpa tanda baca atau gelar)</p>
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
                            <div class="Tombol_Next" style="float:right; padding:10px; margin-top:30px">
                                <div  class="btn remove_border themecolor">Lanjutkan</div>
                            </div>
                        </div>
                        <!-- Rincian Harga -->
                       <div class="col-md-4 remove_padding"  style="background-color:#eee; margin-top:20%; position:absolute">
                            <div class="tulisan_rincian_harga "><h3>Rincian Harga<h3>
                            </div>
                            <div class="rincian_harga col-md-7" style="padding-left:10px">
                                <div class="rincian_harga_1">
                                    <p> Remaja x <tag id="totalOrang_adult">{{Session::get('input')['adult']}} Orang</tag> : </p>
                                </div>
                                <div class="rincian_harga_1">
                                    <p> Anak Anak x <tag id="totalOrang_children">{{Session::get('input')['children']}} Orang</tag> : </p>
                                </div>
                                <div class="rincian_harga_1">
                                    <p> Manula x <tag id="totalOrang_infant">{{Session::get('input')['infant']}} Orang</tag> : </p>
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
                                    <span style="float:left">Rp</span><p><b id="harga_adult" class="rupiah">{{Session::get('PESAWAT')['DATA_PESAWAT']['price']}}</b></p>
                                </div>
                                <div class="harga_1">
                                    <span style="float:left">Rp</span><p><b id="harga_children">0</b></p>
                                </div>
                                <div class="harga_1">
                                    <span style="float:left">Rp</span><p><b id="harga_infant">0</b></p>
                                </div>
                                <div class="harga_2">
                                    <span style="float:left">Rp</span><p><b>0</b></p>
                                </div>
                                <div class="harga_3" style="color:#00b400">
                                    <p>0<p>
                                </div>
                                <div class="harga_4" style="font-size:16px">
                                    <span style="float:left"></span><p><b id="totalharga" class="rupiah"><?php echo (Session::get('input')['adult']+Session::get('input')['infant']+Session::get('input')['children'] )*Session::get('PESAWAT')['DATA_PESAWAT']['price'] ?></b></p>
                                </div>
                            </div>
                        </div>
                     </div>



                        <!-- Notes_1 -->
                        <!-- Data Tambahan Penumpang-->
                        <div class="col-md-8" style="margin-left:325px; margin-top:-150px; margin-bottom:20px">
                            <!-- <div class="tulisan_data_penumpang">
                                <h3>Data Penumpang<h3>
                            </div> -->
                            <div class="notes_data_tambahan_penumpang" style="background-color:#ffff9a; font-size: 16px; margin-top:27%; visibility:none" >
                                <!-- <p>Perhatian: Nama Penumpang rute Internasional <b>harus</b> tepat dan sesuai Paspor,
                                sedangkan domestik dapat sesuai KTP / SIM / Paspor. Data Penumpang tidak dapat diubah setelah halaman berpindah<p> -->
                                <ul><h4><b>Tambahan: </b></h4>
                                  <li>Pihak Rental tetap dapat meng-update harga. Harga final akan Anda dapatkan di halaman review pembayaran</li>
                                  <li>Anda akan membayar dalam mata uang yang Anda pilih: <u>IDR</u></li>
                              </ul>
                            </div>
                            <div id="data_penumpang">
                             <div class="box_data_tambahan_penumpang" style="">
                                <div class="tulisan_penumpang_dewasa" style="text-align:center">
                                    <h4>Penumpang Dewasa</h4>
                                </div>
                                <div class="form_data_penumpang_tambahan">
                                    <!-- Kolom Titel -->
                                    <!-- Kolom Nama -->
                                    <input type="hidden" name="passenger_type[]" value="adult" class="passenger_type">
                                    <div class="row">
                                        <div class="tulisan_titel col-md-4" style="margin-left:10px; padding-top:10px">
                                            <label>Titel</label>
                                            <div class="kotak_titel">
                                                <select style="height:30px" name="PASSENGER_DETAIL_TITTLE[]">
                                                  <option value="Mr">Mr.</option>
                                                  <option value="Mrs">Mrs.</option>
                                                </select>
                                            </div>
                                        </div>
                                            
                                        <div class="tulisan_nama_tambahan col-md-12" style="margin-left:100px; margin-top:-55px" >
                                            <label>Nama Lengkap (sesuai KTP/SIM/Paspor)</label>
                                            <div class="kotak_nama_tambahan">
                                                <input type="text" name="PASSENGER_DETAIL_NAME[]" style="height:30px; width:70%">
                                                <p>Tanpa gelar dan tanda baca</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row tanggal_lahir">
                                    </div>
                                </div>
                                    <div class="tulisan_bagasi" style="padding:10px 0px 10px 10px">
                                        <label>Jumlah Bagasi</label>
                                        <div class="kotak_bagasi">
                                            <select style="height:30px" name="PASSENGER_DETAIL_BAGGAGE[]">
                                              <option value="20"> 20 kg (Rp 0)</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        </div>
                <div class="Tombol_Next_submit" style="float:right; padding:10px; margin-top:30px;visibility:hidden">
                    <button type="submit" class="btn remove_border themecolor">Lanjutkan</button>
                </div>
            </div>
            {!!Form::close()!!}
            <!-- CONTENT CLOSE -->
            
            
            <div class="row subscribe_" style="background: #eee; height: 100px;margin-bottom: 10px;">
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

$('#form_data_penumpang').submit(function() {
    // get all the inputs into an array.
    var $inputs = $('#myForm :input');

    // not sure if you wanted this, but I thought I'd add it.
    // get an associative array of just the values.
    var values = {};
    $inputs.each(function() {
        values[this.name] = $(this).val();
    });

});

    function updateHarga () {
     var adult=parseInt($("#harga_adult"))*parseInt($("totalOrang_adult"));
        var children=parseInt($("#harga_children"))*parseInt($("totalOrang_children"));
        var infant=parseInt($("#harga_infant"))*parseInt($("totalOrang_infant"));
        $("#totalharga").html(adult+children+infant);
    };

    $("div.Tombol_Next").click(function(){
        var name=jQuery.parseJSON('{"form":[{"nama":"Nama Pemesan","name":"COSTUMER_NAME"},{"nama":"Telepon Pemesan","name":"COSTUMER_TELP"},{"nama":"Email Pemesan","name":"COSTUMER_EMAIL"}]}');
        var flag=0;
        for(i=0; i<name.form.length;i++){
            var name_value=$("div.data_pemesan input[name='"+name.form[i].name+"']")[0].value;
            if(name_value==""){
                $("div.data_pemesan input[name='"+name.form[i].name+"']").parent().append("<h1 class='error_form row'>"+name.form[i].nama+" belum di isi</h1>");
                alert('lala');
                return;
            }
        }
        
        var adult=<?php echo Session::get('PESAWAT')['input']['adult'];?>;
        var children=<?php echo Session::get('PESAWAT')['input']['children'];?>;
        var infant=<?php echo Session::get('PESAWAT')['input']['infant'];?>;
        $("div.box_data_tambahan_penumpang").css("visibility","visible");
       console.log(children);
        var form_penumpang=$("#data_penumpang").html();
        $("div.Tombol_Next").remove();
        $("div.Tombol_Next_submit").css("visibility","visible");

        for (i=0; i<adult; i++){
            var box_data_tambahan_penumpang=$($("div.box_data_tambahan_penumpang")[$("div.box_data_tambahan_penumpang").length-1]).find("div.tulisan_penumpang_dewasa h4");
            box_data_tambahan_penumpang.html("Penumpang Dewasa");
            if(i>0){
                $("#data_penumpang").append(form_penumpang);            
            }
        }

        for (i=0; i<children; i++){
            $("#data_penumpang").append(form_penumpang);
            var box_data_tambahan_penumpang=$($("div.box_data_tambahan_penumpang")[$("div.box_data_tambahan_penumpang").length-1]).find("div.tulisan_penumpang_dewasa h4");
            box_data_tambahan_penumpang.html("Penumpang Anak Anak");
            $(box_data_tambahan_penumpang).find("input.passenger_type").attr("name","children");
            $($("div.box_data_tambahan_penumpang")[$("div.box_data_tambahan_penumpang").length-1]).find("div.tanggal_lahir").append('<div class="tulisan_nama_tambahan col-md-5" style="margin-left:100px;" ><label>Tanggal Lahir</label><div class="kotak_nama_tambahan"><input type="text" class="datepicker" name="PASSENGER_DETAIL_BIRTHDAY[]" class="datepicker" style="height:30px; width:70%"></div></div>');
        }

        form_penumpang.replace("Penumpang Anak-Anak","Penumpang Balita");
         for (i=0; i<infant; i++){
	$("#data_penumpang").append(form_penumpang);
            var box_data_tambahan_penumpang=$($("div.box_data_tambahan_penumpang")[$("div.box_data_tambahan_penumpang").length-1]).find("div.tulisan_penumpang_dewasa h4");
            box_data_tambahan_penumpang.html("Penumpang Balita");
            $(box_data_tambahan_penumpang).find("input.passenger_type").attr("name","infant");
            $($("div.box_data_tambahan_penumpang")[$("div.box_data_tambahan_penumpang").length-1]).find("div.tanggal_lahir").append('<div class="tulisan_nama_tambahan col-md-5" style="margin-left:100px; ><label>Tanggal Lahir</label><div class="kotak_nama_tambahan"><input type="text" class="datepicker" name="PASSENGER_DETAIL_BIRTHDAY[]" class="datepicker" style="height:30px; width:70%"></div></div>');
        }
    });

//form step 1 validation


</script>
@stop
