@extends('layouts.backendtemplate')
@section('title', 'patients')
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
		<li class="breadcrumb-item"><a href="{{route('patients.store')}}">Patient</a></li>
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
						<h3 class="h4">Patients Form</h3>
					</div>
					<div class="card-body">
						<form class="form-horizontal" method="POST" action="{{route('patients.store')}}">
							@csrf
							<div class="form-group row" >
								<label class="col-sm-3 form-control-label">Name</label>
								<div class="col-sm-9">
									<input id="inputHorizontal0" name="name" type="text" class="form-control form-control-warning" required="required">
								</div>
							</div>
							<div class="form-group row" >
								<label class="col-sm-3 form-control-label">Email</label>
								<div class="col-sm-9">
									<input id="inputHorizontal1" name="email" type="email" class="form-control form-control-warning" required="required">
								</div>
							</div>
							<div class="form-group row" >
								<label class="col-sm-3 form-control-label">Password</label>
								<div class="col-sm-9">
									<input id="inputHorizontal2" name="password" type="password" class="form-control form-control-warning" required="required">
								</div>
							</div>
							<div class="form-group row" >
								<label class="col-sm-3 form-control-label">Confirm Password</label>
								<div class="col-sm-9">
									<input id="inputHorizontal3" name="password_confirmation" type="password" class="form-control form-control-warning" required="required">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 form-control-label">Address</label>
								<div class="col-sm-9">
									<textarea class="form-control" id="inputHorizontal5" name="address" required="required"></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 form-control-label">Phone</label>
								<div class="col-sm-9">
									<input id="inputHorizontal6" name="phone" type="number" class="form-control form-control-warning" required="required">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 form-control-label">Insurance Number</label>
								<div class="col-sm-9">
									<input id="inputHorizontal7" name="insurance" type="number" class="form-control form-control-warning" required="required">
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
@endsection