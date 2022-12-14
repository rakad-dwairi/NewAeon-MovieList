@extends('layouts.web.app')
@section('content')
    @push('style')
        <style rel="stylesheet">
            li.active {
                color: yellow;
            }
        </style>
    @endpush

    <div class="hero common-hero">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-ct">
                        <h1>{{$user->first_name . ' ' . $user->last_name}}  {{ __('default.Profile')}}</h1>
                        <ul class="breadcumb">
                            <li class="active"><a href="#">{{ __('default.home')}}</a></li>
                            <li><span class="ion-ios-arrow-right"></span>{{ __('default.Profile')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-single">
        <div class="container">
            <div class="row ipad-width2">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="user-information">
                        <div style="margin: 0" class="user-img">
                            <a href="#"><img alt="" src="{{$user->avatar}}"
                                             style="width: 150px; height: 150px; border-radius: 50%"><br></a>
                        </div>
                        <div class="user-fav">
                            <p>{{ __('default.Account Details')}}</p>
                            <ul>
                                <li><a href="{{url('user/profile')}}">{{ __('default.Profile')}}</a></li>
                                <li><a href="{{url('user/favorites')}}">{{ __('default.Favorit Movies')}}</a></li>
                                <li class="active"><a href="{{url('user/ratings')}}">{{ __('default.Rated Movies')}}</a></li>
                                <li><a href="{{url('user/reviews')}}">{{ __('default.Reviewed Movies')}}</a></li>
                            </ul>
                        </div>
                        <div class="user-fav">
                            <p>{{ __('default.Others')}}</p>
                            <ul>
                                <li><a href="{{url('user/change_password/')}}">{{ __('default.Change Password')}}</a></li>
                                <li><a href="{{route('logout')}}">{{ __('default.logout')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                 <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="topbar-filter">
                        <p>Found <span>{{$ratings->count()}} rates</span> in total</p>
                    </div>
                    @foreach($ratings as $rating)
                        <div class="movie-item-style-2 userrate">
                        <img src="{{$rating->film->poster}}" alt="" style="height: 150px">
                        <div class="mv-item-infor">
                            <h6><a href="{{url('movies/' . $rating->film->id)}}">{{$rating->film->name}} <span>({{$rating->film->year}})</span></a></h6>
                            <p class="time sm-text" style="margin-bottom: 10px">your rate:</p>
                            <p class="rate"><i class="ion-android-star"></i><span>{{$rating->rating }}</span> /10</p>
                        </div>
                    </div>
                    @endforeach
                    {{$ratings->appends(request()->query())->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection