<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title')
    <title>Product</title>
@endsection


@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Product', 'key' => 'Add'])
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="productName">Tên Sản Phẩm</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="productName" placeholder="Nhap ten san pham"
                                       name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="alert alert-danger" style="padding: 7px;margin-top: 8px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Ảnh Đại Diện</label>
                                <input type="file" class="form-control-file" id="image" name="feature_image">
                            </div>

                            <div class="form-group">
                                <label for="image">Ảnh Chi Tiết</label>
                                <input type="file" class="form-control-file" id="image" name="image_path[]" multiple>
                            </div>

                            <div class="form-group" style="margin-bottom: 20px">
                                <label for="size">Sizes</label>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sizes as $size)
                                            <tr>
                                                <td>
                                                    <input type="hidden" value="{{ $size->id }}" name="size_id[]" style="border: none">
                                                    <input type="text" value="{{ $size->name }}" disabled style="border: none">
                                                </td>
                                                <td>
                                                    <input type="number" style="border: none" min="0" name="quantity[]">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Giá Sản Phẩm</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Nhap gia san pham"
                                       name="price" value="{{ old('price') }}">
                                @error('price')
                                <div class="alert alert-danger" style="padding: 7px;margin-top: 8px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nhập tag sản phẩm</label>
                                <select class="form-control tags_select_choose" multiple="multiple" name="tags[]">

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Chọn Danh Mục Sản Phẩm</label>
                                <select class="form-control select2_init @error('category_id') is-invalid @enderror" name="category_id">
                                    <option value="">Danh mục sản phẩm</option>
                                    {!! $htmlOption !!}
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger" style="padding: 7px;margin-top: 8px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Nhập Nội Dung Sản Phẩm</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="5" name="description">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="alert alert-danger" style="padding: 7px;margin-top: 8px;">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-dark float-right" style="margin-top: 20px">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admins/product/add/add.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
@endsection



