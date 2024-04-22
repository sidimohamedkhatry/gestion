@extends('layouts.dashboard.app')
@section('title')
   @lang('site.add_employe')
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-users"></i> @lang('site.Employe')
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard') </a>
                </li>
                <li class="active"><a href="{{ route('dashboard.clients.index') }}"><i class="fa fa-users"></i>
                        @lang('site.Employe') </a></li>
                <li class="active"><i class="fa fa-user"></i> @lang('site.add_employe')</li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.add_employe')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.employe.store') }}" method="post" enctype="multipart/form-data" >
                        @csrf

                        <div class="row" >
                        <!-- Debit name-->
                            <div class="form-group col-md-4">
                                <label>@lang('site.name')</label>
                                <input type="text" name="name" class="form-control" placeholder="@lang('site.name')" value="{{ old('name') }}">
                            </div>
                            <!-- Debit prenom -->
                            <div class="form-group col-md-4">
                                <label>@lang('site.prenom')</label>
                                <input type="text" name="prenom" class="form-control" placeholder="@lang('site.prenom')" value="{{ old('prenom') }}">
                            </div>
                             <!-- Debit telephone -->
                            <div class="form-group col-md-4">
                                <label>@lang('site.Telephone')</label>
                                <input type="text" name="telephone" class="form-control" placeholder="@lang('site.Telephone')" value="{{ old('telephone') }}">
                            </div>
                             <!-- Debit salaire -->
                            <div class="form-group col-md-4">
                                <label for="inputName">@lang('site.salaire')</label>
                                <input type="text" name="salaire" id="salaire" step="0.01" class="salaire form-control">
                            </div>
                            <!-- Debit avance -->
                            <div class="form-group col-md-4">
                                <label for="inputName">@lang('site.avance')</label>
                                <input type="text" name="avance" id="avance" step="0.01" class=" avance form-control">
                            </div>

                            <!-- Debit avance -->
                            <div class="form-group col-md-4">
                                <label for="inputName">@lang('site.reste')</label>
                                <input type="text" name="reste" id="reste"  class=" reste form-control" readonly>
                            </div>

                            


                            <div class="row">
                            <div class="form-group col-md-6">
                                <label>@lang('site.image')</label>
                                <input  type="file" name="image" class="form-control image">
                            </div>
    
                            <div class="form-group col-md-6">
                                <img src="{{ asset('uploads/employe_images/defualt.png') }}" style="width: 100px"
                                    class="img-thumbnail image-preview" alt="">
                            </div>

                                          <div class="form-group">
                                                <label class="col-md-2 control-label">Objet de Dépense</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" name="status" rows="5"></textarea>
                                                </div>
                                            </div>

                             {{-- <div class="form-group col-md-3">
                                <label>@lang('site.image')</label>
                                <input  type="file" name="image" class="form-control image">
                            </div>
                            <div class="form-group col-md-3">
                                <img src="{{ asset('uploads/client_images/user.png') }}" style="width: 100px"
                                    class="img-thumbnail images-preview" alt="">
                            </div> --}}
    
                            
                        </div>


                        <div class="row">
                            
                        </div>

                        

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                @lang('site.add')</button>
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


 






