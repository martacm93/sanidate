@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Add User')

@section('content')

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="mb-0">Add User (*)</h3>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="card-body" action="{{ route('pages-users-store') }}" method="POST">

            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="multicol-name">Full Name</label>
                    <input type="text" name="name" id="multicol-name" class="form-control" placeholder="john.doe"
                        required />
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="multicol-email">Email</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="email" id="multicol-email" class="form-control"
                            placeholder="john.doe@example.com" required />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-password-toggle">
                        <label class="form-label" for="multicol-password">Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" name="password" id="multicol-password" class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                required>
                            <span class="input-group-text cursor-pointer" id="multicol-password2"><i
                                    class="bx bx-hide"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-password-toggle">
                        <label class="form-label" for="multicol-password_confirmation">Confirm Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" name="password_confirmation" id="multicol-password-confirmation"
                                class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                required>
                            <span class="input-group-text cursor-pointer" id="multicol-password2-confirmation"><i
                                    class="bx bx-hide"></i></span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="pt-4">
                <button type="submit" class="btn btn-outline-success">Save</button>
                <button type="reset" class="btn btn-outline-primary">Clear</button>
                <a href="{{ route('pages-users') }}" class="btn btn-outline-danger">Cancel</a>
            </div>

            <div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
                <p class="mb-0">
                    <strong>(*) Warning!</strong> Just add admin users. If you want to create a doctor o a patient, you must go to the corresponding section.
                </p>
            </div>

        </form>
    </div>


@endsection
