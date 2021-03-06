<h3>Silakan masukan data kartu kredit Anda.</h3>
<h3>Kami hanya menerima kartu berlogo VISA atau Mastercard.</>
{!! Form::open(array(
        'url' => url('payment/checkout'),
        'method' => 'post',
        'id' => 'payment-form',
        'class' => 'form-horizontal')) !!}
<div class="form-group">
    <label class="col-xs-3 control-label">Card Number</label>

    <div class="col-xs-5">
        <input id="card-number" type="text" class="form-control" value="4811111111111114"/>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-3 control-label">Expiration</label>

    <div class="row">
        <div class="col-xs-1" style="padding-right:20px; border-right: 1px solid #ccc;">
            <input id="card-expiry-month" type="text" class="form-control" maxlength="2" value="12"/>
        </div>
        <div class="col-xs-2">
            <input id="card-expiry-year" maxlength="4" type="text" class="form-control" value="2020"/>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-3 control-label">CVV</label>

    <div class="col-xs-2">
        <input id="card-cvv" class="form-control" maxlength="3" type="text" value="123"/>
    </div>
</div>

<input id="token-id" name="token-id" type="hidden"/>
<input type="hidden" value="credit_card" name="payment_method"/>

<div class="form-group" style="margin-top: 15px;">
    <div class="col-xs-5 col-xs-offset-3">
        <button id="submit-button" type="submit" class="btn btn-success input-block-level form-control">Bayar</button>
    </div>
</div>
{!! Form::close() !!}