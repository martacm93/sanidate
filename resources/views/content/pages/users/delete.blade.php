@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Delete User')

@section('content')



    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="mb-0">Delete user</h3>
        </div>
        <form class="card-body" action="{{ route('pages-users-destroy') }}" method="POST">

            @csrf

            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="user-name">Full Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" id="user-name" class="form-control"
                        placeholder="john.doe" readonly />
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="suer-email">Email</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="email" value="{{ $user->email }}" id="user-email"
                            class="form-control" placeholder="john.doe@example.com" readonly />
                    </div>
                </div>

                <div class="pt-4">
                    <input type="submit" class="btn btn-outline-danger" value="Delete">
                    <a href="{{ route('pages-users') }}" class="btn btn-outline-primary">Return</a>
                </div>
                
            </div>
        </form>
    </div>


@endsection
