@extends('customer.master')

@section('content')
    <h3>Cập nhật: {{ $customer->name }}</h3>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endforeach
    @endif

    @if(session()->has('success') && session()->get('success'))
        <div class="alert alert-success mt-4">
            {{ session()->get('success') }}
        </div>
    @endif

    <form action="{{ route('customers.update', $customer) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="" class="form-label">Name</label>
            <input value="{{  $customer->name }}" type="text" name="name" class="form-control"
                   placeholder="Enter name...">
        </div>
        <div class="form-group mb-3">
            <label for="" class="form-label">Email</label>
            <input value="{{ $customer->email }}" type="email" name="email" class="form-control"
                   placeholder="Enter email...">
        </div>
        <div class="form-group mb-3">
            <label for="" class="form-label">Phone</label>
            <input value="{{ $customer->phone }}" type="tel" name="phone" class="form-control"
                   placeholder="Enter phone...">
        </div>
        <div class="form-group mb-3">
            <label for="" class="form-label">Address</label>
            <input value="{{   $customer->address }}" type="text" name="address" class="form-control"
                   placeholder="Enter address...">
        </div>
        <div class="form-group mb-3">
            <label for="" class="form-label">Status</label>
            <input @checked( $customer->is_active == 1)  value="1" type="checkbox" name="is_active"
                   class="form-check-input">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection
