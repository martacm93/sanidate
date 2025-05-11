@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Delete Speciality')

@section('content')



    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="mb-0">Delete Speciality</h3>
        </div>
        <form class="card-body" action="{{ route('pages-specialties-destroy') }}" method="POST" >

            @csrf

            <input type="hidden" name="specialty_id" value="{{ $specialty->id }}">
            <div class="col-md-12">
                <label class="form-label" for="multicol-name">Speciality Name</label>
                <input type="text" name="name" value="{{ $specialty->name }}" id="multicol-name" class="form-control" placeholder="Ortodoncia"
                    required readonly />
            </div>
            <div class="col-md-12">
                <small class="form-label" for="multicol-email">Status:</small>
                <div class="form-check mt-3">
                    <input name="active" class="form-check-input" type="radio" value="1" id="defaultRadio1" disabled @if ($specialty->active == 1) checked @endif/>
                    <label class="form-check-label" for="defaultRadio1">
                        Active
                    </label>
                </div>
                <div class="form-check">
                    <input name="active" class="form-check-input" type="radio" value="0" id="defaultRadio2" disabled @if ($specialty->active == 0) checked @endif/>

                    <label class="form-check-label" for="defaultRadio2">
                        Inactive
                    </label>
                </div>
            </div>

            <div class="pt-4">
                <input type="submit" class="btn btn-outline-danger" value="Delete">
                <a href="{{ route('pages-specialties') }}" class="btn btn-outline-primary">Return</a>
            </div>
    </div>
    </form>
    </div>


@endsection