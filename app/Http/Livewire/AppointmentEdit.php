<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{Doctor, Patient, User, Appointment};
use Illuminate\Support\Facades\Date;

class AppointmentEdit extends Component
{
  public $doctors = [];
  public $patients = [];
  public $users = [];
  public $appointments = [];

  public $selectedDoctor;
  public $selectedPatient;
  
  public $appointment_id;

  public $selectedDate;

  public function render()
  {
    $this->appointment = Appointment::find($this->appointment_id);
    $this->doctors = Doctor::find($this->appointment->doctor_id);
    $this->patients = Patient::find($this->appointment->patient_id);
    $this->users = User::all();
  
    $this->selectedDate = Date::createFromFormat('Ymd',$this->appointment->appointment_date)->format('Y-m-d');
    // fecha de hoy en formato Y-m-d
    $fechaHoy = Date::now()->format('Y-m-d');
    $query  = Appointment::query();
    $availableHours = array('8', '9' ,'10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21');
    if($this->selectedDate){
        $selectedDateForm = date('Ymd', strtotime($this->selectedDate));
        $query->where('doctor_id', $this->selectedDoctor)->where('patient_id', $this->selectedPatient)->where('appointment_date', $selectedDateForm);
        $availableHours = array_diff($availableHours, $query->pluck('appointment_time')->toArray());
    }
    $this->appointments=$query->get();

    return view('livewire.appointment-edit' , [
      'availableHours' => $availableHours,
      'fechaHoy' => $fechaHoy,
    ]);
  }
}
