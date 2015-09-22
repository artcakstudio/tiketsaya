<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta name="csrf-token" content="" />
  <!-- Title and other stuffs -->
  <title>Dashboard - MacAdmin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">



{!! Html::style('assets/css/jquery.dataTables.min.css')!!}
{!! Html::style('assets/css/jquery.dataTables.css')!!}
  <!-- Font awesome icon -->
  {!! Html::style('assets/css/font-awesome.min.css')!!}
  <!-- jQuery UI -->
  {!! Html::style('assets/css/jquery-ui.css')!!}
  <!-- Calendar -->
  {!! Html::style('assets/css/fullcalendar.css')!!}
  <!-- prettyPhoto -->
  {!! Html::style('assets/css/prettyPhoto.css')!!} 
  <!-- Star rating -->
  {!! Html::style('assets/css/rateit.css')!!}
  <!-- Date picker -->
  <!-- {!! Html::style('assets/css/bootstrap-datetimepicker.min.css')!!} -->
  <!-- CLEditor -->
  {!! Html::style('assets/css/jquery.cleditor.css')!!}
  <!-- Data tables -->
  
  <!-- Bootstrap toggle -->
  {!! Html::style('assets/css/jquery.onoff.css')!!}
  <!-- Main stylesheet -->
  {!! Html::style('assets/css/style.css')!!}
  <!-- Widgets stylesheet -->
  {!! Html::style('assets/css/widgets.css')!!}
  <!-- datatables stylesheet -->
  <!-- Stylesheets -->
{!! Html::style('assets/css/bootstrap.min.css') !!}  
  
  
{!! Html::script('assets/js/jquery.min.js')!!}
{!! HTML::script('assets/js/jquery.dataTables.min.js')!!} <!-- Data tables -->
  <!-- JS -->
{!! HTML::script('assets/js/fullcalendar.min.js')!!} <!-- Full Google Calendar - Calendar -->
{!! HTML::script('assets/js/jquery.rateit.min.js')!!} <!-- RateIt - Star rating -->
{!! HTML::script('assets/js/jquery.prettyPhoto.js')!!} <!-- prettyPhoto -->
{!! HTML::script('assets/js/jquery.slimscroll.min.js')!!} <!-- jQuery Slim Scroll -->

<!-- jQuery Flot -->
{!! HTML::script('assets/js/excanvas.min.js')!!}
{!! HTML::script('assets/js/jquery.flot.js')!!}
{!! HTML::script('assets/js/jquery.flot.resize.js')!!}
{!! HTML::script('assets/js/jquery.flot.pie.js')!!}
{!! HTML::script('assets/js/jquery.flot.stack.js')!!}

<!-- jQuery Notification - Noty -->
{!! HTML::script('assets/js/jquery.noty.js')!!} <!-- jQuery Notify -->
{!! HTML::script('assets/js/themes/default.js')!!} <!-- jQuery Notify -->
{!! HTML::script('assets/js/layouts/bottom.js')!!} <!-- jQuery Notify -->
{!! HTML::script('assets/js/layouts/topRight.js')!!} <!-- jQuery Notify -->
{!! HTML::script('assets/js/layouts/top.js')!!} <!-- jQuery Notify -->
<!-- jQuery Notification ends -->

{!! HTML::script('assets/js/sparklines.js')!!} <!-- Sparklines -->
{!! HTML::script('assets/js/jquery.cleditor.min.js')!!} <!-- CLEditor -->
<!-- {!! HTML::script('assets/js/bootstrap-datetimepicker.min.js')!!}  --><!-- Date picker -->
{!! HTML::script('assets/js/jquery.onoff.min.js')!!} <!-- Bootstrap Toggle -->
{!! HTML::script('assets/js/filter.js')!!} <!-- Filter for support page -->
<!-- {!! HTML::script('assets/js/custom.js')!!} --> <!-- Custom codes -->
{!! HTML::script('assets/js/charts.js')!!} <!-- Charts & Graphs -->

  
{!! HTML::script('assets/js/respond.min.js')!!}
{!! HTML::script('assets/js/bootstrap.min.js')!!} <!-- Bootstrap -->
{!! HTML::script('assets/js/jquery-ui.js')!!} <!-- jQuery UI -->
{!!HTML::script('assets/js/custom.js')!!}
  <!-- Favicon -->
  <link rel="shortcut icon" href="img/favicon/favicon.png">
