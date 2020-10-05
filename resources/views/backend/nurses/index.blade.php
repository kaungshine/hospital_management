@extends('layouts.backendtemplate')
@section('title', 'nurses')
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
    <li class="breadcrumb-item active">Nurse</li>
    @hasrole('admin')
    <a href="{{route('nurses.create')}}" class="btn btn-info  text-right" style="position: absolute; right: 40px; bottom: 7px;">Add New</a>
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
            <h3 class="h4">Nurse Edit Form</h3>
          </div>
          <div class="card-body">
            <form id="update-form" class="form-horizontal">
              @csrf
              <input type="hidden" name="_method" value="PUT">
              <div class="form-group row" >
                <label class="col-sm-3 form-control-label">Name</label>
                <div class="col-sm-9">
                  <input id="name" name="name" type="text" class="form-control form-control-warning">
                </div>
              </div>
              <div class="form-group row" >
                <label class="col-sm-3 form-control-label">Email</label>
                <div class="col-sm-9">
                  <input id="email" name="email" type="email" class="form-control form-control-warning">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Position</label>
                <div class="col-sm-9">
                  <input id="position" name="position" type="text" class="form-control form-control-warning">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Security Number</label>
                <div class="col-sm-9">
                  <input id="ssn" name="ssn" type="text" class="form-control form-control-warning">
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.2/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    var datatable = $('#location_table').DataTable( {
    data: @json($nurses),//ho phet ka par lar tae variable
    columns: [
    { 
          title: "Name",//Table Header/ Column Name
          class: "text-center",
          data: "user.name",
          searchable: true,
          orderable: true
        },
        @hasrole('admin')
        {
          title: "Email",
          class: "text-center",
          data: "user.email",
          searchable: true,
          orderable: true
        },
        @endhasrole
        {
          title: "Position",
          class: "text-center",
          data: "position",
          searchable: true,
          orderable: true
        },
        @hasrole('admin')
        {
          title: "Security Number",
          class: "text-center",
          data: "security_number",
          searchable: true,
          orderable: true
        },
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
        $('#name').val(json.user.name)
        $('#email').val(json.user.email)
        $('#position').val(json.position)
        $('#ssn').val(json.security_number)
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