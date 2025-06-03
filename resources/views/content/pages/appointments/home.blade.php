@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Appointments')

@section('content')

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between flex-wrap">
        <h2 class="mx-auto my-2 fs-1">Appointments</h2>
    </div>
    <div class="card-header d-flex justify-content-between align-items-center">
        <!-- Botón Buscar a la izquierda -->
        <a href="{{ route('pages-appointments-search') }}" class="btn btn-outline-primary">
            <i class="fa fa-search"></i>
        </a>

        <!-- Botón Añadir a la derecha -->
        @role(['admin', 'doctor'])
        <a href="{{ route('pages-appointments-create') }}" class="btn btn-outline-success">
            <i class="fa fa-plus"></i>
        </a>
        @endrole
    </div>


    <div class="table-responsive text-nowrap">

        <table class="table text-center">
            <thead class="table">
                <tr>
                    <th>ID</th>
                    <th>DOCTOR</th>
                    <th>PATIENT</th>
                    <th>DATE</th>
                    <th>TIME</th>
                    <th>UPDATED DATE</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @if(empty($appointments))
                <tr>
                    <td colspan="7">There are no appointments with the selected filters!</td>
                </tr>
                @endif

                @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->id }}</td>
                    <td>{{ $users->find($doctors->find($appointment->doctor_id)->user_id)->name }}</td>
                    <td>{{ $users->find($patients->find($appointment->patient_id)->user_id)->name }}</td>
                    <td>{{ Date::createFromFormat('Ymd',$appointment->appointment_date)->format('d/m/Y') }}</td>
                    <td>{{ $appointment->appointment_time }}:00 - {{ $appointment->appointment_time + $appointment->consultation_hours }}:00</td>
                    <td>{{ $appointment->updated_at }}</td>
                    <td>
                        <a href="{{ route('pages-appointments-show', $appointment->id) }}"><button type="button"
                                class="btn btn-outline-primary"><i class="fa fa-eye"
                                    aria-hidden="true"></i></button></a>
                        @role(['admin', 'doctor'])
                        <a href="{{ route('pages-appointments-edit', $appointment->id) }}"><button type="button"
                                class="btn btn-outline-warning"><i class="fa fa-pencil"
                                    aria-hidden="true"></i></button></a>
                        <a href="{{ route('pages-appointments-delete', $appointment->id) }}"><button type="button"
                                class="btn btn-outline-danger"><i class="fa fa-trash"
                                    aria-hidden="true"></i></button></a>
                        @endrole
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($appointments instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="d-flex justify-content-center mt-3">
            {{ $appointments->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>
<!-- Bootstrap Table with Header Dark -->
@endsection