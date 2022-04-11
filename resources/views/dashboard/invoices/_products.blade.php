<div id="print-area">
    <div class="row">
        <div class="col-sm-6">
            <h6 style="text-align:Left">@lang('site.num_fa') : {{ $order->num_fa }} </span></h6>


            <h6 style="text-align:right; font-size:12px">@lang('site.prand2') :<td>
                    {{ $order->created_at->toFormattedDateString() }}</td> </span></h6>
            <h6>@lang('site.user') : <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </span></h6>
        </div>
        <div class="col-sm-6">
            <h6>@lang('site.prand') : Mjk Traiter </span></h6>
            <h6 style="text-align:right">@lang('site.prand1') : {{ $order->client->name }} </span></h6>
        </div>
    </div>
    <table class="table table-hover table-bordered">

        <thead>
            <tr>
                <th>@lang('#')</th>
                <th>@lang('site.code')</th>
                <th>@lang('site.name')</th>
                <th>@lang('site.stock')</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->num_produitt }}</td>


                    <td>{{ $product->name }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                </tr>
            @endforeach

        </tbody>

    </table>

    <h6 style="text-align:center;font-size:18px">@lang('site.signature') </span></h6>



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
