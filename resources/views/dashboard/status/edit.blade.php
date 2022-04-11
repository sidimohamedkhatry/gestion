@extends('layouts.dashboard.app')

@section('title')
   @lang('site.edit_cat')
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                <i class="ion ion-bag"></i> @lang('site.categories')
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard') </a>
                </li>
                <li class="active"><a href="{{ route('dashboard.categories.index') }}"> <i class="ion ion-bag"></i>
                        @lang('site.categories') </a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.edit_info')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.categories.update',$category->id) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="form-group col-md-6">
                            <label>@lang('site.name')</label>
                            <input type="text" name="name" class="form-control" value="{{ $category->name}}">
                        </div>

                        
                        <div class="form-group col-md-6">
                            
                        </div>
                        

                       
                       

                        <div class="form-group col-md-12" >
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                                @lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->
        </section>
    </div>
@endsection
