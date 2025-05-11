@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Edit User')

@section('content')



    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="mb-0">Edit User</h3>
        </div>
        <form class="card-body" action="{{ route('pages-users-update') }}" method="POST">

            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="row g-3">
                <div class="col-md-12">
                    <h6 class="fw-normal">Change account details</h6>
                    <label class="form-label" for="user-name">Full Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" id="user-name" class="form-control"
                        placeholder="john.doe" required />
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="user-email">Email</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="email" value="{{ $user->email }}" id="user-email"
                            class="form-control" placeholder="john.doe@example.com" required />
                    </div>
                </div>

                <div class="col-md-12">
                    <hr class="my-4 mx-n3" />
                    <h6 class="fw-normal">Change Password</h6>
                    <div class="form-password-toggle">
                        <label class="form-label" for="multicol-old-password">Current Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" name="old_password" id="multicol-old-password" class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                            <span class="input-group-text cursor-pointer" id="multicol-old-password2"><i
                                    class="bx bx-hide"></i></span>
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="form-password-toggle">
                        <label class="form-label" for="multicol-new-password">New Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" name="new_password" id="multicol-new-password" class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                            <span class="input-group-text cursor-pointer" id="multicol-new-password2"><i
                                    class="bx bx-hide"></i></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-password-toggle">
                        <label class="form-label" for="multicol-new-password-confirmaion">Confirm Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" name="new_password_confirmation" id="multicol-new-password-confirmation"
                                class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                            <span class="input-group-text cursor-pointer" id="multicol-new-password2-confirmation"><i
                                    class="bx bx-hide"></i></span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="pt-4">
                <button type="submit" class="btn btn-outline-success">Save</button>
                <a href="{{ route('pages-users') }}" class="btn btn-outline-danger">Cancel</a>
            </div>

        </form>
    </div>


@endsection
