<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    @php
        $setting = App\Models\Setting::find(1);
    @endphp 
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset($setting->favicon)}}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3 ') }}" />
</head>

<body>
    <div class="invoice invoice-content invoice-3">
        <div class="back-top-home hover-up mt-30 ml-30">
            <a class="hover-up" href="{{ route('home') }}"><i class="fi-rs-home mr-5"></i> Homepage</a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-inner">
                        <div class="invoice-info" id="invoice_wrapper">
                            <div class="invoice-header">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="invoice-name">
                                            <div class="logo w-50">
                                                <a href="{{route('home')}}">
                                                    @php
                                                        $logo = get_setting('site_footer_logo');
                                                    @endphp
                                                    @if($logo != null)
                                                        <img src="{{ asset(get_setting('site_footer_logo')->value ?? 'null') }}" alt="{{ env('APP_NAME') }}">
                                                    @else
                                                        <img src="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}" style="height: 60px !important; width: 80px !important; min-width: 80px !important;">
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-sm-6  text-end">
                                        <div class="invoice-numb">
                                            <h4 class="invoice-header-1 mb-10 mt-20">Invoice No:<span class="text-heading">{{ $order->invoice_no }}</span></h4>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="invoice-top">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="invoice-number">
                                            <h4 class="invoice-title-1 mb-10">Invoice To</h4>
                                            <p class="invoice-addr-1 text-capitalize">
                                                <strong>{{ get_setting('business_name')->value ?? 'Null'}}</strong> <br />
                                                {{ get_setting('business_address')->value ?? 'Null'}}<br>
                                                <abbr title="Phone">Phone:</abbr> {{ get_setting('phone')->value ?? 'Null'}}<br>
                                                <abbr title="Email">Email: </abbr>{{ get_setting('email')->value ?? 'Null'}}<br>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="invoice-number">
                                            <h4 class="invoice-title-1 mb-10">Bill To</h4>
                                            <p class="invoice-addr-1 text-capitalize">
                                                <strong>{{ $order->user->name ?? 'NULL' }}</strong> <br />
                                                {{ $order->address ?? 'NULL' }}<br>
                                                {{ $order->upazilla->name_en ?? 'NULL' }}, {{ $order->district->district_name_en ?? 'NULL' }}, {{ $order->division->division_name_en ?? 'NULL' }}<br>
                                                <abbr title="Phone">Phone:</abbr> {{ $order->user->phone }}<br>
                                                <abbr title="Email">Email: </abbr>{{ $order->user->email }}<br>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="invoice-number">
                                            <h4 class="invoice-title-1 mb-10">Overview</h4>
                                            <p class="invoice-addr-1 text-capitalize ">
                                                <strong>Invoice Data:</strong> {{ \Carbon\Carbon::parse($order->date)->isoFormat('MMM Do YYYY')}}<br />
                                                <strong>Payment Method:</strong> {{ $order->payment_method }}<br />
                                                <strong>Status:</strong> <span class="text-brand">{{ $order->delivery_status }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-center">
                                <div class="table-responsive">
                                    <table class="table table-striped invoice-table">
                                        <thead class="bg-active">
                                            <tr>
                                                <th>Item Item</th>
                                                <th class="text-center">Unit Price</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-right">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach($order->order_details as $order_detail)
                                                <tr>
                                                    <td>
                                                        <div class="item-desc-1">
                                                            <span>{{$order_detail->product->name_en ?? 'NULL'}}</span>
                                                            <span>
                                                                @if($order_detail->is_varient && count(json_decode($order_detail->variation))>0)
                                                                    @foreach(json_decode($order_detail->variation) as $varient)
                                                                        <span>{{ $varient->attribute_name }} : <span class="d-inline-block fw-normal ms-1">{{ $varient->attribute_value }}</span></span>
                                                                    @endforeach
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">{{$order_detail->
                                                    price ?? 'NULL'}}</td>
                                                    <td class="text-center">{{$order_detail->
                                                    qty ?? 'NULL'}}</td>
                                                    <td class="text-right">{{ $order->grand_total ?? 'Null' }}</td>
                                                </tr>
                                                @endforeach
                                                 <tr>
                                                    <td colspan="3" class="text-end f-w-600">SubTotal</td>
                                                    <td class="text-right">{{ $order->grand_total ?? 'NULL' }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-end f-w-600">Shipping cost:</td>
                                                    <td class="text-right">10.00</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-end f-w-600">Grand Total</td>
                                                    <td class="text-right f-w-600">{{ $order->grand_total ?? 'NULL' }}</td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="invoice-bottom">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div>
                                            <h3 class="invoice-title-1">Important Note</h3>
                                            <ul class="important-notes-list-1">
                                                <li>All amounts shown on this invoice are in BDT</li>
                                                <li>finance charge of 1.5% will be made on unpaid balances after 30 days.</li>
                                                <li>Once order done, money can't refund</li>
                                                <li>Delivery might delay due to some external dependency</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-offsite">
                                        <div class="text-end">
                                            <p class="mb-0 text-13">Thank you for your business</p>
                                            <p><strong>{{ get_setting('business_name')->value ?? 'Null'}}</strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-btn-section clearfix d-print-none">
                            <a href="javascript:window.print()" class="btn btn-lg btn-custom btn-print hover-up"> <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-print.svg') }}" alt="" /> Print </a>
                            <a id="invoice_download_btn" class="btn btn-lg btn-custom btn-download hover-up"> <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-download.svg') }}" alt="" /> Download </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->
    <script src="{{asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js ') }}"></script>
    <script src="{{asset('frontend/assets/js/vendor/jquery-3.6.0.min.js ') }}"></script>
    <!-- Invoice JS -->
    <script src="{{asset('frontend/assets/js/invoice/jspdf.min.js ') }}"></script>
    <script src="{{asset('frontend/assets/js/invoice/invoice.js ') }}"></script>
</body>

</html>