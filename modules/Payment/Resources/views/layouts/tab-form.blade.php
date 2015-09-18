<h2>Pilih metode pembayaran</h2>
<div class="tab-form">
    <ul class="nav nav-tabs">
        <li class="btn btn-default navbar-btn"><a class="bg-none" data-toggle="tab" href="#credit-card">Credit Card</a>
        </li>
        <li class="btn btn-default navbar-btn"><a class="bg-none" data-toggle="tab" href="#bank-transfer">Bank
                Transfer</a></li>
    </ul>
    <div class="tab-content">
        <div id="credit-card" class="tab-pane fade">
            @include('payment::forms.credit-card')
        </div>
        <div id="bank-transfer" class="tab-pane fade">
            @include('payment::forms.bank-transfer')
        </div>
    </div>
</div>
