<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{  Auth::user()->image_path }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->email }}  </p>
                <a href="#"><i class="fa fa-circle text-success"></i> </a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa  fa-tachometer"></i><span>@lang('site.dashboard')</span></a></li>

            @if (auth()->user()->hasPermission('categories-read'))
                <li><a href="{{ route('dashboard.categories.index') }}"><i class="ion ion-bag"></i><span>@lang('site.categories')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('products-read'))
                <li><a href="{{ route('dashboard.products.index') }}"> <i class="ion ion-stats-bars"></i></i><span>@lang('site.products')</span></a></li>
            @endif

            {{-- @if (auth()->user()->hasPermission('commande-read'))
                <li><a href="{{ route('dashboard.Commande.commande') }}"> <i class="ion ion-stats-bars"></i></i><span>@lang('site.products')</span></a></li>
            @endif --}}


            @if (auth()->user()->hasPermission('clients-read'))
                <li><a href="{{ route('dashboard.clients.index') }}"><i class="fa fa-user"></i><span>@lang('site.clients')</span></a></li>
            @endif

            {{-- @if (auth()->user()->hasPermission('clients-read'))
                <li><a href="{{ route('dashboard.bon.index') }}"><i class="fa fa-user"></i><span>@lang('site.clients')</span></a></li>
            @endif --}}

            @if (auth()->user()->hasPermission('orders-read'))
                <li><a href="{{ route('dashboard.orders.index') }}"><i class="fa fa-th"></i><span>@lang('site.orders')</span></a></li>
            @endif

            {{-- @if (auth()->user()->hasPermission('sidi-read'))
                <li><a href="{{ route('dashboard.sidi.index') }}"><i class="fa fa-th"></i><span>@lang('site.co')</span></a></li>
            @endif    --}}


             @if (auth()->user()->hasPermission('invoices-read'))
                <li><a href="{{ route('dashboard.invoices.index') }}"><i class="fa fa-th"></i><span>@lang('site.co')</span></a></li>
            @endif    

            @if (auth()->user()->hasPermission('users-read'))
                <li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-users"></i><span>@lang('site.users')</span></a></li>
            @endif


             @if (auth()->user()->hasPermission('employe-read'))
                <li><a href="{{ route('dashboard.employe.index') }}"><i class="fa  fa-suitcase"></i><span>@lang('site.Employe')</span></a></li>
            @endif
            {{--<li><a href="{{ route('dashboard.categories.index') }}"><i class="fa fa-book"></i><span>@lang('site.categories')</span></a></li>--}}
            {{----}}
            {{----}}
            {{--<li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-users"></i><span>@lang('site.users')</span></a></li>--}}

            {{--<li class="treeview">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-pie-chart"></i>--}}
            {{--<span>الخرائط</span>--}}
            {{--<span class="pull-right-container">--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--<ul class="treeview-menu">--}}
            {{--<li>--}}
            {{--<a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</li>--}}
        </ul>

    </section>

</aside>