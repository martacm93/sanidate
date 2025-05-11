@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Edit Patient')

@section('content')



    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="mb-0">Edit Patient</h3>
        </div>
        <form class="card-body" action="{{ route('pages-patients-update') }}" method="POST">

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

            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            <input type="hidden" name="user_id" value="{{ $patient->user_id }}">

        
            <div class="row g-3">
                <div class="col-md-12">
                    <h6 class="fw-normal">Change user data</h6>
                    <label class="form-label" for="multicol-name">Full Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" id="multicol-name" class="form-control"
                        placeholder="john.doe" @role(['doctor']) disabled @endrole />
                </div>
            @role(['admin', 'patient'])
                <div class="col-md-12">
                    <label class="form-label" for="multicol-email">Email</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="email" value="{{ $user->email }}" id="multicol-email"
                            class="form-control" placeholder="john.doe@example.com" />
                    </div>
                </div>
                <div class="col-md-12">
                    <hr class="my-4 mx-n3" />
                    <h6 class="fw-normal">Change Password</h6>
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

               @endrole
                

                <div class="col-md-12">
                    <hr class="my-4 mx-n3" />
                    <h6 class="fw-normal">Change patient data</h6>
                    <label class="form-label" for="multicol-age">Age</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="age" value="{{ $patient->age }}" id="multicol-age"
                            class="form-control" @role(['patient']) disabled @endrole />
                    </div>
                </div>


                <div class="col-md-12">
                    <small class="form-label" for="multicol-gender">Gender:</small>
                    <div class="form-check mt-3">
                        <input name="gender" class="form-check-input" type="radio" value="1" id="defaultRadio1"
                            @if ($patient->gender == 'Female') checked @endif @role(['patient']) disabled @endrole />
                        <label class="form-check-label" for="defaultRadio1">
                            Female
                        </label>
                    </div>
                    <div class="form-check">
                        <input name="gender" class="form-check-input" type="radio" value="0" id="defaultRadio2"
                            @if ($patient->gender == 'Male') checked @endif @role(['patient']) disabled @endrole />
                        <label class="form-check-label" for="defaultRadio2">
                            Male
                        </label>
                    </div>
                </div>

                <!--  input alertas sanitarias -->
                <div class="col-md-12">
                    <label for="exampleFormControlTextarea1" class="form-label">Health Warnings</label>
                    <textarea name="medical_warnings" class="form-control" id="exampleFormControlTextarea1" rows="3" @role(['patient']) disabled @endrole >{{ $patient->medical_warnings }}</textarea>
                </div>

                <div class="col-md-12">
                    <small class="form-label" for="multicol-gender">Status:</small>
                    <div class="form-check mt-3">
                        <input name="active" class="form-check-input" type="radio" value="1" id="defaultRadio3" @role(['patient']) disabled @endrole
                             @if ($patient->active == 1) checked @endif  />
                        <label class="form-check-label" for="defaultRadio3">
                            Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input name="active" class="form-check-input" type="radio" value="0" id="defaultRadio4" @role(['patient']) disabled @endrole
                             @if ($patient->active == 0) checked @endif />
                        <label class="form-check-label" for="defaultRadio4">
                            Inactive
                        </label>
                    </div>
                </div>
            </div>
            

            <div class="pt-4">
                <button type="submit" class="btn btn-outline-success">Save</button>
                <a href="{{ route('pages-patients') }}" class="btn btn-outline-danger">Cancel</a>
            </div>




        </form>
    </div>


@endsection
