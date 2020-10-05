@extends('layouts.backendtemplate')
@section('title', 'stay')
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
		<li class="breadcrumb-item"><a href="{{route('stays.store')}}">Stay</a></li>
		<li class="breadcrumb-item active">Create</li>
	</ul>
</div>
<!-- Forms Section-->
<section class="forms"> 
	<div class="container-fluid" id="app">
		<stay-component :patients='@json($patients)' :rooms='@json($rooms)' :codes='@json($codes)' :floors='@json($floors)' :url='@json(route("stays.store"))' csrf='{{csrf_token()}}'></stay-component>
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
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>	
@endsection