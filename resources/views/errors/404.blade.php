<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Tell Me">
    <meta name="keyword" content="Tell Me, reating">
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">

    <title>Not Found</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-reset.css')}}" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/style-responsive.css')}}" rel="stylesheet" />

</head>

  <body class="body-404">
    <div class="container">
      <section class="error-wrapper">
          <i class="icon-404"></i>
          <h1>404</h1>
          <h2>page not found</h2>
          <p class="page-404">Something went wrong or that page doesn’t exist yet. <a href="{{url('/')}}">Return Home</a></p>
      </section>
    </div>
  </body>
</html>
