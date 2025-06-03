@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Patients')

@section('content')

<!-- Bootstrap Table with Header - Dark -->
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between flex-wrap">
        <!-- Título centrado -->
        <h3 class="mx-auto my-2 fs-1">Patients</h3>
    </div>
    <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!-- Buscador -->
        <form method="GET" action="{{ route('pages-patients') }}" class="d-flex mb-2 mb-md-0">
            <input type="text" name="search" class="form-control me-2" placeholder="Search by name"
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary" title="Search">
                <i class="fa fa-search"></i> 
            </button>    
        </form>

        <!-- Botón de añadir -->
        @role('admin')
        <a href="{{ route('pages-patients-create') }}" class="btn btn-outline-success my-2">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
        @endrole
    </div>

    <div class="table-responsive text-nowrap">

        <table class="table text-center">
            <thead class="table">
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>AGE</th>
                    <th>GENDER</th>
                    <th>HEALTH WARNING</th>
                    <th>STATUS</th>
                    <th>CREATED DATE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @if($patients->isEmpty())
                <tr>
                    <td colspan="7">There are no registered patients or you do not have permission to view them!</td>
                </tr>
                @else
                @foreach ($patients as $patient)
                <tr>
                    <td>{{ $patient->id }}</td>
                    <td>{{ $patient->user->name }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->gender }}</td>
                    <!-- hacer un if que si tiene alertas sanitarias, que muestre el icono de alerta -->
                    <td>
                        <!-- si medical_warnings no es nulo -->
                        @if ($patient->medical_warnings != null)
                        <span class="badge rounded-pill bg-label-danger">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        </span>
                        @else
                        <span class="badge rounded-pill bg-label-success">
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        @endif
                    </td>
                    <td>
                        @if ($patient->active == 1)
                        <span class="badge rounded-pill bg-label-success">Active</span>
                        @else
                        <span class="badge rounded-pill bg-label-danger">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $patient->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('pages-patients-show', $patient->id) }}"><button type="button"
                                class="btn btn-outline-primary"><i class="fa fa-eye"
                                    aria-hidden="true"></i></button></a>
                        <a href="{{ route('pages-patients-edit', $patient->id) }}"><button type="button"
                                class="btn btn-outline-warning"><i class="fa fa-pencil"
                                    aria-hidden="true"></i></button></a>
                        @role('admin')
                        <a href="{{ route('pages-patients-delete', $patient->id) }}"><button type="button"
                                class="btn btn-outline-danger"><i class="fa fa-trash"
                                    aria-hidden="true"></i></button></a>
                        @endrole
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{ $patients->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
<!-- Bootstrap Table with Header Dark -->
@endsection