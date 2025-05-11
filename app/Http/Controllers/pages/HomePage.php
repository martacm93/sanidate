<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Appointment, Patient, Doctor, User, Specialty};
use Illuminate\Support\Facades\Date;

class HomePage extends Controller
{
  public function index()
  {
    $n_patients = Patient::where('active','1')->count();
    $n_doctors = Doctor::where('active','1')->count();
    $n_appointments = Appointment::all()->count();
    $n_users = User::all()->count();
    $n_specialties = Specialty::all()->count();
    $users = User::all();
    $patients = Patient::all();
    $doctors = Doctor::all();
    $specialties = Specialty::all();
    $todayDate = Date::now()->format('Y-m-d');
    $next_appointment = null;

    $auth_user = user::find(auth()->user()->id);
    if($auth_user->hasRole('patient')){
    $next_appointment = Appointment::where('patient_id', $auth_user->patient->id)
      ->where('active', '1')
      ->orderBy('appointment_date', 'asc')
      ->orderBy('appointment_time', 'asc')
      ->first();
    }
    if($auth_user->hasRole('doctor')){
    $next_appointment = Appointment::where('doctor_id', $auth_user->doctor->id)
      ->where('active', '1')
      ->orderBy('appointment_date', 'asc')
      ->orderBy('appointment_time', 'asc')
      ->first();
    $n_patients = Appointment::where('doctor_id', $auth_user->doctor->id)->distinct('patient_id')->count();
    $n_appointments = Appointment::where('doctor_id', $auth_user->doctor->id)->count();
    }

    if($next_appointment != null){
      $appoint_date = Date::createFromFormat('Ymd', $next_appointment->appointment_date);
      $days_to_appointment = $appoint_date->diffInDays($todayDate);
    }

    
    return view('content.pages.pages-home', [
      'n_patients' => $n_patients,
      'n_doctors' => $n_doctors,
      'n_appointments' => $n_appointments,
      'n_users' => $n_users,
      'n_specialties' => $n_specialties,
      'next_appointment' => $next_appointment ?? null,
      'users' => $users,
      'patients' => $patients,
      'doctors' => $doctors,
      'specialties' => $specialties,
      'days_to_appointment' => $days_to_appointment ?? null,
    ]);
  }
}
