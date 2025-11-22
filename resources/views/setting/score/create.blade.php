@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Score Per Project</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Add</a></li>
                    <li class="breadcrumb-item active">Score Per Project</li>
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
                            <h3 class="card-title">Add Score Per Project</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" id="setting_score" class="form-horizontal">
                                <div class="form-group row">
                                    <label for="inputClientName" class="col-sm-2 col-form-label">Client Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="client_name" id="client_name" readonly>
                                        <input type="hidden" class="form-control" name="client_id" id="client_id" readonly>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modal-xl">Find</button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="projectName" class="col-sm-2 col-form-label">Project Name</label>
                                    <div class="col-sm-4">
                                        <select name="project_code" id="project_code" class="form-control select2"></select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="InputDateSetScore" class="col-sm-2 col-form-label">Date Score:</label>
                                      <div class="col-sm-4 input-group date" id="dateFormat" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input col-sm-4" id="period_date" name="period_date" data-target="#dateFormat"/>
                                        <div class="input-group-append" data-target="#dateFormat" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                      <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1">
                                      <label class="custom-control-label" for="is_active">is Active ?</label>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-sm mb-2" id="addRow"><i class="fas fa-square-plus"></i> Add</button>
                                <table id="rowScore" class="table table-striped table-bordered" style="width:50%">
                                    <thead>
                                        <th>Category</th>
                                        <th>Initial</th>
                                        <th>Score</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control form-control-sm" id="category1" name="category[]"></td>
                                            <td><input type="text" class="form-control form-control-sm" id="initial1" name="initial[]"></td>
                                            <td><input type="number" class="form-control form-control-sm" id="score1" name="score[]"></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary btn-sm mb-2" id="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Client</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="overflow:scroll">
                <table id="table_client" class="diplay table table-bordered table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Client Name</th>
                            <th>Address</th>
                            <th>Contact 1</th>
                            <th>Contact 2</th>
                            <th>Mobile</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
$(document).ready(function(){
    $( "li.item-a" )
    .closest( "ul" )
    .css( "background-color", "red" );
        var i = 1;
        var tb_client = $('#table_client').DataTable({
        processing:true,
        serverSide:true,
        destroy: true,
        ajax:'{!! route("data_client_to_selected:dt") !!}',
        columns:[
            {data:'', name:'', render:function(row, type, set){
                return i++;
            }},
            { data:'client_name', name:'client_name' },
            { data:'address', name:'address' },
            { data: 'contact1', name:'contact1' },
            { data: 'contact2', name: 'contact2' },
            { data: 'contact_mobile', name: 'contact_mobile'},
            { data: 'description', name: 'description'},
            { data: 'action', name: 'action'}
            ],
    });
});
$(document).on('click','.pilih_client',function(){
    $('#client_id').val(($(this).attr('data-id')));
    $('#client_name').val(($(this).attr('data-client_name')));
    $('#client_description').val($(this).attr('data-client-description'));
    $('#modal-xl').modal('toggle');
    $.ajax({
        headers:{
            'X_CSRF-TOKEN':$('meta[name=csrf-token]').attr('content')
        },
        url:"/project/getProjectToSelected",
        type:"POST",
        dataType:"JSON",
        data:{
            "client_id":$('#client_id').val(),
            _token: '{{csrf_token()}}',
        },
        processData:true,
        success:function(data){
            $('.tb_sub_area > tbody').empty();
            $('select#project_code option').remove();
            $('select#project_code').append($('<option>',{
                    text:"Choice Project",
                    value:""
                }));
            $.each(data,function(i,item){
                $('select#project_code').append($('<option>',{
                    text:data[i].project_name,
                    value:data[i].project_code
                }));
            });
        }
    });
});
var counter = 2;
$('#addRow').on('click',function(e){
    var newRow = $("<tr>");
    var cols = "";
    cols += "<td><input type=\"text\" class=\"form-control form-control-sm\" id=\"category"+counter+"\" name=\"category[]\"></td>"+
            "<td><input type=\"text\" class=\"form-control form-control-sm\" id=\"initial"+counter+"\" name=\"initial[]\"></td>"+
            "<td><input type=\"number\" class=\"form-control form-control-sm\" id=\"score"+counter+"\" name=\"score[]\"></td>"+
            "<td><button type=\"button\" class=\"btn btn-danger btn-sm\" id=\"deleteRow"+counter+"\"><i class=\"fa-solid fa-delete-left\"></i> Delete</button></td>";
    newRow.append(cols);
    $("#rowScore").append(newRow);
    $("#rowScore").on("click","#deleteRow"+counter,function(){
        $(this).closest("tr").remove();
    });
    counter++;
});

$(document).ready(function(){
    $('#setting_score').validate({
        rules:{
            client_name:{
                required:true
            },
            project_code:{
                required:true
            },
            period_date:{
                required:true
            }
        },
        messages:{
            client_name:{
                required:"Please input client name"
            },
            project_code:{
                required:"Please input project code"
            },
            period_date:{
                required:"Please input period date" 
            }
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
                counter_category = 0;
                counter_initial = 0;
                counter_score = 0;
                $('input[name^="category[]"]').each(function(){
                    if(this.value !=""){
                        counter_category++;
                    }
                });
                $('input[name^="initial[]"]').each(function(){
                    if(this.value !=""){
                        counter_initial++;
                    }
                });
                $('input[name^="score[]"]').each(function(){
                    if(this.value !=""){
                        counter_score++;
                    }
                });
                if(counter_category == $('input[name="category[]"]').length && counter_initial == $('input[name="category[]"]').length && counter_score == $('input[name="category[]"]').length){
                    
                    var category = [];
                    var initial = [];
                    var score = [];
                    var formData = new FormData();
                    formData.append('project_code',$('#project_code').val());
                    formData.append('period_date',$('#period_date').val());
                    formData.append('is_active',$('#is_active').is(':checked') ? 1 : 0);
                    for(var i = 1;i <= $('input[name^="category[]"]').length; i++){
                        category.push($('#category'+i).val());
                        initial.push($('#initial'+i).val());
                        score.push($('#score'+i).val());
                    }
                    formData.append('category',category);
                    formData.append('initial',initial);
                    formData.append('score',score);
                    formData.append('_token',$('meta[name=csrf-token]').attr('content'));
                    $.ajax({
                        'X_CSRF-TOKEN':{
                            headers:$('meta[name=csrf-token]').attr('content')
                        },
                        url:'/score/setScore',
                        type:'POST',
                        dataType:'JSON',
                        data:formData,
                        processData:false,
                        contentType:false,
                        success:function(data){
                        Swal.fire({
                            position: 'center',
                            icon: data.icon,
                            title: data.title,
                            html: data.messages,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        }
                    });
                }else{
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Check your all input',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
    });
});
</script>
@endsection