</head>

<body>
<?php echo '<script>var token="'.csrf_token().'"</script>\r\n'?>
<div class="navbar navbar-fixed-top bs-docs-nav" role="banner" style="overflow-x:hidden; position:absolute">


@section('header')
<!-- Header starts -->	    
    <div class="page-head">
      <div class="row">
        <!-- Logo section -->
        <div class="col-md-4">
          <!-- Logo. -->
          <div class="logo">
            <h1><a href="#"><span class="bold">{{Session::get('name')}}</span></a></h1>
          </div>
          <!-- Logo ends -->
        </div>
        <ul class="nav navbar-nav pull-right">
          <li class="dropdown pull-right">            
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <i class="fa fa-user"></i> Admin <b class="caret"></b>              
            </a>
            <!-- Dropdown menu -->
            <ul class="dropdown-menu">
              <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
              <li><a href="#"><i class="fa fa-cogs"></i> Settings</a></li>
              <li><a href="login.html"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  

<!-- Header ends -->

<!-- Main content starts -->

<div class="content">

  	<!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-dropdown"><a href="#">Navigation</a></div>

        <!--- Sidebar navigation -->
        <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
        <ul id="nav">
          <!-- Main menu with font awesome icon -->
          <li class="has_sub">
            <a href="#"><i class="fa fa-list-alt"></i> User Management  <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
            <ul>
              <li>{!!Html::link('/usermanagement', 'User')!!}</li>
              <li>{!!Html::link('usermanagement/roles','Roles')!!}</li>
              <li><a href="widgets3.html">Tambah Hak Akses User</a></li>
            </ul>
          </li> 

          <li class="has_sub">
			      <a href="#"><i class="fa fa-list-alt"></i> Vehicle<span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
            <ul>
              <li>{!!Html::link('/vehicle', 'Vehicle')!!}</li>
              <li>{!!Html::link('/vehicle/city', 'City')!!}</li>
              <li>{!!Html::link('/vehicle/partner', 'Partner')!!}</li>
            </ul>
          </li>  
          <li class="has_sub">
			<a href="#"><i class="fa fa-file-o"></i>Travel<span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
            <ul>
              <li><a href="{!!url('travel')!!}">List Schedule</a></li>
              <li><a href="{!!url('travel/route')!!}">Route</a></li>
              <li><a href="{!!url('travel/transaction')!!}">Transaction</a></li>
            </ul>
          </li> 
          <li class="has_sub">
	       		<a href="#"><i class="fa fa-file-o"></i>Rent Schedule<span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
            <ul>
              <li><a href="{!!url('rent')!!}">List Schedule</a></li>
              <li><a href="{!!url('rent/transaction')!!}">Transaction</a></li>
            </ul>
          </li>
          <li class="has_sub">
            <a href="#"><i class="fa fa-file-o"></i>Link Footer<span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
            <ul>
              <li><a href="{!!url('linkfooter/travel')!!}">Travel</a></li>
              <li><a href="{!!url('linkfooter/rent')!!}">Sewa Mobil</a></li>
            </ul>
          </li>   
          <li><a href="{{url('auth/logout')}}"><i class="fa fa-magic"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Sidebar ends -->

  	  	<!-- Main bar -->
  	<div class="mainbar">
      
	    <!-- Page heading -->
	    
	    <div class="container">
	    	@yield('content')
	    </div>
	</div>
<!-- Footer starts -->
@section('footer')
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
            <!-- Copyright info -->
            <p class="copy">Copyright &copy; 2012 | <a href="#">Your Site</a> </p>
      </div>
    </div>
  </div>
</footer> 	
@show
<!-- Footer ends -->

<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 



<!-- Script for this page -->
<script type="text/javascript">
    $(".datepicker").datepicker({changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy", 
        minDate: 0
    });
/* Curve chart ends */
</script>


</body>
</html>
