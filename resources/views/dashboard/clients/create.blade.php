@extends('layouts.dashboard.app')
@section('title')
   @lang('site.add_client')
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-users"></i> @lang('site.clients')
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard') </a>
                </li>
                <li class="active"><a href="{{ route('dashboard.clients.index') }}"><i class="fa fa-users"></i>
                        @lang('site.clients') </a></li>
                <li class="active"><i class="fa fa-user"></i> @lang('site.add_client')</li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.add_client')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.clients.store') }}" method="post" enctype="multipart/form-data" >
                        @csrf

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>@lang('site.name')</label>
                                <input type="text" name="name" class="form-control" placeholder="@lang('site.name')" value="{{ old('name') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label>@lang('site.phone')</label>
                                <input type="text" name="phone" class="form-control" placeholder="@lang('site.phone')" value="{{ old('phone') }}">
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>@lang('site.address')</label>
                                <input type="text" name="address" class="form-control" placeholder="@lang('site.address')" value="{{ old('address') }}">
                            </div>
                             <div class="form-group col-md-3">
                                <label>@lang('site.image')</label>
                                <input  type="file" name="image" class="form-control image">
                            </div>
                            <div class="form-group col-md-3">
                                <img src="{{ asset('uploads/client_images/user.png') }}" style="width: 100px"
                                    class="img-thumbnail images-preview" alt="">
                            </div>
    
                            
                        </div>


                        <div class="row">
                            
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
