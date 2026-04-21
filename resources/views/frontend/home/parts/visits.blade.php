        <div id="accordion">
         
            <?php $i = (($allVisits->currentPage() - 1) * $allVisits->perPage() + 1); ?>
            @foreach ($allVisits as $visit)
            <div class="card- px-2 w3-card mb-2">
              <div class="card-header">
                <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseOne{{ $visit->id }}">
                   {{ $i++ }}. (Patient Name: {{ $visit->patient_name }}) (Patient Mobile: {{ $visit->patient_mobile }})
                </a>
              </div>
              <div id="collapseOne{{ $visit->id }}" class="collapse" data-bs-parent="#accordion">
                <div class="card-body px-4 pb-3">
                     <dl class="row">
                        <dt class="col-sm-4">Patien Gender</dt>
                        <dd class="col-sm-8">{{ $visit->patient_name }}</dd>

                        <dt class="col-sm-4">Patient Age</dt>
                        <dd class="col-sm-8">{{ $visit->patient_age }}</dd>

                        <dt class="col-sm-4">Bisesoggo Category Name</dt>
                        <dd class="col-sm-8">{{ $visit->bisesoggo_category->name ?? '' }}</dd>

                        <dt class="col-sm-4">Doctor Name</dt>
                        <dd class="col-sm-8">{{ Str::ucfirst( $visit->doctor->name ?? '') }}</dd>

                        <dt class="col-sm-4">Hospital Name</dt>
                        <dd class="col-sm-8">{{ $visit->hospital->name ?? ''}}</dd>

                        <dt class="col-sm-4">Visit Status</dt>
                        <dd class="col-sm-8">{{  $visit->visit_status ?? ''  }}</dd>

                        <dt class="col-sm-4">Payment Status</dt>
                        <dd class="col-sm-8">{{ $visit->payment_status ?? '' }}</dd>


                        <dt class="col-sm-4">Visit Date</dt>
                        <dd class="col-sm-8">{{ $visit->visit_date ?? ''}}</dd>

                        <dt class="col-sm-4">Visit Time</dt>
                        <dd class="col-sm-8">{{ $visit->visit_time ?? ''}}</dd>

                        <dt class="col-sm-4">Chember Room</dt>
                        <dd class="col-sm-8">{{ $visit->chember_room ?? '' }}</dd>

                        <dt class="col-sm-4">Chember Serial</dt>
                        <dd class="col-sm-8">{{ $visit->chember_serial_no ?? '' }}</dd>

                        <dt class="col-sm-4">Patient Details</dt>
                        <dd class="col-sm-8">{{ $visit->patient_details ?? '' }}</dd>
                    </dl>
                </div>
              </div>
            </div>
            @endforeach
            {{ $allVisits->render() }}
          </div>


