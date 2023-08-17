@extends('Admin.layouts.master')

@section('title','Product List Page')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
            <div class="card col-4 ">
                <div class="card-header">
                  Order Info
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><i class="fa-regular fa-user me-1"></i>Name: {{ $orderList[0]->user_name }}</li>
                  <li class="list-group-item"><i class="fa-solid fa-barcode me-1"></i>Ordercode : {{ $orderList[0]->order_code }}</li>
                  <li class="list-group-item"><i class="fa-solid fa-calendar-days me-1"></i>Orderdate : {{ $orderList[0]->created_at->format('j-F-Y') }}</li>
                  <li class="list-group-item"><i class="fa-solid fa-money-bill-wave me-1"></i>Total     : {{ $order->total_price }} kyats <small class="text-danger">(added delivery feeds)</small></li>
                </ul>
              </div>
              <span class="input-group-append d-flex justify-content-sm-end ">
                <div class="btn btn-dark"><i class="fa-solid fa-database me-1"></i>{{ count($orderList) }}</div>
              </span>
                <div class="table-responsive table-responsive-data2 my-3">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr class="table-secondary tr-shadow">
                                <th>Order ID</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Order Date</th>
                                <th>Qty</th>
                                <th>Amount</th>

                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($orderList as $o)

                            <tr class="tr-shadow">

                                <tr class="table tr-shadow">
                                    <td class="">{{ $o->id }}</td>
                                    <td class="col-1"><img src="{{ asset('storage/'.$o->product_image) }}" class=" img-thumbnail"></td>
                                    <td class="">{{ $o->product_name }}</td>
                                    <td class="">{{ $o->created_at->format('j-F-Y') }}</td>
                                    <td class="">{{ $o->qty }}</td>
                                    <td class="">{{ $o->total }} kyats</td>


                                </tr>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

