@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Specialties')

@section('content')

<!-- Bootstrap Table with Header - Dark -->
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between flex-wrap">
        <h2 class="mx-auto my-2 fs-1">Specialties</h2>
    </div>

    <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
        <form method="GET" action="{{ route('pages-specialties') }}" class="d-flex align-items-center gap-2 flex-wrap flex-md-nowrap">
            <input type="text" name="search" class="form-control" placeholder="Specialty name"
                value="{{ request('search') }}" style="max-width: 250px;">

            <select name="status" class="form-select" style="min-width: 150px;">
                <option value="">All status</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
            </select>

            <button type="submit" class="btn btn-outline-primary" title="Search">
                <i class="fa fa-search"></i>
            </button>
        </form>

        @role('admin')
        <a href="{{ route('pages-specialties-create') }}" class="btn btn-outline-success my-2 my-md-0">
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
                    <td>{{ $specialty->created_at->format('d/m/Y H:i') }}</td>
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
        @if($specialties instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="d-flex justify-content-center mt-3">
            {{ $specialties->links('pagination::bootstrap-5') }}
        </div>
        @endif

    </div>
</div>
<!-- Bootstrap Table with Header Dark -->
@endsection