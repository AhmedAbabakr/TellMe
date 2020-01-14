<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Tell Me">
    <meta name="keyword" content="Tell Me, rating">
    <link rel="shortcut icon" href="{{asset('img/faviconx.png')}}">

    <title>Tell Me </title>

    <!-- Bootstrap core CSS -->
   <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-reset.css')}}" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/style-responsive.css')}}" rel="stylesheet" />
</head>

<body class="cs-bg">
    <!-- START HEADER -->
    <section id="header">
        <div class="container">
            <header class="col-xl-6 col-lg-6 col-md-6 col-sm-10 mx-auto text-center form p-4">
                <img  class="logo floatless " src="{{asset('img/Logo.png')}}" alt="">
                <h2 class="mt-3"> Thank You...</h2>
                <br/>
                <p> Thank You For Your Review . </p>
            </header>
          
        </div>
    </section>
    <!-- END HEADER -->
 <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
     <script type="text/javascript" src="{!!asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/common-scripts.js')}}"></script>
    <script type="text/javascript" charset="utf-8">
       $(document).ready(function() {
              $("#commentForm").validate();
          } );
    </script>

  </body>
  <footer class="site-footer"  style="position: absolute;bottom: 0;width: 100%;" >
          <div class="text-center">
              {{date('Y')}} &copy;<a href="hashcode.me" style="color: #fff">Hash Code</a>.
              
          </div>
      </footer>
</html>
