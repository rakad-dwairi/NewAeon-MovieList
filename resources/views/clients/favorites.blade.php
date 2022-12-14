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
                                <li class="active"><a href="{{url('user/favorites')}}">{{ __('default.Favorit Movies')}}</a></li>
                                <li><a href="{{url('user/ratings')}}">{{ __('default.Rated Movies')}}</a></li>
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
                    <div class="topbar-filter user">
                        <p>Found <span>{{$favorites->count()}} movies</span> in total</p>
                    </div>
                    <div class="flex-wrap-movielist grid-fav">
                        @foreach($favorites as $favorite)
                            <div class="movie-item-style-2 movie-item-style-1 style-3">
                            <img src="{{$favorite->film->poster}}" alt="" style="height: 245px">
                            <div class="hvr-inner">
                                <a href="{{url('movies/' . $favorite->film->id)}}"> {{ __('default.Show')}} <i class="ion-android-arrow-dropright"></i> </a>
                            </div>
                            <div class="mv-item-infor">
                                <h6><a href="{{url('movies/' . $favorite->film->id)}}">{{$favorite->film->aname}}</a></h6>
                                <p class="rate"><i class="ion-android-star"></i><span>{{$favorite->film->ratings->avg('rating') ?? 0}}</span> /10</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{$favorites->appends(request()->query())->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection