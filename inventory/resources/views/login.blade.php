<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
	  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	  	<title>Login (Test CJFI - Kuswandi)</title>

	  	<!-- General CSS Files -->
	  	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	  	<link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">

	  	<!-- Template CSS -->
	  	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	  	<link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
	</head>

	<body>
  		<div id="app">
    		<section class="section">
      			<div class="container mt-5">
        			<div class="row">
          				<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            				<div class="login-brand">
              					<img src="{{ asset('assets/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
            				</div>
							
							<p class="text-center">Peserta Test : <strong>Kuswandi</strong></strong></p>
        				    <p class="text-center">
        				        Username : admin<br>
        				        Password : admin
        				    </p>

            				<div class="card card-primary">
              					<div class="card-header"><h4>Login</h4></div>

              					<div class="card-body">
              						@if($errors->has('error'))
              						    <div class="alert alert-danger">
                                            {{ $errors->first('error') }}
                    				    </div>
                                    @endif
                					<form method="POST" action="{{ url('login') }}" class="needs-validation" novalidate="">
                						@csrf
                  						<div class="form-group">
                    						<label for="name">Username</label>
                    						<input id="name" type="text" class="form-control" name="name" tabindex="1" required autofocus>
                    						@if($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                  						</div>

                  						<div class="form-group">
                    						<label for="password">Password</label>
                    						<input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    						@if($errors->has('password'))
                                                <p class="text-danger">{{ $errors->first('password') }}</p>
                                            @endif
                  						</div>

                  						<div class="form-group">
                    						<div class="custom-control custom-checkbox">
                      							<input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      							<label class="custom-control-label" for="remember-me">Remember Me</label>
                    						</div>
                  						</div>

                  						<div class="form-group">
                    						<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                     							Login
                    						</button>
                  						</div>
                					</form>
              					</div>
            				</div>

            				<div class="simple-footer">
              					Template Copyright &copy; Stisla 2018
            				</div>
          				</div>
        			</div>
      			</div>
    		</section>
  		</div>

	  	<!-- General JS Scripts -->
	  	<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
	  	<script src="{{ asset('assets/js/popper.min.js') }}"></script>
	  	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	  	<script src="{{ asset('assets/js/jquery.nicescroll.min.js') }}"></script>
	  	<script src="{{ asset('assets/js/moment.min.js') }}"></script>
	  	<script src="{{ asset('assets/js/stisla.js') }}"></script>

  		<!-- Template JS File -->
  		<script src="{{ asset('assets/js/scripts.js') }}"></script>
  		<script src="{{ asset('assets/js/custom.js') }}"></script>
	</body>
</html>
