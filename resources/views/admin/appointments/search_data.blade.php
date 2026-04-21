<table id="example1" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th width="20">SL</th>
        <th width="80">Action</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Department</th>
        <th>Doctor</th>
        <th>Appointment Date</th>
    </tr>
    </thead>
    <tbody>
        <?php $i = (($appointments->currentPage() - 1) * $appointments->perPage() + 1); ?>
    @foreach($appointments as $appointment)
        <tr>
            <td>{{$i++}}</td>
            <td>
                <form action="{{ route('deleteAppointment',$appointment->id) }}" method="post" onclick="return confirm('Are you sure you want to delete this item?');">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-xs btn-outline-danger mr-1 float-left"><i class="fa fa-trash"></i></button>
                </form>
            </td>
            <td>{{$appointment->name}}</td>
            <td>{{$appointment->email}}</td>
            <td>{{$appointment->mobile}}</td>
            <td>{{$appointment->department->name_en ?? 'N/A'}}</td>
            <td>{{$appointment->doctor->name_en ?? 'N/A'}}</td>
            <td>{{ $appointment->appointment_date ? \Carbon\Carbon::parse($appointment->appointment_date)->format('d M, Y') : 'N/A' }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
{{ $appointments->render() }}
