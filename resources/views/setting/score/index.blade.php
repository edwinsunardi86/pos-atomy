@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Set Score</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Score</a></li>
                    <li class="breadcrumb-item active">Score List</li>
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
                            <h3 class="card-title">Score List</h3>
                        </div>
                        <div class="card-body">
                            <a class="btn btn-md btn-primary" href="score/createScore">ADD</a>
                            <table id="dt_score" class="table table-striped table-bordered">
                                <thead>
                                    <th>No. </th>
                                    <th>Project Code</th>
                                    <th>Project Name</th>
                                    <th>Period_date</th>
                                    <th>Is Current Active</th>
                                    <th>Score</th>
                                    <th>Action</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
$(document).ready(function(){
    var i = 1;
    var tb_score = $('#dt_score').DataTable({
        processing:true,
        serverSide:true,
        destroy:true,
        ajax: '{!! route("getListScore:dt") !!}',
        columns:[
            { data:i, name: i, render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }},
            { data: 'project_code', name: 'project_code' },
            { data: 'project_name', name: 'project_name' },
            { data: 'period_date', name: 'period_date' },
            { data: 'is_current_active', render: function(data, type, row, meta){
                if(data == 0){
                    var status = 'inactive'
                }else{
                    var status = 'active'
                }
                return status;
            }},
            { data: 'kategori_nilai', name: 'kategory_nilai'},
            { data: 'action', name: 'action'}
        ],
    });
})
</script>
@endsection