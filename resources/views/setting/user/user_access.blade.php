@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Access</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item active">User Access</li>
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
                            <h3 class="card-title">Detail User</h3>
                        </div>
                        <form id="form_user" class="form-horizontal">
                            @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                                {{-- <div class="col-sm-4">
                                    <input type="text" name="username" id="username" class="form-control" value="{{ $user->username ?? '' }}" placeholder="Username" readonly>
                                </div> --}}
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-4">
                                    <input type="email" name="email" id="email" class="form-control" value="{{ $role->email }}" placeholder="Email" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputFullName" class="col-sm-2 col-form-label">Full Name</label>
                                <div class="col-sm-4">
                                    <input type="text" name="fullname" id="fullname" class="form-control" value="{{ $role->fullname}}" placeholder="Full Name" readonly>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a href="#custom-tab-one-access-privileges" data-toggle="pill" class="nav-link active" id="custom-tabs-one-access-privileges-tab" role="tab" aria-controls="custom-tabs-one-access-privileges">Privileges</a>
                                </li>
                                @if($role->role == 3)
                                <li class="nav-item">
                                    <a href="#custom-tab-one-access-authority" data-toggle="pill" class="nav-link" id="custom-tabs-one-access-authority-tab" role="tab" aria-controls="custom-tabs-one-access-privileges">Authority</a>
                                </li>
                                @endif
                                <li class="nav-item">
                                    <a href="#branch-access-tab" data-toggle="pill" class="nav-link" id="branch-access-tabs" role="tab" aria-controls="branch-access-tabs">Branch Access</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane" id="branch-access-tab" role="tabpanel" aria-labelledby="branch-access-tabs">
                                    <form class="form-horizontal" id="form_data_access"> 
                                        {{-- <div class="form-group row">
                                            <label for="col-form-label" class="col-form-label col-sm-2">Company</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" style="width:430px;" name="company_id" id="company_id">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="col-form-label" class="col-form-label col-sm-2">Branch</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" style="width:430px;" multiple name="branch" id="branch">
                                                </select>
                                            </div>
                                        </div> --}}
                                        <button type="button" class="btn btn-primary" id="add-company">ADD</button>
                                        <div id="drop-down-company-branches"></div>
                                    <button type="submit" class="btn btn-md btn-primary">Submit</button>
                                    </form>
                                </div>
                                <div class="tab-pane fade show active" id="custom-tab-one-access-privileges" role="tabpanel" aria-labelledby="custom-tab-one-access-privileges-tab">
                                    <div class="col-12">
                                            <form method="post" id="form_user_access" class="form-horizontal">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="mb-6">
                                                        @php
                                                        $checkedCreate = "";
                                                        $checkedUpdate = "";
                                                        $checkedDelete = "";
                                                        if(! function_exists('isCreateChecked')) {
                                                            function isCreateChecked($menu_array,$row_menu){
                                                                foreach($menu_array as $arr){
                                                                    if($arr['menu_id'] == $row_menu->id){
                                                                        if($arr['create']==1){
                                                                                return "checked";
                                                                        }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }

                                                        if(! function_exists('isUpdateChecked')) {
                                                            function isUpdateChecked($menu_array,$row_menu){
                                                                foreach($menu_array as $arr){
                                                                    if($arr['menu_id'] == $row_menu->id){
                                                                        if($arr['update']==1){
                                                                                return "checked";
                                                                        }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if(! function_exists('isDeleteChecked')) {
                                                            function isDeleteChecked($menu_array,$row_menu){
                                                                foreach($menu_array as $arr){
                                                                    if($arr['menu_id'] == $row_menu->id){
                                                                        if($arr['delete']==1){
                                                                                return "checked";
                                                                        }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <table class="table table-hover table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Menu</th>
                                                                    <th>Sub Menu</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php $a = 0; @endphp
                                                                @foreach($access_menu_parent as $row_parent)
                                                                <tr>
                                                                    <td>
                                                                        <div class="icheck-primary d-inline">
                                                                            <input type="checkbox" name="checkboxPrimary[]" id="checkboxPrimary{{ $a }}" value="{{ $row_parent->id }}">
                                                                            <label for="checkboxPrimary{{ $a }}">
                                                                                <h4>{{ $row_parent->nama_menu }}</h4>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <table class="table table-bordered">
                                                                            <tbody>
                                                                                @php
                                                                                    $z = 0;
                                                                                    $i = 1;
                                                                                    $count_user_access = 1;
                                                                                    $if_check_all = null;
                                                                                @endphp
                                                                                @foreach($access_menu as $row_menu)
                                                                                @php
                                                                                $arr = array_filter($menu_array,function($ar) use($row_menu){
                                                                                    return $ar['menu_id'] == $row_menu->id;
                                                                                });
                                                                                $checkedCreate = "";
                                                                                @endphp
                                                                                    @if($row_parent->id == $row_menu->menu_parent_id)
                                                                                        <tr>
                                                                                            <td>
                                                                                                <div class="icheck-primary d-inline pl-5 col-md-4">
                                                                                                    <input type="checkbox" class="menuParent{{ $a }}" data-createId="checkbox{{ $a }}MenuCreate{{ $i }}" data-updateId="checkbox{{ $a }}MenuUpdate{{ $i }}" data-deleteId="checkbox{{ $a }}MenuDelete{{ $i }}" id="checkbox{{ $a }}Menu{{ $i }}" name="menuParent[]" value="{{ $row_menu->id }}" {{ count($arr) > 0 ? 'checked' : '' }}>
                                                                                                    <label for="checkbox{{ $a }}Menu{{ $i }}">
                                                                                                        <h5>{{ $row_menu->nama_menu }}</h5>
                                                                                                    </label>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="icheck-primary d-inline pl-5">
                                                                                                    <input type="checkbox" class="menuParentCreate{{ $a }}" id="checkbox{{ $a }}MenuCreate{{ $i }}" name="menuParentCreate[]" value="1" {{ isCreateChecked($menu_array,$row_menu) }}>
                                                                                                    <label for="checkbox{{ $a }}MenuCreate{{ $i }}">
                                                                                                        Create
                                                                                                    </label>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="icheck-primary d-inline pl-5">
                                                                                                    <input type="checkbox" class="menuParentUpdate{{ $a }}" id="checkbox{{ $a }}MenuUpdate{{ $i }}" name="menuParentUpdate[]" value="1" {{ isUpdateChecked($menu_array,$row_menu) }}>
                                                                                                    <label for="checkbox{{ $a }}MenuUpdate{{ $i }}">
                                                                                                        Update
                                                                                                    </label>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="icheck-primary d-inline pl-5">
                                                                                                    <input type="checkbox" class="menuParentDelete{{ $a }}" id="checkbox{{ $a }}MenuDelete{{ $i }}" name="menuParentDelete[]" value="1" {{ isDeleteChecked($menu_array,$row_menu) }}>
                                                                                                    <label for="checkbox{{ $a }}MenuDelete{{ $i }}">
                                                                                                        Delete
                                                                                                    </label>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        @php
                                                                                            $z++;
                                                                                            $i++;
                                                                                            if(count($arr) > 0){ 
                                                                                                $count_user_access++;
                                                                                            }
                                                                                        @endphp
                                                                                    @endif          
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $if_check_all = ($i == $count_user_access) ? 'all' : '';
                                                                    echo '<input type="hidden" name="check_all[]" id="check_all'.$a.'" value="'.$if_check_all.'">';
                                                                @endphp
                                                                @php $a++; @endphp
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary" id="btn_submit">Submit</button>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                                {{-- <div class="tab-pane fade" id="custom-tab-one-access-authority" role="tabpanel" aria-labelledby="custom-tab-one-access-authority-tab">
                                    <div class="col-12">
                                            <form method="post" id="form_user_authority" class="form-horizontal">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="mb-6">
                                                        <div class="form-group row">
                                                            <label for="branch" class="col-form-label col-sm-1">Branch</label>
                                                            <div class="col-sm-5">
                                                                <select name="branch" multiple="multiple" id="branch" data-placeholder="Choose Branch" class="form-control select2" style="width: 100%;"></select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="div_region row d-flex justify-content-center">
                                                            
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                    </div>
                                </div> --}}
                                @php
                                    $arr_branch = [];
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="/plugins/select2/js/select2.full.min.js"></script>
<script>

$(document).ready(function(){
    // $.get('/aging_ar/branch_admin', function(data, status){
    //     $('#branch').empty();
    //     let user_data_access = "{{ $user_data_access }}";
    //     let arrSplitUserDataAccess = user_data_access.split(",");
    //     $.each(data, function(i,item){
    //         if(arrSplitUserDataAccess.includes(String(data[i].id))){
    //             $('#branch').append($('<option>',{
    //                 value:data[i].id,
    //                 text:data[i].branch_name
    //             }).attr('selected','selected'));
    //         }else{
    //             $('#branch').append($('<option>',{
    //                 value:data[i].id,
    //                 text:data[i].branch_name
    //             }));
    //         }
    //     });
    //     $('#branch').select2();
    // });

    // $.get("/users/data_company",function(data){
    //         $('#company_id').append($('<option>',{
    //            value:"",
    //            text:"Choose"
    //         }));
    //         $.each(data,function(key,value){
    //            $('#company_id').append($('<option>',{
    //               value:data[key].COMPANY_ID,
    //               text:data[key].COMPANY_NAME
    //            }));
    //         });
    // });

    // $(document).on('change','#company_id',function(){
    //     $.ajax({
    //         url: '/users/branch_admin',
    //         type: "POST",
    //         dataType:"JSON",
    //         data: {
    //             company_id: $('#company_id').val(),
    //             _token: '{{csrf_token()}}',
    //         },
    //         success: function(data){
    //             $('#branch').empty();
    //             let user_data_access = "{{ $user_data_access }}";
    //             let arrSplitUserDataAccess = user_data_access.split(",");
    //             $.each(data, function(i,item){
    //                 if(arrSplitUserDataAccess.includes(String(data[i].id))){
    //                     $('#branch').append($('<option>',{
    //                         value:data[i].id,
    //                         text:data[i].branch_name
    //                     }).attr('selected','selected'));
    //                 }else{
    //                     $('#branch').append($('<option>',{
    //                         value:data[i].id,
    //                         text:data[i].branch_name
    //                     }));
    //                 }
    //             });
    //         }
    //     });
    // });
    let companyIndex = 1;
    $.ajax({
        url: "/users/get_user_company_branches/{{ $user->id }}",
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            const uniqueCompanyIds = [];

            $.each(data, function(index, item){
                if($.inArray(item.company_id, uniqueCompanyIds)=== -1){
                    uniqueCompanyIds.push(item.company_id);
                }
            });

            const grouped = {};
            data.forEach(item => {
                if (!grouped[item.company_id]) {
                    grouped[item.company_id] = {
                    company_name: item.company_name,
                    branches: []
                    };
                }

                grouped[item.company_id].branches.push({
                    branch_id: item.branch_id,
                    branch_name: item.branch_name
                });
            });
            let i = 1;
            $.each(uniqueCompanyIds, function(index, companyId){
                const html = 
                '<div class="company_branches">'+
                    '<div class="form-group row">'+
                        '<label for="col-form-label" class="col-form-label col-sm-2">Company</label>'+
                        '<div class="col-sm-10">'+
                            '<select class="form-control company_select" style="width:430px;" name="company_id[]" id="company_id'+i+'" data-company-id="'+companyId+'">'+
                            '</select>'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                        '<label for="col-form-label" class="col-form-label col-sm-2">Branch</label>'+
                        '<div class="col-sm-10">'+
                            '<select class="form-control select2 branch_select" style="width:430px;" multiple name="branch[]" id="branch'+i+'" data-selected-branches=\''+JSON.stringify(grouped[companyId].branches.map(b=>b.branch_id)) +'\'\>'+
                            '</select>'+
                        '</div>'+
                    '</div>'+
                '</div><hr/>';
                i++;
                
                $('#drop-down-company-branches').append(html);
                companyIndex = i;
            });
            $('.branch_select').select2();
        }
    }).done(function(response){
        $.get("/users/data_company",function(data){
            // $('.company_select').append($('<option>',{
            //    value:"",
            //    text:"Choose"
            // }));
            // $.each(data,function(key,value){
            //    $('.company_select').append($('<option>',{
            //       value:data[key].COMPANY_ID,
            //       text:data[key].COMPANY_NAME
            //    }));
            // });
            $('.company_select').each(function(){
                const el = $(this);
                const selectedCompanyId = el.data('company-id');

                el.append($('<option>',{
                    value:"",
                    text:"Choose"
                }));

                $.each(data, function(key, value){
                    el.append($('<option>',{
                        value: data[key].COMPANY_ID,
                        text:data[key].COMPANY_NAME
                    }));
                });

                el.val(selectedCompanyId).trigger('change');
            });
            }).done(function(res){
                $('.company_select').each(function(){    
                        const select = $(this);
                        const companyId = select.val();
                        const wrapper = select.closest('.company_branches');
                        const branchSelect = wrapper.find('.branch_select');

                        $.ajax({
                            url: '/users/branch_admin',
                            type: "POST",
                            dataType:"JSON",
                            data: {
                                company_id: companyId,
                                _token: '{{csrf_token()}}',
                            },
                            success: function(data){
                                branchSelect.empty();
                                $.each(data, function(i,item){
                                    branchSelect.append($('<option>',{
                                        value:data[i].id,
                                        text:data[i].branch_name
                                    }));
                                });
                                const selectedBranches = JSON.parse(branchSelect.attr('data-selected-branches') || '[]');
                                // console.log(selectedBranches);
                                branchSelect.val(selectedBranches).trigger('change');
                            }
                        });
                });
            }
        );
    });

    $('#add-company').on('click', function() {
        $.get("/users/data_company", function(companies) {
            const html = `
                <div class="company_branches mb-3">
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">Company</label>
                        <div class="col-sm-10">
                            <select class="form-control company_select" name="company_id[]" id="company_id${companyIndex}" style="width:430px;" data-company-id="">
                                <option value="">Choose</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">Branch</label>
                        <div class="col-sm-10">
                            <select class="form-control select2 branch_select" name="branch[]" id="branch${companyIndex}" style="width:430px;" multiple data-selected-branches="[]">
                            </select>
                        </div>
                    </div>
                </div><hr/>
            `;
            $('#drop-down-company-branches').append(html);
            $('#branch' + companyIndex).select2();
            const select = $('#company_id' + companyIndex);
            $.each(companies, function(i, company){
                select.append(
                    $('<option>', {
                        value: companies[i].COMPANY_ID,
                        text: companies[i].COMPANY_NAME
                    })
                );
            });
        }).done(function(res){
        ++companyIndex;
        });
        // Apply Select2
    })

    $(document).on('change', '.company_select', function() {
        const select = $(this);
        const companyId = select.val();
        const wrapper = select.closest('.company_branches');
        const branchSelect = wrapper.find('.branch_select');

        $.ajax({
            url: '/users/branch_admin',
            type: 'POST',
            dataType: 'JSON',
            data: {
                company_id: companyId,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                branchSelect.empty(); // Clear existing options

                // Tambahkan branch baru
                $.each(data, function(i, item) {
                    branchSelect.append(
                        $('<option>', {
                            value: item.id,
                            text: item.branch_name
                        })
                    );
                });

                // Jika pakai select2
                branchSelect.trigger('change');
            }
        });
    });

    $('input[name="check_all[]"]').each(function(){
        if($(this).val()=='all'){
            var number = this.id.match(/\d+/);
            $('#checkboxPrimary'+number).prop('checked',true);
        }
    });
    $('input[name="checkboxPrimary[]"]').each(function(){
        $(this).click(function(){
            var idParent = this.id.match(/\d+/);
            
            if($(this).is(':checked')){
                // $('input[name="menuParent'+idParent+'[]"]').prop('checked',true);
                $('.menuParent'+idParent).prop('checked',true);
            }else{
                $('.menuParent'+idParent).prop('checked',false);
            }
        });
    });

    $('#form_user_access').validate({
        rules:{
            'menuParent[]':{
                required:true
            }
        },
        errorElement: 'span',
            errorPlacement: function (error, element) {
            },
            highlight: function (element, errorClass, validClass) {
            Swal.fire({
                title : "Perhatian!",
                html  : "Mohon isi privilegenya!",
                icon  : "error"
            });
            },
            unhighlight: function (element, errorClass, validClass) {
            },
            submitHandler: function() { 
                var url = window.location.href;
                var param = url.split('/');
                var formData = new FormData();
                const menu = [];
                $('input[name="menuParent[]"]:checked').each(function(){
                    var getDataCreateCB = $(this).attr('data-createId');
                    var getDataUpdateCB = $(this).attr('data-updateId');
                    var getDataDeleteCB = $(this).attr('data-deleteId');
                    var isCreateChecked = $('#'+getDataCreateCB).is(':checked') ? 1 : 0;
                    var isUpdateChecked = $('#'+getDataUpdateCB).is(':checked') ? 1 : 0;
                    var isDeleteChecked = $('#'+getDataDeleteCB).is(':checked') ? 1 : 0;
                    // menuParent.push(
                    //     $(this).val()
                    // );
                    menu.push({
                        'menu_id'   : $(this).val(),
                        'create' : isCreateChecked,
                        'update' : isUpdateChecked,
                        'delete' : isDeleteChecked
                    });
                });
                console.log(menu);
                formData.append('menu',menu);
                formData.append('user_id',param[5]);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                    },
                    url:'/users/set_user_access_previlage',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        'menu':menu,
                        'user_id':param[5],
                        _token: '{{csrf_token()}}',
                    },
                    processData:true,
                    success: function(data){
                        if(data.error == 1){
                            Toast.fire({
                                icon: 'error',
                                title: 'Warning!'
                            })
                        }else{
                            Swal.fire({
                                title: data.title,
                                html : data.message,
                                icon : data.icon,
                                showConfirmButton: false
                            });
                            setTimeout(() => {
                                window.location.href = data.redirect
                            }, 1500);
                            
                        }
                    }
                });
            }
    });
});

$(document).on('submit','#form_data_access',function(e){
    e.preventDefault();
    // $.ajax({
    //     url: '/users/setDataAccess',
    //     type:"POST",
    //     processData:true,
    //     data:{
    //         'id':{{ $user->id }},
    //         'company':$('').val(),
    //         'branch':$('#branch').val(),
    //         '_token':"{{ csrf_token() }}"
    //     },
    //     success:function(data){
    //         Swal.fire({
    //             title:data.title,
    //             html:data.message,
    //             icon:data.icon
    //         });
    //     }
    // });

    const finalData = [];

    $('.company_branches').each(function(){
        const wrapper = $(this);
        const companyId = wrapper.find('.company_select').val();
        const branchIds = wrapper.find('.branch_select').val();

        finalData.push({
            company_id:companyId,
            branches:branchIds
        });
        
    });

    const jsonFinalData = JSON.stringify(finalData);
    console.log(jsonFinalData);
    $.ajax({
        url: '/users/setDataAccess',
        type:"POST",
        processData:true,
        dataType:"JSON",
        data:{
            'id':{{ $user->id }},
            'finalData': jsonFinalData,
            '_token':"{{ csrf_token() }}"
        },
        success:function(data){
            Swal.fire({
                title:data.title,
                html:data.message,
                icon:data.icon
            });
        }
    });


});

// $(document).on('submit','#form_user_authority', function(e){
//     e.preventDefault();
//     var url = window.location.href;
//     var param = url.split('/');
//     let countDataSelect2 = $('#branch').select2('data').length;
//     let arrTextSelect2 = [];
//     $.each($('#branch').select2('data'), function(i,j){
//         arrTextSelect2.push($('#branch').select2('data')[i].text);
//     });
//     $.ajax({
//         url:"/users/setUserAccessAuthority",
//         type:"POST",
//         dataType:"JSON",
//         data:{
//             branch:$('#branch').val(),
//             // location_name:$('#branch').find('option:selected').text(),
//             location_name:arrTextSelect2,
//             user_id:param[5],
//             _token: '{{csrf_token()}}',
//         },
//         processData:true,
//         success: function(data){
//             Swal.fire({
//                                 title: data.title,
//                                 html : data.message,
//                                 icon : data.icon,
//                                 showConfirmButton: false
//                             });
            
//             setTimeout(() => {
//                 window.location.href = data.redirect
//             }, 1500);
//         }
//     })
// })

$('#branch').select2();
</script>
@endsection