@extends('User.layouts.master')
@section('content')
    <!-- Breadcrumb Start -->
    
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid" style="height: 400px">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr><th>Date</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o)
                        <tr><th>{{ $o->created_at->format('j-F-Y') }}</th>
                            <th>{{ $o->order_code }}</th>
                            <th>{{ $o->total_price }} kyats</th>
                            <th>
                                @if ($o->status==0)
                                        <div class="text-warning"><i class="fa-solid fa-clock-rotate-left me-2"></i>Pending...</div>
                                @elseif ($o->status==1)
                                        <div class="text-success"><i class="fa-solid fa-check-double me-2"></i>Success</div>
                                @elseif ($o->status==2)
                                         <div class="text-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i>Reject</div>
                                @endif
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-dark mt-3">
                    {{ $order->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
