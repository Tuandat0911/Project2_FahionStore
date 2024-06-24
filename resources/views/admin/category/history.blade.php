@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Category', 'key' => 'List'])
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
                        <span style="font-weight: normal; font-size: 30px">Category Table History</span>
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-success float-right"
                           style="margin-bottom: 10px">Back</a>
                    </div>
                    <div class="card-body">
                        <div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Deleted At</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Restore</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category => $val)
                                    <tr>
                                        <th scope="row">{{ $category + 1 }}</th>
                                        <th>{{ $val->deleted_at }}</th>
                                        <td>{{ $val->name }}</td>
                                        <td>
                                            <a href="{{ route('categories.restore', $val->id) }}">
                                                <i class="fas fa-undo"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {{ $categories->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



