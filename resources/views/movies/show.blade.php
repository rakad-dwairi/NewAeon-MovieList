@extends('layouts.web.app')
@section('content')
    @push('style')
        <style rel="stylesheet">
            .serverButton
            {
                background-color: #685e5e;
                border: none;
                color: white;
                padding: 13px 60px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 10px 30px 20px 20px;
                border-radius: 8px;
            }
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

    <style>

    </style>
    <div id="divpa"
        style=" position:fixed; background-color:rgb(241, 234, 234); top:0; left:0; width:100%; height:100%; z-index:500; ">
        <div class="container" style="padding-top: 13%;">

            <div class="parent evenly">
                <img src="{{ asset('/images/ads1.png') }}" alt="" style="width: 900px;">
            </div>

            <div class="parent between text-center">
                <div id="countdown" class="text-center"></div>
            </div>

            <div class="parent around">
                <img src="{{ asset('/images/ads1.png') }}" alt="" style="width: 900px;">
            </div>

        </div>
    </div>

    <div class="hero mv-single-hero"
        style="background: url('{{ $film->background_cover }}'); no-repeat center center fixed; 
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
                        <img alt="" src="{{ $film->poster }}" style="height: 350px">
                    </div>
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="movie-single-ct main-content">
                        @if (app()->getLocale() == 'ar')
                            <h1 class="bd-hd">{{ $film->arname }} <span>{{ $film->year }}</span></h1>
                        @else
                        <h1 class="bd-hd">{{ $film->name }} <span>{{ $film->year }}</span></h1>
                        @endif
                        
                        <div class="social-btn favorite_div">
                            @if (!$film->isInfavorite(auth()->user()))
                                <a class="parent-btn add_to_favorite" data-value="{{ $film->id }}"
                                    href="javascript:void(0);">
                                    <i class="ion-ios-heart-outline"></i>{{ __('default.Add to Favorite') }}
                                </a>
                            @else
                                <a class="parent-btn remove_from_favorite" data-value="{{ $film->id }}"
                                    href="javascript:void(0);">
                                    <i class="ion-ios-heart"></i>{{ __('default.Remove From Favorite') }}
                                </a>
                            @endif

                        </div>
                        <div class="movie-rate">
                            <div class="rate">
                                <i class="ion-android-star"></i>
                                <p><span class="movie_rating">{{ $film->ratings->avg('rating') ?? 0 }}</span> /10<br>
                                    <span class="rv movie_reviews">{{ $film->ratings->count() }}
                                        {{ __('default.Reviews') }}</span>
                                </p>
                            </div>
                            <div class="rate-star">
                                <p>{{ __('default.Rate This Movie') }}: </p>
                                <form class="rating">
                                    @php
                                        $userrate = 0;
                                        if (auth()->user() != null) {
                                            $userrate = auth()
                                                ->user()
                                                ->ratings->where('film_id', $film->id)
                                                ->first();
                                        }
                                        if ($userrate != null) {
                                            $userrate = $userrate->rating;
                                        }
                                    @endphp
                                    <input type="hidden" class="user_rate" value="{{ $userrate }}">
                                    <label>
                                        <input class="stars_1" {{ $userrate == 1 ? 'checked' : '' }} name="stars"
                                            type="radio" value="1" />
                                        <span class="icon">???</span>
                                    </label>
                                    <label>
                                        <input class="stars_2" {{ $userrate == 2 ? 'checked' : '' }} name="stars"
                                            type="radio" value="2" />
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                    </label>
                                    <label>
                                        <input class="stars_3" {{ $userrate == 3 ? 'checked' : '' }} name="stars"
                                            type="radio" value="3" />
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                    </label>
                                    <label>
                                        <input class="stars_4" {{ $userrate == 4 ? 'checked' : '' }} name="stars"
                                            type="radio" value="4" />
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                    </label>
                                    <label>
                                        <input class="stars_5" {{ $userrate == 5 ? 'checked' : '' }} name="stars"
                                            type="radio" value="5" />
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                    </label>
                                    <label>
                                        <input class="stars_6" {{ $userrate == 6 ? 'checked' : '' }} name="stars"
                                            type="radio" value="6" />
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                    </label>
                                    <label>
                                        <input class="stars_7" {{ $userrate == 7 ? 'checked' : '' }} name="stars"
                                            type="radio" value="7" />
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                    </label>
                                    <label>
                                        <input class="stars_8" {{ $userrate == 8 ? 'checked' : '' }} name="stars"
                                            type="radio" value="8" />
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                    </label>
                                    <label>
                                        <input class="stars_9" {{ $userrate == 9 ? 'checked' : '' }} name="stars"
                                            type="radio" value="9" />
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                    </label>
                                    <label>
                                        <input class="stars_10" {{ $userrate == 10 ? 'checked' : '' }} name="stars"
                                            type="radio" value="10" />
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                        <span class="icon">???</span>
                                    </label>
                                </form>
                            </div>
                        </div>
                        <div class="movie-tabs">
                            <div class="tabs">
                                <ul class="tab-links tabs-mv" style="margin-top: 30px">
                                    <li class="active"><a onclick="window.open('/ads')"
                                            href="#overview">{{ __('default.Overview & Play') }}</a></li>
                                    <li><a onclick="window.open('/ads')" href="#reviews"> {{ __('default.Reviews') }}</a>
                                    </li>
                                    <li><a onclick="window.open('/ads')" href="#actor"> {{ __('default.Actor') }} </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab active" id="overview">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <p>{{ $film->overview }}</p>
                                                <hr style="background-color: #405266">
                                                <br>
                                                <div class="row">
                                                @foreach ($film->servers as $server)
                                                    <button type="submit" class="btn serverButton" id="embd_url_"
                                                        onclick="set_url1({{ $server->id }})">{{ $server->name }}</button>
                                                @endforeach
                                            </div>
                                                <div id='display'>
                                                    @foreach ($servers as $s)
                                                        @if ($loop->first)
                                                            <div id="url" style="display: block">
                                                                {!! $s->embed_url !!}
                                                            </div>
                                                        @endif
                                                        <div class="embd_url_{{ $s->server_id }}" id="url"
                                                            style="display: none">
                                                            {!! $s->embed_url !!}
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <script>
                                        function set_url1(id) {
                                            window.open('/ads');
                                            $('*#url').each(function() {
                                                $(this).css('display', 'none');
                                            });
                                            $('.embd_url_' + id).css('display', 'block');
                                        }
                                    </script>
                                    <div class="tab review" id="reviews">
                                        <div class="row">
                                            <div class="rv-hd">
                                                <div class="div">
                                                    <h3>{{ __('default.Related Movies To') }}</h3>

                                                    @if (app()->getLocale() == 'ar')
                                                        <h2>{{ $film->arname }}</h2>
                                                    @else
                                                        <h2>{{ $film->name }}</h2>
                                                    @endif
                                                </div>
                                                <a class="redbtn write_review" href="#write_review"
                                                    style="margin-right: 20px">{{ __('default.Write Review') }}</a>
                                            </div>
                                            <div class="topbar-filter">
                                                <p>Found <span>{{ $film->reviews->count() }} reviews</span> in total</p>
                                            </div>
                                            @foreach ($reviews as $review)
                                                <div class="mv-user-review-item">
                                                    <div class="user-infor">
                                                        <img alt="" src="{{ $review->user->avatar }}">
                                                        <div>
                                                            <h3>{{ $review->title }}</h3>
                                                            <div class="no-star">
                                                                @php
                                                                    $stars = $review->user->ratings->where('film_id', $film->id)->first();
                                                                    if ($stars != null) {
                                                                        $stars = $stars->rating;
                                                                        for ($i = 1; $i <= $stars; $i++) {
                                                                            echo '<i class="ion-android-star"></i>';
                                                                        }
                                                                        for ($i = 1; $i <= 10 - $stars; $i++) {
                                                                            echo '<i class="ion-android-star last"></i>';
                                                                        }
                                                                    }
                                                                @endphp
                                                            </div>
                                                            <p class="time">
                                                                {{ date('d F Y', strtotime($review->created_at)) }} by
                                                                <a> {{ $review->user->username }}</a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <p>{{ $review->review }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                        {{ $reviews->appends(request()->query())->links() }}
                                        <div class="blog-detail-ct" id="write_review">
                                            <div class="comment-form" style="padding-top: 75px!important;">
                                                <h4>{{ __('default.Write Review') }}</h4>
                                                <form action="{{ url('user/review/' . $film->id) }}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input name="title" placeholder="Title" type="text"
                                                                required max="15">
                                                        </div>
                                                        @error('title')
                                                            <span class="invalid-feedback" style="color: red; font-size: 12px"
                                                                role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <textarea id="" name="review" placeholder="Review" style="resize: none" required max="150"></textarea>
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
                                                <h4>{{ __('default.Actor') }}</h4>
                                            </div>
                                            <div class="mvcast-item">
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
        <script src="{{ asset('dashboard_files/assets/plugins/bootstrap-notify/bootstrap-notify.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                // alert($('.user_rate').val() !== "");
                var allowDismiss = true;
                var user = "{{ auth()->user() }}";
                $('body').on('click', '.add_to_favorite', function(e) {
                    if (user !== "") {
                        $.ajax({
                            url: "{{ URL('user/addToFavorite/' . $film->id) }}",
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                if (response) {
                                    $.notify({
                                        message: "This Film Added To Your Favorite."
                                    }, {
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
                                        template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' +
                                            (allowDismiss ? "p-r-35" : "") +
                                            '" role="alert">' +
                                            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">??</button>' +
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
                                            <a class="parent-btn remove_from_favorite" data-value="{{ $film->id }}" href="javascript:void(0);">
                                                <i class="ion-ios-heart"></i>Remove From Favorite
                                            </a>
                                    `);
                                }
                            },
                            error: function(response) {
                                $.notify({
                                    message: "Error, Please Try Again!"
                                }, {
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
                                    template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' +
                                        (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
                                        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">??</button>' +
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
                        }, {
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
                            template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' +
                                (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
                                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">??</button>' +
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
                $('body').on('click', '.remove_from_favorite', function(e) {
                    if (user !== "") {
                        $.ajax({
                            url: "{{ URL('user/removeFromFavorite/' . $film->id) }}",
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                if (response) {
                                    $.notify({
                                        message: "This Film Removed From Your Favorite."
                                    }, {
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
                                        template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' +
                                            (allowDismiss ? "p-r-35" : "") +
                                            '" role="alert">' +
                                            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">??</button>' +
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
                                            <a class="parent-btn add_to_favorite" data-value="{{ $film->id }}" href="javascript:void(0);">
                                                <i class="ion-ios-heart-outline"></i>Add to Favorite
                                            </a>
                                    `);
                                }
                            },
                            error: function(response) {
                                $.notify({
                                    message: "Please Login To Allow This Function"
                                }, {
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
                                    template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' +
                                        (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
                                        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">??</button>' +
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
                        }, {
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
                            template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' +
                                (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
                                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">??</button>' +
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
                $('body').on('click', "input[name='stars']", function(e) {
                    var rating = $(this).val();
                    if (user !== "") {
                        $.ajax({
                            url: "{{ URL('user/rate/' . $film->id) }}",
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "rating": rating
                            },
                            success: function(response) {
                                if (response.status) {
                                    $.notify({
                                        message: "Thank You For Rating This Movie"
                                    }, {
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
                                        template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' +
                                            (allowDismiss ? "p-r-35" : "") +
                                            '" role="alert">' +
                                            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">??</button>' +
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
                            error: function(response) {
                                $.notify({
                                    message: "Error, Please Try Again!"
                                }, {
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
                                    template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' +
                                        (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
                                        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">??</button>' +
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
                        }, {
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
                            template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' +
                                (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
                                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">??</button>' +
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

                @if (session('create_review'))
                    $.notify({
                        message: "{{ session('create_review') }}"
                    }, {
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
                        template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' +
                            (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
                            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">??</button>' +
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
