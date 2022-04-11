@extends('layouts.dashboard.app')
@section('title')
   @lang('site.categories')
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                 <i class="ion ion-bag"></i>  @lang('site.categories')
            </h1>

            <ol class="breadcrumb">
                <li ><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard') </a></li>
                <li class="active"> <i class="ion ion-bag"></i> @lang('site.categories') </li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">
                
                <div class="box-header with-border" style="margin-bottom:10px ">
                    <h3 class="box-title"> <i class="ion ion-bag"></i> @lang('site.categories') <small><mark>{{ $categories->count() }}</mark> </small></h3>
                    <form action="{{ route('dashboard.categories.index') }}" method="GET" style="margin-top:10px;" autocomplete="off">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-search"></li> @lang('site.search')</button>
                               @if(auth()->user()->hasPermission('categories-create'))
                                    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> @lang('site.add_category')   </a>

                               @else
                               <a href="#" class="btn btn-primary btn-sm disabled"><i class="fa fa-plus"></i> @lang('site.add_category')   </a>
                               @endif
                            </div>
                        </div>
                    </form>


                </div><!-- end of box header -->
                <div class="box-body">
                  @if ($categories->count() > 0)
                  <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>@lang('site.name')</td>
                            <td>@lang('site.products')</td>
                            <td>@lang('site.related_products')</td>
                            <td>@lang('site.action')</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index=>$cat )
                            <tr>
                                <td>{{ $index +1}}</td>
                                <td>{{ $cat->name }}</td>
                                <td>{{ $cat->products->count() }}</td>
                                <td><a href="{{ route('dashboard.products.index',['category_id' => $cat->id]) }}" class="btn btn-info btn-sm">@lang('site.related_products')</a></td>
                                <td>
                                   @if (auth()->user()->hasPermission('categories-update'))
                                        <a href="{{ route('dashboard.categories.edit', $cat->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>

                                   @else
                                        <button class="btn btn-info btn-sm disabled"><i class="fa fa-edit"> @lang('site.edit')</button>
                                   @endif
                                  @if (auth()->user()->hasPermission('categories-delete'))
                                        <form action="{{ route('dashboard.categories.destroy',$cat->id) }}" method="post" style="display: inline;">
                                            @csrf
                                           @method('delete')
                                            <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash "></i>@lang('site.delete')</button>
                                        </form>
                                  @else
                                        <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash "></i>@lang('site.delete')</button>

                                  @endif
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>   <!-- end of table  -->

                {{ $categories->links() }}
                
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

