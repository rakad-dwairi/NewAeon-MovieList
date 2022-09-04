@extends('layouts.dashboard.app')

@section('content')

@push('styles')
<link rel="stylesheet" href="{{asset('dashboard_files/assets/plugins/sweetalert/sweetalert.css')}}" />
<link href="{{asset('dashboard_files/assets/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endpush

<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-5 col-sm-12">
                <h2>All seasons
                    <small class="text-muted">Welcome to seasons</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-7 col-sm-12">
                @if(auth()->guard('admin')->user()->hasPermission('create_seasons'))
                <a href="{{ route('dashboard.seasons.create',['series_id' => request()->route()->series]) }}">
                    <button class="btn btn-primary btn-icon btn-round d-none d-md-inline-block float-right m-l-10"
                        type="button">
                        <i class="zmdi zmdi-plus"></i>
                    </button>
                </a>
                @else
                <button class="btn btn-primary btn-icon btn-round d-none d-md-inline-block float-right m-l-10 disabled"
                    style="cursor: no-drop" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                @endif
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="zmdi zmdi-home"></i>
                            seasons</a>
                    </li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">seasons</a></li>
                    <li class="breadcrumb-item active">All seasons</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <div class="header">
                        <h2><strong>seasons </strong></h2>
                    </div>
                    <div class="body">

                        <div class="tab-content m-t-10">
                            <div class="tab-pane table-responsive active">
                                <table class="table m-b-0 table-hover">
                                    <thead>
                                        <tr>
                                            <th>Poster</th>
                                            <th>Name</th>
                                            <th>season No</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        {{-- @if(sizeof($seasons[0])) --}}
                                        @forelse($seasons->seasons2 as $season)                                       
                                        <tr>
                                            <td>
                                                <span class="list-icon">
                                                    <img src="{{$season->background_cover}}" alt="logi"
                                                        style="width: 50px; height: 50px;">
                                                </span>
                                            </td>
                                            <td><span class="list-name">{{$season->name}}</span></td>
                                            <td>{{$season->id}}</td>
                                                                             
                                            <td>
                                                @if(auth()->guard('admin')->user()->hasPermission('read_seasons'))
                                                <a href="{{route('dashboard.seasons.show', $season->id)}}">
                                                    <button class="btn btn-icon btn-neutral btn-icon-mini" title="Edit">
                                                        <i class="zmdi zmdi-eye"></i>
                                                    </button>
                                                </a>
                                                @else
                                                <button class="btn btn-icon btn-neutral btn-icon-mini disabled"
                                                    style="cursor: no-drop" title="Edit">
                                                    <i class="zmdi zmdi-eye"></i>
                                                </button>
                                                @endif

                                                @if(auth()->guard('admin')->user()->hasPermission('update_seasons'))
                                                <a href="/seasons/{{ $season->id }}/edit">
                                                    {{-- @dd($season->id) --}}
                                                    <button class="btn btn-icon btn-neutral btn-icon-mini" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </a>
                                                @else
                                                <button class="btn btn-icon btn-neutral btn-icon-mini disabled"
                                                    style="cursor: no-drop" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                @endif

                                                @if(auth()->guard('admin')->user()->hasPermission('delete_seasons'))
                                                <form action="{{ route('dashboard.seasons.destroy', $season) }}"
                                                    method="POST" style="display: inline-block">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="btn btn-icon btn-neutral btn-icon-mini remove_serie"
                                                        title="Delete" value="{{$season->id}}">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </form>
                                                @else
                                                <button
                                                    class="btn btn-icon btn-neutral btn-icon-mini remove_admin disabled"
                                                    style="cursor: no-drop" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr class="text-center">
                                            <td colspan="5">There Is No Data...</td>
                                        </tr>
                                        @endforelse
                                        {{-- @endif --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- {{$seasons->appends(request()->query())->links()}} --}}
        </div>
    </div>
</section>

@push('scripts')
<script src="{{asset('dashboard_files/assets/plugins/sweetalert/sweetalert.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $(".remove_serie").click(function (e) {
            var that = $(this);
            e.preventDefault();

            var id = $(this).val();
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this serie!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                that.closest('form').submit();
            });
        });

        $(".show_overview").click(function () {
            var overview = $(this).val();
            swal({
                title: "<spna style='color: #8CD4F5'>Overview</span>",
                text: "<textarea rows='15' class='form-control no-resize' style='background-color: white!important; cursor: auto!important;' readonly>" +
                    overview + "</textarea>",
                html: true
            });
        });
    });

</script>
@endpush

@endsection
