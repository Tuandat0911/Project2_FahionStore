@extends('layouts.admin')

@section('title')
    <title>Product</title>
@endsection


@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'product', 'key' => 'List'])
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
                        @can('product_add')
                            <span style="font-weight: normal; font-size: 30px">Product Table</span>
                            <a href="{{ route('product.create') }}" class="btn btn-outline-success float-right"
                               style="margin-bottom: 10px">ADD</a>
                            <a href="{{ route('product.history') }}" class="btn btn-outline-warning float-right"
                               style="margin-bottom: 10px; margin-right: 10px">History</a>
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
                                    <th scope="col">Thể Loại</th>
{{--                                    @canany('product_edit', 'product_delete')--}}
                                    <th scope="col">Action</th>
                                    <th scope="col"></th>
{{--                                    @endcanany--}}
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
                                        <td>{{ $val->category->name }}</td>
                                        <td>
                                            {{--                                        @can('product_edit')--}}
                                            <a href="{{ route('product.edit', $val->id) }}"
                                               class=""><i class="bi bi-pencil-square"
                                                           style="color: green; font-size: 20px"></i></a>
                                            {{--                                        @endcan--}}
                                        </td>
                                        <td>
                                            {{--                                        @can('product_delete')--}}
                                            <a href="{{ route('product.destroy', $val->id) }}"
                                               class="" onclick="return confirm('Are you to delete ?')"><i
                                                    class="bi bi-trash" style="color:red; font-size: 20px"></i></a>
                                            {{--                                        @endcan()--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {{ $data->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



