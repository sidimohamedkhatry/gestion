@extends('layouts.dashboard.app')

@section('title')
    @lang('site.dashboard')
@endsection

@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1><i class="fa fa-dashboard"></i> @lang('site.dashboard')</h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                {{-- Début categories --}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $categories_count }}</h3>

                            <p>@lang('site.total_categories')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('dashboard.categories.index') }}" class="small-box-footer">@lang('site.read') <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                {{-- Fin Catégories --}}

                {{-- products --}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $products_count }}</h3>

                            <p>@lang('site.total_produit')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('dashboard.products.index') }}" class="small-box-footer">@lang('site.read') <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- clients --}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>
                             {{number_format(\App\Models\Order::sum('total_price'), 2)}} MRU                            
                            </h3>

                            <p>@lang('site.To')</p>
                        </div>
                        <div class="icon">
                            <i class="ion  ion-cash "></i>
                        </div>
                        <a href="{{ route('dashboard.orders.index') }}" class="small-box-footer">@lang('site.read') <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- users --}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $users_count }}</h3>

                            <p>@lang('site.users')</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('dashboard.users.index'), $users_count }}"
                            class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div><!-- end of row -->
          
            

            <div class="box box-solid">
               
                <div class="box-header">
                    <h3 class="box-title">Sales Graph</h3>
                </div>
                <div class="box-body border-radius-none">
                    <div class="chart" id="line-chart1" style="height: 250px;"></div>
                </div>
            </div>



            <div class="box box-solid">

                <div class="box-header">
                    <h3 class="box-title" style="color:green">MJK TRAITER</h3>
                </div>
                <div class="box-body border-radius-oui">
                    <div class="chart" id="line-chart" style="height: 50px;">
                        <h4 style="color:red">@lang('site.gestion')<h4>
                    </div>
                </div>

            </div>

        </section><!-- end of content -->
    </div><!-- end of content wrapper -->

    
@endsection

@section ('scripts')

    <script>
        //line chart
        var line = new Morris.Line({
            element: 'line-chart1',
            resize: true,
            data: [
                @foreach ($sales_data as $data)
                    {
                    ym: "{{ $data->year }}-{{ $data->month }}", sum: "{{ $data->sum }}"
                    },
                @endforeach
            ],
            xkey: 'ym',
            ykeys: ['sum'],
            labels: ['@lang('
                site.total ')'
            ],
            lineWidth: 2,
            hideHover: 'auto',
            gridStrokeWidth: 0.4,
            pointSize: 4,
            gridTextFamily: 'Open Sans',
            gridTextSize: 10
        });
    </script> 

@endsection
