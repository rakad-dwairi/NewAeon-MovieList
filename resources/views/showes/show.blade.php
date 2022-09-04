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

    <div class="hero mv-single-hero" style="background: url('{{ $serie->background_cover }}') no-repeat">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
        </div>
    </div>

    <div class="page-single movie-single movie_single">
        <div class="container">

        </div>
    </div>
@endsection
