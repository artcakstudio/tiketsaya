@extends('page_template')

@section('custom_css')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{!! url('assets/css/fancybox/jquery.fancybox.css') !!}" media="screen">
    <style type="text/css">
        .tab-form {
            margin-top: 20px;
        }

        #payment-form {
            margin-top: 20px;
        }

        .bg-none {
            background: none !important;
            background-color: transparent !important;
        }
    </style>
@stop

@section('custom_js')
    <script type="text/javascript" src="{!! url('assets/js/fancybox/jquery.fancybox.pack.js') !!}"></script>
    <script src="https://api.sandbox.veritrans.co.id/v2/assets/js/veritrans.min.js"></script>
    <script>
        <!-- Javascript to generate token and show 3DSecure Dialog -->
        $(function () {
            // Sandbox API URL. TODO: Change with Production API URL when you're ready to go live.
            Veritrans.url = "https://api.sandbox.veritrans.co.id/v2/token";

            // TODO: Change with your actual client key that can be found at Merchant Administration Portal >> Settings >> Access Key
            Veritrans.client_key = "VT-client-0hEvNDVd5dzXBJHm";
            var card = function () {
                return {
                    'card_number': $("#card-number").val(),
                    'card_exp_month': $("#card-expiry-month").val(),
                    'card_exp_year': $("#card-expiry-year").val(),
                    'card_cvv': $("#card-cvv").val(),

                    // Set 'secure', 'bank', and 'gross_amount', if the merchant wants transaction to be processed with 3D Secure
                    'secure': true,
                    'bank': 'bni',
                    'gross_amount': '{{ $gross_amount }}'
                }
            };

            // handler when user click the 'Pay' button.
            $('#submit-button').click(function (event) {
                event.preventDefault();
                $(this).attr("disabled", "disabled");
                Veritrans.token(card, callback);
                return false;
            });

            function callback(response) {
                if (response.redirect_url) {
                    // 3Dsecure transaction. Open 3Dsecure dialog
                    console.log('Open Dialog 3Dsecure');
                    openDialog(response.redirect_url);

                } else if (response.status_code == '200') {
                    // success 3d secure or success normal
                    //close 3d secure dialog if any
                    closeDialog();

                    // store token data in input #token_id and then submit form to merchant server
                    $("#token-id").val(response.token_id);
                    $("#payment-form").submit();
                } else {
                    // failed request token
                    //close 3d secure dialog if any
                    closeDialog();
                    $('#submit-button').removeAttr('disabled');
                    // Show status message.
                    $('#message').text(response.status_message);
                    console.log(JSON.stringify(response));
                }
            }

            // Open 3DSecure dialog box
            function openDialog(url) {
                $.fancybox.open({
                    href: url,
                    type: 'iframe',
                    autoSize: false,
                    width: 400,
                    height: 420,
                    closeBtn: false,
                    modal: true
                });
            }

            // Close 3DSecure dialog box
            function closeDialog() {
                $.fancybox.close();
            }
        });
    </script>
    @stop

    @section('content')
            <!-- SLIDER -->
    <div class="row">
        <div class="col-md-12 slider"></div>
    </div>
    <!-- SLIDER CLOSE -->

    <?php
    $day = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"]
    ?>

            <!-- CONTENT OPEN -->
    <div class="row">
        <div class="col-md-12 content_">
            <div class="row head_table">
                <div class="col-md-4" style="padding-top: 0px"><h4><b>PROSES PEMESANAN</b></h4></div>
                <div class="col-md-8" style="padding: 0;">
                    <p style="float: right;padding-top: 10px; margin-right: 10px;">
                        @if(Session::has('DATA_TRAVEL'))
                            {{Session::get('DATA_TRAVEL')['ROUTE_DEPARTURE']}}
                            ke {{Session::get('DATA_TRAVEL')['ROUTE_DEST']}}
                            | <?php echo $day[date('N', strtotime('D', strtotime(Session::get('DATA_TRAVEL')['TRAVEL_SCHEDULE_DEPARTTIME']))) - 1]; echo " " . date('d-m-Y', strtotime(Session::get('DATA_TRAVEL')['TRAVEL_SCHEDULE_DEPARTTIME']))?>
                        @elseif(Session::has('DATA_RENT'))
                            {{Session::get('DATA_RENT')['CITY_NAME']}}
                            | <?php echo " " . date('d-m-Y', strtotime(Session::get('DATA_RENT')['RENT_SCHEDULE_DATE']))?>
                        @endif

                    </p>
                </div>
            </div>

            <div class="row" style="margin-top: 5px; height: 50px;">
                <div class="kotak_step">
                    <div class="step">
                        <h4>Isi Data</h4>
                    </div>
                </div>
                <div class="kotak_step">
                    <div class="step">
                        <h4>Review</h4>
                    </div>
                </div>
                <div class="kotak_step">
                    <div class="step_selected">
                        <h4>Pembayaran</h4>
                    </div>
                </div>
                <div class="kotak_step">
                    <div class="step">
                        <h4>e-Tiket</h4>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top:50px">
                <!-- Info No.Pesanan Pojok Kiri Atas -->
                <div class="col-md-4 remove_padding"
                     style="background-color:#eee;border: 1px solid #ddd; border-left: 4px solid #00cd00; width:320px">
                    <div class="tulisan_no_pesanan" style="padding-left:10px; padding-top:10px">
                        <p>No. Pesanan</p>
                    </div>
                    <div class="no_pesanan" style="margin-left:220px; margin-top:-28px">
                        <p><b>{{  Session::get(Session::get('type'))['DATA_COSTUMER']['NO_PEMESANAN'] }}</b></p>
                    </div>
                </div>
            </div>

            <br/>

            <div class="container">
                @include('payment::layouts.tab-form')
            </div>
        </div>
    </div>
@stop