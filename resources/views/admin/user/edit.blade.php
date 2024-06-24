@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'User', 'key' => 'Edit'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('user.update', $data->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" style="margin-bottom: 20px">
                                <label for="name">Tên Nhân Viên</label>
                                <input type="text" class="form-control" id="name" placeholder="Nhap ten nhan vien"
                                       name="name" value="{{ $data->name }}" required>
                            </div>

                            <div class="form-group" style="margin-bottom: 20px">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Nhap email"
                                       name="email" value="{{ $data->email }}" required>
                            </div>

                            <div class="form-group" style="margin-bottom: 20px">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" id="password" placeholder="Nhap password"
                                       name="password" required>
                            </div>

                            <div class="form-group" style="margin-bottom: 20px">
                                <label for="role">Vai trò</label>
                                <select name="role_id[]" id="role" class="form-control select2_init" multiple>
                                    <option value=""></option>
                                    @foreach($roles as $role)

                                        <option {{ $rolesOfUser->contains('id', $role->id) ? 'selected': '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
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

@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script>
        $('.select2_init').select2({
            'placeholder': 'Chọn vai trò'
        })
    </script>
@endsection



