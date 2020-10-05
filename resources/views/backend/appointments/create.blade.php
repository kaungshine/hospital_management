@extends('layouts.backendtemplate')
@section('title', 'appointment')
@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endsection
@section('content')

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
    <li class="breadcrumb-item"><a href="{{route('appointments.store')}}">Appointment</a></li>
		<li class="breadcrumb-item active">Create</li>
	</ul>
</div>
<!-- Forms Section-->
<section class="forms"> 
	<div class="container-fluid">
		<div class="row">
			<!-- Basic Form-->
			<div class="col-lg-6">
				<div class="card">
					<div class="card-close">
						<div class="dropdown">
							<button type="button" id="closeCard1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
							<div aria-labelledby="closeCard1" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
						</div>
					</div>
					<div class="card-header d-flex align-items-center">
						<h3 class="h4">Appointment Form</h3>
					</div>
					<div class="card-body">
            <form class="form-horizontal" method="POST" action="{{route('appointments.store')}}">
              @csrf
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Patients</label>
                <div class="col-sm-9">
                  <select name="patient" class="form-control mb-3">
                    <option>Choose Patient</option>
                    @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Nurse</label>
                <div class="col-sm-9">
                  <select name="nurse" class="form-control mb-3">
                    <option>Choose Nurse</option>
                    @foreach($nurses as $nurse)
                    <option value="{{ $nurse->id }}">{{ $nurse->user->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Physician</label>
                <div class="col-sm-9">
                  <select name="physician" class="form-control mb-3">
                    <option>Choose Physician</option>
                    @foreach($physicians as $physician)
                    <option value="{{ $physician->id }}">{{ $physician->user->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Start Date Time</label>
                <div class="col-sm-9">
                  <input id="time" type="date" class="form-control form-control-warning" name="startdate" required="required">
                  <input type="text" class="timepicker form-control" name="starttime" required="required"/>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">End Date Time</label>
                <div class="col-sm-9">
                  <input id="time" type="date" class="form-control form-control-warning" name="enddate" required="required">
                  <input type="text" class="timepicker form-control" name="endtime" required="required"/>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Examination Room</label>
                <div class="col-sm-9">
                  <textarea class="form-control" name="exaroom" required="required"></textarea>
                </div>
              </div>
              <div class="form-group row">       
                <div class="col-sm-9 offset-sm-3">
                  <input type="submit" value="Save" class="btn btn-info">
                </div>
              </div>
            </form>
          </div>
        </div>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
  (function($) {
    $(function() {
      $('input.timepicker').timepicker();
    });
  })(jQuery);
</script>
@endsection