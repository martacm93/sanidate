<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatient;
use App\Http\Requests\UpdatePatient;
use Illuminate\Http\Request;
use App\Models\{Appointment, User, Patient};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;


class Patients extends Controller
{
  public function index(Request $request)
  {
    $auth_user = User::find(auth()->user()->id);
    $search = $request->input('search');

    $patients = Patient::with('user');

    if ($auth_user->hasRole('patient')) {
      $patients = Patient::with('user')->where('id', $auth_user->patient->id);
    } elseif ($auth_user->hasRole('doctor')) {
      $appoint_doctor = Appointment::where('doctor_id', $auth_user->doctor->id)->get();
      $patients = Patient::with('user')->whereIn('id', $appoint_doctor->pluck('patient_id')->unique());
    }

    // Si es admin o no entra en ningún filtro previo, se usa el query base
    $patients = is_a($patients, 'Illuminate\Database\Eloquent\Builder') ? $patients : Patient::with('user')->whereIn('id', $patients->pluck('id'));

    // Búsqueda por nombre del usuario
    if ($search) {
      $patients = $patients->whereHas('user', function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%');
      });
    }

    $patients = $patients->paginate(10)->appends(['search' => $search]);

    return view('content.pages.patients.home', ['patients' => $patients]);
  }


  public function create()
  {
    return view('content.pages.patients.create');
  }

  public function store(StorePatient $request)
  {
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();
    $user->assignRole('patient');

    $patient = new Patient();
    $patient->user_id = $user->id;
    $patient->age = $request->age;
    if ($request->gender == 0) {
      $patient->gender = 'Male';
    } elseif ($request->gender == 1) {
      $patient->gender = 'Female';
    }
    $patient->active = $request->active;
    $patient->medical_warnings = $request->medical_warnings;
    $patient->save();


    return redirect()->route('pages-patients');
  }

  public function show($patient_id)
  {
    $patient = Patient::find($patient_id);
    $user = User::find($patient->user_id);
    return view('content.pages.patients.show', ['patient' => $patient, 'user' => $user]);
  }

  public function edit($patient_id)
  {
    $patient = Patient::find($patient_id);
    $user = User::find($patient->user_id);

    return view('content.pages.patients.edit', ['patient' => $patient, 'user' => $user]);
  }

  public function update(UpdatePatient $request)
  {
    $patient = Patient::find($request->patient_id);
    $user = User::find($patient->user_id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->new_password);

    $patient->user_id = $user->id;
    $patient->age = $request->age;
    if ($request->gender == 0) {
      $patient->gender = 'Male';
    } elseif ($request->gender == 1) {
      $patient->gender = 'Female';
    }
    $patient->active = $request->active;
    $patient->medical_warnings = $request->medical_warnings;
    $user->save();
    $patient->save();

    return redirect()->route('pages-patients');
  }

  public function delete($patient_id)
  {
    $patient = Patient::find($patient_id);
    $user = User::find($patient->user_id);
    return view('content.pages.patients.delete', ['patient' => $patient, 'user' => $user]);
  }

  public function destroy(Request $request)
  {
    $patient = Patient::find($request->patient_id);
    $user = User::find($patient->user_id);
    $patient->delete();
    $user->delete();
    return redirect()->route('pages-patients');
  }
}
