@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Doctors')

@section('content')

    <!-- Bootstrap Table with Header - Dark -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="mb-0">Doctors</h3>
            @role('admin')
            <a href="{{ route('pages-doctors-create') }}"><button type="button" class="btn btn-outline-success"><i class="fa fa-plus" aria-hidden="true"></i></button></a>
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
                            <td>{{ $users->find($doctor->user_id)->name; }}</td>
                            <td>{{ $specialties->find($doctor->specialty_id)->name; }}</td>
                            <td>{{ $doctor->annual_salary }}</td>
                            <td>
                                @if ($doctor->active == 1)
                                    <span class="badge rounded-pill bg-label-success">Active</span>
                                @else
                                    <span class="badge rounded-pill bg-label-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $doctor->created_at }}</td>
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
        </div>
    </div>
    <!-- Bootstrap Table with Header Dark -->
@endsection
