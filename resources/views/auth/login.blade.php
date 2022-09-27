<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7 no-js" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 no-js" lang="en-US">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html class="no-js" lang="en">

<!-- landing14:04-->

<head>
    <!-- Basic need -->
    <title>Films::Login</title>
    <meta charset="UTF-8">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta content="" name="author">
    <link href="#" rel="profile">

    <!--Google Font-->
    <link href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' rel="stylesheet" />
    <!-- Mobile specific meta -->
    <meta content="width=device-width, initial-scale=1" name=viewport>
    <meta content="telephone-no" name="format-detection">

    <!-- CSS files -->
    <link href="{{ asset('web_files/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('web_files/css/style.css') }}" rel="stylesheet">

</head>

<body>
    <!--preloading-->
    <div id="preloader">
        <img alt="" class="logo" height="58" src="{{ asset('web_files/images/logo1.png') }}"
            width="119">
        <div id="status">
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="landing-hero" style="padding-top: 50px">

        <div style="margin-bottom: 50px">
            <img alt="Logo" src="{{ asset('web_files/images/logo1.png') }}">
        </div>
        <div class="container">
            <div class="login-content">
                <h3>{{ __('default.login')}}</h3>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="row">
                        <label for="email ">
                            {{ __('default.Email')}}:
                            <input id="email" name="email" placeholder="Email" required="required" type="email"
                                value="{{ old('email', '') }}" />
                            @error('email')
                                <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </label>
                    </div>
                    <div class="row">
                        <label for="password">
                            {{ __('default.Password')}}:
                            <input id="password" name="password" placeholder="Password" required="required"
                                type="password" />
                            @error('password')
                                <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </label>
                    </div>
                    <div class="row">
                        <div class="remember">
                            <div>
                                <input name="remember" type="checkbox" value="Remember me"
                                    {{ old('remember') ? 'checked' : '' }}><span>{{ __('default.Remember me')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit">{{ __('default.login')}}</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- end of footer v3 section-->

    <script src="{{ asset('web_files/js/jquery.js') }}"></script>
    <script src="{{ asset('web_files/js/plugins.js') }}"></script>
    <script src="{{ asset('web_files/js/plugins2.js') }}"></script>
    <script src="{{ asset('web_files/js/custom.js') }}"></script>
</body>

<!-- landing14:38-->

</html>
