<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>Login - Administrator</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">

  <!-- Stylesheets -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link href="assets/css/style.css" rel="stylesheet">
  
  <script src="assets/js/respond.min.js"></script>
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Favicon -->
  <link rel="shortcut icon" href="assets/img/favicon/favicon.png">
</head>

<body>

<!-- Form area -->
<div class="admin-form">
  <div class="container">

    <div class="row">
      <div class="col-lg-12">
        <!-- Widget starts -->
            <div class="widget worange">
              <!-- Widget head -->
              <div class="widget-head">
                <i class="fa fa-lock"></i> Login 
              </div>

              <div class="widget-content">
                <div class="padd">
                  <!-- Login form -->
                  {!!Form::open(['url'=>'auth/login', 'method'=>'post','class'=>'form-horizontal'])!!}
                    <!-- Email -->
                    <div class="form-group">
                      <label class="control-label col-lg-3">username</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control"  placeholder="Username" name="username">
                      </div>
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                      <label class="control-label col-lg-3" for="inputPassword">Password</label>
                      <div class="col-lg-9">
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
                      </div>
                    </div>
                    <!-- Remember me checkbox and sign in button -->
                    <div class="form-group">
					<div class="col-lg-9 col-lg-offset-3">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" style="position: absolute;margin-top: -7px;"> Remember me
                        </label>
						</div>
					</div>
					</div>
                        <div class="col-lg-9 col-lg-offset-3">
							<button type="submit" class="btn btn-info btn-sm">Sign in</button>
							<button type="reset" class="btn btn-default btn-sm">Reset</button>
						</div>
                    <br />
                  {!!Form::close()!!}
				  
				</div>

                </div>
              
                <div class="widget-foot" style="margin-top:inherit">
                  Not Registred? <a href="#">Register here</a>
                </div>
            </div>  
      </div>
    </div>
            @if (Session::has('error'))
   <div class="alert alert-info">{{ Session::get('error') }}</div>
        @endif
  </div> 
</div>
	
		

<!-- JS -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>