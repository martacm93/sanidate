@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Users')

@section('content')

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between flex-wrap">
        <!-- Título centrado -->
        <h2 class="mx-auto my-2 fs-1">Users</h2>
    </div>

    <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!-- Buscador -->
        <form method="GET" action="{{ route('pages-users') }}" class="d-flex align-items-center gap-2 flex-nowrap">
            <input type="text" name="search" class="form-control" placeholder="Search by name or email"
                value="{{ request('search') }}" style="max-width: 250px;">

            <select name="role" class="form-select" style="width: 150px;">
                <option value="">All Roles</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="doctor" {{ request('role') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                <option value="patient" {{ request('role') == 'patient' ? 'selected' : '' }}>Patient</option>
            </select>

            <button type="submit" class="btn btn-outline-primary" title="Search">
                <i class="fa fa-search"></i> 
            </button>
        </form>
        <!-- Botón de añadir -->
        @role('admin')
        <a href="{{ route('pages-users-create') }}" class="btn btn-outline-success my-2">
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
                    <th>EMAIL</th>
                    <th>ROLE</th>
                    <th>CREATED DATE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->hasRole('admin'))
                        <span class="badge rounded-pill bg-label-primary">Admin</span>
                        @elseif ($user->hasRole('doctor'))
                        <span class="badge rounded-pill bg-label-success">Doctor</span>
                        @elseif ($user->hasRole('patient'))
                        <span class="badge rounded-pill bg-label-warning">Patient</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('pages-users-show', $user->id) }}"><button type="button" class="btn btn-outline-primary"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                        <a href="{{ route('pages-users-edit', $user->id) }}"><button type="button" class="btn btn-outline-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                        @role('admin')
                        <a href="{{ route('pages-users-delete', $user->id) }}"><button type="button" class="btn btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                        @endrole
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection