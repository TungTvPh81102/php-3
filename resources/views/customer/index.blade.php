@extends('customer.master')

@section('content')
    <div class="d-flex justify-content-between">
        <h1>Danh sách sản phẩm</h1>
        <a href="{{ route('customers.create') }}" class="btn btn-primary">Thêm mới</a>
    </div>
    @if(session()->has('success') && session()->get('success'))
        <div class="alert alert-success mt-4">
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->has('error') && session()->get('error'))
        <div class="alert alert-danger mt-4">
            {{ session()->get('error') }}
        </div>
    @endif
    <table class="table  mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Address</th>
            <th scope="col">Status</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <th scope="row">{{ $item->id }}</th>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->address }}</td>
                <td>{!!  $item->is_active ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
                <td class="d-flex">
                    <a href="{{ route('customers.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('customers.destroy', $item) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button onclick="confirm('Bạn có chắc muốn xoá sản phẩm?')" type="submit"
                                class="btn btn-warning">
                            Delete
                        </button>
                    </form>
                    <form action="{{ route('customers.forceDestroy', $item) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button onclick="confirm('Bạn có chắc muốn xoá sản phẩm?')" type="submit"
                                class="btn btn-danger">
                            Force Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
@endsection
