@extends('layouts.admin')

@section('title')
    <title>Product</title>
@endsection


@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Inventory', 'key' => 'Add'])
        <div class="content">
            <div class="container">

                <form action="{{ route('inventory.search') }}" class="form-inline" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="name">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit">Search</button>
                        </div>
                    </div>
                    <a href="{{ route('inventory.create') }}" class="btn btn-outline-warning float-right"
                       style="margin-left: 10px">Reset</a>
                </form>

                <form action="{{ route('inventory.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Select transaction type</label>
                        <select class="form-control" name="transaction_type" required>
                            <option value="Import">Import</option>
                            <option value="Export">Export</option>
                        </select>
                    </div>

                    <div class="card" style="margin-top: 20px">
                        <div class="card-header">
                            @can('product_add')
                                <span style="font-weight: normal; font-size: 30px">Product Table</span>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div>
                                <table class="table table-hover table-avatar table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên Sản Phẩm</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Hình Ảnh</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $key => $val)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $val -> name }}</td>
                                            <td>{{ $val -> price }}</td>
                                            <td>
                                                <img src="{{ $val->feature_image }}" alt="" style="width: 100px">
                                            </td>
                                            <td>
                                                <a class="btn product-details-btn btn-outline-info"  data-product-id="{{ $val->id }}">Product Details</a>
                                            </td>
                                        </tr>

                                        <tr class="product-details" id="product-details-{{ $val->id }}" style="display: none;">
                                            <td colspan="5">
                                                <div class="product-items">
                                                    <table class="table table-bordered text-center mb-0">
                                                        <thead class="bg-secondary text-dark">
                                                        <tr>
                                                            <th>Size</th>
                                                            <th>Quantity</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($val->productDetails as $detail)
                                                            <tr>
                                                                <td class="align-middle">
                                                                    <input type="hidden" value="{{ $detail->id }}" name="product_detail_id[]" style="border: none">
                                                                    <input type="text" value="{{ $detail->sizes->name }}" disabled style="border: none; width: 40px">
                                                                </td>
                                                                <td class="align-middle">
                                                                    <input type="number" min="0" name="quantity[]">
                                                                </td>
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
                        </div>
                    </div>

                    <button class="btn btn-outline-info" type="submit">Perform</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.product-details-btn').on('click', function () {
                var productId = $(this).data('product-id');
                $('#product-details-' + productId).toggle();
            });
        });
    </script>
@endsection




