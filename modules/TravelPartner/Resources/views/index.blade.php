@extends('page_template')


@section('content')
@parent
	@include('travel_partner.sidebar')
	                  <div class="header_backend">PROFIL TRAVEL PARTNER</div>  
                    
                    <div class="row">
                      <img onError="this.onerror=null;this.src='<?php echo url('assets/image/noimage.png')?>'" src="<?php echo url('public/Assets/partnerPhoto/'.$partner['PARTNER_PHOTO'])?>" width=180 height=100 >
                    </div>
	                  <div class="row" style="padding-right:0px">
	                  		<div class="col-md-4" >Name :</div>
	                  		<div class="col-md-8">{{$partner['PARTNER_NAME']}}</div>
	                  </div>
	                  <div class="row">
	                  		<div class="col-md-4" >Address :</div>
	                  		<div class="col-md-8">{{$partner['PARTNER_ADDRESS']}}</div>
	                  </div>
	                  <div class="row">
	                  		<div class="col-md-4" >Telp :</div>
	                  		<div class="col-md-8">{{$partner['PARTNER_TELP']}}</div>
	                  </div>
	                  <div class="row">
	                  		<div class="col-md-4" >Description :</div>
	                  		<div class="col-md-8">{{$partner['PARTNER_DESCRIPTION']}}</div>
	                  </div>
	                  <div class="row">
	                  		<div class="col-md-4" >Username :</div>
	                  		<div class="col-md-8">{{$partner['PARTNER_USERNAME']}}</div>
	                  </div>
	                  <div class="row">
	                  		<div class="col-md-4" >Email :</div>
	                  		<div class="col-md-8">{{$partner['PARTNER_EMAIL']}}</div>
	                  </div>
	                  <div>
	                  	<button class="btn btn-primary editProfile">Edit Profile</button>
	                  	<button class="btn btn-primary editPassword">Edit Password</button>
	                  </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'travelpartner.update','METHOD'=>'POST','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'])!!} 
            <input type="hidden" name="PARTNER_ID" value="{{$partner['PARTNER_ID']}}">
            <div class="form-group">
              <label class="col-lg-3 control-label">Name</label>
              <div class="col-lg-8">
                 <input type="text" name="PARTNER_NAME" value="{{$partner['PARTNER_NAME']}}" class="form-control">
              </div>
            </div>    
            <div class="form-group">
              <label class="col-lg-3 control-label">Address</label>
              <div class="col-lg-8">
                <input type="text" class="form-control" name="PARTNER_ADDRESS" value="{{$partner['PARTNER_ADDRESS']}}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Telp</label>
              <div class="col-lg-8">
                <input type="text" class="form-control" name="PARTNER_TELP" value="{{$partner['PARTNER_TELP']}}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Username</label>
              <div class="col-lg-8">
                <input type="text" class="form-control" name="PARTNER_USERNAME" value="{{$partner['PARTNER_USERNAME']}}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Email</label>
              <div class="col-lg-8">
                <input type="text" class="form-control" name="PARTNER_EMAIL" value="{{$partner['PARTNER_EMAIL']}}">
              </div>
            </div>
             <div class="form-group">
              <label class="col-lg-3 control-label">Foto</label>
              <div class="col-lg-8">
                <input type="file" class="form-control" name="PARTNER_PHOTO" value="{{$partner['PARTNER_PHOTO']}}">
              </div>
              <div class="col-md-8" style="margin-left:20%">
                <img onError="this.onerror=null;this.src='<?php echo url('assets/image/noimage.png')?>'" src="<?php echo url('public/Assets/partnerPhoto/'.$partner['PARTNER_PHOTO'])?>" width=90 height=50>
              </div>
            </div>
  
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Edit Profile</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$("button.btn.editProfile").click(function(){
		$("#editProfile").modal("show");
	});
</script>

<div class="modal fade" id="editPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Password</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'travelpartner.update.password','METHOD'=>'POST','class'=>'form-horizontal'])!!} 
            <input type="hidden" name="PARTNER_ID" value="{{$partner['PARTNER_ID']}}">
            <div class="form-group">
              <label class="col-lg-3 control-label">Old Password</label>
              <div class="col-lg-8">
                 <input type="password" name="old_password"class="form-control">
              </div>
            </div>    
            <div class="form-group">
              <label class="col-lg-3 control-label">New Password</label>
              <div class="col-lg-8">
                <input type="password" class="form-control" name="new_password">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Re Confirm Password</label>
              <div class="col-lg-8">
                <input type="password" class="form-control" name="confirm_password">
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Edit Password</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
      <h1 class="message" style="text-align:center"></h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>
@if (Session::has('message'))
<?php echo '<script> $("#message").modal("show"); 
$("#message h1.message").html("'.Session::get('message').'");
</script>';?>
@endif

<script type="text/javascript">
	$("button.btn.editPassword").click(function(){
		$("#editPassword").modal("show");
	});
</script>
@stop