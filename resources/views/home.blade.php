@extends('layouts.web.app')
@section('content')
    <div class="slider movie-items">
        <div class="container">
            <div class="row">
                <h1 style="color: white">Top Rated Movies</h1>
                <div class="slick-multiItemSlider">
                    @foreach ($sliderFilms as $film)
                        <div class="movie-item">
                            <div class="mv-img">
                                <a href="#"><img alt="" height="437" style="height: 400px;"
                                        src="{{ $film->poster }}" width="285"></a>
                            </div>
                            <div class="hvr-inner">
                                <a onclick="$('#divpa').show()" class="a_movie" c-on="0"
                                    a-href="{{ url('movies/' . $film->id) }}" href="#"> Show <i
                                        class="ion-android-arrow-dropright"></i> </a>

                            </div>
                            <div class="title-in">
                                <div class="cate">
                                    @foreach ($film->categories as $category)
                                        <span class="blue"><a href="#">{{ $category->name }}</a></span>
                                    @endforeach
                                </div>
                                @if(app()->getLocale() == 'ar')
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
                <h1 style="color: white">Top Rated Series</h1>
                <div class="slick-multiItemSlider">
                    @foreach ($sliderSeries as $serie)
                        <div class="movie-item">
                            <div class="mv-img">
                                <a href="#"><img alt="" height="437" style="height: 400px;"
                                        src="{{ $serie->poster }}" width="285"></a>
                            </div>
                            <div class="hvr-inner">
                                <a onclick="$('#divpa').show()" class="a_movie" c-on="0"
                                    a-href="{{ url('series/' . $serie->id) }}"> Show <i
                                        class="ion-android-arrow-dropright"></i> </a>
                            </div>
                            <div class="title-in">
                                <div class="cate">
                                    @foreach ($serie->categories as $category)
                                        <span class="blue"><a href="#">{{ $category->name }}</a></span>
                                    @endforeach
                                </div>
                                <h6><a href="#">{{ $serie->name }}</a></h6>
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
                            <h2>{{ $category->name }}</h2>
                            <a class="viewall" href="{{ url('movies?category=' . $category->name) }}">View all <i
                                    class="ion-ios-arrow-right"></i></a>
                        </div>
                        <div class="tabs">
                            <ul class="tab-links">
                                <li><span style="color: lightslategray"> {{ $category->films->count() }} Movies</span>
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
                                                            <a href="{{ url('movies/' . $film->id) }}"> Show <i
                                                                    class="ion-android-arrow-dropright"></i> </a>
                                                        </div>
                                                        <div class="title-in">
                                                            <h6><a href="#">{{ $film->name }}</a></h6>
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
