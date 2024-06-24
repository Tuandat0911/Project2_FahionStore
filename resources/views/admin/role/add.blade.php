@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Role', 'key' => 'Add'])
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('role.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" style="margin-bottom: 20px">
                        <label for="menuName">Tên vai trò</label>
                        <input type="text" class="form-control" id="menuName" placeholder="Nhap ten menu" name="name">
                    </div>

                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea class="form-control" id="description" name="display_name"></textarea>
                    </div>

                    <div>
                        <label for="">
                            <input type="checkbox" class="checkall" style="transform: scale(1.2)">
                            Check all
                        </label>
                    </div>
                    @foreach($permissions as $permissionItem)
                        <div class="card">
                            <div class="card-header" style="background-color: #00bfff">
                                <label>
                                    <input type="checkbox" class="checkbox_wrapper" style="transform: scale(1.1)">
                                    Module {{ $permissionItem->name }}
                                </label>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($permissionItem->permissionChild as $permissionChildItem)
                                        <div class="col-md-3">
                                            <label>
                                                <input type="checkbox" class="checkbox_child" name="permission_id[]"
                                                       value="{{ $permissionChildItem->id }}"
                                                       style="transform: scale(1.1)">
                                                Module {{ $permissionChildItem->name }}
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-dark">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $('.checkbox_wrapper').on('click', function () {
            $(this).parents('.card').find('.checkbox_child').prop('checked', $(this).prop('checked'));
        });

        $('.checkall').on('click', function () {
            $(this).parents().find('.checkbox_child').prop('checked', $(this).prop('checked'));
            $(this).parents().find('.checkbox_wrapper').prop('checked', $(this).prop('checked'));
        })
    </script>
@endsection



