<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="description" content="Template Gull">
    <meta name="keywords" content="admin template, Gull admin template">
    <meta name="author" content="Oki">
    <title>{{ env('APP_NAME')}} - Login</title>

    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('app-assets/images/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('app-assets/images/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('app-assets/images/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('app-assets/images/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('app-assets/images/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('app-assets/images/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('app-assets/images/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('app-assets/images/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('app-assets/images/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('app-assets/images/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('app-assets/images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('app-assets/images/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('app-assets/images/favicon/favicon-16x16.png')}}">
    <link rel="icon" type="image/x-icon" href="{{asset('app-assets/images/favicon/favicon.ico')}}">

    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('app-assets/css/themes/lite-purple.min.css')}}" rel="stylesheet">

    <style>
        .auth-layout-wrap .auth-content {
            min-width: 400px;
        }
    </style> 
</head>
<body>
<div class="auth-layout-wrap" style="background-image: url('{{asset('app-assets/images/photo-wide-4.jpg')}}')">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-4">
                        <div class="auth-logo text-center mb-4"><img src={{asset('app-assets/images/logo.png')}} alt=""></div>
                        <h1 class="mb-3 text-18">Sign In</h1>
                        <form autocomplete="off" class="auth-login-form mt-2" id="form-login"
                        action="{{ route('login') }}" method="POST">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ old('username') }}" placeholder="username"
                                    aria-describedby="username" tabindex="1" autofocus />
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge form-password-toggle">
                                    <input type="password" class="form-control" id="password"
                                        name="password" tabindex="2"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="site_code">Store</label>
                                <select class="select2 w-100 form-control" id="site_code" name="site_code">
                                    <option label=""></option>
                                </select>
                            </div>
                            
                            @if($errors->any())
                            @foreach ($errors->all() as $error)
                            <h5>{{ $error }}</h5>
                            @endforeach
                            @endif

                            <button id="login" name="login" type="submit" value="Login"
                            class="btn btn-rounded btn-primary btn-block mt-2" tabindex="4">Sign in
                            </button>
                        </form>
                        <div class="mt-3 text-center"><a class="text-muted" href="forgot.html">
                            <u>Forgot Password?</u></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('app-assets/js/plugins/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('app-assets/js/plugins/forms/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
    
    $( document ).ready(function() {
      $("#username").focus();
      if ($("#username").val()){
        getCabang($("#username").val());
      }
    });

    $(function(){
      $('#form-login').validate();
    });

    function getCabang(value){
      $.ajax({
        url:"{{route('get.store')}}",
        method:"POST",
        data:{
          value:value
        },
        success:function(result){
          $('#site_code').html(result);
        }
      })
    }

    $("#username").keyup(function() {
      let value = $(this).val();
      getCabang(value);
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
</script>

</body>
</html>
