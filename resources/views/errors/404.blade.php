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
               <h1 style="text-align:center">Page Not Found</h1>
               <a href="<?php echo url('/')?>"><h1 style="text-align:center">Back To Home</h1></a>
            </div>   
            
   @stop