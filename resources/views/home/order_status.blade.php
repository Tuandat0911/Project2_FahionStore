@extends('layout_guest.master2')

@section('title')
    <title>Order status</title>
@endsection

@section('content')
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-12 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                    <tr>
                        <th></th>
                        <th>Time Order</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                    </thead>
                        <tbody class="align-middle">
                        @foreach($orders as $key => $order)
                            <tr class="item">
                                @if($order->status == 'PENDING')
                                    <td>
                                        @if (collect($cancel)->keys()->contains($order->id))
                                            <p style="color: red">Cancellation request is being processed</p>
                                        @else
                                            <a href="{{ route('cancel', $order->id) }}" style="color: red" onclick="return confirm('Are you sure you want to cancel your order?')">Cancel Order</a>
                                        @endif
                                    </td>
                                @else
                                    <td></td>
                                @endif
                                <td class="align-middle">{{ $order->created_at }}</td>
                                <td class="align-middle">${{ $order->total_amount }}</td>
                                <td class="align-middle">
                                    <span
                                    @if($order->status == 'PENDING')
                                        @if (collect($cancel)->keys()->contains($order->id))
                                            style="color: red"
                                        @else
                                            style="color: #26f626"
                                        @endif
                                    @elseif($order->status == 'SHIPPING')
                                        style="color: #ffec1c"
                                    @elseif($order->status == 'CANCELED')
                                        style="color: #f10707"
                                    @else
                                        style="color: #1818cc"
                                    @endif>
                                        {{ $order->status }}</span>
                                </td>
                                <td>
                                    <button class="btn order-details-btn" style="border: none" data-order-id="{{ $order->id }}">Order Details</button>
                                </td>
                            </tr>

                            <tr class="order-details" id="order-details-{{ $order->id }}" style="display: none;">
                                <td colspan="4">
                                    <table class="table table-bordered text-center mb-0">
                                        <thead class="bg-secondary text-dark">
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($order->orderDetail as $detail)
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
                                        <tr>
                                            <p style="color: red">{{ $order->note }}</p>
                                        </tr>
                                        </tbody>
                                    </table>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.order-details-btn').on('click', function () {
                var orderId = $(this).data('order-id');
                var $detailsRow = $('#order-details-' + orderId);

                $detailsRow.toggle();
            })
        });
    </script>
@endsection
