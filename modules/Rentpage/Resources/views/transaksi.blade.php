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

					
					{!!Form::open(['route'=>'rentpage.transaksi','method'=>'post'])!!}
					<input type="hidden" value="{{$id}}" name="RENT_SCHEDULE_ID">
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
@endsection
