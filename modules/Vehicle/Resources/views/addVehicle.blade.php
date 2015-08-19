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
                     {!!Form::open(['route'=>'vehicle..store','METHOD'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data'] )!!}
				        <div class="form-group">
				          <label class="col-lg-2 control-label">Vehicle Name</label>
				          <div class="col-lg-5">
				            	<input type="text" name="VEHICLE_NAME" class="form-control">
				          </div>
				        </div>
				        <div class="form-group">
				          <label class="col-lg-2 control-label">Vehicle Capacity</label>
				          <div class="col-lg-5">
				            	<input type="text" name="VEHICLE_CAPACITY" class="form-control">
				          </div>
				        </div>

				        <div class="form-group">
				          <label class="col-lg-2 control-label">Vehicle Description</label>
				          <div class="col-lg-5">
				            	<textarea name="VEHICLE_DESCRIPTION" class="form-control form-group" style="margin-left:0px"></textarea>
				          </div>
				        </div>

				        <div class="form-group">
				          <label class="col-lg-2 control-label">Vehicle Photo</label>
				          <div class="col-lg-5">
				            	<input type="file" name="VEHICLE_PHOTO" class="form-control">
				          </div>
				        </div>

				         <div class="form-group">
				          <label class="col-lg-2 control-label">Vehicle Partner</label>
				          <div class="col-lg-5">
				            	<select name="PARTNER_ID" class="form-control">
				            	@foreach($partner as $row)
				            		<option value="{{$row['PARTNER_ID']}}">{{$row['PARTNER_NAME']}}</option>
				            	@endforeach
				            	</select>
				          </div>
				        </div>

				        <div class="form-group">
				          <label class="col-lg-2 control-label">City</label>
				          <div class="col-lg-5">
				            	<select name="CITY_ID" class="form-control">
				            	@foreach($city as $row)
				            		<option value="{{$row['CITY_ID']}}">{{$row['CITY_NAME']}}</option>
				            	@endforeach
				            	</select>
				          </div>
				        </div>

				        <div class="form-group">
				          <label class="col-lg-2 control-label">Type</label>
				          <div class="col-lg-5">
				            	<select name="VEHICLE_TYPE_ID" class="form-control">
				            	@foreach($type as $row)
				            		<option value="{{$row['VEHICLE_TYPE_ID']}}">{{$row['VEHICLE_TYPE_NAME']}}</option>
				            	@endforeach
				            	</select>
				          </div>
				        </div>

				        <div class="form-group">    
				        <label></label>
				        <div class="form-group">
				          <div class="col-lg-offset-2 col-lg-6">
				            <button type="submit"  class="btn btn-sm btn-primary">Add Vehicle</button>
          				   </div>
        				</div>
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
      <div class="widget-foot" id="lalaa">
      </div>
	@stop
