@extends('layouts.dashboard.app')
@section('title')
   @lang('site.add_product')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                <i class="ion ion-stats-bars"></i> @lang('site.products')
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard') </a>
                </li>
                <li class="active"><a href="{{ route('dashboard.products.index') }}"><i class="ion ion-stats-bars"></i>
                        @lang('site.products') </a></li>
                <li class="active">@lang('site.add_product')</li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.add_product')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                           <div class="form-group col-md-6">
                                <label>Code</label>
                                <input type="text" name="num_produitt" class="form-control" value="{{ old('num_produitt') }}" required>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>@lang('site.name')</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('site.categories')</label>
                                <select name="category_id" id="" class="form-control " required>
                                    <option value="" selected disabled>@lang('site.all_categories')</option>
                                   @foreach ($categories as $cat)
                                       <option value="{{ $cat->id }}" {{ old('cat_id') == $cat->id ?'selected':'' }}>{{ $cat->name }}</option>
                                   @endforeach
                                </select>
                            </div>

                           
    
                            
                        </div>
                           <div class="row">
                            <div class="form-group col-md-6">
                                <label>@lang('site.image')</label>
                                <input  type="file" name="image" class="form-control image">
                            </div>
    
                            <div class="form-group col-md-6">
                                <img src="{{ asset('uploads/product_images/defualt.png') }}" style="width: 100px"
                                    class="img-thumbnail image-preview" alt="">
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>@lang('site.purches_price')</label>
                                <input  type="text" name="purches_price" class="form-control " value="{{old('purches_price')}}" required>
                            </div>
                            {{-- <div class="form-group col-md-4">
                                <label>@lang('site.sale_price')</label>
                                <input  type="number" name="sale_price" class="form-control " value="{{ old('sale_price') }}" required>
                            </div> --}}
                            <div class="form-group col-md-4">
                                <label>@lang('site.stock')</label>
                                <input  type="number" name="stock" class="form-control " value="{{ old('stock') }}" >
                            </div>
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
