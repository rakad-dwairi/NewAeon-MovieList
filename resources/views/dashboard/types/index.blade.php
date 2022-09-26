@extends('layouts.dashboard.app')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('dashboard_files/assets/plugins/sweetalert/sweetalert.css') }}" />
    @endpush

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-5 col-sm-12">
                    <h2>All Types
                        <small class="text-muted">Welcome to Films</small>
                    </h2>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12">
                    @if (auth()->guard('admin')->user()->hasPermission('create_type'))
                        <a href="{{ route('dashboard.types.create') }}">
                            <button class="btn btn-primary btn-icon btn-round d-none d-md-inline-block float-right m-l-10"
                                type="button">
                                <i class="zmdi zmdi-plus"></i>
                            </button>
                        </a>
                    @else
                        <button
                            class="btn btn-primary btn-icon btn-round d-none d-md-inline-block float-right m-l-10 disabled"
                            style="cursor: no-drop" type="button">
                            <i class="zmdi zmdi-plus"></i>
                        </button>
                    @endif
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="zmdi zmdi-home"></i>
                                Films</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Types</a></li>
                        <li class="breadcrumb-item active">All Types</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">
                        <div class="header">
                            <h2><strong>Types </strong><span>({{ $types->total() }})</span></h2>
                        </div>
                        <div class="body">
                            <div class="col-5" style="padding-left: 0px">
                                <form action="{{ route('dashboard.types.index') }}" method="GET">
                                    <div class="input-group" style="margin-bottom: 0px">
                                        <input type="text" class="form-control" placeholder="Search..." name="search"
                                            value="{{ request()->search }}">
                                        <button class="input-group-addon" type="submit">
                                            <i class="zmdi zmdi-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-content m-t-10">
                                <div class="tab-pane table-responsive active">
                                    <table class="table m-b-0 table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Arabic Name</th>
                                                <th>Relations</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($types as $type)
                                                <tr>
                                                    <td><span class="list-name">{{ $type->name }}</span></td>
                                                    <td><span class="list-name">{{ $type->arname }}</span></td>
                                                    <td>
                                                        <a href="{{ route('dashboard.films.index', ['type' => $type->id]) }}"
                                                            class="btn btn-info btn-sm">Films</a>
                                                    </td>
                                                    <td>
                                                        @if (auth()->guard('admin')->user()->hasPermission('update_type'))
                                                            <a href="{{ route('dashboard.types.edit', $types) }}">
                                                                <button class="btn btn-icon btn-neutral btn-icon-mini"
                                                                    title="Edit">
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                </button>
                                                            </a>
                                                        @else
                                                            <button class="btn btn-icon btn-neutral btn-icon-mini disabled"
                                                                style="cursor: no-drop" title="Edit">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </button>
                                                        @endif

                                                        @if (auth()->guard('admin')->user()->hasPermission('delete_type'))
                                                            <form
                                                                action="{{ route('dashboard.types.destroy', $type) }}"
                                                                method="POST" style="display: inline-block">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit"
                                                                    class="btn btn-icon btn-neutral btn-icon-mini remove_category"
                                                                    title="Delete" value="{{ $type->id }}">
                                                                    <i class="zmdi zmdi-delete"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-icon btn-neutral btn-icon-mini disabled"
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
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ $types->appends(request()->query())->links() }}
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="{{ asset('dashboard_files/assets/plugins/sweetalert/sweetalert.min.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $(".remove_category").click(function(e) {
                    var that = $(this);
                    e.preventDefault();

                    var id = $(this).val();
                    swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this Category!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    }, function() {
                        that.closest('form').submit();
                    });
                });
            });
        </script>
    @endpush
@endsection
