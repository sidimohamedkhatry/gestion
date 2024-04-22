@extends('layouts.dashboard.app')

@section('title')
   @lang('site.edit_info')
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-users"></i> @lang('site.Employe')
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard') </a>
                </li>
                <li class="active"><a href="{{ route('dashboard.employe.index') }}"><i class="fa fa-users"></i>
                        @lang('site.Employe') </a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-edit"></i> @lang('site.edit_info')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.employe.update',$employe->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="form-group col-md-4">
                            <label>@lang('site.name')</label>
                            <input type="text" name="name" class="form-control" value="{{ $employe->name}}">
                        </div>
                        <!-- Debit prenom -->
                            <div class="form-group col-md-4">
                                <label>@lang('site.prenom')</label>
                                <input type="text" name="prenom" class="form-control" placeholder="@lang('site.prenom')" value="{{ $employe->prenom}}">
                            </div>
                        <div class="form-group col-md-4">
                             <label>@lang('site.Telephone')</label>
                            <input type="text" name="Telephone" class="form-control" value="{{ $employe->telephone}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label>@lang('site.salaire')</label>
                            <input type="text" name="salaire" id="salaire" class="form-control" value="{{ $employe->salaire}}">
                        </div>


                        <div class="form-group col-md-4">
                            <label>@lang('site.avance')</label>
                            <input type="text" name="avance" id="avance" class="form-control" value="{{ $employe->avance}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label>@lang('site.reste')</label>
                            <input type="text" name="reste" id="reste" class="form-control" value="{{ $employe->reste}}" readonly>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>@lang('site.image')</label>
                                <input  type="file" name="image" class="form-control image">
                            </div>
    
                            <div class="form-group col-md-6">
                                <img src="{{ $employe->image_path }}" style="width: 100px"
                                    class="img-thumbnail image-preview" alt="">
                            </div>
                        </div>

                        <div class="form-group">
                                                <label class="col-md-2 control-label">Objet de Dépense</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" name="status" rows="5" value="">{{ $employe->status}}</textarea>
                                                </div>
                                            </div>
                        



                        {{-- <div class="row">
                            <div class="form-group col-md-6">
                                <label>@lang('site.image')</label>
                                <input  type="file" name="image" class="form-control image">
                            </div>
    
                            <div class="form-group col-md-6">
                                <img src="{{ $client->image_path }}" style="width: 100px"
                                    class="img-thumbnail images-preview" alt="">
                            </div>
                        </div> --}}

                        
                       

                        <div class="form-group col-md-12" >
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                                @lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->
        </section>
    </div>


    <script>
  $(document).ready(function(){

      $("#salaire, #avance").keyup(function(){
          var total = 0;
          var x = Number($("#salaire").val());
          var y = Number($("#avance").val());
          var total = x - y;
          $('#reste').val(total);

      });

  });
</script>
@endsection
