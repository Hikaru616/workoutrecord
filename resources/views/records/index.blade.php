@extends('layouts.app')

@section('title', 'GymHome')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-2">
                <div class="card card-statistic-1 bg-white">
                    <div class="card-icon bg-primary h4">
                        <i class="fa-solid fa-dumbbell"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header bg-white">
                            <h4>Bench Press</h4>
                        </div>
                        <div class="card-body">

                            @if ( !is_null($latestBench))
                                {{ $latestBench->bench }} kg
                            @else
                                No record
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-2">
                <div class="card card-statistic-1 bg-white">
                    <div class="card-icon bg-danger h4">
                        <i class="fa-solid fa-dumbbell"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header bg-white">
                            <h4>Dead Lift</h4>
                        </div>
                        <div class="card-body">
                            @if ( !is_null($latestDead))
                                {{ $latestDead->dead }} kg
                            @else
                                No record
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 bg-white">
                    <div class="card-icon bg-warning h4">
                        <i class="fa-solid fa-dumbbell"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header bg-white">
                            <h4>Squat</h4>
                        </div>
                        <div class="card-body">
                            @if ( !is_null($latestSquat))
                                {{ $latestSquat->squat }} kg
                            @else
                                No record
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row justify-content-center mt-4">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Latest Records</h4>
                    <div class="card-header-action">
                        <form action="{{ route('record.update') }}">
                            <button class="btn btn-sm d-flex justify-content-end text-white"
                                style="box-shadow: 0 2px 6px #c5c0f2; background-color:#6777EF;">Update Records <span
                                    class="ms-1"><i class="fa-solid fa-person-walking-arrow-right"></i></span></button>
                        </form>
                    </div>

                    <div class="card-header-action">
                        <form action="{{ route('bigthree.index') }}">
                            <button class="btn btn-sm d-flex justify-content-end text-white"
                                style="box-shadow: 0 2px 6px #c5c0f2; background-color:#6777EF;">Update Big3 <span
                                    class="ms-1"><i class="fa-solid fa-person-walking-arrow-right"></i></span></button>
                        </form>
                    </div>

                    <div class="card-header-action">
                        <form action="{{ route('record.records') }}">
                            <button class="btn btn-sm d-flex justify-content-end text-white"
                                style="box-shadow: 0 2px 6px #c5c0f2; background-color:#6777EF;">See All Records <span
                                    class="ms-1"><i class="fa-solid fa-person-walking-arrow-right"></i></span></button>
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                            <tr>
                                <th>DATE</th>
                                <th>DATE OF WEEK</th>
                                <th>PART</th>
                                <th>MEMO</th>
                                <th></th>
                                <th></th>
                            </tr>


                            @foreach ($home_records as $record)
                                <tr>
                                    <td>{{ $record->date }}</td>
                                    <td>{{ date('D', strtotime($record->date)) }}</td>
                                    <td>
                                        @if ($record->hasRecordPost())
                                            @foreach ($record->categoryRecord as $category_record)
                                                <div class="badge badge-success">
                                                    {{ $category_record->category->name }}
                                                </div>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td
                                        style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ $record->memo }}</td>
                                    <td>

                                        <button type="button" class="btn btn-primary ms-2 btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#detail-edit-record-{{ $record->id }}">Detail & Edit</button>

                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger ms-2 btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#delete-record-{{ $record->id }}">

                                            <i class="fa-solid fa-trash-can text-white me-1"></i> Delete </button>
                                        @include('records.modal.status')
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
