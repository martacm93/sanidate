@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Filter Appointments')

@section('content')


    <div class="d-flex align-items-center justify-content-center">

        <div class="card col-8">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="mb-0">Filter Appointments</h3>
            </div>
            <form class="card-body" action="{{ route('pages-appointments') }}" method="GET">

                @csrf

                <div class="mb-3">
                    <label for="doctor" class="form-label">Doctor</label>
                    <select class="select2 form-select" id="doctor" name="doctor_id" aria-label="Default select example">
                        @role(['admin', 'patient'])<option value="0">All</option>@endrole
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}">
                                {{ $users->find($doctor->user_id)->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 ">
                    
                    <label for="patient" class="form-label">Patient</label>
                    <select class="select2 form-select" id="patient" name="patient_id"
                        aria-label="Default select example">
                        @role(['admin', 'doctor'])<option value="0">All</option>@endrole
                        @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}" >
                                {{ $users->find($patient->user_id)->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="day" class="form-label">Date</label>
                    <div class="col">
                        <input class="form-control" name="appointment_date" type="date" id="day">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="time" class="form-label">Time</label>
                    <select class="select2 form-select" id="time" name="appointment_time"
                        aria-label="Default select example">
                        <option value="0" selected>All</option>
                        @for ($i = 8; $i < 22; $i++)
                            <option value="{{ $i }}">{{ $i }}:00-{{ $i + 1 }}:00</option>
                        @endfor
                    </select>
                </div>
                <div class="pt-4">
                    <input type="submit" class="btn btn-outline-primary" value="Filter">
                </div>
            </form>
        </div>

    </div>


@endsection
