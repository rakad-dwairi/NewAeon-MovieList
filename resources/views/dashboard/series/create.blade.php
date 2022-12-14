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
                    <h2>Add Serie
                        <small>Welcome to Series</small>
                    </h2>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="zmdi zmdi-home"></i>
                                Series</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Series</a></li>
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
                            <h2><strong>Add</strong> Series</h2>
                        </div>

                        <div class="body">
                            <form action="{{ route('dashboard.series.store') }}" method="POST"
                                enctype="multipart/form-data">
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
                                            <input type="text" name="arname" class="form-control" placeholder="Arabic Name"
                                                value="{{ old('arname', '') }}">
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('arname') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="year" class="form-control" placeholder="Year"
                                                value="{{ old('year', '') }}">
                                            <span style="color: red;margin-left: 10px">{{ $errors->first('year') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="number" name="seasons" class="form-control" placeholder="seasons"
                                                value="{{ old('seasons', '') }}">
                                            <span
                                                style="color: red; margin-left: 10px">{{ $errors->first('seasons') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <select class="form-control z-index show-tick" name="categories[]"
                                            data-live-search="true" multiple>
                                            <option selected disabled>- Select Categories -</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <span
                                            style="color: red;margin-left: 10px">{{ $errors->first('categories') }}</span>
                                    </div>
                                </div>
                                <br>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <select class="form-control z-index show-tick" name="type[]"
                                            data-live-search="true" multiple required>
                                            <option selected disabled>- Select Type -</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                        <span
                                            style="color: red;margin-left: 10px">{{ $errors->first('type') }}</span>
                                    </div>
                                </div>
                                <br>


                                <br>
                                <br>

                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea name="overview" rows="4" class="form-control no-resize" placeholder="Serie Overview">{{ old('overview', '') }}</textarea>
                                            <span
                                                style="color: red; margin-left: 10px">{{ $errors->first('overview') }}</span>
                                        </div>
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
                                                <span class="fileinput-new"> Select Serie Background_Cover </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="background_cover"
                                                    value="{{ old('background_cover', '') }}">
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
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                                alt="" />
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                            style="max-width: 200px; max-height: 150px;">
                                        </div>
                                        <div>
                                            <span class="btn btn-dark btn-file">
                                                <span class="fileinput-new"> Select Serie Poster </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="poster" value="{{ old('poster', '') }}">
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
        <script src="{{ asset('web_files/js/bootstrap-fileinput.js') }}"></script>
    @endpush
@endsection
