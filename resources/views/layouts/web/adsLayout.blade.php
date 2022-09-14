<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7 no-js" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 no-js" lang="en-US">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html class="no-js" lang="en">
<head>
    <!-- Basic need -->
    <title>Films</title>
    <meta charset="UTF-8">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta content="" name="author">
    <link href="#" rel="profile">

    @stack('style')

    <!--Google Font-->
    <link href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' rel="stylesheet"/>
    <!-- Mobile specific meta -->
    <meta content="width=device-width, initial-scale=1" name=viewport>
    <meta content="telephone-no" name="format-detection">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- CSS files -->
    <link href="{{asset('web_files/css/plugins.css')}}" rel="stylesheet">
    <link href="{{asset('web_files/css/style.css')}}" rel="stylesheet">

    <!-- AD sense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2554459562280158" crossorigin="anonymous"></script>

</head>
<body>
<!--preloading-->
<div id="preloader">
    <img alt="" class="logo" height="58" src="{{asset('web_files/images/logo1.png')}}" width="119">
    <div id="status">
        <span></span>
        <span></span>
    </div>
</div>

<!-- BEGIN | Header -->
<header class="ht-header">

</header>
<!-- END | Header -->

@yield('content')

<!-- footer section-->

<!-- end of footer section-->

<script src="{{asset('web_files/js/jquery.js')}}"></script>
<script src="{{asset('web_files/js/plugins.js')}}"></script>
<script src="{{asset('web_files/js/plugins2.js')}}"></script>
<script src="{{asset('web_files/js/custom.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.a_movie').click(function(){
var a= $(this);
            if(a.attr('c-on')=='0'){                
                a.attr('c-on',"1");
                window.open('ads', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
            }else{
                window.location.href=a.attr('a-href');
            }

        });
    });
// style=" border-radius:8px; background-color: #4CAF50; border: none;color: white; padding: 15px 50px; text-align: center;  text-decoration: none;  display: inline-block;  font-size: 16px;"   

    var timeleft = 10;
var downloadTimer = setInterval(function(){
  if(timeleft <= 0){
    clearInterval(downloadTimer);
    document.getElementById("countdown").innerHTML = ' <input id="ShowButton" type="button" runat="server"  value="Play" onclick="GetFilmId()"/>';
  } else {
    document.getElementById("countdown").innerHTML = timeleft + " seconds remaining";
  }
  timeleft -= 1;
}, 1000);

</script>
<script src="{{asset('dashboard_files/assets/plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>
@if(session('success'))
    <script type="text/javascript">
        $(document).ready(function () {
            var allowDismiss = true;

            $.notify({
                    message: "{{ session('success') }}"
                },
                {
                    type: "alert-success",
                    allow_dismiss: allowDismiss,
                    newest_on_top: true,
                    timer: 1000,
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    animate: {
                        enter: "animated fadeIn",
                        exit: "animated fadeOut"
                    },
                    template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
                        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                        '<span data-notify="icon"></span> ' +
                        '<span data-notify="title">{1}</span> ' +
                        '<span data-notify="message">{2}</span>' +
                        '<div class="progress" data-notify="progressbar">' +
                        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                        '</div>' +
                        '<a href="{3}" target="{4}" data-notify="url"></a>' +
                        '</div>'
                });
        });
    </script>
@endif

@stack('script')

</body>


</html>
