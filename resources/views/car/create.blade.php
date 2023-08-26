@extends('layouts.index')

@section('title')
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
        <form action="/car/add" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Brand</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="brand" aria-describedby="emailHelp"
                    placeholder="Enter brand car">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Model</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="model"
                    placeholder="Enter model">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Police Number</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="police_number"
                    placeholder="Enter police number">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Price</label>
                <input type="Number" class="form-control" id="exampleInputPassword1" name="price"
                    placeholder="Enter price">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
