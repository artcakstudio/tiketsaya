<h3>E-mail instruksi pembayaran akan dikirimkan setelah Anda klik Bayar</h3>
{!! Form::open(array(
                'url' => url('payment/checkout'),
                'method' => 'post',
                'id' => 'payment-form',
                'class' => 'form-horizontal')) !!}
<input type="hidden" value="bank_transfer" name="payment_method"/>


<div class="form-group" style="margin-top: 15px;">
    <div class="col-xs-5 col-xs-offset-3">
        <button id="submit-button" type="submit" class="btn btn-success input-block-level form-control">Bayar</button>
    </div>
</div>
{!! Form::close() !!}