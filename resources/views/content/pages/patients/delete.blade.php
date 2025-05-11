@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Delete Patient')

@section('content')



    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="mb-0">Delete Patient</h3>
        </div>
        <form class="card-body" action="{{ route('pages-patients-destroy') }}" method="POST">

            @csrf

            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="multicol-name">Full name</label>
                    <input type="text" name="name" value="{{ $user->name }}" id="multicol-name" class="form-control"
                        placeholder="john.doe" readonly />
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="multicol-email">Email</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="email" value="{{ $user->email }}" id="multicol-email"
                            class="form-control" placeholder="john.doe@example.com" readonly />
                    </div>
                </div>


                <div class="col-md-12">
                    <label class="form-label" for="multicol-age">Age</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="age" value="{{ $patient->age }}" id="multicol-age"
                            class="form-control" readonly />
                    </div>
                </div>


                <div class="col-md-12">
                    <small class="form-label" for="multicol-gender">Gender:</small>
                    <div class="form-check mt-3">
                        <input name="gender" class="form-check-input" type="radio" value="1" id="defaultRadio1"
                        disabled @if ($patient->gender == "Female") checked @endif />
                        <label class="form-check-label" for="defaultRadio1">
                            Female
                        </label>
                    </div>
                    <div class="form-check">
                        <input name="gender" class="form-check-input" type="radio" value="0" id="defaultRadio2" disabled @if ($patient->gender == "Male") checked @endif/>
                        <label class="form-check-label" for="defaultRadio2">
                            Male
                        </label>
                    </div>
                </div>

                <!--  input alertas sanitarias -->
                <div class="col-md-12">
                    <label for="exampleFormControlTextarea1" class="form-label">Alertas Sanitarias</label>
                    <textarea name="medical_warnings" class="form-control" id="exampleFormControlTextarea1" rows="3" readonly>{{ $patient->medical_warnings }}</textarea>
                </div>

                <div class="col-md-12">
                    <small class="form-label" for="multicol-gender">Estado:</small>
                    <div class="form-check mt-3">
                        <input name="active" class="form-check-input" type="radio" value="1" id="defaultRadio3"
                            disabled @if ($patient->active == 1) checked @endif />
                        <label class="form-check-label" for="defaultRadio3">
                            Activo
                        </label>
                    </div>
                    <div class="form-check">
                        <input name="active" class="form-check-input" type="radio" value="0" id="defaultRadio4"
                            disabled @if ($patient->active == 0) checked @endif />
                        <label class="form-check-label" for="defaultRadio4">
                            No activo
                        </label>
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <input type="submit" class="btn btn-outline-danger" value="Eliminar">
                <a href="{{ route('pages-patients') }}" class="btn btn-outline-primary">Volver</a>

            </div>
        </form>
    </div>


@endsection
