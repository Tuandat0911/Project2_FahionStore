@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'menu', 'key' => 'List'])
        <div class="content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        @can('menu_add')
                            <span style="font-weight: normal; font-size: 30px">Menu Table</span>
                        <a href="{{ route('menu.create') }}" class="btn btn-outline-success float-right"
                           style="margin-bottom: 10px">Add</a>
                        @endcan
                    </div>
                    <div>
                        
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên menu</th>
                                @canany('menu_edit', 'menu_delete')
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
                                        @can('menu_edit')
                                        <a href="{{ route('menu.edit',$val->id) }}"
                                           class="btn btn-success">Edit</a>
                                        @endcan

                                        @can('menu_delete')
                                        <a href="{{ route('menu.destroy',$val->id) }}"
                                           class="btn btn-danger" onclick="return confirm('Are you to delete ?')">Delete</a>
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



