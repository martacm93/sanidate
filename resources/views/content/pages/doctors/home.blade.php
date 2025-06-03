@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Doctors')

@section('content')

<!-- Bootstrap Table with Header - Dark -->
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between flex-wrap">
        <h2 class="mx-auto my-2 fs-1">Doctors</h2>
    </div>
    <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
        <form method="GET" action="{{ route('pages-doctors') }}" class="d-flex align-items-center gap-2 flex-wrap flex-md-nowrap">
            <!-- Input de búsqueda -->
            <input type="text" name="search" class="form-control" placeholder="Doctor name"
                value="{{ request('search') }}" style="max-width: 250px;">

            <!-- Select de especialidades -->
            <select name="specialty" class="form-select" style="min-width: 200px;">
                <option value="">All Specialties</option>
                @foreach($specialties as $spec)
                <option value="{{ $spec->id }}" {{ request('specialty') == $spec->id ? 'selected' : '' }}>
                    {{ $spec->name }}
                </option>
                @endforeach
            </select>

            <!-- Botón de búsqueda -->
            <button type="submit" class="btn btn-outline-primary" title="Search">
                <i class="fa fa-search"></i>
            </button>
        </form>

        <!-- Botón de añadir -->
        @role('admin')
        <a href="{{ route('pages-doctors-create') }}" class="btn btn-outline-success my-2 my-md-0">
            <i class="fa fa-plus"></i>
        </a>
        @endrole
    </div>

    <div class="table-responsive text-nowrap">

        <table class="table text-center">
            <thead class="table">
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>SPECIALTY</th>
                    <th>ANNUAL SALARY (€)</th>
                    <th>STATUS</th>
                    <th>CREATED DATE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @if(empty($doctors))
                <tr>
                    <td colspan="7">There are no registered doctors or you do not have permission to view them!</td>
                </tr>
                @endif
                @foreach ($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->id }}</td>
                    <td>{{ $doctor->user->name }}</td>
                    <td>{{ $doctor->specialty->name }}</td>
                    <td>{{ $doctor->annual_salary }}</td>
                    <td>
                        @if ($doctor->active == 1)
                        <span class="badge rounded-pill bg-label-success">Active</span>
                        @else
                        <span class="badge rounded-pill bg-label-danger">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $doctor->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('pages-doctors-show', $doctor->id) }}"><button type="button" class="btn btn-outline-primary"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                        <a href="{{ route('pages-doctors-edit', $doctor->id) }}"><button type="button" class="btn btn-outline-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                        @role('admin')
                        <a href="{{ route('pages-doctors-delete', $doctor->id) }}"><button type="button" class="btn btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                        @endrole
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($doctors instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="d-flex justify-content-center mt-3">
            {{ $doctors->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>
<!-- Bootstrap Table with Header Dark -->
@endsection