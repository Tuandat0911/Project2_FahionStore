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
                        <span style="font-weight: normal; font-size: 30px">Product Table History</span>
                        <a href="{{ route('product.index') }}" class="btn btn-outline-warning float-right"
                           style="margin-bottom: 10px">Back</a>
                    </div>
                    <div class="card-body">
                        <div>
                            <table class="table table-hover table-avatar table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Deleted At</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Restore</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $val)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <th>{{ $val->deleted_at }}</th>
                                        <td>{{ $val -> name }}</td>
                                        <td>{{ $val -> price }}</td>
                                        <td>
                                            <img src="{{ $val->feature_image }}" alt="" style="width: 100px">
                                        </td>
                                        <td>{{ $val->category->name }}</td>
                                        <td>
                                            <a href="{{ route('product.restore', $val->id) }}"
                                               class=""><i class="fas fa-undo"></i></a>
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



