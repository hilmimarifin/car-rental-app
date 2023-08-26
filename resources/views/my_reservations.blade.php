@extends('layouts.index')

@section('title')
    My Reservations
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Car</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Police Number</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Start Date</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        End Date</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{$reservation->car->model}}</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{$reservation->car->police_number}}</h6>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{$reservation->start_date}}</h6>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle">
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{$reservation->end_date}}</h6>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle">
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <form method="POST" action="{{ "/reservation/"."$reservation->id" }}">
                                    @method('put')
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Return</button>
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
