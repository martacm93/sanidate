<div>
    <form class="card-body" action="{{ route('pages-appointments-store') }}" method="POST">

        @csrf
        <div class="mb-3">
            <label for="doctor" class="form-label">Doctor</label>
            <select class="select2 form-select" id="doctor" name="doctor_id" wire:model="selectedDoctor" aria-label="Default select example"
                required>
                <option value="">Select Doctor</option>
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}" @if ($doctor->id == $selectedDoctor)
                        selected
                    @endif>{{ $users->find($doctor->user_id)->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 ">

            <label for="patient" class="form-label">Patient</label>
            <select class="select2 form-select" id="patient" name="patient_id" wire:model="selectedPatient" aria-label="Default select example"
                required>
                <option value="">Select Patient</option>
                @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}" >{{ $users->find($patient->user_id)->name }}</option>
                @endforeach
            </select>

        </div>


        <div class="mb-3">
            <label for="date" class="form-label" >Date</label>
            <div class="col">
                <input class="form-control" name="appointment_date"  type="date" id="date"
                    wire:model="selectedDate" max="2023-12-31" min="{{ $fechaHoy }}" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="time" class="form-label">Time</label>
            <select class="select2 form-select" id="time" name="appointment_time"
                aria-label="Default select example" required>
                <option value="">Select Time</option>
                @foreach ($availableHours as $availableHour)
                    <option value="{{ $availableHour }}">{{ $availableHour }}:00</option> 
                @endforeach
            </select>
        </div>

        <div class="col-md-12">

            <label class="form-label" for="h_consulta">Consultation Hours</label>
            <input type="number" name="consultation_hours" id="h_consulta" class="form-control" value="1" placeholder="1"
                required readonly />

        </div>


        <div class="pt-4">
            <button type="submit" class="btn btn-outline-success">Save</button>
            <button type="reset" class="btn btn-outline-primary">Clear</button>
            <a href="{{ route('pages-appointments-search') }}" class="btn btn-outline-danger">Cancel</a>
        </div>

    </form>
</div>
