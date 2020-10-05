@extends('layouts.backendtemplate')
@section('title', 'stay')
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
  <ul class="breadcrumb" style="position: relative;">
    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
    <li class="breadcrumb-item active">Stays</li>
    @hasrole('admin')
    <a href="{{route('stays.create')}}" class="btn btn-info  text-right" style="position: absolute; right: 40px; bottom: 7px;">Add New</a>
    @endhasrole
  </ul>
</div>
<!-- Forms Section-->
<div class="container-fluid my-5">
  <div class="row bg-white has-shadow">
    <div class="container my-5">
      <table id="location_table" class="table table-striped table-bordered" width="100%"></table>
    </div>
  </div>
</div>
<!-- Page Footer-->
<footer class="main-footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <p>Your company &copy; 2017-2020</p>
      </div>
      <div class="col-sm-6 text-right">
        <p>Design by <a href="https://bootstrapious.com/p/admin-template" class="external">Bootstrapious</a></p>
        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
      </div>
    </div>
  </div>
</footer>
@endsection
@section('javascript')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.2/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    var datatable = $('#location_table').DataTable( {
    data: @json($dp_obj),//ho phet ka par lar tae variable
    columns: [
    { 
          title: "Patient",//Table Header/ Column Name
          class: "text-center",
          data: "patient",
          searchable: true,
          orderable: true
        },
        {
          title: "Room",
          class: "text-center",
          data: "room",
          searchable: true,
          orderable: true
        },
        {
          title: "Start Date",
          class: "text-center",
          data: "starttime",
          searchable: true,
          orderable: true
        },
        {
          title: "End Date",
          class: "text-center",
          data: "endtime",
          searchable: true,
          orderable: true
        }
         ]
       });
    const deleteLocation = url => {
      return fetch(url, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
    }
    const getLocation = url => {
      return fetch(url, {
        method: 'GET',
        headers: {
          "Content-type": "application/json",
          "Accept": "application/json",
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })   
    }
    const putLocation = (url, data) => {
      return fetch(url, {
        method: 'POST',
        body: data,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      })     
    }
  });
</script>
@endsection