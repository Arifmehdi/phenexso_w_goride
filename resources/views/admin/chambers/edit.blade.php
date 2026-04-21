@extends('admin.master')
@section('title',"Admin Dashboard | Edit Chamber location")

@section('body')
<section class="pt-3">
    <div class="card">
        <div class="card-header bg-info">
            <div class="card-title">Edit Chamber location</div>
        </div>
        <div class="card-body w3-light-gray">
            <form action="{{ route('chambers.update', $chamber->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Doctor -->
                <div class="mb-3">
                    <label class="form-label">Doctor</label>
                    <select name="doctor_id" class="form-control" required>
                        <option value="">-- Select Doctor --</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ $chamber->doctor_id == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->name_en }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Chamber Title -->
                <div class="mb-3">
                    <label class="form-label">Chamber Title</label>
                    <input type="text" name="chamber_title" class="form-control" value="{{ $chamber->chamber_title }}" placeholder="Chamber Title" required>
                </div>

                <!-- Address -->
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="2" required placeholder="Address">{{ $chamber->address }}</textarea>
                </div>

                <!-- Dynamic Day + Time -->
                <div id="schedule-wrapper">
                    @foreach($chamber->schedules as $schedule)
                    <div class="row mb-2 schedule-row">
                        <div class="col-md-5">
                            <label class="form-label">Day</label>
                            <select name="day[]" id="day[]" class="form-control" required>
                                <option value="">Select Day</option>
                                @foreach (config('parameter.day') as $item)
                                    <option value="{{ $item }}" {{ $schedule['day'] ==  $item ? 'selected' : ''}}>{{ ucfirst($item) }}</option>
                                @endforeach
                            </select>
                           
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Time</label>
                            <input type="text" name="time[]" class="form-control" value="{{ $schedule['time'] }}" placeholder="e.g. 10:00 AM - 1:00 PM" required>
                        </div>
                        <div class="col-md-2 d-flex align-items-end gap-2">
                            <button type="button" class="btn btn-success px-3 add-row mr-2">+</button>
                            <button type="button" class="btn btn-danger px-3 delete-row">-</button>
                        </div>
                    </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </form>
        </div>
    </div>
</section>

@push('js')
<script>
document.addEventListener("click", function(e) {
    // Add new schedule row
    if(e.target.classList.contains("add-row")) {
        let wrapper = document.getElementById("schedule-wrapper");
        let newRow = document.querySelector(".schedule-row").cloneNode(true);
        newRow.querySelectorAll("input").forEach(input => input.value = "");
        wrapper.appendChild(newRow);
    }

    // Remove schedule row
    if(e.target.classList.contains("delete-row")) {
        let row = e.target.closest(".schedule-row");
        let wrapper = document.getElementById("schedule-wrapper");
        if(wrapper.querySelectorAll(".schedule-row").length > 1) {
            row.remove();
        } else {
            alert("At least one schedule is required.");
        }
    }
});
</script>
@endpush
@endsection
