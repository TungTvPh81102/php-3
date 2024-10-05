@extends('customer.master')

@section('content')
    <h3>Thêm mới</h3>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <form action="{{ route('customers.store') }}" method="post">
        @csrf
        <div class="form-group mb-3">
            <label for="" class="form-label">Name</label>
            <input value="{{ old('name') }}" type="text" name="name" class="form-control" placeholder="Enter name...">
        </div>
        <div class="form-group mb-3">
            <label for="" class="form-label">Email</label>
            <input value="{{ old('email') }}" type="email" name="email" class="form-control"
                   placeholder="Enter email...">
        </div>
        <div class="form-group mb-3">
            <label for="" class="form-label">Phone</label>
            <input value="{{ old('phone') }}" type="tel" name="phone" class="form-control" placeholder="Enter phone...">
        </div>
        <div class="form-group mb-3">
            <label for="" class="form-label">Address</label>
            <input value="{{ old('address') }}" type="text" name="address" class="form-control"
                   placeholder="Enter address...">
        </div>
        <div class="form-group mb-3">
            <label for="" class="form-label">Status</label>
            <input value="1" type="checkbox" name="is_active" class="form-check-input">
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@endsection
