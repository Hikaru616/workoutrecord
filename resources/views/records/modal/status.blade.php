{{-- Delete --}}
<div class="modal fade" id="delete-record-{{ $record->id }}">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-danger fw-bold mx-auto">Delete Record</h2>
            </div>
            <form action="{{ route('record.destroy', $record->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p class="text-center">Are you sure you want to <span class="text-danger">Delete</span>
                        record on " {{ $record->date }},{{ date('D', strtotime($record->date)) }} " ?</p>
                    <div class="row mt-3">
                        <div class="col">
                            <button type="button" class=" btn btn-outline-danger w-100 fw-bold"
                                data-bs-dismiss="modal"><span>Close</span></button>
                        </div>
                        <div class="col">
                            <button type="submit" class=" btn btn-danger w-100 fw-bold">Delete</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit & Detail --}}

<div class="modal fade palanquin-dark-regular" id="detail-edit-record-{{ $record->id }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            {{-- サイズ変えたい --}}
            <div class="row justify-content-center add-bg-color">
                <div class="col px-5 pb-4">
                    <form action="{{ route('record.updateDetail', $record->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="modal-header">
                            <h2 class="modal-title modal-title fw-bold mx-auto">Detail & Edit</h2>
                        </div>

                        <div class="my-3">
                            <label for="date" class="form-label fw-bold">Date</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ $record->date }}" autofocus>
                            @error('date')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">

                            <label for="category" class="form-label d-block fw-bold">
                                Training Part
                            </label>

                            <div class="mt-2">
                                @foreach ($all_categories as $category)
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input"
                                        @if($record->categoryRecord->contains('category_id', $category->id)) checked @endif>
                                        <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
                                    </div>
                                @endforeach

                                @error('category')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror

                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="memo" class="form-label m-0 fw-bold">memo</label>
                            <textarea name="memo" id="memo" rows="5" class="form-control" placeholder="memo">{{ $record->memo }}</textarea>
                        </div>

                        <div class="">
                            @csrf
                            <div class="row mt-3 w-100">
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm  text-white w-100"
                                    style="box-shadow: 0 2px 6px #c5c0f2; background-color:#6777EF;"
                                        data-bs-dismiss="modal"><span>Close</span></button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-sm text-white w-100"
                                    style="box-shadow: 0 2px 6px #c5c0f2; background-color:#6777EF;">Edit</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
