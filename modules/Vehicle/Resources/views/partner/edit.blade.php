
<?php print_r($partner);?>
@extends('template')
@section('content')
	@parent
<div class="matter" id="formAddUser">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="widget wgreen">	
                <div class="widget-content">
                  <div class="padd">
                    <br />
                    <!-- Form starts.  -->
                     {!!Form::open(['route'=>'vehicle.partner.update', 'METHOD'=>'POST','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'] )!!}
                     <input type="hidden" value="{{$id}}" name="PARTNER_ID">
				        <div class="form-group">
				          <label class="col-lg-2 control-label">Partner Name</label>
				          <div class="col-lg-5">
				            	<input type="text" name="PARTNER_NAME" class="form-control" value="{{$partner['PARTNER_NAME']}}">
				          </div>
				        </div>
				        <div class="form-group">
				          <label class="col-lg-2 control-label">Partner Address</label>
				          <div class="col-lg-5">
				            	<input type="text" name="PARTNER_ADDRESS" class="form-control" value="{{$partner['PARTNER_ADDRESS']}}">
				          </div>
				        </div>
				        <div class="form-group">
				          <label class="col-lg-2 control-label">Partner Telp</label>
				          <div class="col-lg-5">
				            	<input type="text" name="PARTNER_TELP" class="form-control" value="{{$partner['PARTNER_TELP']}}">
				          </div>
				        </div>
				        <div class="form-group">
				          <label class="col-lg-2 control-label">Partner Description</label>
				          <div class="col-lg-5">
				            	<textarea name="PARTNER_DESCRIPTION" class="form-control form-group" style="margin-left:0px">{{$partner['PARTNER_DESCRIPTION']}}</textarea>
				          </div>
				        </div>

				        <div class="form-group">
				          <label class="col-lg-2 control-label">Partner Photo</label>
				          <div class="col-lg-5">
				            	<input type="file" name="PARTNER_PHOTO" class="form-control" value="{{$partner['PARTNER_PHOTO']}}">
				          </div>
				        </div>
				        <div class="form-group">
				          <label class="col-lg-2 control-label">Partner Username</label>
				          <div class="col-lg-5">
				            	<input type="text" name="PARTNER_USERNAME" class="form-control" value="{{$partner['PARTNER_USERNAME']}}">
				          </div>
				        </div>

				        <div class="form-group">
				          <label class="col-lg-2 control-label">Partner Email</label>
				          <div class="col-lg-5">
				            	<input type="email" name="PARTNER_EMAIL" class="form-control" value="{{$partner['PARTNER_EMAIL']}}">
				          </div>
				        </div>
				        <div class="form-group">
				          <label class="col-lg-2 control-label">Partner Password</label>
				          <div class="col-lg-5">
				            	<input type="password" name="PARTNER_PHOTO" class="form-control" value="">
				          </div>
				        </div>

				        <div class="form-group">    
				        <label></label>
				        <div class="form-group">
				          <div class="col-lg-offset-2 col-lg-6">
				            <button type="submit"  class="btn btn-sm btn-primary">Edit Partner</button>
          				   </div>
        				</div>
      				{!!Form::close()!!}
      				{!!Form::close()!!}
                  </div>
                </div>
                  <div class="widget-foot">
                    <!-- Footer goes here -->
                  </div>
              </div>  

            </div>

          </div>

        </div>
		  </div>


    
      </div>
      </div>      
      <div class="widget-foot">
      </div>
	@stop
