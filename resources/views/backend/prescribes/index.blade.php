@extends('layouts.backendtemplate')
@section('title', 'prescribe')
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
    <li class="breadcrumb-item active">Prescribe</li>
    {{-- @hasanyrole('admin|physician')
    <a href="{{route('prescribes.create')}}" class="btn btn-info  text-right" style="position: absolute; right: 40px; bottom: 7px;">Add New</a>
    @endhasrole --}}
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
<div class="modal" id="information" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid white;">
        <h5 class="modal-title" style="padding-left: 30px;font-weight: none; font-size: 18px;opacity: .7;">Appointment Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="appointment-info" style="padding: 0px 20px;"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.2/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    var datatable = $('#location_table').DataTable( {
    data: @json($dp_obj),//ho phet ka par lar tae variable
    columns: [
    { 
          title: "Physician",//Table Header/ Column Name
          class: "text-center",
          data: "physician",
          searchable: true,
          orderable: true
        },
        {
          title: "Patient",
          class: "text-center",
          data: "patient",
          searchable: true,
          orderable: true
        },
        {
          title: "Date",
          class: "text-center",
          data: "date",
          searchable: true,
          orderable: true
        },
        {
          title: "Dose",
          class: "text-center",
          data: "dose",
          searchable: true,
          orderable: true
        },
        {
          title: "View",
          class: "text-center",
          data: null,
          render: function(data,type,row){
           return '<button type="button" data-appointment=\'' + JSON.stringify(data) + '\' class="btn btn-info btn_view"><i class="fas fa-eye"></i></button>'},
           orderable: false,
           searchable: false
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
    $('#location_table').on('click', '.btn_view', function (e){
      let data = $(this).data('appointment');
      let arr = Array();
      let options = ''
      // console.log(data.medication)
      data.medication.forEach(element => {
        options += `<li>${element.name}</li>`
      })
      // console.log(options)
      let html = `
        <table class="table table-borderless text-left">
          <tr>
          <td>Physician:</td>
            <td> ${data.appointment.physician.name}</td>
          </tr>
          <tr>
            <td>Nurse:</td>
            <td>${data.appointment.nurse.name}</td>
          </tr>
          <tr>
            <td>Start Date Time:</td>
            <td >${data.appointment.start_date_time}</td>
          </tr>
          <tr>
            <td>End Date Time:</td>
            <td>${data.appointment.end_date_time}</td>
          </tr>
          <tr>
            <td colspan="2"><p style="border-top:1px solid gray;width:100%;margin-top:15px;opacity:.7;"></p></td>
          </tr>
          <tr>
            <th style="font-size:18px;font-weight:none;">Medicine</th>
          </tr>
          <tr>
          <td><ul>${options}</ul></td>
          </tr>

        </table>
      `;
      $('#appointment-info').html(html)
      $('#information').modal('show')
    })
  });
</script>
@endsection