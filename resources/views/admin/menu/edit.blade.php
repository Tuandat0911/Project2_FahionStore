@extends('layouts.admin')

@section('title')
    <title>Menu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'menu', 'key' => 'Edit'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('menu.update', $menu->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="menuName">Ten Menu</label>
                                <input type="text" class="form-control" id="menuName" placeholder="Nhap ten menu"
                                       name="name" value="{{ $menu -> name }}">
                            </div>

                            <div class="form-group">
                                <label>Chon Menu Cha</label>
                                <select class="form-control" name="parent_id">
                                    <option selected>0</option>
                                    {!! $htmloption !!}
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



