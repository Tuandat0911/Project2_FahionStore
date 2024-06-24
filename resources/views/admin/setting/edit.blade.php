@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Setting', 'key' => 'Edit'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('setting.update', $data->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="configKey">Config key</label>
                                <input type="text" class="form-control @error('config_key') is-invalid @enderror" id="configKey" placeholder="Nhap ten menu"
                                       name="config_key" value="{{ $data->config_key }}">
                                @error('config_key')
                                <div class="alert alert-danger" style="padding: 7px;margin-top: 8px;">{{ $message }}</div>
                                @enderror
                            </div>

                            @if(request()->type === 'Text')
                                <div class="form-group">
                                    <label for="configValue">Config value</label>
                                    <input type="text" class="form-control @error('config_value') is-invalid @enderror" id="configValue" placeholder="Nhap ten menu"
                                           name="config_value" value="{{ $data->config_value }}">
                                    @error('config_value')
                                    <div class="alert alert-danger" style="padding: 7px;margin-top: 8px;">{{ $message }}</div>
                                    @enderror
                                </div>
                            @elseif(request()->type === 'Textarea')
                                <div class="form-group">
                                    <label for="configValue">Config value</label>
                                    <textarea class="form-control @error('config_value') is-invalid @enderror" name="config_value" id="configValue" rows="5">{{ $data->config_value }}</textarea>
                                    @error('config_value')
                                    <div class="alert alert-danger" style="padding: 7px;margin-top: 8px;">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                            <button type="submit" class="btn btn-dark">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



