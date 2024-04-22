<div id="print-area">
    <div class="row">
        <div class="col-sm-6">
            <h6 style="text-align:left; font-size:12px">@lang('site.prand2') :<td>
                    {{ $employe->created_at->toFormattedDateString() }}</td> </span></h6>
        </div>
        <h6 style="text-align:center">N°: {{ $employe->telephone }}<h6>
                <h6 style="text-align;center">@lang('site.user') : <span>{{ Auth::user()->first_name }}
                        {{ Auth::user()->last_name }} </span></h6>
    </div>

    <table class="table table-hover table-striped table-bordered">
        <thead>
            <tr>
               <th>Image</th>
                <th>@lang('site.name')</th>
                <th>@lang('site.salaire')</th>
                <th>@lang('site.avance')</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td><img src="{{ $employe->image_path }}" alt="" style="width: 50px"></td>
                <td>{{ $employe->name }}</td>
                <td>{{ number_format($employe->salaire, 2) }} MRU</td>
                <td>{{ number_format($employe->avance, 2) }} MRU</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>@lang('site.reste') </td>
                <td><span>{{ number_format($employe->reste, 2) }} MRU</span></td>
                <td><span>{{($employe->status) }}</span></td>

            </tr>
        </tfoot>
    </table>
    <h6 style="text-align:center;font-size:18px">@lang('site.signature') </span></h6>
    <h6 style="text-align:center;font-size:18px">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6>
    <div style='text-align: left; '>
        <!-- insert your custom barcode setting your data in the GET parameter "data" -->
        <img style="height:60px" src="{{ asset('dashboard_files/img/QR Code meCard.jpg') }}" class=""
            alt="User Image">
    </div>
    <div style='padding-top:2px; text-align:center; font-size:15px; font-family: Source Sans Pro, Arial, sans-serif;'>
        <!-- back-linking to www.tec-it.com is required -->
        <!-- logos are optional -->
    </div>
</div>
<button class="btn btn-block btn-primary print-btn"><i class="fa fa-print"></i> @lang('site.print')</button>
