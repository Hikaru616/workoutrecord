@extends('layouts.app')

@section('title', 'GymHome')

@section('content')


<div class="row justify-content-center mt-5">
    <div class="col-10">

      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4>All Records</h4>
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
            <form action="{{ route('home') }}">
                <button class="btn btn-sm d-flex justify-content-end text-white"
                    style="box-shadow: 0 2px 6px #c5c0f2; background-color:#6777EF;">Home <span
                        class="ms-1"><i class="fa-solid fa-person-walking-arrow-right"></i></span></button>
            </form>
        </div>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive table-invoice">
            <table class="table table-striped">
              <tr>
                <th>DATE</th>
                <th>DOW</th>
                <th>PART</th>
                <th>MEMO</th>
                <th></th>
                <th></th>
              </tr>


              @foreach ($all_records as $record)
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
                    <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $record->memo }}</td>
                    <td>
                        <button type="button" class="btn btn-primary ms-2 btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#detail-edit-record-{{ $record->id }}">Detail</button>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-danger ms-2 btn-sm" data-bs-toggle="modal"
                        data-bs-target="#delete-record-{{ $record->id }}">

                     Delete </button>
                        @include('records.modal.status')
                    </td>
                </tr>
            @endforeach
            </table>
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-center mt-3">
        {{ $all_records->links() }}
      </div>

    </div>
@endsection
