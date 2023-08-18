@extends('Admin.layouts.master')

@section('title', 'Order List Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-xmark"></i>{{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondery">Search Key : <span class="text-danger">{{ request('key') }}</span>
                            </h4>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="{{ route('order#list') }}" class="d-flex" method="GET">
                                @csrf
                                <input type="search" name="key" class="form-control" placeholder="Search . . ."
                                    value="{{ request('key') }}">
                                <button class="btn btn-dark" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="table-data__tool ">
                        <div class="table-data__tool-left">
                            <form action="{{ route('change#status') }}" method="get">
                                @csrf
                                <div class="input-group">

                                    <select name="orderStatus" class="form-control custom-select">
                                        <option value="">All</option>
                                        <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending
                                        </option>
                                        <option value="1" @if (request('orderStatus') == '1') selected @endif>Accept
                                        </option>
                                        <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject
                                        </option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-dark" type="submit">Search</button>
                                    </div>
                                    <div class="input-group-append">
                                        <div class="btn btn"><i class="fa-solid fa-database me-1"></i>{{ count($order) }}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($order as $o)
                                    <tr class="tr-shadow">

                                    <tr class="tr-shadow">
                                        <input type="hidden" class="orderId" value="{{ $o->id }}">
                                        <td class="col-2">{{ $o->user_id }}</td>
                                        <td class="col-2">{{ $o->name }}</td>
                                        <td class="col-2">{{ $o->created_at->format('j-F-Y') }}</td>
                                        <td class="col-2">
                                            <a href="{{ route('listInfo', $o->order_code) }}">{{ $o->order_code }}</a>
                                        </td>
                                        <td class="col-2">{{ $o->total_price }} kyats</td>
                                        <td class="col-2">
                                            <select id="status" class="form-control statusChange">
                                                <option value="">All</option>
                                                <option value="0" @if ($o->status == 0) selected @endif>
                                                    Pending</option>
                                                <option value="1" @if ($o->status == 1) selected @endif>
                                                    Accept</option>
                                                <option value="2" @if ($o->status == 2) selected @endif>
                                                    Reject</option>
                                            </select>
                                        </td>
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
@section('scriptSession')
    <script>
        $(document).ready(function() {
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                $orderId = $parentNode.find('.orderId').val();
                $data = {
                    'status': $currentStatus,
                    'orderId': $orderId,
                }
                $.ajax({
                    type: 'get',
                    url: '/order/ajax/change/status',
                    data: $data,
                    dataType: 'json',
                    success: function(response) {}
                })
            })
        })
    </script>
@endsection
