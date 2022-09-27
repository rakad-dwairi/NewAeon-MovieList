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


    <div class="hero common-hero">
        <div class="container">
            <div class="row">
            </div>
        </div>
    </div>

    <div class="page-single" style="padding: 0 !important;">
        <div class="container">
            <div class="row ipad-width">
                {{-- <div class="container">
                    <div class="row">
                        <div class="col">
                            <h1>test</h1>
                        </div>
                    </div>
                    <br>
                </div> --}}
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="topbar-filter">

                        @if (app()->getLocale() == 'ar')
                            <h1 class="center">{{ $actor->arname }}</h1>
                        @else
                            {{-- <h1 class="bd-hd">{{ $film->name }} </h1> --}}
                            <h1 class="center">{{ $actor->name }}</h1>
                        @endif
                    </div>
                    <div class="flex-wrap-movielist">
                        @foreach ($films as $film)
                            <div class="movie-item-style-2 movie-item-style-1">
                                <img src="{{ $film->poster }}" style="height: 260px" alt="">
                                <div class="hvr-inner">
                                    <a href="{{ url('movies/' . $film->id) }}"> SHOW <i
                                            class="ion-android-arrow-dropright"></i> </a>
                                </div>
                                <div class="mv-item-infor">
                                    @if (app()->getLocale() == 'ar')
                                        <h6><a href="#">{{ $film->arname }} <span>{{ $film->year }}</span></a></h6>
                                    @else
                                        {{-- <h1 class="bd-hd">{{ $film->name }} </h1> --}}
                                        <h6><a href="#">{{ $film->name }} <span>{{ $film->year }}</span></a></h6>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
