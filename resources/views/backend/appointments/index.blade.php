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
  <ul class="breadcrumb" style="position: relative;">
    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
    <li class="breadcrumb-item active">Appointment</li>
    @hasrole('admin')
    <a href="{{route('appointments.create')}}" class="btn btn-info  text-right" style="position: absolute; right: 40px; bottom: 7px;">Add New</a>
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
<div class="modal" id="information" tabindex="-1" role="dialog">
  <div class="modal-dialog model-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-center" id="spinner">
          <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Appointment Edit Form</h3>
          </div>
          <div class="card-body">
            <form id="update-form" class="form-horizontal">
              @csrf
              <input type="hidden" name="_method" value="PUT">
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Patients</label>
                <div class="col-sm-9">
                  <select name="patient" id="patient" class="form-control mb-3">
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
                  <select name="nurse" id="nurse" class="form-control mb-3">
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
                  <select name="physician" id="physician" class="form-control mb-3">
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
                  <input id="startdate" type="date" class="form-control form-control-warning" name="startdate">
                  <input type="text" class="timepicker form-control" name="starttime" id="starttime" />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">End Date Time</label>
                <div class="col-sm-9">
                  <input id="enddate" type="date" class="form-control form-control-warning" name="enddate">
                  <input type="text" class="timepicker form-control" name="endtime" id="endtime" />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Examination Room</label>
                <div class="col-sm-9">
                  <textarea class="form-control" name="exaroom" id="exaroom"></textarea>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" id="btn-update" data-dismiss="modal">Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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
          title: "Nurse",
          class: "text-center",
          data: "nurse",
          searchable: true,
          orderable: true
        },
        {
          title: "Physician",
          class: "text-center",
          data: "physician",
          searchable: true,
          orderable: true
        },
        {
          title: "Start Date Time",
          class: "text-center",
          data: "startdatetime",
          searchable: true,
          orderable: true
        },
        {
          title: "End Date Time",
          class: "text-center",
          data: "enddatetime",
          searchable: true,
          orderable: true
        },
        {
          title: "Examination Room",
          class: "text-center",
          data: "exaroom",
          searchable: true,
          orderable: true
        },
        @hasrole('admin')
        {
          title: "Edit",
          class: "text-center",
          data: null,
          render: function(data,type,row){
           return '<button type="button" data-url="' + data.url + '/' + data.id + '/edit' + '" class="btn btn-warning btn_edit"><i class="fas fa-edit"></i></button>'},
           orderable: false,
           searchable: false
         },
         {
          title: "Delete",
          class: "text-center",
          data: null,
          render: function(data,type,row){
           return '<button type="button" data-url="' + data.url + '/' + data.id + '" class="btn btn-danger btn_delete"><i class="fas fa-trash-alt"></i></button>'},
           orderable: false,
           searchable: false          
         }
         @endhasrole
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
    $('#location_table').on('click', '.btn_edit', function (e){
      $('#information').find('div.card').hide()
      $('#spinner').find('div.spinner-border').show()
      let url = $(this).data('url')
      getLocation(url)
      .then(response => response.json())
      .then(json => {
        console.log(json.url)
        $('#patient').find("option:selected").attr('selected', false)
        $('#physician').find("option:selected").attr('selected', false)
        $('#nurse').find("option:selected").attr('selected', false)
        $('#patient').find("option[value='" + json.patient_id + "']").attr('selected', true)
        $('#physician').find("option[value='" + json.physician_id + "']").attr('selected', true)
        $('#nurse').find("option[value='" + json.nurse_id + "']").attr('selected', true)
        $('#exaroom').val(json.exaroom)
        $('#startdate').val(json.startdate)
        $('#starttime').val(json.starttime)
        $('#enddate').val(json.enddate)
        $('#endtime').val(json.endtime)
        $('#btn-update').data('url', json.url)
        $('#btn-update').data('id', json.id)
        $('#information').find('div.card').show()
        $('#spinner').find('div.spinner-border').hide()
      })
      .catch(err => {
        console.log(err)
      })
      $('#information').modal('show')
    })
    $('#btn-update').on('click', function () {
      let id = $(this).data('id')
      let form = document.getElementById('update-form');
      let fd = new FormData(form);
      let serialized = $('#update-form').serialize()
      putLocation($(this).data('url') + '/' + id, fd)
      .then(resp => resp.json())
      .then(json => {
         console.log(json)
       new Swal({
        position: 'center',
        icon: 'success',
        title: 'Your change has been updated',
        showConfirmButton: false,
        timer: 1500
      })
       datatable.clear().rows.add(json).draw();
     })
      .catch(err => console.log(err))
    });
    $('#location_table').on('click', '.btn_delete', function (e){
      let url = $(this).data('url')
      let id = $(this).data('id')
      new Swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          deleteLocation(url)
          .then(resp => resp.json())
          .then(json => {
            datatable.clear().rows.add(json).draw();
            Swal.fire(
              'Deleted!',
              'Record has been deleted.',
              'success'
              )
          })
          .catch(err => { console.log(err) })
        }
      })
    });
  });
</script>
@endsection