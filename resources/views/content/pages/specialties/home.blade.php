@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Specialties')

@section('content')

    <!-- Bootstrap Table with Header - Dark -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="mb-0">Specialties</h3>
            @role('admin')
            <a href="{{ route('pages-specialties-create') }}"><button type="button" class="btn btn-outline-success"><i class="fa fa-plus" aria-hidden="true"></i></button></a>
            @endrole
        </div>
        <div class="table-responsive text-nowrap">
            
            <table class="table text-center">
                <thead class="table">
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>STATUS</th>
                        <th>CREATED DATE</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($specialties as $specialty)
                        <tr>
                            <td>{{ $specialty->id }}</td>
                            <td>{{ $specialty->name }}</td>
                            <td>
                                @if ($specialty->active == 1)
                                    <span class="badge rounded-pill bg-label-success">Active</span>
                                @else
                                    <span class="badge rounded-pill bg-label-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $specialty->created_at }}</td>
                            <td>
                                <a href="{{ route('pages-specialties-show', $specialty->id) }}"><button type="button" class="btn btn-outline-primary"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                @role('admin')
                                <a href="{{ route('pages-specialties-edit', $specialty->id) }}"><button type="button" class="btn btn-outline-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                                <a href="{{ route('pages-specialties-delete', $specialty->id) }}"><button type="button" class="btn btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
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
