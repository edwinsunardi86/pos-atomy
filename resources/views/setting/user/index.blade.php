@extends('layouts.main')
@section('container')
<style>
  #user-table td{
      padding:5px 5px 5px 5px;
  }
 </style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Daftar User</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">User</a></li>
                <li class="breadcrumb-item active">Daftar User</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="users/create_user" class="btn btn-block bg-gradient-primary col-md-2"><i class="fas fa-user-plus"></i> Tambah User</a>
              </div>
              <div class="card-body">
                <table id="user-table" class="table table-bordered table-striped" width="100%">
                  <thead>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Full Name</th>
                    <th>Role</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
<script>
jQuery(document).ready(function(){
  var i = 1;
  $('#user-table').DataTable({
    processing: true,
    serverSide: true,
    ajax:'/users/',
    columns:[
      {data:'', name:'', render:function(row, type, set){
        return i++;
      }},
      {data:'username', name:'username'},
      {data:'email', name:'email'},
      {data:'fullname', name:'fullname'},
      {data:'role', name:'role', render:function(row, type, set){
        if(row==1){
          return 'Super Administrator';
        }else if(row==2){
          return 'Administrator';
        }else{
          return 'User';
        }
      }},
      {data:'action', name:'action'}
    ],
    "columnDefs": [{
      "targets": 0,
      "orderable": false
    }]
  }).draw();

  
});
</script>
@endsection