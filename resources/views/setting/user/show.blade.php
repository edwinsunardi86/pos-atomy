@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>View User</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">User</a></li>
                  <li class="breadcrumb-item active">View User</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form User</h3>
                        </div>
                        <form id="form_user" class="form-horizontal">
                            @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-4">
                                    <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}" placeholder="Username" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-4">
                                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" placeholder="Email" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputFullName" class="col-sm-2 col-form-label">Full Name</label>
                                <div class="col-sm-4">
                                    <input type="text" name="fullname" id="fullname" class="form-control" value="{{ $user->fullname}}" placeholder="Full Name" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="/users"><button type="button" class="btn bg-purple">Back to list</button></a>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection