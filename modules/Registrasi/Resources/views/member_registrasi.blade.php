@extends('page_template')

@section('content')

<div class="container-fluid" style="margin-top:10%">
    <div class="row">
        <div class="col-md-12 left">
            <div class="panel panel-default">
                <div class="panel-heading">MEMBER Travel Registrasi</div>
                <div class="panel-body">
                    {!!Form::open(['route'=>'registrasi.member','method'=>'POST','class'=>'form-horizontal'])!!}
                        <div class="form-group">
                            <label class="col-lg-2">Name</label>
                              <div class="col-lg-6">
                                  <input type="text" name="MEMBER_NAME" class="form-control">
                              </div>
                        </div>
                          <div class="form-group">
                              <label class="col-lg-2">Email</label>
                              <div class="col-lg-6">
                                  <input type="text" name="MEMBER_EMAIL" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-2">Username</label>
                              <div class="col-lg-6">
                                  <input type="text" name="MEMBER_USERNAME" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-2">Password</label>
                              <div class="col-lg-6">
                                  <input type="password" name="MEMBER_PASSWORD" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-lg-8 right">
                                  <button class="btn btn-danger" style="float:right; margin-right:0px" >Cancel</button> 
                                  <button class="btn btn-primary" style="float:right;margin-right:10%;" type="submit">Register</button>
                                  
                              </div>
                          </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
