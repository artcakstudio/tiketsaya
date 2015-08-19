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
{!! Html::style('assets/css/jquery.dataTables.min.css') !!}
  <!-- Stylesheets -->
{!! Html::style('assets/css/bootstrap.min.css') !!}  
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
  {!! Html::style('assets/css/bootstrap-datetimepicker.min.css')!!}
  <!-- CLEditor -->
  {!! Html::style('assets/css/jquery.cleditor.css')!!}
  <!-- Data tables -->
  {!! Html::style('assets/css/jquery.dataTables.css')!!}
  <!-- Bootstrap toggle -->
  {!! Html::style('assets/css/jquery.onoff.css')!!}
  <!-- Main stylesheet -->
  {!! Html::style('assets/css/style.css')!!}
  <!-- Widgets stylesheet -->
  {!! Html::style('assets/css/widgets.css')!!}
  <!-- datatables stylesheet -->
  
  <!-- JS -->
{!! HTML::script('assets/js/jquery-1.10.2.min.js')!!}
{!! HTML::script('assets/js/bootstrap.min.js')!!} <!-- Bootstrap -->
{!! HTML::script('assets/js/jquery-ui.js')!!} <!-- jQuery UI -->
{!! HTML::script('assets/js/fullcalendar.min.js')!!} <!-- Full Google Calendar - Calendar -->
{!! HTML::script('assets/js/jquery.rateit.min.js')!!} <!-- RateIt - Star rating -->
{!! HTML::script('assets/js/jquery.prettyPhoto.js')!!} <!-- prettyPhoto -->
{!! HTML::script('assets/js/jquery.slimscroll.min.js')!!} <!-- jQuery Slim Scroll -->
{!! HTML::script('assets/js/jquery.dataTables.min.js')!!} <!-- Data tables -->

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
{!! HTML::script('assets/js/bootstrap-datetimepicker.min.js')!!} <!-- Date picker -->
{!! HTML::script('assets/js/jquery.onoff.min.js')!!} <!-- Bootstrap Toggle -->
{!! HTML::script('assets/js/filter.js')!!} <!-- Filter for support page -->
{!! HTML::script('assets/js/custom.js')!!} <!-- Custom codes -->
{!! HTML::script('assets/js/charts.js')!!} <!-- Charts & Graphs -->

  
{!! HTML::script('assets/js/respond.min.js')!!}

  <!--[if lt IE 9]>
  {!! HTML::script('js/html5shiv.js')!!}
  <![endif]-->


  <!-- Favicon -->
  <link rel="shortcut icon" href="img/favicon/favicon.png">
</head>

<body>
<?php echo '<script>var token="'.csrf_token().'"</script>\r\n'?>
<div class="navbar navbar-fixed-top bs-docs-nav" role="banner">


@section('header')
<!-- Header starts -->	    
    <div class="page-head">
      <div class="row">
        <!-- Logo section -->
        <div class="col-md-4">
          <!-- Logo. -->
          <div class="logo">
            <h1><a href="#"><span class="bold">Admin</span></a></h1>
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
            </ul>
          </li>  
          <li class="has_sub">
			<a href="#"><i class="fa fa-file-o"></i>Rent Schedule<span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
            <ul>
              <li><a href="post.html">List Schedule</a></li>
              <li><a href="login.html">Login</a></li>
              <li><a href="register.html">Register</a></li>
              <li><a href="support.html">Support</a></li>
              <li><a href="invoice.html">Invoice</a></li>
              <li><a href="gallery.html">Gallery</a></li>
            </ul>
          </li> 
          <li class="has_sub">
			<a href="#"><i class="fa fa-file-o"></i>Travel Schedule<span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
            <ul>
              <li><a href="media.html">Media</a></li>
              <li><a href="statement.html">Statement</a></li>
              <li><a href="error.html">Error</a></li>
              <li><a href="error-log.html">Error Log</a></li>
              <li><a href="calendar.html">Calendar</a></li>
              <li><a href="grid.html">Grid</a></li>
            </ul>
          </li>    
		  <li class="has_sub"><a href="#"><i class="fa fa-table"></i> Tables  <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
            <ul>
              <li><a href="tables.html">Tables</a></li>
              <li><a href="dynamic-tables.html">Dynamic Tables</a></li>
            </ul>
          </li>		  
          <li><a href="charts.html"><i class="fa fa-bar-chart-o"></i> Charts</a></li> 
          <li><a href="forms.html"><i class="fa fa-tasks"></i> Forms</a></li>
          <li><a href="ui.html"><i class="fa fa-magic"></i> User Interface</a></li>
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
$(function () {

    /* Bar Chart starts */

    var d1 = [];
    for (var i = 0; i <= 20; i += 1)
        d1.push([i, parseInt(Math.random() * 30)]);

    var d2 = [];
    for (var i = 0; i <= 20; i += 1)
        d2.push([i, parseInt(Math.random() * 30)]);


    var stack = 0, bars = true, lines = false, steps = false;
    
    function plotWithOptions() {
        $.plot($("#bar-chart"), [ d1, d2 ], {
            series: {
                stack: stack,
                lines: { show: lines, fill: true, steps: steps },
                bars: { show: bars, barWidth: 0.8 }
            },
            grid: {
                borderWidth: 0, hoverable: true, color: "#777"
            },
            colors: ["#ff6c24", "#ff2424"],
            bars: {
                  show: true,
                  lineWidth: 0,
                  fill: true,
                  fillColor: { colors: [ { opacity: 0.9 }, { opacity: 0.8 } ] }
            }
        });
    }

    plotWithOptions();
    
    $(".stackControls input").click(function (e) {
        e.preventDefault();
        stack = $(this).val() == "With stacking" ? true : null;
        plotWithOptions();
    });
    $(".graphControls input").click(function (e) {
        e.preventDefault();
        bars = $(this).val().indexOf("Bars") != -1;
        lines = $(this).val().indexOf("Lines") != -1;
        steps = $(this).val().indexOf("steps") != -1;
        plotWithOptions();
    });

    /* Bar chart ends */

});


/* Curve chart starts */

$(function () {
    var sin = [], cos = [];
    for (var i = 0; i < 14; i += 0.5) {
        sin.push([i, Math.sin(i)]);
        cos.push([i, Math.cos(i)]);
    }

    var plot = $.plot($("#curve-chart"),
           [ { data: sin, label: "sin(x)"}, { data: cos, label: "cos(x)" } ], {
               series: {
                   lines: { show: true, fill: true},
                   points: { show: true }
               },
               grid: { hoverable: true, clickable: true, borderWidth:0 },
               yaxis: { min: -1.2, max: 1.2 },
               colors: ["#1eafed", "#1eafed"]
             });

    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 5,
            left: x + 5,
            border: '1px solid #000',
            padding: '2px 8px',
            color: '#ccc',
            'background-color': '#000',
            opacity: 0.9
        }).appendTo("body").fadeIn(200);
    }

    var previousPoint = null;
    $("#curve-chart").bind("plothover", function (event, pos, item) {
        $("#x").text(pos.x.toFixed(2));
        $("#y").text(pos.y.toFixed(2));

        if ($("#enableTooltip:checked").length > 0) {
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                    
                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);
                    
                    showTooltip(item.pageX, item.pageY, 
                                item.series.label + " of " + x + " = " + y);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;            
            }
        }
    }); 

    $("#curve-chart").bind("plotclick", function (event, pos, item) {
        if (item) {
            $("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
            plot.highlight(item.series, item.datapoint);
        }
    });

});

/* Curve chart ends */
</script>


</body>
</html>