@extends('layouts.dashboard.app')
@section('title')
   @lang('site.edit_order')
@endsection
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.edit_order')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.clients.index') }}">@lang('site.clients')</a></li>
                <li class="active">@lang('site.edit_order')</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

               

                <div class="col-md-8">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title">@lang('site.orders')</h3>

                        </div><!-- end of box header -->

                        <div class="box-body">

                            @include('partials._errors')

                            <form action="" method="post">
                                
                               @csrf
                              @method('put')

                         
                                <table class="table table-hover">
                                <label>@lang('site.num_fa')</label>
                                <input type="text" name="num_fa" class="form-control" value="0" required>
                                    <thead>
                                    <tr>
                                        <th>@lang('site.product')</th>
                                        <th>@lang('site.stock')</th>
                                        <th>@lang('site.price')</th>
                                    </tr>
                                    </thead>
                                    <tbody class="order-list">
                                     {{-- @foreach ($order->products as $product) --}}

                                        <tr>
                                             
                                            <td>n</td>
                                            <td><input type="number" name="n" data-price="0" class="form-control input-sm product-quantity" min="1" value="0"></td>
                                            <td class="product-price">0</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm remove-product-btn" data-id="d"><span class="fa fa-trash"></span></button>
                                            </td>
                                        </tr>
                                     {{-- @endforeach --}}

                                    </tbody>

                                 

                                </table><!-- end of table -->

                                <h4>@lang('site.total') : <span class="total-price">000</span></h4>

                                <button class="btn btn-primary btn-block" id="form-btn"><i class="fa fa-edit"></i> @lang('site.edit_order')</button>

                            </form><!-- end of form -->

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                  

                </div><!-- end of col -->

            </div><!-- end of row -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
