<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Models\{Appointment, User, Patient, Doctor, Specialty};
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Illuminate\Pagination\LengthAwarePaginator;

class Appointments extends Controller
{
  public function search()
  {
    $date_now = Date::now()->format('Y-m-d');
    $doctors = Doctor::all();
    $specialties = Specialty::all();
    $patients = Patient::all();
    $users = User::all();
    $appointments = Appointment::all();
    $auth_user = user::find(auth()->user()->id);

    if ($auth_user->hasRole('doctor')) {
      $doctors = Doctor::where('user_id', $auth_user->id)->get();
      $appointments = Appointment::where('doctor_id', $doctors[0]->id)->get();
    }
    if ($auth_user->hasRole('patient')) {
      $patients = Patient::where('user_id', $auth_user->id)->get();
      $appointments = Appointment::where('patient_id', $patients[0]->id)->get();
    }
    return view('content.pages.appointments.search', [
      'doctors' => $doctors,
      'specialties' => $specialties,
      'patients' => $patients,
      'users' => $users,
      'appointments' => $appointments,
      'date_now' => $date_now,
    ]);
  }
  public function index(Request $request)
  {

    if ($request->has('doctor_id') && $request->doctor_id != 0) {
      $doctor_id = $request->doctor_id;
    }
    if ($request->has('patient_id') && $request->patient_id != 0) {
      $patient_id = $request->patient_id;
    }
    if ($request->has('appointment_date') && $request->appointment_date != null) {
      $appointment_date = Date::createFromFormat('Y-m-d', $request->appointment_date)->format('Ymd');
    }
    if ($request->has('appointment_time') && $request->appointment_time != 0) {
      $appointment_time = $request->appointment_time;
    }



    $query = 'SELECT * FROM appointments WHERE ';
    if (isset($doctor_id)) {
      $query .= 'doctor_id = ' . $doctor_id . ' AND ';
    }
    if (isset($patient_id)) {
      $query .= 'patient_id = ' . $patient_id . ' AND ';
    }
    if (isset($appointment_date)) {
      $query .= "appointment_date = '" . $appointment_date . "' AND ";
    }
    if (isset($appointment_time)) {
      $query .= "appointment_time = '" . $appointment_time . "' AND ";
    }
    $query .= '1 = 1 ORDER BY appointment_date, appointment_time ASC';


    $rawResults = collect(DB::select($query));

    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 10;
    $currentItems = $rawResults->slice(($currentPage - 1) * $perPage, $perPage)->values();

    $appointments = new \Illuminate\Pagination\LengthAwarePaginator(
      $currentItems,
      $rawResults->count(),
      $perPage,
      $currentPage,
      ['path' => request()->url(), 'query' => request()->query()]
    );


    $users = User::all();
    $patients = Patient::all();
    $doctors = Doctor::all();

    return view('content.pages.appointments.home', [
      'appointments' => $appointments,
      'users' => $users,
      'patients' => $patients,
      'doctors' => $doctors,
    ]);
  }

  public function create()
  {

    return view('content.pages.appointments.create');
  }

  public function store(AppointmentRequest $request)
  {

    $appointment = new Appointment();
    $appointment->doctor_id = $request->doctor_id;
    $appointment->patient_id = $request->patient_id;
    $appointment->appointment_date = Date::createFromFormat('Y-m-d', $request->appointment_date)->format('Ymd');
    $appointment->appointment_time = $request->appointment_time;
    $appointment->consultation_hours = $request->consultation_hours;
    $appointment->save();
    return redirect()->route('pages-appointments-search');
  }

  public function show($appointment_id)
  {
    $appointment = Appointment::find($appointment_id);
    $doctor = Doctor::find($appointment->doctor_id);
    $patient = Patient::find($appointment->patient_id);
    $specialty = Specialty::find($doctor->specialty_id);
    $users = User::all();
    return view('content.pages.appointments.show', [
      'users' => $users,
      'appointment' => $appointment,
      'doctor' => $doctor,
      'patient' => $patient,
      'specialty' => $specialty,
    ]);
  }

  public function edit($appointment_id)
  {
    return view('content.pages.appointments.edit', [
      'appointment_id' => $appointment_id
    ]);
  }

  public function update(AppointmentRequest $request)
  {

    $appointment = Appointment::find($request->appointment_id);
    $appointment->doctor_id = $request->doctor_id;
    $appointment->patient_id = $request->patient_id;
    $appointment->appointment_date = Date::createFromFormat('Y-m-d', $request->appointment_date)->format('Ymd');
    $appointment->appointment_time = $request->appointment_time;
    $appointment->consultation_hours = $request->consultation_hours;
    $appointment->save();
    return redirect()->route('pages-appointments-search');
  }

  public function delete($appointment_id)
  {
    $appointment = Appointment::find($appointment_id);
    $doctor = Doctor::find($appointment->doctor_id);
    $patient = Patient::find($appointment->patient_id);
    $specialty = Specialty::find($doctor->specialty_id);
    $users = User::all();
    return view('content.pages.appointments.delete', [
      'users' => $users,
      'appointment' => $appointment,
      'doctor' => $doctor,
      'patient' => $patient,
      'specialty' => $specialty,
    ]);
  }

  public function destroy(Request $request)
  {
    $appointment = Appointment::find($request->appointment_id);
    $appointment->delete();
    return redirect()->route('pages-appointments-search');
  }
}
