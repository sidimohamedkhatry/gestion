@extends('layouts.dashboard.app')
@section('title')
    @lang('site.users')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                <i class="fa fa-users"></i> @lang('site.users')
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard') </a>
                </li>
                <li class="active"><i class="fa fa-users"></i> @lang('site.users') </li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">

                <div class="box-header with-border" style="margin-bottom:10px ">
                    <h3 class="box-title"><i class="fa fa-users"></i> @lang('site.users')
                        <small><mark>{{ $users->count() }}</mark></small></h3>
                    <form action="{{ route('dashboard.users.index') }}" method="GET" style="margin-top:10px;"
                        autocomplete="off">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <li class="fa fa-search"></li> @lang('site.search')
                                </button>
                                @if (auth()->user()->hasPermission('users-create'))
                                    <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary btn-sm"><i
                                            class="fa fa-plus"></i> @lang('site.add_user') </a>
                                @else
                                    <a href="#" class="btn btn-primary btn-sm disabled"><i class="fa fa-plus"></i>
                                        @lang('site.add_user') </a>
                                @endif
                            </div>
                        </div>
                    </form>


                </div><!-- end of box header -->
                <div class="box-body">
                    @if ($users->count() > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>@lang('site.image')</td>
                                    <td>@lang('site.first_name')</td>
                                    <td>@lang('site.last_name')</td>
                                    <td>@lang('site.email')</td>
                                    <td>@lang('site.action')</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><img class="user-image" src="{{ $user->image_path }}" alt=""
                                                style="width: 30px"></td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (auth()->user()->hasPermission('users-update'))
                                                <a href="{{ route('dashboard.users.edit', $user->id) }}"
                                                    class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                                    @lang('site.edit')</a>
                                            @else
                                                <button class="btn btn-info btn-sm disabled"><i class="fa fa-edit">
                                                        @lang('site.edit')</button>
                                            @endif
                                            @if (auth()->user()->hasPermission('users-delete'))
                                                <form action="{{ route('dashboard.users.destroy', $user->id) }}"
                                                    method="post" style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger delete btn-sm"><i
                                                            class="fa fa-trash "></i>@lang('site.delete')</button>
                                                </form>
                                            @else
                                                <button class="btn btn-danger btn-sm disabled"><i
                                                        class="fa fa-trash "></i>@lang('site.delete')</button>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> <!-- end of table  -->

                        {{ $users->links() }}
                    @else
                        <div class="text-center alert alert-warning">
                            <h2>@lang('site.no_data_found')</h2>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection
