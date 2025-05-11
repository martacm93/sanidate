@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Add Doctor')

@section('content')

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="mb-0">Add Doctor</h3>
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

        <form class="card-body" action="{{ route('pages-doctors-store') }}" method="POST">

            @csrf

            <div class="col-md-12">
                <label class="form-label" for="multicol-name">Full name</label>
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
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required>
                        <span class="input-group-text cursor-pointer" id="multicol-password2"><i
                                class="bx bx-hide"></i></span>
                    </div>
                </div>
            </div>
            <!--confirmacion de la contraseña-->
            <div class="col-md-12">
                <div class="form-password-toggle">
                    <label class="form-label" for="multicol-password_confirmation">Confirm Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" name="password_confirmation" id="multicol-password-confirmation"
                            class="form-control"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required>
                        <span class="input-group-text cursor-pointer" id="multicol-password2-confirmation"><i
                                class="bx bx-hide"></i></span>
                    </div>
                </div>
            </div>
            <div class="row g-3">

                <!-- Crear un select con las especialidades -->
                <div class="col-md-12">
                    <hr class="my-4 mx-n3" />
                    <label class="form-label" for="multicol-name">Specialty</label>
                    <select name="specialty_id" class="form-select" id="multicol-name" required>
                        <option value="">Select a specialty</option>
                        @foreach ($specialties as $specialty)
                            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12">

                    <label class="form-label" for="multicol-name">Annual salary (€)</label>
                    <input type="number" name="annual_salary" id="multicol-name" class="form-control" placeholder="50000"
                        required />

                </div>

                <div class="col-md-12">
                    <small class="form-label" for="multicol-email">Status:</small>
                    <div class="form-check mt-3">
                        <input name="active" class="form-check-input" type="radio" value="1" id="defaultRadio1"
                            checked />
                        <label class="form-check-label" for="defaultRadio1">
                            Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input name="active" class="form-check-input" type="radio" value="0" id="defaultRadio2" />
                        <label class="form-check-label" for="defaultRadio2">
                            Inactive
                        </label>
                    </div>
                </div>

            </div>

            <div class="pt-4">
                <button type="submit" class="btn btn-outline-success">Save</button>
                <button type="reset" class="btn btn-outline-primary">Clear</button>
                <a href="{{ route('pages-doctors') }}" class="btn btn-outline-danger">Cancel</a>
            </div>

        </form>
    </div>


@endsection
