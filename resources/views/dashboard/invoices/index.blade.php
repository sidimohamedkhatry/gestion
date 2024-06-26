@extends('layouts.dashboard.sidi')
@section('title')
    @lang('site.co')
@endsection
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.co')
                <small>12 @lang('site.co')</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li class="active">@lang('site.co')</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                <div class="col-md-8">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.co')</h3>

                            <form action="{{ route('dashboard.invoices.index') }}" method="get">

                                <div class="row">

                                    <div class="col-md-8">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="@lang('site.search')" value="{{ request()->search }}">
                                    </div>

                                    

                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                            @lang('site.search')</button>

                                           <a href="{{url('dashboard/export_order')}}"
                                                        class="btn btn-primary"><i class="fa fa-pencil"></i>
                                                        @lang('site.excel')</a>

                                             
                                    </div>
                                                      

                                </div><!-- end of row -->

                            </form><!-- end of form -->

                        </div><!-- end of box header -->

                         @if ($orders->count() > 0) 
                            <div class="box-body table-responsive">

                                <table class="table table-hover">
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('site.client_name')</th>
                                        {{-- <th>@lang('site.status')</th> --}}
                                        <th>@lang('site.created_by')</th>
                                        <th>@lang('site.created_at')</th>
                                        
                                        <th>@lang('site.action')</th>
                                    </tr>

                                    {{-- @foreach ($orders as $index => $order) --}}
                                        <tr>
                                         @foreach ($orders as $index => $order)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $order->client->name }}</td>
                                            <td>{{Auth::user()->first_name }} {{ Auth::user()->last_name }}</td>
                                            {{-- <td> --}}
                                            {{-- <button --}}
                                            {{-- data-status="@lang('site.' . $order->status)" --}}
                                            {{-- data-url="{{ route('dashboard.orders.update_status', $order->id) }}" --}}
                                            {{-- data-method="put" --}}
                                            {{-- data-available-status='["@lang('site.processing')", "@lang('site.finished') "]' --}}
                                            {{-- class="order-status-btn btn {{ $order->status == 'processing' ? 'btn-warning' : 'btn-success disabled' }} btn-sm" --}}
                                            {{-- > --}}
                                            {{-- @lang('site.' . $order->status) --}}
                                            {{-- </button> --}}
                                            {{-- </td> --}}
                                            <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm order-products"
                                                    data-url="{{ route('dashboard.invoices.products', $order->id) }}"
                                                    data-method="get">
                                                    <i class="fa fa-list"></i>
                                                    @lang('site.show')
                                                </button>
                                            <td>
                                                {{-- <button class="btn btn-primary btn-sm order-products"
                                                    data-url=""
                                                    data-method="get">
                                                    <i class="fa fa-list"></i>
                                                    @lang('site.show')
                                                </button> --}}
                                                {{-- @if (auth()->user()->hasPermission('orders-update'))
                                                    <a href="{{ route('dashboard.clients.orders.edit', ['client' => $order->client->id, 'order' => $order->id]) }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>
                                                        @lang('site.edit')</a>
                                                @else
                                                    <a href="#" disabled class="btn btn-warning btn-sm"><i
                                                            class="fa fa-edit"></i> @lang('site.edit')</a>
                                                @endif --}}

                                                 @if (auth()->user()->hasPermission('orders-delete'))
                                                    <form action="{{ route('dashboard.orders.destroy', $order->id) }}"
                                                        method="post" style="display: inline-block;">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm delete"><i
                                                                class="fa fa-trash"></i> @lang('site.delete')</button>
                                                    </form>

                                                @else
                                                    <a href="#" class="btn btn-danger btn-sm" disabled><i
                                                            class="fa fa-trash"></i> @lang('site.delete')</a>
                                                @endif

                                            </td>

                                        </tr>
                                    @endforeach 
                                  
                                </table><!-- end of table -->
                                   
                                {{-- {{ $orders->appends(request()->query())->links() }} --}}

                            </div>

                         @else 

                             <div class="box-body alert alert-warning text-center">
                                <h3>@lang('site.no_data_found')</h3>
                            </div> 
                         @endif 
                      
                    </div><!-- end of box -->

                </div><!-- end of col -->

                <div class="col-md-4">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.show-command')</h3>
                        </div><!-- end of box header -->


                        <div class="box-body">

                            <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                                <div class="loader "></div>
                                <p style="margin-top: 10px">@lang('site.loading')</p>
                            </div>

                            <div id="order-product-list">

                            </div><!-- end of order product list -->

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                </div><!-- end of col -->

            </div><!-- end of row -->

        </section><!-- end of content section -->

    </div><!-- end of content wrapper -->
@endsection


