@extends('layouts.index')

@section('Profile')
    Add Car
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="px-4">
        <form action="/user/edit" method="POST">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp"
                    value={{ $user->name }}>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="email"
                    aria-describedby="emailHelp" value={{ $user->email }}>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Address</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="address"
                    value={{ $user->address }}>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Phone</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="phone"
                    value={{ $user->phone }}>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">License Number</label>
                <input type="Number" class="form-control" id="exampleInputPassword1" name="driver_license"
                    value={{ $user->driver_license }}>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>

        </form>
    </div>
@endsection
