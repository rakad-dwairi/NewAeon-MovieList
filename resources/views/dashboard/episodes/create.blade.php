@extends('layouts.dashboard.app')

@section('content')

@push('styles')
<link rel="stylesheet" href="{{asset('web_files/css/bootstrap-fileinput.css')}}">
<link href="{{asset('dashboard_files/assets/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endpush
{{-- @dd($series_id) --}}
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-5 col-sm-12">
                <h2>Add Episode
                    <small>Welcome to Episodes</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-7 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="zmdi zmdi-home"></i>
                            Episodes</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Episodes</a></li>
                    <li class="breadcrumb-item active">Add</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Add</strong> Episodes</h2>
                    </div>

                    <div class="body">
                        <form action="{{route('dashboard.episodes.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="header col-lg-12 col-md-12 col-sm-12">
                                <h2>Main Information</h2>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Name"
                                            value="{{ old('name', '') }}">
                                        <span style="color: red; margin-left: 10px">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="year" class="form-control" placeholder="Year"
                                            value="{{ old('year', '') }}">
                                        <span style="color: red;margin-left: 10px">{{ $errors->first('year') }}</span>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="header col-lg-12 col-md-12 col-sm-12">
                                <h2>Main Server</h2>
                            </div>
                                @foreach ($servers as $server)
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Name"
                                                value="{{ $server->name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="server_url[{{ $server->id }}]" class="form-control" placeholder="url">
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            <br>

                            {{-- <div class="row clearfix">
                                <div class="col-sm-12">
                                    <select class="form-control z-index show-tick" name="categories[]"
                                        data-live-search="true" multiple>
                                        <option selected disabled>- Select Categories -</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color: red;margin-left: 10px">{{ $errors->first('categories') }}</span>
                                </div>
                            </div> --}}
                            <br>
                            {{-- <div class="row clearfix">
                                <div class="col-sm-12">
                                    <select class="form-control z-index show-tick" name="actors[]"
                                        data-live-search="true" multiple>
                                        <option selected disabled>- Select Actors -</option>
                                        @foreach ($actors as $actor)
                                        <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color: red;margin-left: 10px">{{ $errors->first('actors') }}</span>
                                </div>
                            </div> --}}

                            <br>
                            <br>

                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="overview" rows="4" class="form-control no-resize"
                                            placeholder="Episode Overview">{{ old('overview', '') }}</textarea>
                                        <span
                                            style="color: red; margin-left: 10px">{{ $errors->first('overview') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="url" rows="4" class="form-control no-resize"
                                            placeholder="Embed Code From JWPlayer Server">{{ old('url', '') }}</textarea>
                                        <span style="color: red; margin-left: 10px">{{ $errors->first('url') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="api_url" rows="4" class="form-control no-resize"
                                            placeholder="API URL">{{ old('api_url', '') }}</textarea>
                                        <span
                                            style="color: red; margin-left: 10px">{{ $errors->first('api_url') }}</span>
                                    </div>
                                </div>
                            </div>
                             <input type="hidden" name="seasons_id" value="{{ $seasons_id }}">
                             <input type="hidden" name="series_id" value="{{ $series_id }}">
                           {{-- <input type="hidden" name="season" value="{{ $season }}"> --}}
                            <div class="form-group last">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                            alt="" />
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                        style="max-width: 200px; max-height: 150px;">
                                    </div>
                                    <div>
                                        <span class="btn btn-dark btn-file">
                                            <span class="fileinput-new"> Select Episode Background_Cover </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="background_cover"
                                                value="{{ old('background_cover', '') }}">
                                        </span>
                                        <a href="" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                            Remove </a>
                                    </div>
                                    <span
                                        style="color: red; margin-left: 10px">{{ $errors->first('background_cover') }}</span>
                                </div>
                            </div>


                            <div class="form-group last">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                            alt="" />
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                        style="max-width: 200px; max-height: 150px;">
                                    </div>
                                    <div>
                                        <span class="btn btn-dark btn-file">
                                            <span class="fileinput-new"> Select Episode Poster </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="poster" value="{{ old('poster', '') }}">
                                        </span>
                                        <a href="" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                            Remove </a>
                                    </div>
                                    <span style="color: red; margin-left: 10px">{{ $errors->first('poster') }}</span>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-round">Add</button>
                                    <button type="reset" class="btn btn-default btn-round btn-simple">Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script src="{{asset('web_files/js/bootstrap-fileinput.js')}}"></script>
@endpush

@endsection
