<div id="print-area">
    <div class="row">
        <div class="col-sm-6">
       
        <h6>@lang('site.prand2') :<td>{{ $order->created_at->toFormattedDateString() }}</td>  </span></h6>
            <h6>@lang('site.user') : <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </span></h6>
        </div>
        <div class="col-sm-6">
            <h6>@lang('site.prand') : Mjk Traiter </span></h6>
             <h6>@lang('site.prand1') : {{ $order->client->name }} </span></h6>
        </div>
    </div>
    <table class="table table-hover table-bordered">

        <thead>
        <tr>
            <th>@lang('site.name')</th>
            <th>@lang('site.stock')</th>
        </tr>
        </thead>

        <tbody>
        
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->quantity }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>

<button class="btn btn-block btn-primary print-btn"><i class="fa fa-print"></i> @lang('site.print')</button>
