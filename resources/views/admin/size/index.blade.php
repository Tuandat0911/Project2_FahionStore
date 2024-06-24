@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Size', 'key' => 'List'])
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                @can('slider_add')
                                    <a href="{{ route('size.create') }}" class="btn btn-success float-right"
                                       style="margin-bottom: 10px">Add</a>
                                @endcan
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover table-avatar">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tên Size</th>
                                            @canany('slider_edit', 'slider_delete')
                                                <th scope="col">Action</th>
                                            @endcanany
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $key => $val)
                                            <tr>
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td>{{ $val->name }}</td>
                                                <td>
                                                    @can('slider_edit')
                                                        <a href="{{ route('size.edit',$val->id) }}"
                                                           class="btn btn-success">Edit</a>
                                                    @endcan

                                                    @can('slider_delete')
                                                        <a href="{{ route('size.destroy',$val->id) }}"
                                                           class="btn btn-danger"
                                                           onclick="return confirm('Are you to delete ?')">Delete</a>
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
            </div>
        </div>
    </div>
@endsection



