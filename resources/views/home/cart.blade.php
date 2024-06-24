@php use App\Models\Size; @endphp
@extends('layout_guest.master2')

@section('title')
    <title>Cart</title>
@endsection

@section('content')
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                    <tr>
                        <th></th>
                        <th>Products</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                    </thead>
                    @if($carts != null)
                    <tbody class="align-middle">
                    @foreach($carts as $key => $cart)
                        @php
                        $size = Size::where('id', $cart['size'])->first();
                        $maxQuantity = \App\Models\ProductDetails::where('id', $key)->first()->quantity;
                        @endphp
                    <tr class="item" data-key="{{ $key }}">
                        <td class="align-middle"><img src="{{ $cart['feature_image'] }}" alt="" style="width: 60px;"></td>
                        <td class="align-middle">{{ $cart['name'] }}</td>
                        <td class="align-middle">{{ $size->name }}</td>
                        <td class="align-middle price">{{ $cart['price'] }}</td>
                        <td class="align-middle">
                            <input type="number" class="quantity" min="1" max="{{ $maxQuantity  }}" value="{{ $cart['quantity'] }}" style="width: 80px; border: none; text-align: center" oninput="validateInput(this)">
                            <div class="error-message" style="color: red; display: none;">Invalid quantity</div>
                        </td>
                        <td class="align-middle totalPrice"></td>
                        <td class="align-middle"><a href="{{ route('deleteCart', $key) }}"><button class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button></a></td>
                    </tr>
                    @endforeach
                    </tbody>
                    @endif
                </table>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium" id="total-price"></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold" id="total-price-ship"></h5>
                        </div>
                        <a class="btn btn-block btn-primary my-3 py-3" id="proceed-to-checkout" href="{{ route('checkout') }}">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            function validateInput(input) {
                var min = parseInt(input.min);
                var max = parseInt(input.max);
                var value = parseInt(input.value);

                var errorMessage = $(input).next('.error-message');

                if (value < min || value > max || isNaN(value)) {
                    errorMessage.show();
                    $(input).css('border', '1px solid red');
                    $('#proceed-to-checkout').css('pointer-events', 'none', 'cursor', 'not-allowed');
                } else {
                    errorMessage.hide();
                    $(input).css('border', 'none');
                    $('#proceed-to-checkout').css('pointer-events', 'auto', 'cursor', 'pointer');
                }
            }

            // Khi số lượng thay đổi, cập nhật tổng giá trị
            $('.quantity').change(function () {
                validateInput(this);

                // xu ly quantity va gia
                var total = 0;
                var totalship = 10;
                $('.item').each(function () {
                    var price = parseFloat($(this).find('.price').text());

                    var quantity = parseInt($(this).find('.quantity').val());
                    var itemTotal = price * quantity;
                    $(this).find('.totalPrice').text(formatCurrency(itemTotal));
                    total += itemTotal;
                    totalship += itemTotal;
                });
                $('#total-price').text(formatCurrency(total));
                $('#total-price-ship').text(formatCurrency(totalship));

                // Gửi yêu cầu AJAX để cập nhật số lượng trong session
                var key = $(this).closest('.item').data('key');
                var quantity = $(this).val();
                $.ajax({
                    url: '{{ route('updateCart') }}',
                    method: 'POST',
                    data: {
                        key: key,
                        quantity: quantity,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if(response.success) {
                            console.log('Cart updated successfully');
                        }
                    },
                    error: function (error) {
                        console.error('Error placing order:', error);
                    }
                });
            });

            function formatCurrency(number) {
                return number.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'USD'
                });
            }

            // Cập nhật tổng số tiền ban đầu
            $('.quantity').change();
        });
    </script>
@endsection
