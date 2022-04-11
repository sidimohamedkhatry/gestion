@extends('layouts.dashboard.app')
@section('title')
    @lang('site.products')
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
                <li class="active"><i class="ion ion-stats-bars"></i> @lang('site.products') </li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">

                <div class="box-header with-border" style="margin-bottom:10px ">
                    <h3 class="box-title"><i class="ion ion-stats-bars"></i> @lang('site.products')
                        <small><mark>{{ $products->count() }}</mark></small>
                    </h3>
                    <form action="{{ route('dashboard.products.index') }}" method="GET" style="margin-top:10px;"
                        autocomplete="off">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>
                            <div class="col-md-4">
                                <select name="category_id" class="form-control" id="">
                                    <option value="" selected disabled>@lang('site.all_categories')</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ request()->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <li class="fa fa-search"></li> @lang('site.search')
                                </button>
                                @if (auth()->user()->hasPermission('products-create'))
                                    <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary btn-sm"><i
                                            class="fa fa-plus"></i> @lang('site.add_product') </a>

                                @else
                                    <a href="#" class="btn btn-primary btn-sm disabled"><i class="fa fa-plus"></i>
                                        @lang('site.add_product') </a>
                                @endif
                                <a href="{{ url('dashboard/export_product') }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-pencil"></i>
                                    @lang('site.excel')</a>
                            </div>
                        </div>
                    </form>


                </div><!-- end of box header -->
                <div class="box-body">
                    @if ($products->count() > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Code</td>
                                    <td>@lang('site.name')</td>
                                    <td>@lang('site.image')</td>
                                    <td>@lang('site.purches_price')</td>
                                    {{-- <td>@lang('site.sale_price')</td>
                            <td>@lang('site.profit_percent')</td> --}}
                                    <td>@lang('site.stock')</td>

                                    <td>@lang('site.action')</td>
                                </tr>
                            </thead>
                            <tbody>
                            
                                @foreach ($products as $index => $product)
                                
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $product->num_produitt }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td><img src="{{ $product->image_path }}" alt="" style="width: 50px"></td>
                                        <td>{{ $product->purches_price }}</td>
                                        {{-- <td>{{ $product->sale_price }}</td>
                                <td><mark>{{ $product->profit_percent }}%</mark></td> --}}
                                        <td>{{ $product->stock }}</td>

                                        <td>
                                            @if (auth()->user()->hasPermission('products-update'))
                                                <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                                    class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                                    @lang('site.edit')</a>

                                            @else
                                                <button class="btn btn-info btn-sm disabled"><i class="fa fa-edit">
                                                        @lang('site.edit')</button>
                                            @endif
                                            @if (auth()->user()->hasPermission('products-delete'))
                                                <form action="{{ route('dashboard.products.destroy', $product->id) }}"
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

                        {{ $products->links() }}

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
