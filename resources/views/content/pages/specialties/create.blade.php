@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Add Speciality')

@section('content')

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="mb-0">Add Speciality</h3>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="card-body" action="{{ route('pages-specialties-store') }}" method="POST">

            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="multicol-name">Speciality Name</label>
                    <input type="text" name="name" id="multicol-name" class="form-control" placeholder="Ortodoncia"
                        required />
                </div>
                <div class="col-md-12">
                    <small class="form-label" for="multicol-email">Status:</small>
                    <div class="form-check mt-3">
                        <input name="active" class="form-check-input" type="radio" value="1" id="defaultRadio1"
                            checked />
                        <label class="form-check-label" for="defaultRadio1">
                            Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input name="active" class="form-check-input" type="radio" value="0" id="defaultRadio2" />
                        <label class="form-check-label" for="defaultRadio2">
                            Inactive
                        </label>
                    </div>
                </div>

            </div>

            <div class="pt-4">
                <button type="submit" class="btn btn-outline-success">Save</button>
                <button type="reset" class="btn btn-outline-primary">Clear</button>
                <a href="{{ route('pages-specialties') }}" class="btn btn-outline-danger">Cancel</a>
            </div>

        </form>
    </div>


@endsection
