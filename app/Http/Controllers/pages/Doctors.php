<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Http\Requests\StoreDoctor;
use App\Http\Requests\UpdateDoctor;
use Illuminate\Http\Request;
use App\Models\{Doctor, Specialty, User};
use Illuminate\Support\Facades\Hash;

class Doctors extends Controller
{

  public function index()
  {
    $doctors = Doctor::all();
    $specialties = Specialty::all();
    $auth_user = user::find(auth()->user()->id);
    if($auth_user->hasRole('admin')){
      $users = User::all();
    }else{
      $users = $auth_user;
      if($auth_user->doctor != null)
      $doctors = [doctor::find($auth_user->doctor->id)];
      else{
        $doctors = [];
      }
    }

    return view('content.pages.doctors.home', ['doctors' => $doctors, 'users' => $users, 'specialties' => $specialties]);
  }

  public function create()
  {
    $specialties = Specialty::where('active', 1)->get();
    return view('content.pages.doctors.create', ['specialties' => $specialties]);
  }

  public function store(StoreDoctor $request)
  {

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();
    $user->assignRole('doctor');

    $doctor = new Doctor();
    $doctor->specialty_id = $request->specialty_id;
    $doctor->user_id = $user->id;
    $doctor->annual_salary = $request->annual_salary;
    $doctor->active = $request-> active;
    $doctor->save();

    return redirect()->route('pages-doctors');
  }

  public function show($doctor_id)
  {
    $doctor = Doctor::find($doctor_id);
    $user = User::find($doctor->user_id);
    $specialty = Specialty::find($doctor->specialty_id);
    return view('content.pages.doctors.show', ['doctor' => $doctor, 'user' => $user, 'specialty' => $specialty]);
  }

  public function edit($doctor_id)
  {
    $doctor = Doctor::find($doctor_id);
    $user = User::find($doctor->user_id);
    $specialties = Specialty::where('active', 1)->get();
    return view('content.pages.doctors.edit', ['doctor' => $doctor, 'user' => $user, 'specialties' => $specialties]);
  }

  public function update(UpdateDoctor $request)
  {
    $doctor = Doctor::find($request->doctor_id);
    $user = User::find($doctor->user_id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->new_password);
    $doctor->specialty_id = $request->specialty_id;
    $doctor->active = $request-> active;
    $doctor->annual_salary = $request->annual_salary;
    $user->save();
    $doctor->save();
    return redirect()->route('pages-doctors');
  }

  public function delete($doctor_id)
  {
    $doctor = Doctor::find($doctor_id);
    $user = User::find($doctor->user_id);
    $specialty = Specialty::find($doctor->specialty_id);
    return view('content.pages.doctors.delete', ['doctor' => $doctor, 'user' => $user, 'specialty' => $specialty]);
  }

  public function destroy(Request $request)
  {
    $doctor = Doctor::find($request->doctor_id);
    $user = User::find($doctor->user_id);
    $user->delete();
    $doctor->delete();
    return redirect()->route('pages-doctors');
  }
  
}
