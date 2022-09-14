@extends('layouts.web.adsLayout')
@section('content')

<style>
    body{
        background-color: white;
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
  @endsection