@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Edit Doctor')

@section('content')



    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="mb-0">Edit Doctor</h3>
        </div>
        <form class="card-body" action="{{ route('pages-doctors-update') }}" method="POST">

            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
            <input type="hidden" name="user_id" value="{{ $doctor->user_id }}">

            <div class="row g-3">
                <div class="col-md-12">
                    <h6 class="fw-normal">Change patient data</h6>
                    <label class="form-label" for="multicol-name">Full name</label>
                    <input type="text" name="name" value="{{ $user->name }}" id="multicol-name" class="form-control"
                        placeholder="john.doe" />
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="multicol-email">Email</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="email" value="{{ $user->email }}" id="multicol-email"
                            class="form-control" placeholder="john.doe@example.com" />
                    </div>
                </div>
                <div class="col-md-12">
                    <hr class="my-4 mx-n3" />
                    <h6 class="fw-normal">Change password</h6>
                    <div class="form-password-toggle">
                        <label class="form-label" for="multicol-old-password">Current Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" name="old_password" id="multicol-old-password" class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                            <span class="input-group-text cursor-pointer" id="multicol-old-password2"><i
                                    class="bx bx-hide"></i></span>
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="form-password-toggle">
                        <label class="form-label" for="multicol-password">New Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" name="new_password" id="multicol-new-password" class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                            <span class="input-group-text cursor-pointer" id="multicol-new-password2"><i
                                    class="bx bx-hide"></i></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-password-toggle">
                        <label class="form-label" for="multicol-password">Confirm Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" name="new_password_confirmation" id="multicol-new-password-confirmation"
                                class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                            <span class="input-group-text cursor-pointer" id="multicol-new-password2-confirmation"><i
                                    class="bx bx-hide"></i></span>
                        </div>
                    </div>
                </div>

                @role('admin')
                <div class="col-md-12">
                    <hr class="my-4 mx-n3" />
                    <h6 class="fw-normal">Change doctor data</h6>
                    <label class="form-label" for="multicol-specialty">Specialty</label>
                    <select class="form-select" name="specialty_id" id="multicol-specialty">
                        @foreach ($specialties as $specialty)
                            <option value="{{ $specialty->id }}" @if ($doctor->specialty_id == $specialty->id) selected @endif>
                                {{ $specialty->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="multicol-salary">Annual Salary (€)</label>
                    <input type="number" name="annual_salary" value="{{ $doctor->annual_salary }}" id="multicol-salary"
                        class="form-control" placeholder="50000" />
                </div>

                <div class="col-md-12">
                    <small class="form-label" for="multicol-email">Status:</small>
                    <div class="form-check mt-3">
                        <input name="active" class="form-check-input" type="radio" value="1" id="defaultRadio1"
                            @if ($doctor->active == 1) checked @endif />
                        <label class="form-check-label" for="defaultRadio1">
                            Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input name="active" class="form-check-input" type="radio" value="0" id="defaultRadio2"
                            @if ($doctor->active == 0) checked @endif />

                        <label class="form-check-label" for="defaultRadio2">
                            Inactive
                        </label>
                    </div>
                </div>
                @endrole

                <div class="pt-4">
                    <button type="submit" class="btn btn-outline-success">Save</button>
                    <a href="{{ route('pages-doctors') }}" class="btn btn-outline-danger">Cancel</a>
                </div>
            </div>



        </form>
    </div>


@endsection
