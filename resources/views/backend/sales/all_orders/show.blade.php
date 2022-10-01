@extends('admin.admin_master')
@section('admin')

<style type="text/css">
    table, tbody, tfoot, thead, tr, th, td{
        border: 1px solid #dee2e6 !important;
    }
    th{
        font-weight: bolder !important;
    }
</style>
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Order detail</h2>
            <p>Details for Order ID: {{ $order->invoice_no?? 'Null'}}</p>
        </div>
    </div>
    <div class="card">
        <header class="card-header">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-4 mb-lg-0 mb-15">
                    <span class="text-white"> <i class="material-icons md-calendar_today"></i> <b>Wed, Aug 13, 2020, 4:34PM</b> </span> <br />
                    <small class="text-white">Order ID: {{ $order->invoice_no?? 'Null'}}</small>
                </div>
                @php
                    $payment_status = $order->payment_status;
                    $delivery_status = $order->delivery_status;
                @endphp
                <div class="col-lg-8 col-md-8 ms-auto text-md-end">
                    <select class="form-select d-inline-block mb-lg-0 mr-5 mw-200" id="update_payment_status">
                        <option value="0" @if ($payment_status == '0') selected @endif>Unpaid</option>
                        <option value="1" @if ($payment_status == '1') selected @endif>Paid</option>
                    </select>
                    @if($delivery_status != 'delivered' && $delivery_status != 'cancelled')
                    <select class="form-select d-inline-block mb-lg-0 mr-5 mw-200" id="update_delivery_status">
                        <option value="pending" @if ($delivery_status == 'pending') selected @endif>Pending</option>
                        <option value="confirmed" @if ($delivery_status == 'confirmed') selected @endif>Confirmed</option>
                        <option value="shipped" @if ($delivery_status == 'shipped') selected @endif>Shipped</option>
                        <option value="picked_up" @if ($delivery_status == 'picked_up') selected @endif>Picked Up</option>
                        <option value="on_the_way" @if ($delivery_status =='on_the_way') selected @endif>On The Way</option>
                        <option value="delivered" @if ($delivery_status == 'delivered') selected @endif>Delivered</option>
                        <option value="cancelled" @if ($delivery_status == 'cancelled') selected @endif>Cancel</option>
                    </select>
                    @else
                        <input type="text" class="form-control d-inline-block mb-lg-0 mr-5 mw-200" value="{{ $delivery_status }}" disabled>
                    @endif
                    
                    <!-- <a class="btn btn-primary" href="#">Save</a> -->
                    <a class="btn btn-secondary print ms-2" href="#" onclick="window.print();"><i class="icon material-icons md-print"></i></a>
                </div>
            </div>
        </header>
        <!-- card-header end// -->
        <div class="card-body">
            <div class="row mb-50 mt-20 order-info-wrap">
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-person"></i>
                        </span>

                       
                        <div class="text">
                            <h6 class="mb-1">Customer</h6>
                            <p class="mb-1">
                                {{ $order->user->name ?? 'Null'}} <br />
                                {{ $order->user->email ?? 'Null'}} <br />
                                {{ $order->user->phone ?? 'Null'}}
                            </p>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop1{{ $order->user_id }}">Edit Customer</a>
                        </div>
                    </article>
                </div>
                <!-- col// -->
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-local_shipping"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Order info</h6>
                            <p class="mb-1">
                                Order Id: {{ $order->invoice_no?? 'Null'}} </br>
                                Shipping: Fargo express <br />
                                Pay method: card <br />
                                Status: @php
                                            $status = $order->delivery_status;
                                            if($order->delivery_status == 'cancelled') {
                                                $status = 'Received';
                                            }

                                        @endphp
                                        {!! $status !!}
                            </p>
                            <a href="#">Download info</a>
                        </div>
                    </article>
                </div>
                <!-- col// -->
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-place"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Deliver to</h6>
                            <p class="mb-1">
                                City: {{ ucwords($order->upazilla->name_en ?? 'Null' ) }}, <br />{{ ucwords($order->district->district_name_en ?? 'Null') }},<br />
                                {{ ucwords($order->division->division_name_en ?? 'Null') }}
                            </p>
                            <!-- <a  href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $order->id }}">Edit Address</a> -->


                        </div>
                    </article>
                </div>
                <!-- col// -->
                <div class="col-md-12 mt-40">
                    <table class="table table-bordered">
                        <form action="{{ route('admin.orders.update',$order->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <tbody>
                                <tr>
                                    <th>Invoice</th>
                                    <td>{{ $order->invoice_no?? 'Null'}}</td>
                                    <th>Email</th>
                                    <td><input type="" class="form-control" name="email" value="{{ $order->user->email ?? 'Null'}}"></td>
                                </tr>
                                <tr>
                                    <th class="col-2">Shipping Address</th>
                                    <td>
                                        <label for="division_id" class="fw-bold text-black"><span class="text-danger">*</span> Division</label>
                                        <select class="form-control select-active"  name="division_id" id="division_id" required>
                                            <option value="">Select Division</option>

                                            @foreach(get_divisions($order->division_id) as $division)
                                              <option value="{{ $division->id }}" {{ $division->id == $order->division_id ? 'selected': '' }}>{{ ucwords($division->division_name_en) }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <label for="district_id" class="fw-bold text-black"><span class="text-danger">*</span> District</label>
                                        <select class="form-control select-active" name="district_id" id="district_id" required>
                                            <option selected=""  value="">Select District</option>
                                            @foreach(get_district_by_division_id($order->division_id) as $district)
                                                <option value="{{ $district->id }}" {{ $district->id == $order->district_id ? 'selected': '' }}>{{ ucwords($district->district_name_en) }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <label for="upazilla_id" class="fw-bold text-black"><span class="text-danger">*</span> Upazilla</label>
                                        <select class="form-control select-active" name="upazilla_id" id="upazilla_id" required>
                                            <option selected=""  value="">Select Upazilla</option>
                                            @foreach(get_upazilla_by_district_id($order->district_id) as $upazilla)
                                                <option value="{{ $upazilla->id }}" {{ $upazilla->id == $order->upazilla_id ? 'selected': '' }}>{{ ucwords($upazilla->name_en) }}</option>
                                            @endforeach

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Payment Method</th>
                                    <td>
                                        <select class="form-control select-active" name="payment_method" id="payment_method">
                                            <option selected=""  value="" >Select Payment Method</option>
                                                <option value="cash">Cash</option>
                                                <option value="bikash" >Bikash</option>
                                                <option value="nagad">Nagad</option>
                                        </select>
                                    </td>
                                    <th>Shipping Method</th>
                                    <td>
                                        <select class="form-control select-active" name="shipping_type" id="shipping_type" >
                                            <option selected=""  value="" >Select Shipping Method</option>
                                                <option value="cash">Cash</option>
                                                <option value="bikash" >Bikash</option>
                                                <option value="nagad">Nagad</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Shipping Charge</th>
                                    <td><input type="" class="form-control" name="shipping_cost" value="70"></td>
                                    <th>Discount</th>
                                    <td><input type="" class="form-control" name="discount" value="0.00"></td>
                                </tr>
                                <tr>
                                    <th>Payment Status</th>
                                    <td>
                                        @php
                                            $status = $order->delivery_status;
                                            if($order->delivery_status == 'cancelled') {
                                                $status = 'Received';
                                            }

                                        @endphp
                                        <span class="badge rounded-pill alert-success text-success">{!! $status !!}</span>
                                    </td>
                                    <th>Payment Date</th>
                                    <td>{{ date_format($order->created_at,"Y/m/d") ?? 'Null'}}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>{{ $order->grand_total ?? 'Null'}} <strong>Tk</strong></td>
                                    <th>Sub Total</th>
                                    <td>{{ $order->grand_total ?? 'Null'}}</td>
                                   <!--  <td>
                                         
                                        <span class="badge badge-success">Delivered</span>
                                            
                                    </td> -->
                                </tr>
                            </tbody>
                    </table>
                </div>
                <!-- col// -->
            </div>
            <!-- row // -->
            <div class="row">
                <div class="col-lg-7">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="40%">Product</th>
                                    <th width="20%">Unit Price</th>
                                    <th width="20%">Quantity</th>
                                    <th width="20%" class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($order->order_details as $key => $orderDetail)
                                    <tr>
                                        <td>
                                            <a class="itemside" href="#">
                                                <div class="left">
                                                    <img src="{{ asset($orderDetail->product->product_thumbnail ?? 'Null') }}" width="40" height="40" class="img-xs" alt="Item" />
                                                </div>
                                                <div class="info">
                                                    <span class="text-bold">
                                                        {{$orderDetail->product->name_en ?? 'NULL'}}
                                                    </span>
                                                    
                                                @if($orderDetail->is_varient && count(json_decode($orderDetail->variation))>0)
                                                    @foreach(json_decode($orderDetail->variation) as $varient)
                                                        <br/><span>{{ $varient->attribute_name }} : {{ $varient->attribute_value }}</span>
                                                    @endforeach
                                                @endif
                                                </div>
                                            </a>
                                        </td>
                                        <td>{{ $orderDetail->price ?? 'NULL' }}</td>
                                        <td>{{ $orderDetail->qty ?? 'NULL' }}</td>
                                        <td class="text-end">{{ $orderDetail->price ?? 'NULL' }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">
                                        <article class="float-end">
                                            <dl class="dlist">
                                                <dt>Subtotal:</dt>
                                                <dd>{{ $order->grand_total ?? 'NULL' }}</dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Shipping cost:</dt>
                                                <dd>10.00</dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Grand total:</dt>
                                                <dd><b class="h5">{{ $order->grand_total ?? 'NULL' }}</b></dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt class="text-muted">Status:</dt>
                                                <dd>
                                                    @php
                                                        $status = $order->delivery_status;
                                                        if($order->delivery_status == 'cancelled') {
                                                            $status = 'Received';
                                                        }

                                                    @endphp
                                                    <span class="badge rounded-pill alert-success text-success">{!! $status !!}</span>
                                                </dd>
                                            </dl>
                                        </article>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- table-responsive// -->
                </div>
                <!-- col// -->
                <div class="col-lg-1"></div>
                <div class="col-lg-4">
                    <div class="box shadow-sm bg-light">
                        <h6 class="mb-15">Payment info</h6>
                        <p>
                            <img src="{{ asset('backend/assets/imgs/card-brands/2.png ') }}" class="border" height="20" /> Master Card ** ** 4768 <br />
                            Business name: Grand Market LLC <br />
                            Phone: +1 (800) 555-154-52
                        </p>
                    </div>
                    <div class="h-25 pt-4">
                        <div class="mb-3">
                            <label>Notes</label>
                            <textarea class="form-control" name="notes" id="notes" placeholder="Type some note"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Orders</button>
                    </div>
                    </form>
                </div>
                <!-- col// -->
            </div>
        </div>
        <!-- card-body end// -->
    </div>
    <!-- card end// -->
</section>
@endsection
@push('footer-script')

<script type="text/javascript">

    /* ============ Update Payment Status =========== */
    $('#update_payment_status').on('change', function(){
        var order_id = {{ $order->id }};
        var status = $('#update_payment_status').val();
        $.post('{{ route('orders.update_payment_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
            // console.log(data);
            // Start Message 
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  
                  showConfirmButton: false,
                  timer: 1000
                })
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    type: 'success',
                    icon: 'success',
                    title: data.success
                })
            }else{
                Toast.fire({
                    type: 'error',
                    icon: 'error',
                    title: data.error
                })
            }
            // End Message 
        });
    });

    /* ============ Update Delivery Status =========== */
    $('#update_delivery_status').on('change', function(){
        var order_id = {{ $order->id }};
        var status = $('#update_delivery_status').val();
        $.post('{{ route('orders.update_delivery_status') }}', {
            _token:'{{ @csrf_token() }}',
            order_id:order_id,
            status:status
        }, function(data){
            // console.log(data);
            // Start Message 
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  
                  showConfirmButton: false,
                  timer: 1000
                })
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    type: 'success',
                    icon: 'success',
                    title: data.success
                })
            }else{
                Toast.fire({
                    type: 'error',
                    icon: 'error',
                    title: data.error
                })
            }
            // End Message 
        });
    });
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!--  Division To District Show Ajax -->
<script type="text/javascript">
  $(document).ready(function() {
    $('select[name="division_id"]').on('change', function(){
        var division_id = $(this).val();
        // const divArray = division.split("-");
        // var division_id = divArray[0];
        // $('#division_name').val(divArray[1]);
        if(division_id) {
            $.ajax({
                url: "{{  url('/division-district/ajax') }}/"+division_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                    $('select[name="district_id"]').html('<option value="" selected="" disabled="">Select District</option>');
                      $.each(data, function(key, value){
                        // console.log(value);
                          $('select[name="district_id"]').append('<option value="'+ value.id +'">' + capitalizeFirstLetter(value.district_name_en) + '</option>');
                    });
                    $('select[name="upazilla_id"]').html('<option value="" selected="" disabled="">Select District</option>');
                },
            });
        } else {
           alert('danger');
        }
    });
    function capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }
});
</script>

