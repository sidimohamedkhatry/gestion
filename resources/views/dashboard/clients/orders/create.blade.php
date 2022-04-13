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
                                                            <th>@lang('site.price')</th>
                                                            <th>@lang('site.add')</th>
                                                        </tr>

                                                        @foreach ($category->products as $product)
                                                            <tr>
                                                                <td>{{ $product->name }}</td>
                                                                <td>{{ $product->stock }}</td>
                                                                <td>{{ number_format($product->purches_price, 2) }}</td>
                                                                <td>
                                                                    <a href=""
                                                                       id="product-{{ $product->id }}"
                                                                       data-name="{{ $product->name }}"
                                                                       data-id="{{ $product->id }}"
                                                                       data-price="{{ $product->purches_price }}"
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
                            <form action="{{ route('dashboard.clients.orders.store', $client->id) }}" method="post">
                               @csrf
                               {{-- <div class="form-group col-md-6" >
                                <label>@lang('site.categories')</label>
                                <select name="status" id="" class="form-control " required>
                                    <option value="No Payé" selected >No Payé</option> 
                                    <option value="Payé" selected >Payé</option> 
                                </select>
                            </div> --}}
                               {{-- <div class="form-group col-md-6">
                                 <label>N_Facture:</label>
                                <input type="text" name="num_fa" id="num_fa" >
                                </div> --}}
                                @include('partials._errors')
                                <table class="table table-hover">
                                   
                                    <thead>
                                    <tr>
                                        <th>@lang('site.product')</th>
                                        <th>@lang('site.stock')</th>
                                        <th>@lang('site.price')</th>
                                    </tr>
                                    </thead>

                                    <tbody class="order-list">
                                         
                                    </tbody>

                                </table><!-- end of table -->

                                <h4>@lang('site.total') : <span class="total-price">0</span> MRU </h4>
                                
                                



                                {{-- <td><input type="text" name="num_fa" id="num_fa" >N°</td> --}}

                                <button class="btn btn-primary btn-block disabled" id="add-order-form-btn"><i class="fa fa-plus"></i> @lang('site.add_order')</button>

                            </form>
                          <!-- End Form Facture-->
                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                    @if ($client->orders->count() > 0)

                        <div class="box box-primary">

                            <div class="box-header">

                                <h3 class="box-title" style="margin-bottom: 10px">@lang('site.previous_orders')
                                    <small>{{ $orders->count() }}</small>
                                </h3>

                            </div><!-- end of box header -->
                       <!-- Place Order -->
                            <div class="box-body">

                                @foreach ($orders as $order)
                                    <div class="panel-group">

                                        <div class="panel panel-success">

                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#{{ $order->created_at->format('d-m-Y-s') }}">{{ $order->created_at->toFormattedDateString() }}</a>
                                                </h4>
                                            </div>

                                            <div id="{{ $order->created_at->format('d-m-Y-s') }}" class="panel-collapse collapse">

                                                <div class="panel-body">

                                                    <ul class="list-group">
                                                        @foreach ($order->products as $product)
                                                            <li class="list-group-item">{{ $product->name }} </li>
                                                        @endforeach
                                                    </ul>

                                                </div><!-- end of panel body -->

                                            </div><!-- end of panel collapse -->

                                        </div><!-- end of panel primary -->

                                    </div><!-- end of panel group -->
                                    <!-- Place Order -->
                                @endforeach

                                {{-- {{ $orders->links() }} --}}

                            </div><!-- end of box body -->

                        </div><!-- end of box -->

                    @endif

                </div><!-- end of col -->

            </div><!-- end of row -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->



    <script>
        $(document).ready(function() {
            $('select[name="statuts"]').on('change', function() {
                var statuts = $(this).val();
                if (statuts) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + statuts,
                        type: "POST",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="status"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="status"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });

    </script>

@endsection
