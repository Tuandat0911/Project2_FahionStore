@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Slider', 'key' => 'List'])
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @can('slider_add')
                        <a href="{{ route('slider.create') }}" class="btn btn-success float-right"
                           style="margin-bottom: 10px">Add</a>
                        @endcan
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên slider</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Hình ảnh</th>
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
                                    <td>{{ $val->description }}</td>
                                    <td>
                                        <img src="{{ $val->image_path }}" alt="" style="width: 200px">
                                    </td>
                                    <td>
                                        @can('slider_edit')
                                        <a href="{{ route('slider.edit',$val->id) }}"
                                           class="btn btn-success">Edit</a>
                                        @endcan

                                        @can('slider_delete')
                                        <a href="{{ route('slider.destroy',$val->id) }}"
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



