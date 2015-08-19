@extends('template')
@section('content')
<div class="matter" id="formAddUser">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="widget wgreen">	
                <div class="widget-content">
                  <div class="padd">
                    <br />
                    <!-- Form starts.  -->
                     {!!Form::open(['route'=>'usermanagement..store', 'METHOD'=>'POST','class'=>'form-horizontal'] )!!}
				        <div class="form-group">
				          <label class="col-lg-2 control-label">Nama User</label>
				          <div class="col-lg-5">
				            <input type="text" class="form-control" placeholder="Nama User" name="USERS_NAME">
				          </div>
				        </div>
				        <div class="form-group">
				          <label class="col-lg-2 control-label">Username</label>
				          <div class="col-lg-5">
				            <input type="text" class="form-control" placeholder="Username" name="USERS_USERNAME">
				          </div>
				        </div>
				        <div class="form-group">
				          <label class="col-lg-2 control-label">Password</label>
				          <div class="col-lg-5">
				            <input type="password" class="form-control" placeholder="Password" name="USERS_PASSWORD">
				          </div>
				        </div>
				        
				        <div class="form-group">
				          <label class="col-lg-2 control-label">Email</label>
				          <div class="col-lg-5">
				            <input class="form-control" placeholder="email" name="USERS_EMAIL" type="email">
				          </div>
				        </div>    
				        <div class="form-group">
				          <div class="col-lg-offset-2 col-lg-6">
				            <button type="submit"  class="btn btn-sm btn-primary">Add User</button>
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


<!--     
      </div>
      </div>    -->   
      <div class="widget-foot" id="lalaa">
      </div>
	@stop
	@parent
