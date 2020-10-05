@extends('layouts.backendtemplate')
@section('title', 'prescribe')
@section('content')
<style type="text/css">
  .select2-selection--multiple{
    width: 548px;
    height: auto;
    padding:5px 0px;
  }
</style>
<!-- Page Header-->
<header class="page-header">
	<div class="container-fluid">
		<h2 class="no-margin-bottom">Forms</h2>
	</div>
</header>
<!-- Breadcrumb-->
<div class="breadcrumb-holder container-fluid">
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.html">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('prescribes.store')}}">Prescribe</a></li>
		<li class="breadcrumb-item active">Create</li>
	</ul>
</div>
<!-- Forms Section-->
<section class="forms"> 
	<div class="container-fluid">
		<div class="row">
			<!-- Basic Form-->
			<div class="col-12 col-md-8">
				<div class="card">
					<div class="card-close">
						<div class="dropdown">
							<button type="button" id="closeCard1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
							<div aria-labelledby="closeCard1" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
						</div>
					</div>
					<div class="card-header d-flex align-items-center">
						<h3 class="h4">Prescribe Form</h3>
					</div>
					<div class="card-body">
            <form class="form-horizontal" method="POST" action="{{route('prescribes.store')}}">
              @csrf
              {{-- <div class="form-group row">
                <label class="col-sm-3 form-control-label">Physician</label>
                <div class="col-sm-9">
                  <select name="physician" class="form-control mb-3">
                    <option selected value="{{ $physician->id }}">{{ $physician->user->name }}</option>
                  </select>
                </div>
              </div> --}}
              <input type="hidden" name="patient_id" value="{{$patient->id}}"> 
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Patient Name </label>
                <div class="col-sm-9">
                  <div class="text-dark">
                    {{ $patient->user->name }}
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Patient Disease</label>
                <div class="col-sm-9">
                  {{-- <div class="text-dark">
                    @foreach($patient->diseases as $disease)
                      {{$disease->name}}
                    @endforeach
                  </div> --}}
                  <select name="disease" class="form-control mb-3">
                  <option>Choose Disease</option>
                  @foreach($diseases as $disease)
                    <option value="{{ $disease->id }}">{{ $disease->name }}</option>
                  @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Medications</label>
                <div class="col-12 col-md-9">
                  <select name="medication[]" class="js-example-basic-multiple form-control" multiple="multiple" style="border:none;">
                    <option disabled="disabled" style="padding: 5px 0;">Choose Medication</option>
                    @foreach($medications as $medication)
                    <option value="{{ $medication->id }}">{{ $medication->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Date</label>
                <div class="col-sm-9">
                  <input id="inputHorizontalWarning" type="date" class="form-control form-control-warning" name="date" required="required">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Dose</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="dose" name="dose" required="required" rows="4"></textarea>
                </div>
              </div>
              <div class="form-group row">       
                <div class="col-sm-9 offset-sm-3">
                  <input type="submit" value="Save" class="btn btn-info">
                </div>
              </div>
              <div class="form-group row" style="visibility: hidden;">
                <label class="col-sm-3 form-control-label">Appointments</label>
                <div class="col-sm-9">
                  <input type="hidden" name="appointment" value="{{ $appointment->id }}">
                  {{-- <select name="appointment" class="form-control mb-3">
                    <option selected value="{{ $appointment->id }}">
                        Physician : {{ $appointment->physician->user->name }} |
                        Nurse : {{ $appointment->nurse->user->name }}
                        [From {{ $appointment->start_date_time }} ~ 
                        To {{ $appointment->end_date_time }}]
                    </option>
                  </select> --}}
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4"> 
        
        {{-- <table class="table table-hover table-striped" style="border: 1px solid #dee2e6;">
            <tr class="bg-info text-light">
              <th colspan="2" class="py-3" style="font-size: 18px; font-weight: 400;">Appointment Information</th>
            </tr>
            <tr>
              <th>Physician</th>
              <td>{{ $appointment->physician->user->name }}</td>
            </tr>
            <tr>
              <th>Nurse</th> 
              <td>{{ $appointment->nurse->user->name }}</td>
            </tr>  
            <tr>
              <th>From</th>
              <td>{{ $appointment->start_date_time }}</td>
            </tr>  
            <tr>
              <th>To</th>
              <td>{{ $appointment->end_date_time }}</td>
            </tr>  
        </table>   --}}
        
        @foreach($previous_appointments as $key => $appt)
        <h3 class="mb-4 text-info">Previous Appointment {{$key + 1}}</h3>
        <div class="accordion" id="accordionExample{{$key}}">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                <button class="btn btn-block text-left text-dark font-weight-bold" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                    {{ $appt->prescribes->first()->date }}
                </button>
              </h2>
            </div>

            <div id="collapse{{$key}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample{{$key}}">
              <div class="card-body">
                <table class="table">
                  <tr>
                    <th>Patient</th>
                    <td>{{$appt->patient->user->name}}</td>
                  </tr>
                  {{-- <tr>
                    <th>Disease</th>
                    <td>@foreach($appt->patient->diseases as $disease) {{$disease->name}} @endforeach</td>
                  </tr> --}}
                  <tr>
                    <th>From</th>
                    <td>{{$appt->start_date_time}}</td>
                  </tr>
                  <tr>
                    <th>To</th>
                    <td>{{$appt->end_date_time}}</td>
                  </tr>
                  <tr>
                    <th>Medicine</th>
                    <td>
                      <ul>
                        @foreach($appt->prescribes->map->medication as $medication)
                          <li>{{$medication->name}}</li>
                        @endforeach
                      </ul>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>   
        @endforeach
      </div>
    </div>
  </div>
</section>
<!-- Page Footer-->
<footer class="main-footer">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6">
				<p>Your company &copy; 2017-2020</p>
			</div>
			<div class="col-sm-6 text-right">
				<p>Design by <a href="https://bootstrapious.com/p/admin-template" class="external">Bootstrapious</a></p>
			</div>
		</div>
	</div>
</footer>
@endsection
@section('javascript')
<script type="text/javascript">
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    $("select option:first-child").attr("disabled", "disabled");
  });
</script>
@endsection