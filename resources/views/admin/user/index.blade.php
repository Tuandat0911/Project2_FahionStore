@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'User', 'key' => 'List'])
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

                <div class="row">
                    <div class="col-md-12">
                        @can('user_add')
                        <a href="{{ route('user.create') }}" class="btn btn-success float-right"
                           style="margin-bottom: 10px">Add</a>
                        @endcan
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên nhân viên</th>
                                <th scope="col">Email</th>
                                @canany('user_edit', 'user_delete')
                                <th scope="col">Action</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $val)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $val->name }}</td>
                                    <td>{{ $val->email }}</td>
                                    <td>
                                        @can('user_edit')
                                        <a href="{{ route('user.edit',$val->id) }}"
                                           class="btn btn-success">Edit</a>
                                        @endcan

                                        @can('user_delete')
                                        <a href="{{ route('user.destroy',$val->id) }}"
                                           class="btn btn-danger" onclick="return confirm('Are you to delete?')">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $data->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



