@extends('layouts.web.app')
@section('content')
    @push('style')
        <style rel="stylesheet">
            li.active {
                color: yellow;
            }

            .page-item.active {
                margin-left: 0px !important;
            }
            .parent {
      display: flex;
      margin-bottom: 30px;
      padding: 20px 0;
    }
    
    .evenly {
      justify-content: space-evenly;
    }
    
    .between {
      justify-content: center;
    }
    
    .around {
      justify-content: space-around;
    }
        </style>
    @endpush

    <div id="divpa" style="display:none; position:fixed; background-color:#dd003f; top:0; left:0; width:100%; height:100%; z-index:500; ">     
        <div class="container" style="padding-top: 13%;">
    
    
            <div class="parent evenly">
             <img src="{{asset('/images/ads1.png')}}" alt="" style="width: 900px;">
             </div>
         
         <div class="parent between text-center">
             <div id="countdown" class="text-center"></div>
         </div>
         
         <div class="parent around">
             <img src="{{asset('/images/ads1.png')}}" alt="" style="width: 900px;">
         </div>
    
    </div>
    </div>
    <div class="hero mv-single-hero" style="background: url('{{$episode->background_cover}}');  no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
        </div>
    </div>
    <!-- movie single section-->
    <div class="page-single movie-single movie_single">
        <div class="container">
            <div class="row ipad-width2">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="movie-img">
                        <img alt="" src="{{ $episode->poster }}" style="height: 350px">
                    </div>
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="movie-single-ct main-content">
                        <h1 class="bd-hd">{{$episode->name}} <span>{{$episode->year}}</span></h1>
                      
                        <div class="movie-rate">
                           
                        </div>
                        <div class="movie-tabs">
                            <div class="tabs">
                                <ul class="tab-links tabs-mv" style="margin-top: 30px">
                                    <li class="active"><a href="#overview">Play</a></li>
                                    <li><a href="#reviews"> Reviews</a></li>
                                    <li><a href="#actor"> Actor </a></li>
                                </ul>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="tab-content">
                                    <div class="tab active" id="overview">
                                        <div class="row">
                                        
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                            
                                                <hr style="background-color: #405266">
                                                <br>
                                                
                                                @foreach($episode->servers as $server)
                                                
                                                <button type="submit" class="btn" id="embd_url_" onclick="set_url1({{ $server->id }})">{{$server->name}}</button>
                                                @endforeach
                                                
                                                <div id='display'>
                                                    @foreach($servers as $s)
                                                    {{-- @dd($s) --}}
                                                      @if($loop->first)
                                                      <div id="url" style="display: block">
                                                        {!! $s->embed_url !!}
                                                    </div>
                                                      @endif
                                                    <div class="embd_url_{{ $s->server_id }}" id="url" style="display: none">
                                                        {!! $s->embed_url !!}
                                                    </div>
                                                    @endforeach
                                                </div>
                                                
                                            </div>

                                        </div>
                                    </div>
                                    <script>
                                        function set_url1(id) {
                                            // $('#url').css('display','none');
                                            $('*#url').each(function() {
                                                console.log('x');
                                                $(this).css('display','none');
                                            });
                                            $('.embd_url_'+id).css('display','block');           
                                        }                                
                                    </script>
                                    <div class="tab review" id="reviews">
                                        <div class="row">
                                            <div class="rv-hd">
                                                <div class="div">
                                                    <h3>Related Movies To</h3>
                                                    <h2>{{$episode->name}}</h2>
                                                </div>
                                                <a class="redbtn write_review" href="#write_review"
                                                   style="margin-right: 20px">Write
                                                    Review</a>
                                            </div>
                                        </div>                                        
                                        <div class="blog-detail-ct" id="write_review">
                                            <div class="comment-form" style="padding-top: 75px!important;">
                                                <h4>Write a review</h4>
                                                <form action="{{url('user/review/' . $episode->id)}}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input name="title" placeholder="Title" type="text" required
                                                                   max="15">
                                                        </div>
                                                        @error('title')
                                                        <span class="invalid-feedback"
                                                              style="color: red; font-size: 12px" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <textarea id="" name="review" placeholder="Review"
                                                                  style="resize: none" required max="150"></textarea>
                                                            @error('review')
                                                            <span class="invalid-feedback"
                                                                  style="color: red; font-size: 12px" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                         </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <button class="submit" type="submit"> Write</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab" id="actor">
                                        <div class="row">
                                            <div class="title-hd-sm">
                                                <h4>Actor</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{asset('dashboard_files/assets/plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                // alert($('.user_rate').val() !== "");
                var allowDismiss = true;
                var user = "{{auth()->user()}}";
                $('body').on('click', '.add_to_favorite', function (e) {
                    if (user !== "") {
                        $.ajax({
                            url: "{{ URL('user/addToFavorite/' . $episode->id) }}",
                            type: "POST",
                            data: {
                                "_token": "{{csrf_token()}}",
                            },
                            success: function (response) {
                                if (response) {
                                    $.notify({
                                            message: "This episode Added To Your Favorite."
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

                                    $(".favorite_div").html(`
                                            <a class="parent-btn remove_from_favorite" data-value="{{$episode->id}}" href="javascript:void(0);">
                                                <i class="ion-ios-heart"></i>Remove From Favorite
                                            </a>
                                    `);
                                }
                            },
                            error: function (response) {
                                $.notify({
                                        message: "Error, Please Try Again!"
                                    },
                                    {
                                        type: "alert-danger",
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
                            }
                        });
                    } else {
                        $.notify({
                                message: "Please Login To Allow This Function."
                            },
                            {
                                type: "alert-danger",
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
                    }
                });
                $('body').on('click', '.remove_from_favorite', function (e) {
                    if (user !== "") {
                        $.ajax({
                            url: "{{ URL('user/removeFromFavorite/' . $episode->id) }}",
                            type: "POST",
                            data: {
                                "_token": "{{csrf_token()}}",
                            },
                            success: function (response) {
                                if (response) {
                                    $.notify({
                                            message: "This episode Removed From Your Favorite."
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

                                    $(".favorite_div").html(`
                                            <a class="parent-btn add_to_favorite" data-value="{{$episode->id}}" href="javascript:void(0);">
                                                <i class="ion-ios-heart-outline"></i>Add to Favorite
                                            </a>
                                    `);
                                }
                            },
                            error: function (response) {
                                $.notify({
                                        message: "Please Login To Allow This Function"
                                    },
                                    {
                                        type: "alert-danger",
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
                            }
                        });
                    } else {
                        $.notify({
                                message: "Please Login To Allow This Function."
                            },
                            {
                                type: "alert-danger",
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
                    }
                });
                $('body').on('click', "input[name='stars']", function (e) {
                    var rating = $(this).val();
                    if (user !== "") {
                        $.ajax({
                            url: "{{ URL('user/rate/' . $episode->id) }}",
                            type: "POST",
                            data: {
                                "_token": "{{csrf_token()}}",
                                "rating": rating
                            },
                            success: function (response) {
                                if (response.status) {
                                    $.notify({
                                            message: "Thank You For Rating This Movie"
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
                                    $(".movie_rating").html(response.avg);
                                    $(".movie_reviews").html(response.count);
                                }
                            },
                            error: function (response) {
                                $.notify({
                                        message: "Error, Please Try Again!"
                                    },
                                    {
                                        type: "alert-danger",
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
                            }
                        });
                    } else {
                        $.notify({
                                message: "Please Login To Allow This Function."
                            },
                            {
                                type: "alert-danger",
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
                    }
                });

                @if(session('create_review'))
                $.notify({
                        message: "{{ session('create_review') }}"
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
                @endif

            });
        </script>
    @endpush

@endsection