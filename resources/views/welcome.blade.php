@extends('layouts.index')

@section('title')
    List Cars
@endsection

@section('content')
    <a class="btn btn-primary mx-4" href="/car/add" role="button">Add Car</a>
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
                                    <form id="{{"book-form-"."$car->id"}}" action="{{ "/reservation/"."$car->id" }}" method="POST">
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
