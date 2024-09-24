@extends('layouts.app')

@section('title', 'GymHome')

@section('content')

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-2">
                <form action="{{ route('bench.store') }}" method="POST">
                    @csrf
                    <div class="card card-statistic-1 bg-white">
                        <div class="card-icon bg-primary h4">
                            <i class="fa-solid fa-dumbbell"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header bg-white">
                                <h4>Bench Press</h4>
                            </div>
                            <div class="card-body">

                                @if (!is_null($latestBench))
                                    {{$latestBench->bench}} kg
                                @else
                                    No record
                                @endif

                            </div>
                        </div>
                    </div>
                    @if (!is_null($latestBench))
                        <div class="text-center mt-3">
                            <input type="text" class="w-100 form-control" name="bench" id="bench"
                                value="{{ old('name', $latestBench) }}">
                        </div>
                    @else
                        <div class="text-center mt-3">
                            <input type="text" class="w-100 form-control" placeholder="your best bench" name="bench"
                                id="bench">
                        </div>
                    @endif

                    <div class="text-center mt-3">
                        <input type="date" class="w-100 form-control" name="bench_created_at" id="bench_created_at">
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="w-100 btn form-control btn-primary">Bench Update</button>
                    </div>

                </form>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-2">
                <form action="{{ route('dead.store') }}" method="POST">
                    @csrf
                    <div class="card card-statistic-1 bg-white">
                        <div class="card-icon bg-danger h4">
                            <i class="fa-solid fa-dumbbell"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header bg-white">
                                <h4>Dead Lift</h4>
                            </div>
                            <div class="card-body">

                                @if (!is_null($latestDead))
                                    {{$latestDead->dead}} kg
                                @else
                                    No record
                                @endif

                            </div>
                        </div>
                    </div>
                    @if (!is_null($latestDead))
                        <div class="text-center mt-3">
                            <input type="text" class="w-100 form-control" name="dead" id="dead"
                                value="{{ old('name', $latestDead) }}">
                        </div>
                    @else
                        <div class="text-center mt-3">
                            <input type="text" class="w-100 form-control" placeholder="your best dead" name="dead"
                                id="dead">
                        </div>
                    @endif

                    <div class="text-center mt-3">
                        <input type="date" class="w-100 form-control" name="dead_created_at" id="dead_created_at">
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="w-100 btn form-control btn-danger">Dead Update</button>
                    </div>

                </form>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-2">
                <form action="{{ route('squat.store') }}" method="POST">
                    @csrf
                    <div class="card card-statistic-1 bg-white">
                        <div class="card-icon bg-warning h4">
                            <i class="fa-solid fa-dumbbell"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header bg-white">
                                <h4>Squat</h4>
                            </div>
                            <div class="card-body">

                                @if (!is_null($latestSquat))
                                    {{$latestSquat->squat}} kg
                                @else
                                    No record
                                @endif

                            </div>
                        </div>
                    </div>
                    @if (!is_null($latestSquat))
                        <div class="text-center mt-3">
                            <input type="text" class="w-100 form-control" name="squat" id="squat"
                                value="{{ old('name', $latestSquat) }}">
                        </div>
                    @else
                        <div class="text-center mt-3">
                            <input type="text" class="w-100 form-control" placeholder="your best squat" name="squat"
                                id="squat">
                        </div>
                    @endif

                    <div class="text-center mt-3">
                        <input type="date" class="w-100 form-control" name="squat_created_at" id="squat_created_at">
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="w-100 btn form-control btn-warning text-white">Squat Update</button>
                    </div>

                </form>
            </div>

            <div class="mt-5 row">
                <div class="col-4">
                    <canvas id="benchPressChart"></canvas>
                </div>

                <div class="col-4">
                    <canvas id="deadChart"></canvas>
                </div>

                <div class="col-4">
                    <canvas id="squatChart"></canvas>
                </div>
            </div>

        </div>
{{-- {{ dd($deadData); }} --}}
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

    <script>
        const benchPressData = @json($benchPressData);

        const ctx1 = document.getElementById('benchPressChart').getContext('2d');
        const benchPressChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: benchPressData.dates.map(date => date.split(' ')[0]), // 日付のラベル
                datasets: [{
                    label: 'Bench Press (kg)',
                    data: benchPressData.bench, // ベンチプレスの重量
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const deadData = @json($deadData);

        const ctx2 = document.getElementById('deadChart').getContext('2d');
        const deadChart = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: deadData.dates.map(date => date.split(' ')[0]), // 日付のラベル
                datasets: [{
                    label: 'Dead (kg)',
                    data: deadData.dead, // ベンチプレスの重量
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // 薄い赤
                    borderColor: 'rgba(255, 99, 132, 1)', // 濃い赤

                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const squatData = @json($squatData);

        const ctx3 = document.getElementById('squatChart').getContext('2d');
        const squatChart = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: squatData.dates.map(date => date.split(' ')[0]), // 日付のラベル
                datasets: [{
                    label: 'Squat (kg)',
                    data: squatData.squat, // ベンチプレスの重量
                    backgroundColor: 'rgba(255, 206, 86, 0.2)', // 薄い黄色
                    borderColor: 'rgba(255, 206, 86, 1)', // 濃い黄色
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

@endsection
