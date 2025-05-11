@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'View Doctor')

@section('content')



<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="mb-0">Doctor Data</h3>
    </div>
    <form class="card-body">

        @csrf

        <div class="row g-3">
            <div class="col-md-12">
                <label class="form-label" for="multicol-name">Full name</label>
                <input type="text" name="name" value="{{ $user->name }}" id="multicol-name" class="form-control"
                    placeholder="john.doe" readonly />
            </div>
            <div class="col-md-12">
                <label class="form-label" for="multicol-email">Email</label>
                <div class="input-group input-group-merge">
                    <input type="text" name="email" value="{{ $user->email }}" id="multicol-email"
                        class="form-control" placeholder="john.doe@example.com" readonly />
                </div>
            </div>

            <div class="col-md-12">
                <label class="form-label" for="multicol-specialty">Specialty</label>
                <div class="input-group input-group-merge">
                    <input type="text" name="specialty" value="{{ $specialty->name }}" id="multicol-specialty"
                        class="form-control" readonly />
                </div>
            </div>

            <div class="col-md-12">
                <label class="form-label" for="multicol-annual_salary">Annual Salary (€)</label>
                <div class="input-group input-group-merge">
                    <input type="text" name="annual_salary" value="{{ $doctor->annual_salary }}" id="multicol-annual_salary"
                        class="form-control" readonly />
                </div>
            </div>

            <div class="col-md-12">
                <small class="form-label" for="multicol-email">Status:</small>
                <div class="form-check mt-3">
                    <input name="active" class="form-check-input" type="radio" value="1" id="defaultRadio1" disabled @if ($doctor->active == 1) checked @endif/>
                    <label class="form-check-label" for="defaultRadio1">
                        Active
                    </label>
                </div>
                <div class="form-check">
                    <input name="active" class="form-check-input" type="radio" value="0" id="defaultRadio2" disabled @if ($doctor->active == 0) checked @endif/>

                    <label class="form-check-label" for="defaultRadio2">
                        Inactive
                    </label>
                </div>
            </div>



            <div class="pt-4">
                <a href="{{ route('pages-doctors') }}" class="btn btn-outline-primary">Return</a>
            </div>
        </div>
    </form>
</div>



@endsection
