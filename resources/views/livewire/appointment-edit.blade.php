<div>
    <form class="card-body" action="{{ route('pages-appointments-update') }}" method="POST">

        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
        <input type="hidden" name="doctor_id" value="{{ $appointment->doctor_id }}">
        <input type="hidden" name="patient_id" value="{{ $appointment->patient_id }}">

        <div class="mb-3">
            <label for="doctor" class="form-label">Doctor</label>
            <select class="select2 form-select" id="doctor" name="doctor_id" wire:model="selectedDoctor" aria-label="Default select example"
                required disabled>

                    <option value="{{ $doctors->id }}" selected >
                        {{ $users->find($doctors->user_id)->name }}</option>

            </select>
        </div>
        <div class="mb-3 ">
            <label for="patient" class="form-label">Patient</label>
            <select class="select2 form-select" id="patient" name="patient_id" wire:model="selectedPatient" aria-label="Default select example"
                required disabled>

                    <option value="{{ $patients->id }}" selected >
                        {{ $users->find($patients->user_id)->name }}</option>

            </select>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <div class="col">
                <input class="form-control" wire:model ="selectedDate" name="appointment_date" value="{{ Date::createFromFormat('Ymd',$appointment->appointment_date)->format('Y-m-d')}}" type="date"
                    id="date" max="2023-12-31" min="{{ $fechaHoy }}" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="time" class="form-label">Time</label>
            <select class="select2 form-select" id="time" name="appointment_time"
                aria-label="Default select example" required>
                @foreach ($availableHours as $availableHour)
                    <option value="{{ $availableHour }}">{{ $availableHour }}:00</option> 
                @endforeach
            </select>
        </div>

        <div class="col-md-12">

            <label class="form-label" for="h_consulta">Consultation Hours</label>
            <input type="number" name="consultation_hours" id="h_consulta" class="form-control"
                value="{{ $appointment->consultation_hours }}" placeholder="1" required readonly />

        </div>

        <div class="pt-4">
            <button type="submit" class="btn btn-outline-success">Save</button>
            <a href="{{ route('pages-appointments-search') }}" class="btn btn-outline-danger">Cancel</a>
        </div>




    </form>
</div>
