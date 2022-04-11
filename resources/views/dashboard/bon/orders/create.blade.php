@extends('layouts.dashboard.app')
@section('title')
   @lang('site.add_order')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-list"></i> @lang('site.orders')
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard') </a>
                </li>
                <li class="active"><a href="{{ route('dashboard.clients.index') }}"><i class="fa fa-users"></i>
                        @lang('site.orders') </a></li>
                <li class="active"><i class="fa fa-user"></i> @lang('site.add_order')</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">

                <div class="col-md-4">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.categories')</h3>

                        </div><!-- end of box header -->

                        <div class="box-body">
                         <!-- Star Form Catégory -->
                             @foreach ($categories as $category) 
                                
                                <div class="panel-group">

                                    <div class="panel panel-info">

                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#{{ str_replace(' ', '-', $category->name) }}">{{ $category->name }}</a>
                                            </h4>
                                        </div>

                                        <div id="{{ str_replace(' ', '-', $category->name) }}" class="panel-collapse collapse">

                                            <div class="panel-body">

                                         @if ($category->products->count() > 0) 

                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>@lang('site.name')</th>
                                                            <th>@lang('site.stock')</th>
                                                            <th>@lang('site.add')</th>
                                                        </tr>

                                                 @foreach ($category->products as $product) 
                                                            <tr>
                                                                <td>{{ $product->name }}</td>
                                                                <td>{{ $product->stock }}</td>
                                                                <td>
                                                                     <a href=""
                                                                       id="product-{{ $product->id }}"
                                                                       data-name="{{ $product->name }}"
                                                                       data-id="{{ $product->id }}"
                                                                       class="btn btn-success btn-sm add-product-btn">
                                                                        <i class="fa fa-plus"></i>
                                                                    </a> 
                                                                </td>
                                                            </tr>
                                                         @endforeach 

                                                    </table><!-- end of table -->

                                                 @else 
                                                <div class="text-center alert alert-warning">
                                                    <h5>@lang('site.no_data_found')</h5>
                                                </div>
                                                    
                                                 @endif 

                                            </div><!-- end of panel body -->

                                        </div><!-- end of panel collapse -->

                                    </div><!-- end of panel primary -->

                                </div><!-- end of panel group -->

                             @endforeach 

                        </div><!-- end Form Category-->

                    </div><!-- end of box -->

                </div><!-- end of col -->

                <div class="col-md-8">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title">@lang('site.orders')</h3>

                        </div><!-- end of box header -->

                        <div class="box-body">
                           <!-- Form Facture-->
                            <form action="{{ route('dashboard.bon.orders.store') }}" method="post">

                                <input  type="text" id="sd" name="sd">

                                @include('partials._errors')
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>@lang('site.product')</th>
                                        <th>@lang('site.stock')</th>
                                    </tr>
                                    </thead>

                                    <tbody class="order-list">


                                    </tbody>

                                </table><!-- end of table -->


                                <button class="btn btn-primary btn-block " id="add-order-form-btn"><i class="fa fa-plus"></i> @lang('site.add_order')</button>

                            </form>
                          <!-- End Form Facture-->
                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                    {{-- @if ($client->orders->count() > 0) --}}

                        <div class="box box-primary">

                            <div class="box-header">

                                <h3 class="box-title" style="margin-bottom: 10px">@lang('site.previous_orders')
                                    <small>Order</small>
                                </h3>

                            </div><!-- end of box header -->
                       <!-- Place Order -->
                            <div class="box-body">

                                {{-- @foreach ($orders as $order) --}}
                                    <div class="panel-group">

                                        <div class="panel panel-success">

                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#">d</a>
                                                </h4>
                                            </div>

                                            <div id="#" class="panel-collapse collapse">

                                                <div class="panel-body">

                                                    <ul class="list-group">
                                                        {{-- @foreach ($order->products as $product) --}}
                                                            <li class="list-group-item">name </li>
                                                        {{-- @endforeach --}}
                                                    </ul>

                                                </div><!-- end of panel body -->

                                            </div><!-- end of panel collapse -->

                                        </div><!-- end of panel primary -->

                                    </div><!-- end of panel group -->
                                    <!-- Place Order -->
                                {{-- @endforeach --}}

                                {{-- {{ $orders->links() }} --}}

                            </div><!-- end of box body -->

                        </div><!-- end of box -->

                    {{-- @endif --}}

                </div><!-- end of col -->

            </div><!-- end of row -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
