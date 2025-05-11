@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')
    <h2 class="mb-5">Home Page</h4>
        @role('patient')
            <div class="d-flex justify-content-center">
                <div class="col-md-8 col-lg-8 mb-5">
                    <div class="card text-center">
                        <div class="card-header">
                            Next Appointment
                        </div>
                        @if ($next_appointment != null)
                            <div class="card-body">
                                <h5 class="card-title">
                                    Doctor:&nbsp;{{ $users->find($doctors->find($next_appointment->doctor_id)->user_id)->name }}
                                </h5>
                                <p class="card-text">
                                    Date:&nbsp;{{ Date::createFromFormat('Ymd', $next_appointment->appointment_date)->format('d/m/Y') }}
                                </p>
                                <p class="card-text">Time:&nbsp;{{ $next_appointment->appointment_time }}:00</p>
                                <a href="{{ route('pages-appointments-show', $next_appointment->id) }}"
                                    class="btn btn-primary">View Appointment</a>
                            </div>
                            <div class="card-footer text-muted">
                                Days for the next appointment: &nbsp;{{ $days_to_appointment }}
                            </div>
                        @else
                            <div class="card-body">
                                <h5 class="card-title">You have no upcoming appointments!</h5>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endrole
        @role('doctor')
            <div class="d-flex justify-content-center">
                <div class="col-md-8 col-lg-8 mb-5 ">
                    <div class="card text-center">
                        <div class="card-header">
                            Next Appointment
                        </div>
                        @if ($next_appointment != null)
                            <div class="card-body">
                                <h5 class="card-title">
                                    Patient:&nbsp;{{ $users->find($patients->find($next_appointment->patient_id)->user_id)->name }}
                                </h5>
                                <p class="card-text">
                                    Date:&nbsp;{{ Date::createFromFormat('Ymd', $next_appointment->appointment_date)->format('d/m/Y') }}
                                </p>
                                <p class="card-text">Time:&nbsp;{{ $next_appointment->appointment_time }}:00</p>
                                <div class="px-4">
                                    <a href="{{ route('pages-appointments-edit', $next_appointment->id) }}"
                                        class="btn btn-primary">Manage Appointment</a>
                                </div>

                            </div>
                        @else
                            <div class="card-body">
                                <h5 class="card-title">You have no upcoming appointments!</h5>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-xl-4 ">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <a href="{{ route('pages-patients') }}">
                                    <span class="avatar-initial rounded-circle bg-label-danger">
                                        <i class="fa fa-user-md fs-3"></i>
                                    </span>
                                </a>
                            </div>
                            <span class="d-block mb-1 text-nowrap">Patients</span>
                            <h2 class="mb-0">{{ $n_patients }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 ">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <a href="{{ route('pages-appointments-search') }}">
                                    <span class="avatar-initial rounded-circle bg-label-info">
                                        <i class="fa fa-calendar fs-3"></i>
                                    </span>
                                </a>
                            </div>
                            <span class="d-block mb-1 text-nowrap">Appointments</span>
                            <h2 class="mb-0">{{ $n_appointments }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        @endrole
        @role('admin')
            <div class="row d-flex justify-content-center">
                <div class="col-xl-2 ">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <a href="{{ route('pages-doctors') }}">
                                    <span class="avatar-initial rounded-circle bg-label-danger">
                                        <i class="fa fa-user-md fs-3"></i>
                                    </span>
                                </a>
                            </div>
                            <span class="d-block mb-1 text-nowrap">Doctors</span>
                            <h2 class="mb-0">{{ $n_doctors }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 ">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <a href="{{ route('pages-appointments-search') }}">
                                    <span class="avatar-initial rounded-circle bg-label-info">
                                        <i class="fa fa-calendar fs-3"></i>
                                    </span>
                                </a>
                            </div>
                            <span class="d-block mb-1 text-nowrap">Appointments</span>
                            <h2 class="mb-0">{{ $n_appointments }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 ">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <a href="{{ route('pages-patients') }}">
                                    <span class="avatar-initial rounded-circle bg-label-warning">
                                        <i class="fa fa-user fs-3"></i>
                                    </span>
                                </a>
                            </div>
                            <span class="d-block mb-1 text-nowrap">Patients</span>
                            <h2 class="mb-0">{{ $n_patients }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 ">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <a href="{{ route('pages-specialties') }}">
                                    <span class="avatar-initial rounded-circle bg-label-primary">
                                        <i class="fa fa-plus-square fs-3"></i>
                                    </span>
                                </a>
                            </div>
                            <span class="d-block mb-1 text-nowrap">Specialties</span>
                            <h2 class="mb-0">{{ $n_specialties }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 ">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <a href="{{ route('pages-users') }}">
                                    <span class="avatar-initial rounded-circle bg-label-success">
                                        <i class="fa fa-user-circle fs-3"></i>
                                    </span>
                                </a>
                            </div>
                            <span class="d-block mb-1 text-nowrap">Users</span>
                            <h2 class="mb-0">{{ $n_users }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        @endrole
    @endsection
