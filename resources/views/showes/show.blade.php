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
        </style>
    @endpush


    <div class="hero common-hero">
        <div class="container">
            <div class="row">
                {{-- <img src="{{$servers[0]->poster}}" style="height: 260px" alt="">            --}}
             </div>
        </div>
    </div>

    <div class="page-single">
        <div class="container">
            <div class="row ipad-width">
                <div class="container">
                    <div class="row">
  
                     </div>
                    <br>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="topbar-filter">
                        {{-- <p>Found <span>{{$series->count()}} showes</span> in total</p> --}}
                    </div>
                    <div class="flex-wrap-movielist">
                        @foreach($servers as $episode)
                            <div class="movie-item-style-2 movie-item-style-1">
                                
                                <img src="{{$episode->poster}}" style="height: 260px" alt="">
                                <div class="hvr-inner">
                                    <a href="{{url('episodes/'.$episode->id)}}"> SHOW <i class="ion-android-arrow-dropright"></i> </a>
                                </div>
                                <div class="mv-item-infor">
                                    <h6><a href="#">{{$episode->name}}</a></h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
