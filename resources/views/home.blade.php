@extends('layouts.web.app')
@section('content')
    <div class="slider movie-items">
        <div class="container">
            <div class="row">
                <h1 style="color: white">{{ __('default.All Movies') }}</h1>
                <div class="slick-multiItemSlider">
                    @foreach ($sliderFilms as $film)
                        <div class="movie-item">
                            <div class="mv-img">
                                <a href="#"><img alt="" height="437" style="height: 400px;"
                                        src="{{ $film->poster }}" width="285"></a>
                            </div>
                            <div class="hvr-inner">
                                <a onclick="$('#divpa').show()" class="a_movie" c-on="0"
                                    a-href="{{ url('movies/' . $film->id) }}" href="#"> {{ __('default.Show') }} <i
                                        class="ion-android-arrow-dropright"></i> </a>

                            </div>
                            <div class="title-in">
                                <div class="cate">
                                    @foreach ($film->categories as $category)
                                        @if (app()->getLocale() == 'ar')
                                            <span class="blue"><a href="#">{{ $category->arname }}</a></span>
                                        @else
                                            <span class="blue"><a href="#">{{ $category->name }}</a></span>
                                        @endif
                                    @endforeach
                                </div>
                                @if (app()->getLocale() == 'ar')
                                    <h6><a href="#">{{ $film->arname }}</a></h6>
                                @else
                                    <h6><a href="#">{{ $film->name }}</a></h6>
                                @endif
                                <p><i class="ion-android-star"></i><span>{{ $film->ratings->avg('rating') ?? 0 }}</span>
                                    /10</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <h1 style="color: white">{{ __('default.All Series') }}</h1>
                <div class="slick-multiItemSlider">
                    @foreach ($sliderSeries as $serie)
                        <div class="movie-item">
                            <div class="mv-img">
                                <a href="#"><img alt="" height="437" style="height: 400px;"
                                        src="{{ $serie->poster }}" width="285"></a>
                            </div>
                            <div class="hvr-inner">
                                <a onclick="$('#divpa').show()" class="a_movie" c-on="0"
                                    a-href="{{ url('series/' . $serie->id) }}"> {{ __('default.Show') }} <i
                                        class="ion-android-arrow-dropright"></i> </a>
                            </div>
                            <div class="title-in">
                                <div class="cate">
                                    @foreach ($serie->categories as $category)
                                    @if (app()->getLocale() == 'ar')
                                    <span class="blue"><a href="#">{{ $category->arname }}</a></span>
                                @else
                                    <span class="blue"><a href="#">{{ $category->name }}</a></span>
                                @endif
                                    @endforeach
                                </div>
                                @if (app()->getLocale() == 'ar')
                                    <h6><a href="#">{{ $serie->arname }}</a></h6>
                                @else
                                    <h6><a href="#">{{ $serie->name }}</a></h6>
                                @endif
                                <p><i class="ion-android-star"></i><span>{{ $serie->ratings->avg('rating') ?? 0 }}</span>
                                    /10</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="movie-items">
        <div class="container">
            <div class="row ipad-width">
                <div class="col-md-12">
                    @foreach ($categoryFilms as $category)
                        <div class="title-hd">
                            @if (app()->getLocale() == 'ar')
                            <h2>{{ $category->arname }}</h2>
                        @else
                        <h2>{{ $category->name }}</h2>
                        @endif
                            
                            

                                    @if (app()->getLocale() == 'ar')
                                    <a class="viewall" href="{{ url('movies?category=' . $category->arname) }}">{{ __('default.View all') }} <i
                                        class="ion-ios-arrow-right"></i></a>
                                @else
                                <a class="viewall" href="{{ url('movies?category=' . $category->name) }}">{{ __('default.View all') }} <i
                                    class="ion-ios-arrow-right"></i></a>
                                @endif
                        </div>
                        <div class="tabs">
                            <ul class="tab-links">
                                <li><span style="color: lightslategray"> {{ $category->films->count() }}
                                        {{ __('default.movies') }}</span>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab active">
                                    <div class="row">
                                        <div class="slick-multiItem" style="margin-top: 10px">
                                            @foreach ($category->films as $film)
                                                <div class="slide-it">
                                                    <div class="">
                                                        <div class="mv-img">
                                                            <img alt="" src="{{ $film->poster }}"
                                                                style="height: 280px">
                                                        </div>
                                                        <div class="hvr-inner">
                                                            <a href="{{ url('movies/' . $film->id) }}">
                                                                {{ __('default.Show') }} <i
                                                                    class="ion-android-arrow-dropright"></i> </a>
                                                        </div>
                                                        <div class="title-in">
                                                            @if (app()->getLocale() == 'ar')
                                                                <h6><a href="#">{{ $film->arname }}</a></h6>
                                                            @else
                                                                <h6><a href="#">{{ $film->name }}</a></h6>
                                                            @endif
                                                            <p>
                                                                <i
                                                                    class="ion-android-star"></i><span>{{ $film->ratings->avg('rating') ?? 0 }}</span>
                                                                /10
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
