@extends('layouts.app')

@section('title', 'GymHome')

@section('content')
    <div class="row justify-content-center mt-5 text-white">
        <div class="col-8">
            <form action="{{ route('record.store') }}" method="POST" class="bg-dark shadow rounded-3 p-5" enctype="multipart/form-data">
                @csrf

                <h2 class="fw-light mb-3">Update Gym Records</h2>

                <div class="mb-3">
                    <label for="date" class="form-label fw-bold">Date</label>
                    <input type="date" name="date" id="date" class="form-control" autofocus>
                    @error('date')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label d-block fw-bold">
                        Training Part
                    </label>

                    @foreach ($all_categories as $category)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input">
                            <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
                        </div>
                    @endforeach
                    @error('category')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="memo" class="form-label fw-bold">MEMO</label>
                   <textarea name="memo" id="memo" rows="5" class="form-control" placeholder="Describe yourself"></textarea>
                </div>

                <button type="submit" class="btn btn-warning px-5">Save</button>
            </form>
        </div>
    </div>
@endsection


