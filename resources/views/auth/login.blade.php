<!DOCTYPE html>  
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
<title>Sales Management System</title>
<!-- Bootstrap Core CSS -->
<link href="{{ asset('admin/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- animation CSS -->
<link href="{{ asset('admin/css/animate.css') }}" rel="stylesheet">
<!-- Custom CSS -->
<link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
<!-- color CSS -->
<link href="{{ asset('admin/css/colors/blue.css') }}" id="theme"  rel="stylesheet">
</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div><br><br><br><br><br>
<section id="wrapper" class="login-register">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="white-box">
          @include('include.message')
            <form class="form-horizontal form-material" id="loginform" action="{{ route('login') }}" method="post">
                {{csrf_field()}}
                <a href="javascript:void(0)" class="text-center db"><img src="{{ asset('admin/plugins/images/admin-logo-dark.png') }}" 
                  alt="Home" /><br/>
                    <img src="{{ asset('admin/plugins/images/admin-text-dark.png') }}" alt="Home" /></a>  
                
                <div class="form-group m-t-40{{ $errors->has('name') ? ' has-error' : '' }}">
                  <div class="col-xs-12">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus 
                    placeholder="Username">
                  </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <div class="col-xs-12">
                    <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
                  </div>
                </div>
                <div class="form-group text-center m-t-20">
                  <div class="col-xs-12">
                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                  </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</section>
<!-- jQuery -->
<script src="{{ asset('admin/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('admin/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{ asset('admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>

<!--slimscroll JavaScript -->
<script src="{{ asset('admin/js/jquery.slimscroll.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('admin/js/waves.js') }}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ asset('admin/js/custom.min.js') }}"></script>
<!--Style Switcher -->
<script src="{{ asset('admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>
</body>

</html>