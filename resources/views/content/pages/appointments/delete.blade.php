@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Delete Appointment')

@section('content')



    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="mb-0">Delete Appointment</h3>
        </div>
        <form class="card-body" action="{{ route('pages-appointments-destroy') }}" method="POST" >

            @csrf

            <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="patient_name">Patient</label>
                    <input type="text" name="name" value="{{ $users->find($patient->user_id)->name }}" id="patient_name" class="form-control"
                        placeholder="" readonly />
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="doctor_name">Doctor</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="doctor_name" value="{{ $users->find($doctor->user_id)->name }}" id="doctor_name"
                            class="form-control" placeholder="" readonly />
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="multicol-specialty">Specialty</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="specialty" value="{{ $specialty->name }}" id="multicol-specialty"
                            class="form-control" readonly />
                    </div>
                </div>

                <div class="col-md-12 d-flex justify-content-around">
                    <div class="col-md-5">
                        <label class="form-label" for="appointment_date">Date</label>
                        <div class="input-group input-group-merge">
                            <input type="text" name="appointment_date" value="{{ Date::createFromFormat('Ymd',$appointment->appointment_date)->format('d/m/Y')}}"
                                id="appointment_date" class="form-control" readonly />
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label" for="appointment_time">Time</label>
                        <div class="input-group input-group-merge">
                            <input type="text" name="appointment_time" value="{{ $appointment->appointment_time }}:00 - {{ $appointment->appointment_time + 1 }}:00"
                                id="appointment_time" class="form-control" readonly />
                        </div>
                    </div>
            
                </div>

            <div class="pt-4">
                <input type="submit" class="btn btn-outline-danger" value="Delete">
                <a href="{{ route('pages-appointments-search') }}" class="btn btn-outline-primary">Return</a>
            </div>
    </div>
    </form>
    </div>


@endsection