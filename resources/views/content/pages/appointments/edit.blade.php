@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Edit Appointment')

@section('content')



    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="mb-0">Edit Appointment</h3>
        </div>
        

            @livewire('appointment-edit', ['appointment_id' => $appointment_id])
    </div>


@endsection
