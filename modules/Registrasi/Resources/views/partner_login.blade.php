@extends('page_template')

@section('content')
@parent
<div class="container-fluid">
            <!-- HEADER CLOSE-->
                              <!-- SLIDER -->
            <div class="row">
                <div class="col-md-12" style="margin-bottom:11%"></div>
            </div>            
            <!-- SLIDER CLOSE -->
           
            <div class="row">
                <div class="col-md-8 content_ left">
                  {!!Form::open(['route'=>'register.login','method'=>'POST','class'=>'form-horizontal'])!!}
             
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
                          <button class="btn btn-primary" style="float:right;margin-right:10%;" type="submit">Login </button>
                          
                      </div>
                  </div>
            {!!Form::close()!!}
                </div>
            </div>   
            
   @stop