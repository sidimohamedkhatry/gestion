@extends('layouts.dashboard.sidi')
@section('title')
   @lang('site.add_order')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-list"></i> @lang('site.co')
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard') </a>
                </li>
                <li class="active"><a href="{{ route('dashboard.invoices.index') }}"><i class="fa fa-users"></i>
                        @lang('site.co') </a></li>
                <li class="active"><i class="fa fa-user"></i> @lang('site.add_order1')</li>
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

                            <h3 class="box-title">@lang('site.co')</h3>

                        </div><!-- end of box header -->

                        <div class="box-body">
                           <!-- Form Facture-->
                            <form action="{{ route('dashboard.invoices.store', $client->id) }}" method="post">
                               @csrf

                                @include('partials._errors')
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>@lang('site.product')</th>
                                        <th>@lang('site.stock')</th>
                                    </tr>
                                    </thead>

                                    <tbody class="order-l">
                                      
                                        
                                    </tbody>

                                </table><!-- end of table -->


                                <button class="btn btn-primary btn-block " id="add-order-form-btn"><i class="fa fa-plus"></i> @lang('site.add_order1')</button>

                            </form>
                          <!-- End Form Facture-->
                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                    {{-- @if ($client->orders->count() > 0) --}}

                        <div class="box box-primary">

                            <div class="box-header">

                                <h3 class="box-title" style="margin-bottom: 10px">@lang('site.previous_orders')
                                    <small>1</small>
                                </h3>

                            </div><!-- end of box header -->
                       <!-- Place Order -->
                            <div class="box-body">

                                {{-- @foreach ($orders as $order) --}}
                                    

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

@section('scripts')
    <script>
   $(document).ready(function () {
    
    //add product btn
    $('.add-product-btn').on('click', function (e) {
      e.preventDefault();
        var name = $(this).data('name');
        var id = $(this).data('id');
        //var price = $.number($(this).data('price'), 2);
        $(this).removeClass('btn-success').addClass('btn-default ');
        var html =
           `<tr>
                <td>${name}</td>
                <td><input type="number" name="products[${id}][quantity]" " class="form-control input-sm product-quantity" min="1" value="1"></td>
                <td class="product-price"></td>               
                <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
          </tr>`;
      

        $('.order-l').append(html);

        //to calculate total price
        calculateTotal();
    });

    //disabled btn
    $('body').on('click', '.', function(e) {

        e.preventDefault();

    });//end of disabled

    //remove product btn
    $('body').on('click', '.remove-product-btn', function(e) {

        e.preventDefault();
        var id = $(this).data('id');

        $(this).closest('tr').remove();
        $('#product-' + id).removeClass('btn-default ').addClass('btn-success');

        //to calculate total price
        calculateTotal();

    });//end of remove product btn

    //change product quantity
   // $('body').on('keyup change', '.product-quantity', function() {

       // var quantity = Number($(this).val()); //2
        //var unitPrice = parseFloat($(this).data('price').replace(/,/g, '')); //150
        //console.log(unitPrice);
       // $(this).closest('tr').find('.product-price').html($.number(quantity * unitPrice, 2));
        //calculateTotal();

   // });//end of product quantity change

    //list all order products
    //$('.order-products').on('click', function(e) {

       // e.preventDefault();

       // $('#loading').css('display', 'flex');
        
        //var url = $(this).data('url');
        //var method = $(this).data('method');
        //$.ajax({
         //   url: url,
          //  method: method,
           // success: function(data) {

             //   $('#loading').css('display', 'none');
              //  $('#order-product-list').empty();
              //  $('#order-product-list').append(data);

           // }
       // })

   // });//end of order products click

    //print order
    $(document).on('click', '.print-btn', function() {

        $('#print-area').printThis();

    });//end of click function

});
   </script> 
@endsection