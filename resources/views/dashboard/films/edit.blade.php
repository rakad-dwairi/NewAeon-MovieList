@extends('layouts.dashboard.app')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('web_files/css/bootstrap-fileinput.css') }}">
        <link href="{{ asset('dashboard_files/assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
    @endpush

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-5 col-sm-12">
                    <h2>Edit Film
                        <small>Welcome to Films</small>
                    </h2>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="zmdi zmdi-home"></i>
                                Films</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Films</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Edit</strong> Films</h2>
                        </div>

                        <div class="body">
                            <form action="{{ route('dashboard.films.update', $film) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="header col-lg-12 col-md-12 col-sm-12">
                                    <h2>Main Information</h2>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Name"
                                                value="{{ $film->name }}">
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('name') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="arname" class="form-control" placeholder="Arabic Name"
                                                value="{{ $film->arname }}">
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('arname') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="year" class="form-control" placeholder="Year"
                                                value="{{ $film->year }}">
                                            <span style="color: red;margin-left: 10px">{{ $errors->first('year') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">


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
                                                        <input type="text" name="server_url[{{ $server->id }}]"
                                                            class="form-control" placeholder="url"
                                                            value="{{ $server->embed_url }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        {{-- <select class="form-control show-tick" name="servers[]" multiple>
                                            <option selected disabled>- Servers -</option>
                                            @foreach ($servers as $server)
                                                <option value="{{ $server->id }}"
                                                {{in_array($server->id, $film->servers->pluck('id')->toArray()) ? 'selected' : ''}}>
                                                    {{ $server->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span style="color: red;margin-left: 10px">{{ $errors->first('servers') }}</span> --}}
                                    </div>
                                </div>
                                <br>

                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <select class="form-control show-tick" name="categories[]" multiple>
                                            <option selected disabled>- Categories -</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ in_array($category->id, $film->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span
                                            style="color: red;margin-left: 10px">{{ $errors->first('categories') }}</span>
                                    </div>
                                </div>
                                <br>

                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <select class="form-control show-tick" name="type[]" multiple>
                                            <option selected disabled>- Film Type -</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}"
                                                    {{ in_array($type->id, $film->type->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span
                                            style="color: red;margin-left: 10px">{{ $errors->first('type') }}</span>
                                    </div>
                                </div>
                                <br>


                                <br>

                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea name="overview" rows="4" class="form-control no-resize" placeholder="Film Overview">{{ $film->overview }}</textarea>
                                            <span
                                                style="color: red; margin-left: 10px">{{ $errors->first('overview') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea name="url" rows="4" class="form-control no-resize" placeholder="Embed Code From JWPlayer Server">{{ $film->url }}</textarea>
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('url') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea name="api_url" rows="4" class="form-control no-resize" placeholder="API URL">{{ $film->api_url }}</textarea>
                                            <span
                                                style="color: red; margin-left: 10px">{{ $errors->first('api_url') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group last">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="{{ $film->background_cover }}" alt="" />
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                            style="max-width: 200px; max-height: 150px;">
                                        </div>
                                        <div>
                                            <span class="btn btn-dark btn-file">
                                                <span class="fileinput-new"> Select Film Background_Cover </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="background_cover"
                                                    value="{{ $film->background_cover }}">
                                            </span>
                                            <a href="" class="btn btn-danger fileinput-exists"
                                                data-dismiss="fileinput">
                                                Remove </a>
                                        </div>
                                        <span
                                            style="color: red; margin-left: 10px">{{ $errors->first('background_cover') }}</span>
                                    </div>
                                </div>


                                <div class="form-group last">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="{{ $film->poster }}" alt="" />
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                            style="max-width: 200px; max-height: 150px;">
                                        </div>
                                        <div>
                                            <span class="btn btn-dark btn-file">
                                                <span class="fileinput-new"> Select Film Poster </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="poster" value="{{ $film->poster }}">
                                            </span>
                                            <a href="" class="btn btn-danger fileinput-exists"
                                                data-dismiss="fileinput">
                                                Remove </a>
                                        </div>
                                        <span style="color: red; margin-left: 10px">{{ $errors->first('poster') }}</span>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-round">Edit</button>
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
        <script src="{{ asset('web_files/js/bootstrap-fileinput.js') }}"></script>
    @endpush
@endsection
