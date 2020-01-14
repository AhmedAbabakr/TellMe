<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Tell Me">
    <meta name="keyword" content="Tell Me, rating">
    <link rel="shortcut icon" href="{{asset('img/faviconx.png')}}">

    <title>Tell Me -  Control Panel</title>

    <!-- Bootstrap core CSS -->
   <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-reset.css')}}" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/style-responsive.css')}}" rel="stylesheet" />
</head>

  <body class="login-body">

    <div class="container">
   {{-- @if($errors->count() !== 0)
                {{dd($errors)}}
                @endif--}}
      <form class="form-signin" method="POST" action="{{url('/')}}" id="commentForm">
          @csrf()
          @method('post')
        <h2 class="form-signin-heading">sign in now</h2>
        <div class="login-wrap">
        
             <input id="email" type="text" class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}" name="login" value="{{ old('login') }}" placeholder="{{ __('Username') . ' Or '.  __('Email') }}" required autofocus>
             @if ($errors->has('login') || $errors->has('admin_email') || $errors->has('admin_username')  )
                <span  role="alert" style="padding-bottom: 1%">
                    <strong >{{ $errors->first('login') }}{{$errors->first('admin_email') }}{{$errors->first('admin_username')}}</strong>
                </span>
              @endif
                              
             <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" name="password" required>
             @if ($errors->has('password'))
                <span >
                    <strong >{{ $errors->first('password') }}</strong>
                </span>
              @endif
            <label class="checkbox">
                
                <input  type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
      
          
           

        </div>

        

      </form>

    </div>



    <!-- js placed at the end of the document so the pages load faster -->
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
  <footer class="site-footer" style="position: absolute;bottom: 0;width: 100%;">
          <div class="text-center">
              {{date('Y')}} &copy;<a href="hashcode.me" style="color: #fff">Hash Code</a>.
              
          </div>
      </footer>
</html>
