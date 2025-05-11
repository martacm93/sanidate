<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{Doctor, Patient, User, Appointment};
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class AppointmentSelect extends Component
{
  public $doctors= [];
  public $patients= [];
  public $users= [];
  public $appointments= [];


  public $selectedDoctor;
  public $selectedPatient;
  public $selectedDate;
  
  
  public function render()
  {

    $this->doctors = Doctor::all();
    $this->patients = Patient::all();
    $this->users = User::all();
    $auth_user = User::find(auth()->user()->id);
    if ($auth_user->hasRole('doctor')){
      $this->doctors = Doctor::where('user_id', $auth_user->id)->get();
    }
    $fechaHoy = Date::now()->format('Y-m-d');
    $query  = Appointment::query();
    $availableHours = array('8', '9' ,'10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21');

    if($this->selectedDoctor && $this->selectedPatient && $this->selectedDate){
        $selectedDateForm = date('Ymd', strtotime($this->selectedDate));
        $query->where('doctor_id', $this->selectedDoctor)->where('patient_id', $this->selectedPatient)->where('appointment_date', $selectedDateForm);
        $availableHours = array_diff($availableHours, $query->pluck('appointment_time')->toArray());
    }

    $this->appointments = $query->get();

    return view('livewire.appointment-select',['appointments' => $this->appointments, 'doctors' => $this->doctors, 'patients' => $this->patients, 'users' => $this->users, 'availableHours' => $availableHours, 'fechaHoy' => $fechaHoy]);
  }
}
