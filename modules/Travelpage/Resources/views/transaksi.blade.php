@extends('page_template')


@section('content')

<div class="container-fluid" style="margin-top:10%">
	<div class="row">
		<div class="col-md-12 left">
			<div class="panel panel-default">
				<div class="panel-heading">Transaksi</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					
					{!!Form::open(['route'=>'travelpage.transaksi','method'=>'post'])!!}
					<input type="hidden" value="{{$id_schedule}}" name="TRAVEL_SCHEDULE_ID">
						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="COSTUMER_NAME">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="COSTUMER_EMAIL">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Telp</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="COSTUMER_TELP">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Total Penumpang</label>
							<div class="col-md-6">
								<select name="TRAVEL_TRANSACTION_PASSENGER" class="form -group form-control" onchange="updateHarga()">
									@for($i=1; $i <= $sisa; $i++)
										<option value="{{$i}}">{{$i}} Orang</option>
									@endfor
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Harga</label>
							<div class="col-md-6">
								<input type="text" name="TRAVEL_TRANSACTION_PRICE" value="{{$harga}}" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Order
								</button>
							</div>
						</div>
					{!!Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="harga" value="{{$harga}}">
<script type="text/javascript">
	function updateHarga (argument) {
		var harga=$("input[name='harga']").val();
		var total=$("select[name='TRAVEL_TRANSACTION_PASSENGER']").val();
		var hargatotal=parseInt(harga)*parseInt(total);
		$("input[name='TRAVEL_TRANSACTION_PRICE']").val(hargatotal);
	}
</script>
@endsection
