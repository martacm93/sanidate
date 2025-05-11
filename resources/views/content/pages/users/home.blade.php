@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Users')

@section('content')

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="mb-0">Users</h3>
            @role('admin')
            <a href="{{ route('pages-users-create') }}"><button type="button" class="btn btn-outline-success"><i class="fa fa-plus" aria-hidden="true"></i></button></a>
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
                            <td>{{ $user->created_at }}</td>
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
        </div>
    </div>
    
@endsection
