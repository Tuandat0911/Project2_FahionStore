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
                        @can('category_add')
                            <span style="font-weight: normal; font-size: 30px">Category Table</span>
                            <a href="{{ route('categories.create') }}" class="btn btn-outline-success float-right"
                               style="margin-bottom: 10px">Add</a>

                            <a href="{{ route('categories.history') }}" class="btn btn-outline-warning float-right"
                               style="margin-bottom: 10px; margin-right: 10px;">History</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category Name</th>
                                    @canany('category_delete', 'category_edit' )
                                        <th scope="col" colspan="2">Action</th>
                                    @endcanany
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category => $val)
                                    <tr>
                                        <th scope="row">{{ $category + 1 }}</th>
                                        <td>{{ $val->name }}</td>
                                        <td>
                                            @can('category_edit')
                                                <a href="{{ route('categories.edit', $val->id) }}">
                                                    <i class="bi bi-pencil-square" style="color: green; font-size: 20px"></i></a>
                                            @endcan
                                        </td>

                                        <td>
                                            @can('category_delete')
                                                <a href="{{ route('categories.destroy', $val->id) }}"
                                                   onclick="return confirm('Are you to delete ?')">
                                                    <i class="bi bi-trash" style="color:red; font-size: 20px"></i></a>
                                            @endcan
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



