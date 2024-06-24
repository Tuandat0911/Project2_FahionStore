@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Setting', 'key' => 'List'])
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        @can('setting_add')
                        <div class="btn-group float-right" role="group" aria-label="Button group with nested dropdown">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Setting Add
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('setting.create') . '?type=Text' }}">Text</a>
                                    <a class="dropdown-item" href="{{ route('setting.create') . '?type=Textarea' }}">Textarea</a>
                                </div>
                            </div>
                        </div>
                        @endcan
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Config key</th>
                                <th scope="col">Config value</th>
                                @canany('setting_edit', 'setting_delete')
                                <th scope="col">Action</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $val)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $val->config_key }}</td>
                                    <td>{{ $val->config_value }}</td>
                                    <td>
                                        @can('setting_edit')
                                        <a href="{{ route('setting.edit',$val->id) . '?type=' . $val->type_setting }}"
                                           class="btn btn-success">Edit</a>
                                        @endcan
                                        @can('setting_delete')
                                        <a href="{{ route('setting.destroy',$val->id) . '?type=' . $val->type_setting }}"
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



