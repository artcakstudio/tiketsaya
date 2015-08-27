@extends('page_template')

@section('content')

<div class="container-fluid" style="margin-top:10%">
    <div class="row">
        <div class="col-md-12 left">
            <div class="panel panel-default">
                <div class="panel-heading">Partner Travel Registrasi</div>
                <div class="panel-body">
                    {!!Form::open(['route'=>'register.partner','method'=>'POST','class'=>'form-horizontal'])!!}
                        <div class="form-group">
                            <label class="col-lg-2">Name</label>
                              <div class="col-lg-6">
                                  <input type="text" name="PARTNER_NAME" class="form-control">
                              </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2">Partner Type</label>
                              <div class="col-lg-6">
                                  <select class="form-group form-control" style="margin-left:0px">
                                    @foreach($partner_type as $row)
                                      <option value="{{$row['PARTNER_TYPE_ID']}}">{{$row['PARTNER_TYPE_NAME']}}</option>
                                      @endforeach
                                  </select>
                              </div>
                        </div>
                        <div class="form-group">
                              <label class="col-lg-2">Address</label>
                              <div class="col-lg-6">
                                  <input type="text" name="PARTNER_ADDRESS" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-2">Telp Name</label>
                              <div class="col-lg-6">
                                  <input type="text" name="PARTNER_TELP" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-2">Description</label>
                              <div class="col-lg-6">
                                  <textarea class="form-control form-group" style="margin-left:0px;" name="PARTNER_DESCRIPTION"></textarea>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-2">Photo</label>
                              <div class="col-lg-6">
                                  <input type="file" name="PARTNER_PHOTO" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-2">Username</label>
                              <div class="col-lg-6">
                                  <input type="text" name="PARTNER_USERNAME" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-2">Password</label>
                              <div class="col-lg-6">
                                  <input type="password" name="PARTNER_PASSWORD" class="form-control">
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
