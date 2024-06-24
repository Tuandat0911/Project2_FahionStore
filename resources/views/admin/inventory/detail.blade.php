@extends('layouts.admin')

@section('title')
    <title>Inventory</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Inventory', 'key' => 'Details'])
        <div class="content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <span style="font-weight: normal; font-size: 30px">Inventory Transaction</span>
                    </div>
                    <div class="card-body">
                        <div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" colspan="2">Product</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Quantity</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $val)
                                    @php
                                    $product_id = \App\Models\ProductDetails::where('id', $val->product_detail_id)->first();
                                    $product = \App\Models\Product::where('id', $product_id->product_id)->first();
                                    $size = \App\Models\Size::where('id', $product_id->size_id)->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <img src="{{ $product->feature_image }}" alt="" style="width: 60px">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $size->name }}</td>
                                        <td>{{ $status }}</td>
                                        <td>{{ $val->quantity }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



