@extends('layouts.dashboard.app')
@section('title')
   @lang('site.add_user')
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
                <li class="active"><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-users"></i>
                        @lang('site.users') </a></li>
                <li class="active">@lang('site.add_user')</li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.add_user')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>@lang('site.first_name')</label>
                                <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}">
                            </div>
    
                            <div class="form-group col-md-4">
                                <label>@lang('site.last_name')</label>
                                <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}">
                            </div>
    
                            <div class="form-group col-md-4">
                                <label>@lang('site.email')</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>@lang('site.image')</label>
                                <input  type="file" name="image" class="form-control image">
                            </div>
    
                            <div class="form-group col-md-3">
                                <img src="{{ asset('uploads/users_images/user.png') }}" style="width: 100px"
                                    class="img-thumbnail image-preview" alt="">
                            </div>

                            <div class="form-group col-md-3">
                                <label>@lang('site.password')</label>
                                <input type="password" name="password" class="form-control">
                            </div>
    
                            <div class="form-group col-md-3">
                                <label>@lang('site.password_confirmation')</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
    
                        </div>
                        <div class="row">
                            
                        </div>

                        <div class="form-group ">
                            <label>@lang('site.permissions')</label>
                            <div class="nav-tabs-custom">

                                @php
                                    $models = ['users', 'categories', 'products', 'clients', 'orders', 'invoices'];
                                    $maps = ['create', 'read', 'update', 'delete'];
                                @endphp

                                <ul class="nav nav-tabs">
                                    @foreach ($models as $index=>$model)
                                        <li class="{{ $index == 0 ? 'active' : '' }}"><a href="#{{ $model }}" data-toggle="tab">@lang('site.' . $model)</a></li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">

                                    @foreach ($models as $index=>$model)

                                        <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">

                                            @foreach ($maps as $map)
                                                <label><input type="checkbox" name="permissions[]" value="{{ $model . '-' . $map }}"> @lang('site.' . $map)</label>
                                            @endforeach

                                        </div>

                                    @endforeach

                                </div><!-- end of tab content -->

                            </div><!-- end of nav tabs -->

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                @lang('site.add')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->
        </section>
    </div>
@endsection
