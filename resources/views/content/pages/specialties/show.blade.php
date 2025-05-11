@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'View Speciality')

@section('content')



    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="mb-0">Speciality Data</h3>
        </div>
        <form class="card-body">

            @csrf
            <div class="row g-3 md-3 ">
                <div class="col-md-12">
                    <label class="form-label" for="multicol-name">Speciality Name</label>
                    <input type="text" name="name" value="{{ $specialty->name }}" id="multicol-name"
                        class="form-control" placeholder="Ortodoncia" required readonly />
                </div>
                <!--
                        <div class="col-md-12">
                            <small class="form-label" for="multicol-email">Status:</small>
                            <div class="form-check mt-3">
                                <input name="active" class="form-check-input" type="radio" value="1" id="defaultRadio1"
                                    disabled @if ($specialty->active == 1) checked @endif />
                                <label class="form-check-label" for="defaultRadio1">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input name="active" class="form-check-input" type="radio" value="0" id="defaultRadio2"
                                    disabled @if ($specialty->active == 0) checked @endif />

                                <label class="form-check-label" for="defaultRadio2">
                                    Inactive
                                </label>
                            </div>
                        </div>
                        -->


                <div class="col-md-12 d-flex justify-content-center">
                    <div class="col-md-8 col-xl-6 col-xxl-6 mb-xxl-0 mb-4 order-2 order-lg-0 text-center">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Doctors</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-borderless mb-1">
                                    <tbody>
                                        <tr>
                                            @if (count($doctors) == 0)
                                                <td>
                                                    <div class="align-items-center">
                                                        <p class="lh-1 text-nowrap mb-0">There are no registered doctors in
                                                            this specialty!</p>
                                                    </div>
                                                </td>
                                        </tr>
                                    @else
                                        @foreach ($doctors as $doctor)
                                            <tr>
                                                <td>
                                                    <div class="align-items-center">
                                                        <p class="lh- text-nowrap mb-0">
                                                            {{ $users->find($doctor->user_id)->name }}</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <a href="{{ route('pages-specialties') }}" class="btn btn-outline-primary">Return</a>
                </div>
            </div>
        </form>
    </div>


@endsection