<!--  District To Upazilla Show Ajax -->
<script type="text/javascript">
  $(document).ready(function() {
    $('select[name="district_id"]').on('change', function(){
        var district_id = $(this).val();
        // const divArray = district.split("-");
        // var division_id = divArray[0];
        // $('#district_name').val(divArray[1]);
        if(district_id) {
            $.ajax({
                url: "{{  url('/district-upazilla/ajax') }}/"+district_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                   var d =$('select[name="upazilla_id"]').empty();
                      $.each(data, function(key, value){
                          $('select[name="upazilla_id"]').append('<option value="'+ value.id +'">' + value.name_en + '</option>');
                          $('select[name="upazilla_id"]').append('<option  class="d-none" value="'+ value.id +'">' + value.name_en + '</option>');
                      });
                },
            });
        } else {
            alert('danger');
        }
    });
});
</script>

<!-- Customer Edit Modal -->
<div class="modal fade" id="staticBackdrop1{{ $order->user_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form method="post" action="{{ route('admin.user.update',$order->user_id) }}">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="division_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter the name" value="{{ $order->user->name ?? 'Null'}}">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="division_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter the email" value="{{ $order->user->email ?? 'Null'}}">
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="division_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> Phone</label>
                        <input type="number" class="form-control" name="phone" placeholder="Enter the phone" value="{{ $order->user->phone ?? 'Null'}}">
                    </div>
                    <!-- <div class="form-group col-lg-6">
                        <label for="division_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> Password</label>
                        <input type="password" class="form-control">
                    </div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
  </div>
</div>
@endpush