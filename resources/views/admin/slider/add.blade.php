@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Slider', 'key' => 'Add'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" style="margin-bottom: 20px">
                                <label for="menuName">Tên Slider</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="menuName" placeholder="Nhap ten menu"
                                       name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="alert alert-danger" style="padding: 7px;margin-top: 8px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="alert alert-danger" style="padding: 7px;margin-top: 8px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image_path">Hình ảnh</label>
                                <input type="file" class="form-control-file @error('image_path') is-invalid @enderror" id="image_path" name="image_path">
                                @error('image_path')
                                <div class="alert alert-danger" style="padding: 7px;margin-top: 8px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-dark">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



