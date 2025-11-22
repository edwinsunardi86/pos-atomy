@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item active">Tambah User</li>
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
                        <form method="post" id="form_user" class="form-horizontal">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-4">
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputFullName" class="col-sm-2 col-form-label">Full Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="fullname" id="fullname" class="form-control @error('fullname') is-invalid @enderror" placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Role</label>
                                    <div class="col-sm-4">
                                        <select name="role" id="role" class="form-control"">
                                            <option value="">Pilih</option>
                                            <option value="1">Super Administrator</option>
                                            <option value="2">Administrator</option>
                                            <option value="3">User</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).on('change','#role', function(){
        if($('#role').val() != "" && $('#role').val() != '1'){
            $('.div_client').show();
        }else{
            $('.div_client').hide();
            $('#client_name').val("");
            $('#client_id').val("");
        }
    });

$(function(){
    $('#form_user').validate({
        rules :{
            username : {
                required:true,
                minlength:5
            },
            email : {
                email:true,
                required:true
            },
            fullname : {
                required:true,
                minlength:5
            },
            role : {
                required:true
            },
            client_name : {
                required:true
            }
        },
        messages:{
            username:{
                required:"Please enter a username",
                minlength:"Username must be at least 4 characters long"
            },
            email:{
                required:"Please enter a email address",
                email:"Please enter a valid email address"
            },
            fullname:{
                required:"Please enter a full name",
                minlength:"Full name must be at least 4 characters long"
            },
            role:{
                required:"Please choice role user"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function() { 
                
        }
    });
    $('#form_user').submit(function(e){
        e.preventDefault();
        var formData = new FormData();
        formData.append('username',$('#username').val());
        formData.append('email', $('#email').val());
        formData.append('fullname', $('#fullname').val());
        formData.append('role',$('#role').val());
        formData.append('client_id',$('#client_id').val());
        formData.append('_token',$('meta[name=csrf-token]').attr('content'));
        $.ajax({
            headers:
            {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            },
            url:"/users/store_user",
            type:"POST",
            data:formData,
            dataType:"JSON",
            processData:false,
            contentType:false,
            success:function(data){
                if(data.icon == 'success'){
                    Swal.fire({
                        title:"<b>Perhatian!</b>",
                        text:data.message,
                        icon:data.icon,
                        confirmButtonText:"OK"
                    });

                    setTimeout(function(){ 
                        window.location.href=data.redirect; }, 
                            2000
                    );
                        
                }else{
                    Swal.fire({
                        title:"<b>perhatian!</b>",
                        html: '<p>' + data.username +'<br/>'+ data.email + '</p>',
                        customClass: {
                            popup: 'format-pre'
                        },
                        icon:data.icon,
                        confirmButtonText:"OK"
                    });
                }
            },
            error:function(xhr,error,errorThrown){
                alert(xhr.status); 
            }
        });
    });
});
</script>
@endsection