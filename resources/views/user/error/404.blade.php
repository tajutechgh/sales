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
<link href="{{ asset('admin/css/colors/default.css') }}" id="theme"  rel="stylesheet">

</head>
<body>
<!-- Preloader -->

<section id="wrapper" class="error-page"> 
  <div class="error-box">
    <div class="error-body text-center">
      <h1 class="text-danger">404</h1>
      <h3 class="text-uppercase">Page Not Found !</h3>
      <p class="text-muted m-t-30 m-b-30">YOU SEEM TO BE TRYING TO FIND YOUR WAY HOME</p>
      <a href="{{ route('home') }}" class="btn btn-danger btn-rounded waves-effect waves-light m-b-40">Back to home</a> 
    </div>
  </div>
</section>
<!-- jQuery -->
<script src="{{ asset('admin/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('admin/bootstrap/dist/js/bootstrap.min.js') }}"></script>


</body>

</html>
