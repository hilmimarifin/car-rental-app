@extends('layouts.index')

@section('title')
    List Cars
@endsection

@section('content')
    <a class="btn btn-primary mx-4" href="/car/add" role="button">Add Car</a>
    <form method="POST" action="/car/search">
        @csrf
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="search_value"
                    placeholder="search by brand, model, or police number">
            </div>
            <button type="submit" class="btn btn-primary mx-2">Search</button>
        </div>
    </form>

    <div>
        <form action="/car/checkListCarsAvailable" method="POST">
            @csrf
            <input type="date" name="start_date" />
            <span>to</span>
            <input type="date" name="end_date" />
            <button type="submit" class="btn btn-primary mx-2">Check</button>
        </form>
    </div>

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
    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class=""></div>
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Brand</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Model</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Police Number</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Price</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $car->brand }}</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $car->model }}</h6>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $car->police_number }}</h6>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Rp {{ $car->price }}</h6>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-row justify-content-center">
                                    <form id="{{ 'book-form-' . "$car->id" }}" action="{{ '/reservation/' . "$car->id" }}"
                                        method="POST">
                                        @csrf
                                        <input type="date" name="start_date">
                                        <input type="number" name="duration"><span> days</span>
                                        <button type=submit class="btn btn-primary">Boook</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
