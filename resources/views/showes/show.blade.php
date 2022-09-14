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

    <div id="divpa" style=" position:fixed; background-color:rgb(241, 234, 234); top:0; left:0; width:100%; height:100%; z-index:500; ">     
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
                        <div class="col">
                        {{-- <img src="{{$servers[0]->background_cover}}" style="height: 260px" alt="">   --}}
                    </div>      
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
