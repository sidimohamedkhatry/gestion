@extends('layouts.dashboard.app')
@section('title')
    @lang('site.Employe')
@endsection
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.Employe')
                <small><mark>{{ $employe->count() }}</mark></small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li class="active">@lang('site.Employe')</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                <div class="col-md-8">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.Employe')</h3>

                            <form action="{{ route('dashboard.employe.index') }}" method="GET" style="margin-top:10px;"
                                autocomplete="off">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="@lang('site.search')" value="{{ request()->search }}">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <li class="fa fa-search"></li> @lang('site.search')
                                        </button>
                                        @if (auth()->user()->hasPermission('clients-create'))
                                            <a href="{{ route('dashboard.employe.create') }}"
                                                class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                                @lang('site.add_employe') </a>
                                        @else
                                            <a href="#" class="btn btn-primary btn-sm disabled"><i
                                                    class="fa fa-plus"></i>
                                                @lang('site.add_client') </a>
                                        @endif
                                    </div>

                                </div>
                            </form><!-- end of form -->

                        </div><!-- end of box header -->

                        @if ($employe->count() > 0)
                            <div class="box-body table-responsive">

                                <table id="" class="table table-striped table-bordered">
                                    <thead style="text-aling:center; font-size:12px; font:bold; color:0000">
                                        <tr>
                                            <td>#</td>
                                            <td>Image</td>
                                            <td>@lang('site.name')</td>
                                            <td>@lang('site.prenom')</td>
                                            <td>@lang('site.Telephone')</td>
                                            <td>@lang('site.salaire')</td>
                                            <td>@lang('site.avance')</td>
                                            <td>@lang('site.reste')</td>
                                            <td>@lang('site.action')</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @if ($clients->count() > 0) --}}
                                        @foreach ($employe as $index => $employes)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td><img src="{{ $employes->image_path }}" alt="" style="width: 50px">
                                                </td>
                                                <td>{{ $employes->name }}</td>
                                                <td>{{ $employes->prenom }}</td>
                                                <td>{{ $employes->telephone }}</td>
                                                <td>{{ $employes->salaire }}</td>
                                                <td>{{ $employes->avance }}</td>
                                                <td>{{ $employes->reste }}</td>


                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary btn-sm order-products"
                                                            data-url="{{ route('dashboard.employe.products', $employes->id) }}"
                                                            data-method="get">
                                                            <i class="fa fa-list"></i>
                                                            @lang('site.show')
                                                        </button>
                                                        @if (auth()->user()->hasPermission('clients-update'))
                                                            <a href="{{ route('dashboard.employe.edit', $employes->id) }}"
                                                                class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                                                @lang('site.edit')</a>
                                                        @else
                                                            <button class="btn btn-info btn-sm disabled"><i
                                                                    class="fa fa-edit">
                                                                    @lang('site.edit')</button>
                                                        @endif
                                                        @if (auth()->user()->hasPermission('clients-delete'))
                                                            <form
                                                                action="{{ route('dashboard.employe.destroy', $employes->id) }}"
                                                                method="post" style="display: inline;">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    class="btn btn-danger delete btn-sm"><i
                                                                        class="fa fa-trash "></i>@lang('site.delete')</button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-danger btn-sm disabled"><i
                                                                    class="fa fa-trash "></i>@lang('site.delete')</button>
                                                        @endif

                                                </td>
                                            </tr>
                                        @endforeach
                            </div>
                            </tbody>
                            </table> <!-- end of table  -->




                            {{ $employe->links() }}

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
                        <h3 class="box-title" style="margin-bottom: 10px">@lang('site.Employe')</h3>
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




@section('scripts')
    <script src="{{ asset('dashboard_files/sidi/didi.min.js') }}"></script>
    <script src="{{ asset('dashboard_files/sidi/jedo.js') }}"></script>

    <script>
        var resizefunc = [];
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').dataTable();
        });
    </script>

    {{-- <script>
           
            $(document).ready(function(){

                $(document).on('click', '.page-link', function(event){

                    event.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    fetch_data(page);

                });

                function fetch_data(page){

                    var _token = $("input[name=_token]").val();


                    $.ajax({

                        url:"{{ route('orders.fetch')}}",
                        method:"POST",
                        data:{_token:_token, page:page},

                    });
                }

            });
        
        </script> --}}
@endsection
