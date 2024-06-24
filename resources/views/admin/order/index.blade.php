@extends('layouts.admin')

@section('title')
    <title>Order</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Order', 'key' => 'List'])
        <div class="content">
            <div class="container">
                @if(session('success'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <span style="font-weight: normal; font-size: 30px">Order list</span>
                    </div>
                    <div class="card-body">
                        <div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Order Time</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Detail</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order => $val)
                                    <tr>
                                        <th scope="row">{{ $order + 1 }}</th>
                                        <td>{{ $val->created_at }}</td>
                                        <td>${{ $val->total_amount }}</td>
                                        <td>
                                            @if (collect($cancel)->keys()->contains($val->id))
                                                <p style="color: red">Wait for cancellation</p>
                                                @else
                                                <a href="{{ route('order.updateOrderStatus', $val->id) }}"
                                                   @if($val->status == 'PENDING')
                                                       style="color: #41f112"
                                                   @elseif($val->status == 'SHIPPING')
                                                       style="color: #ffec1c"
                                                   @elseif($val->status == 'CANCELED')
                                                       style="color: red"
                                                   @else
                                                       style="color: #1818cc"
                                                    @endif>
                                                    {{ $val->status }}
                                                </a>
                                            @endif

                                        </td>
                                        <td>
                                            <button class="btn order-details-btn btn-outline-info"  data-order-id="{{ $val->id }}">Order Details</button>
                                            @if($val->status == 'PENDING')
                                            <a href="{{ route('order.cancelOrder', $val->id) }}" class="btn btn-outline-danger">Cancel</a>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr class="order-details" id="order-details-{{ $val->id }}" style="display: none;">
                                        <td colspan="5">
                                            <div class="customer-info mb-3">
                                                <table class="table table-bordered text-center mb-0">
                                                    <thead class="bg-secondary text-dark">
                                                    <tr>
                                                        <th>Customer Name</th>
                                                        <th>Address</th>
                                                        <th>Phone</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td class="align-middle">{{ $val->name }}</td>
                                                        <td class="align-middle">{{ $val->address }}</td>
                                                        <td class="align-middle">{{ $val->phone }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="order-items">
                                                <table class="table table-bordered text-center mb-0">
                                                    <thead class="bg-secondary text-dark">
                                                    <tr>
                                                        <th colspan="2">Product</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($val->orderDetail as $detail)
                                                        @php
                                                            $productDetail = \App\Models\ProductDetails::where('id', $detail->product_id)->first();
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <img src="{{ $productDetail->products->feature_image }}" alt="" style="width: 60px">
                                                            </td>
                                                            <td class="align-middle">{{ $productDetail->products->name }} (Size {{ $productDetail->sizes->name }})</td>
                                                            <td class="align-middle">{{ $detail->quantity }}</td>
                                                            <td class="align-middle">${{ $detail->price }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {{ $orders->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.order-details-btn').on('click', function () {
                var orderId = $(this).data('order-id');
                $('#order-details-' + orderId).toggle();
            });
        });
    </script>
@endsection



