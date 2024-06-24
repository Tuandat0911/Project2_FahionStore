@extends('layout_guest.master2')

@section('title')
    <title>Checkout</title>
@endsection

@section('content')
    <form action="{{ route('order') }}" method="post">
        @csrf
        <div class="container-fluid pt-5">
            <div class="row px-xl-5">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Full Name</label>
                                <input class="form-control" type="text"  name="name" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No</label>
                                <input class="form-control" type="text"  name="phone" value="{{ Auth::user()->phone }}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Delivery Address</label>
                                <textarea class="form-control" rows="5"  name="address">{{ Auth::user()->address }}</textarea>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                        </div>
                        <div class="card-body">
                            <h5 class="font-weight-medium mb-3">Products</h5>
                            @php
                                $total = 0;
                            @endphp
                            @foreach($carts as $key => $cart)
                                <div class="d-flex justify-content-between">
                                    <p>{{ Str::limit($cart['name'], 20) }}</p>
                                    <p>${{ $cart['price'] * $cart['quantity'] }}</p>
                                </div>
                                @php
                                    $total += $cart['price'] * $cart['quantity'];
                                @endphp
                            @endforeach
                            <hr class="mt-0">
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-medium">Subtotal</h6>
                                <h6 class="font-weight-medium">${{ $total }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Shipping</h6>
                                <h6 class="font-weight-medium">$10</h6>
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-bold">Total</h5>
                                <h5 class="font-weight-bold">${{ $total + 10 }}</h5>
                            </div>
                            <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3 order" type="submit">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('js')
    <script>
        {{--$(document).ready(function () {--}}
        {{--    $('.order').click(function () {--}}
        {{--        var name = $('input[name="name"]').val();--}}
        {{--        var phone = $('input[name="phone"]').val();--}}
        {{--        var address = $('textarea[name="address"]').val();--}}

        {{--        $.ajax({--}}
        {{--            url: '{{ route('order') }}',--}}
        {{--            method: 'POST',--}}
        {{--            data: {--}}
        {{--                name: name,--}}
        {{--                phone: phone,--}}
        {{--                address: address,--}}
        {{--                _token: '{{ csrf_token() }}'--}}
        {{--            },--}}
        {{--            success: function (response) {--}}
        {{--                if(response.success) {--}}
        {{--                    alert('Order placed successfully!');--}}
        {{--                    window.location.href = '/orderStatus'; // Chuyển hướng sau khi đặt hàng thành công--}}
        {{--                }--}}
        {{--            },--}}
        {{--            error: function (error) {--}}
        {{--                console.error('Error placing order:', error);--}}
        {{--                alert('There was an error placing your order. Please try again.');--}}
        {{--            }--}}
        {{--        });--}}
        {{--    });--}}
        {{--});--}}
    </script>
@endsection
