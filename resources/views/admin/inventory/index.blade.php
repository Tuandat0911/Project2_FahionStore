@extends('layouts.admin')

@section('title')
    <title>Inventory</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Inventory', 'key' => 'List'])
        <div class="content">
            <div class="container">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <span style="font-weight: normal; font-size: 30px">Inventory Transaction</span>
                        @can('inventory_add')
                        <a href="{{ route('inventory.create') }}" class="btn btn-outline-success float-right"
                           style="margin-bottom: 10px">Add</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Transaction Date</th>
                                    <th scope="col">Implementer</th>
                                    <th scope="col">Transaction Type</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($inventories as $key => $inventory)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $inventory->transaction_date }}</td>
                                        <td>{{ $inventory->user->name }}</td>
                                        <td>{{ $inventory->transaction_type }}</td>
                                        <td>
                                            <a href="{{ route('inventory.detail', $inventory->id) }}" class="btn btn-outline-info">Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {{ $inventories->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



