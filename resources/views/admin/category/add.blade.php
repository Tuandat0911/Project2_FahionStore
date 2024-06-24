<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- /.content-header -->
        @include('partials.content-header', ['name' => 'category', 'key' => 'Add'])
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('categories.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="categoryName">Ten Danh Muc</label>
                                <input type="text" class="form-control" id="categoryName" placeholder="Nhap ten danh muc" name="name">
                            </div>

                            <div class="form-group">
                                <label>Chon Danh Muc Cha</label>
                                <select class="form-control" name="parent_id">
                                    <option selected>0</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <button type="submit" class="btn btn-dark">Submit</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection



