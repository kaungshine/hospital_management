@extends('layouts.backendtemplate')
@section('title', 'assign')
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
    <li class="breadcrumb-item"><a href="{{route('assigndiseases.store')}}">Assign Disease</a></li>
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
            <h3 class="h4">Assign Disease Form</h3>
          </div>
          <div class="card-body">
            <form class="form-horizontal" method="POST" action="{{route('assigndiseases.store')}}">
              @csrf
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Patient</label>
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
                <label class="col-sm-3 form-control-label">Disease</label>
                <div class="col-sm-9">
                  <select name="disease" class="form-control mb-3">
                    <option>Choose Disease</option>
                    @foreach($diseases as $disease)
                      <option value="{{ $disease->id }}">{{ $disease->name }}</option>
                    @endforeach
                  </select>
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