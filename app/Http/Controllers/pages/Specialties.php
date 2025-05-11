<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpecialtyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Specialty;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Models\Doctor;
use App\Models\User;

class Specialties extends Controller
{
  public function index()
  {
    $specialties = Specialty::all();

    return view('content.pages.specialties.home', ['specialties' => $specialties]);
  }

  public function create()
  {
    return view('content.pages.specialties.create');
  }

  public function store(SpecialtyRequest $request)
  {
    $specialty = new Specialty();
    $specialty->name = $request->name;
    $specialty->active = $request-> active;
    $specialty->save();

    return redirect()->route('pages-specialties');
  }

  public function show($specialty_id)
  {
    $users = User::all();
    $doctors = Doctor::where('specialty_id', $specialty_id)->get();
    $specialty = Specialty::find($specialty_id);

    return view('content.pages.specialties.show', ['specialty' => $specialty, 'users' => $users, 'doctors' => $doctors]);
  }

  public function edit($specialty_id)
  {
    $specialty = Specialty::find($specialty_id);
    return view('content.pages.specialties.edit', ['specialty' => $specialty]);
  }

  public function update(SpecialtyRequest $request)
  {
    $specialty = Specialty::find($request->specialty_id);
    $specialty->name = $request->name;
    $specialty->active = $request-> active;
    $specialty->save();
    return redirect()->route('pages-specialties');
  }

  public function delete($specialty_id)
  {
    $specialty = Specialty::find($specialty_id);
    return view('content.pages.specialties.delete', ['specialty' => $specialty]);
  }

  public function destroy(Request $request )
  {
    $specialty = Specialty::find($request->specialty_id);
    $specialty->delete();
    return redirect()->route('pages-specialties');
  }
}
