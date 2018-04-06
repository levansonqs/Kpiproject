@extends('Tasks.master')
@section('style')
    <style>
        .icon-delete{display:none;font-size:100%}
        .statistic-box:hover .icon-delete{
           display:block;
        }
    </style>
    @stop
@section('content')
<h3>Bảng cá nhân</h3>
<div class="row">
    @foreach($projects as $project)
        @foreach($project as $pro)
    <div class="col-sm-4 col-md-3 col-xl-2" id="pro{{$pro['id']}}">
        <div class="statistic-box purple">
            <div>
                <button type="button" class="btn btn-danger btn-xs delete-dashboard icon-delete float-right" value="{{$pro['id']}}"><i class="fa fa-times"></i></button>
                <button type="button" class="btn btn-warning btn-xs icon-delete float-left edit-dashboard" value="{{$pro['id']}}"> <i class="fa fa-edit"></i> </button>
                <div class="number" style="font-size:200%">
                    <a href="{{url('/dashboard/project-detail/'.$pro['id'])}}" style="color:#fff">
                    {{$pro['name']}}
                    </a>
                </div>
                <div class="caption">
                    <a href="{{url('/dashboard/project-detail/'.$pro['id'])}}" style="color:#fff">
                    {{$pro['description']}}
                    </a>
                </div>

            </div>
        </div>
    </div>
        @endforeach
    @endforeach
        <div  id="dashboardper" class="col-sm-4 col-md-3 col-xl-2">
            <a id="addboard">
                <div class="statistic-box red">
                    <div>
                        <div class="number" >
                            Bảng
                        </div>
                        <div class="caption">
                            Thêm bảng
                        </div>
                    </div>
                </div>
            </a>
        </div>
</div>



<h3> Tạo nhóm <button class="fa fa-plus btn btn-info" id="gregroup"></button> </h3>
<div id="rowgroup">
    @foreach($groups as $group)
        @if(!empty($group['group_id']))
            <div id="group{{$group['group']['id']}}">
                <div id="group-title{{$group['group']['id']}}">
                    <h4 style="color:darksalmon"> <i style="color:darkgrey" class="fa fa-users"></i> {{$group['group']['name'] }} <button type="button" class="btn btn-xs btn-success edit-group" style="font-size:50%" value="{{$group['group']['id']}}">Sửa</button> <button class="btn btn-xs btn-danger delete-group" style="font-size:50%" value="{{$group['group']['id']}}">Xóa</button> </h4>
                </div>


                <div class="row" >
                    <?php
                    $projects_group = [];
                    $projects = $group['projects'];
                    if(!empty($projects)){
                        foreach($projects as $project ){
                            if($project['permission_id'] != 1){
                                $projects_group[] = $project;
                            }
                        }
                    }

                    ?>
                    @foreach($projects_group as $project)
                        <div class="col-sm-4 col-md-3 col-xl-2" id="pro-group{{$project['id']}}">
                            <div class="statistic-box green">

                                <div>
                                    <button type="button" class="btn btn-danger btn-xs delete-project-group icon-delete float-right" value="{{$project['id']}}"><i class="fa fa-times"></i></button>
                                    <button type="button" class="btn btn-warning btn-xs icon-delete float-left edit-dashboard" value="{{$project['id']}}"> <i class="fa fa-edit"></i> </button>
                                    <div class="number" style="font-size:200%">
                                        <a href="{{url('/dashboard/project-detail/'.$project['id'])}}" style="color:#fff">
                                            {{ $project['name'] }}
                                        </a>
                                    </div>
                                    <div class="caption">
                                        <a href="{{url('/dashboard/project-detail/'.$project['id'])}}" style="color:#fff">
                                            {{  $project['description'] }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div id="gr{{$group['id']}}" class="col-sm-4 col-md-3 col-xl-2">
                        <a class="addgroup"  data="{{$group['id']}}">
                            <div class="statistic-box red">
                                <div>
                                    <div class="number">
                                        Bảng
                                    </div>
                                    <div class="caption">
                                        Thêm bảng
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        @endif
    @endforeach
</div>




@stop



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm bảng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frdashboar">
                    <div class="form-group">
                        <label for="name">Tên dự án</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="des">Mô tả dự án</label>
                        <input type="text" class="form-control" id="des">
                    </div>
                    <div class="form-group">
                        <label for="dealine">Dự kiến ngày kết thúc</label>
                        <input type="date" class="form-control" id="dealine">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save" data-id="">Save changes</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="greategroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_title_group"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formcreategroup">
                    <div class="form-group">
                        <label for="group">Thêm Nhóm</label>
                        <input type="text" class="form-control" id="group" name="name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="savegroup" data-id="">Save</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa không?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" id="delete_project" data-id="">Delete</button>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        $(document).ready(function(){


            $("body").on('click','#addboard',function(){
                $('#exampleModalLabel').html("Tạo bảng");
                $('#frdashboar').trigger("reset");
                $('#exampleModal').modal('show');
                $('#save').val('addboardpersonal');
            });
            $("#save").on('click',function(e){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                e.preventDefault();

                var name = $("#name").val();
                var des = $("#des").val();
                var dealine = $("#dealine").val();
                var state = $('#save').val();
                if(state == 'addboardpersonal'){
                    $.ajax({
                        type: 'POST',
                        url: '{{route('postboard')}}',
                        data:{name:name,des:des,dealine:dealine},
                        dataType:'json',
                        success:function(data){
                            var das_1 = '<div class="col-sm-4 col-md-3 col-xl-2" id="pro'+data.id+'">\n' +
                                '        <div class="statistic-box purple">\n' +
                                '            <div>\n' +
                                '                <button type="button" class="btn btn-danger btn-xs delete-dashboard icon-delete float-right" value="'+data.id+'"><i class="fa fa-times"></i></button>\n' +
                                '                <button type="button" class="btn btn-warning btn-xs icon-delete float-left edit-dashboard" value="'+data.id+'"> <i class="fa fa-edit"></i></button>\n' +
                                '                <div class="number" style="font-size:200%">\n' +
                                '                    <a href="" style="color:#fff">\n' +
                                '                    '+data.name+' \n' +
                                '                    </a>\n' +
                                '                </div>\n' +
                                '                <div class="caption">\n' +
                                '                    <a href="" style="color:#fff">\n' +
                                '                     '+data.description+' \n' +
                                '                    </a>\n' +
                                '                </div>\n' +
                                '\n' +
                                '            </div>\n' +
                                '        </div>\n' +
                                '    </div>';

                            $('#dashboardper').before(das_1);
                            $("#frdashboar").trigger("reset");
                            $('#exampleModal').modal('hide');
                        }
                    })
                }
            });



            // Tao group

            $("#gregroup").on('click',function(){
                $('#edit_title_group').html("Tạo Group");
                $("#formcreategroup").trigger("reset");
                $("#savegroup").val('gre_group');
                $('#greategroup').modal('show');
            })
            $("#savegroup").on('click',function(e){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                e.preventDefault();
                var name = $("#group").val();
                var state = $(this).val();
                if(state == 'gre_group'){
                    $.ajax({
                        type: 'POST',
                        url: '{{route('postgroup')}}',
                        data: {name:name},
                        success: function (data) {
                            var add_1 = '<div id="group'+data[0].id+'">\n' +
                                '                <div id="group-title'+data[0].id+'">\n' +
                                '                    <h4 style="color:darksalmon"> <i style="color:darkgrey" class="fa fa-users"></i> '+data[0].name+' <button type="button" class="btn btn-xs btn-success edit-group" style="font-size:50%" value="'+data[0].id+'">Sửa</button> <button class="btn btn-xs btn-danger delete-group" style="font-size:50%" value="'+data[0].id+'">Xóa</button> </h4>\n' +
                                '                </div>\n' +
                                '                <div class="row" >\n' +
                                '                    <div id="gr'+data[1].id+'" class="col-sm-4 col-md-3 col-xl-2">\n'+
                                '                        <a class="addgroup"  data="'+data[1].id+'">\n'+
                                '                            <div class="statistic-box red">\n'+
                                '                                <div>\n'+
                                '                                    <div class="number">\n'+
                                '                                        Bảng\n'+
                                '                                    </div>\n'+
                                '                                    <div class="caption">\n'+
                                '                                        Thêm bảng\n'+
                                '                                    </div>\n'+
                                '                                </div>\n'+
                                '                            </div>\n'+
                                '                        </a>\n'+
                                '                    </div>\n'+
                                '                </div>\n'+
                                '            </div>';
                            console.log(data);
                            $("#rowgroup").append(add_1);
                            $('#greategroup').modal('hide');
                            $('#formcreategroup').trigger("reset");
                        }
                    })
                }

            })




            $("body").on('click','.addgroup',function () {
                $('#exampleModalLabel').html("Tạo bảng");
                $('#frdashboar').trigger("reset");
                $('#exampleModal').modal('show');

                var datamember = $(this).attr('data');
                $('#save').attr('data-id',datamember);
                $('#save').val('add_board_group');
            })
            $("#save").on('click',function(e){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                e.preventDefault();
                var state = $('#save').val();
                var name = $("#name").val();
                var description = $("#des").val();
                var dealine = $("#dealine").val();
                var member_id = $(this).attr('data-id');
                if(state == 'add_board_group'){
                    $.ajax({
                        type: 'POST',
                        url:'{{route('createprojectgroup')}}',
                        data:{name:name,description:description,dealine:dealine,member_id:member_id},
                        dataType:'json',
                        success:function(data){
                            console.log(data[0].name);
                            var add_1 = '<div class="col-sm-4 col-md-3 col-xl-2" id="pro-group'+data[0].id+'">\n' +
                                '                    <div class="statistic-box green">\n' +
                                '\n' +
                                '                        <div>\n' +
                                '                            <button type="button" class="btn btn-danger btn-xs delete-project-group icon-delete float-right" value="'+data[0].id+'"><i class="fa fa-times"></i></button>\n' +
                                '                            <button type="button" class="btn btn-warning btn-xs icon-delete float-left edit-dashboard" value="'+data[0].id+'"> <i class="fa fa-edit"></i> </button>\n' +
                                '                            <div class="number" style="font-size:200%">\n' +
                                '                                <a href="{{url('/dashboard/project-detail')}}/'+data[0].id+'" style="color:#fff">\n' +
                                '                                    '+data[0].name+'\n' +
                                '                                </a>\n' +
                                '                            </div>\n' +
                                '                            <div class="caption">\n' +
                                '                                <a href="{{url('/dashboard/project-detail')}}/'+data[0].id+'" style="color:#fff">\n' +
                                '                                    '+data[0].description+'\n' +
                                '                                </a>\n' +
                                '                            </div>\n' +
                                '                        </div>\n' +
                                '                    </div>\n' +
                                '                </div>';
                            $("#gr"+data[1][0].id).before(add_1);
                            $("#frdashboar").trigger("reset");
                            $('#exampleModal').modal('hide');
                        }
                    })
                }
            })



            $('body').on('click','.delete-dashboard',function () {
                $('#deletemodal').modal('show');
                var button_val = $(this).val();
                $('#delete_project').val('del_project_per');
                $('#delete_project').attr('data-id',button_val);
            })
            $('#delete_project').on('click',function(e){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                e.preventDefault();
                var id = $(this).attr('data-id');
                var state = $('#delete_project').val();
                if(state == 'del_project_per'){
                    $.ajax({
                        type : 'DELETE',
                        url : '{{url('/dashboard/deletepersonal')}}/'  +id,
                        success:function(data){
                            $('#pro'+data[0].id).remove();
                            $('#deletemodal').modal('hide');
                        },
                    })
                }
            })







            $('body').on('click','.edit-dashboard',function () {
                var id = $(this).val();
                $('#exampleModalLabel').html("Sửa bảng");
                $('#exampleModal').modal('show');
                $('#save').val('edit_board');
                $('#save').attr('data-id',id);
                $.get('{{url('/dashboard/getboardpersonal')}}/'+id,function(data){
                    var name = $("#name").val(data.name);
                    var des = $("#des").val(data.description);
                    var dealine = $("#dealine").val(data.dealine);
                })
            })
            $('#save').on('click',function(e){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                e.preventDefault();
                var state = $('#save').val();
                var name = $("#name").val();
                var des = $("#des").val();
                var dealine = $("#dealine").val();
                var id = $(this).attr('data-id');
                if(state == 'edit_board'){
                    $.ajax({
                        type:'PUT',
                        url: '{{url('/dashboard/editboardpersonal')}}/'+id,
                        data:{name:name,description:des,dealine:dealine},
                        dataType:'json',
                        success:function(data){

                            var edit = '<div class="col-sm-4 col-md-3 col-xl-2" id="pro'+data.id+'">\n' +
                                '        <div class="statistic-box purple">\n' +
                                '            <div>\n' +
                                '                <button type="button" class="btn btn-danger btn-xs delete-dashboard icon-delete float-right" value="'+data.id+'"><i class="fa fa-times"></i></button>\n' +
                                '                <button type="button" class="btn btn-warning btn-xs icon-delete float-left edit-dashboard" value="'+data.id+'"> <i class="fa fa-edit"></i> </button>\n' +
                                '                <div class="number" style="font-size:200%">\n' +
                                '                    <a href="" style="color:#fff">\n' +
                                '                    '+data.name+'\n' +
                                '                    </a>\n' +
                                '                </div>\n' +
                                '                <div class="caption">\n' +
                                '                    <a href="" style="color:#fff">\n' +
                                '                    '+data.description+'\n' +
                                '                    </a>\n' +
                                '                </div>\n' +
                                '\n' +
                                '            </div>\n' +
                                '        </div>\n' +
                                '    </div>';

                            var edit_project_group = '<div class="col-sm-4 col-md-3 col-xl-2" id="pro-group'+data.id+'">\n' +
                                '                    <div class="statistic-box green">\n' +
                                '\n' +
                                '                        <div>\n' +
                                '                            <button type="button" class="btn btn-danger btn-xs delete-project-group icon-delete float-right" value="'+data.id+'"><i class="fa fa-times"></i></button>\n' +
                                '                            <button type="button" class="btn btn-warning btn-xs icon-delete float-left edit-dashboard" value="'+data.id+'"> <i class="fa fa-edit"></i> </button>\n' +
                                '                            <div class="number" style="font-size:200%">\n' +
                                '                                <a href="" style="color:#fff">\n' +
                                '                                    '+data.name+'\n' +
                                '                                </a>\n' +
                                '                            </div>\n' +
                                '                            <div class="caption">\n' +
                                '                                <a href="" style="color:#fff">\n' +
                                '                                    '+data.description+'\n' +
                                '                                </a>\n' +
                                '                            </div>\n' +
                                '                        </div>\n' +
                                '                    </div>\n' +
                                '                </div>';
                            $("#pro-group"+data.id).replaceWith(edit_project_group);
                            $("#pro"+data.id).replaceWith(edit);
                            $('#exampleModal').modal('hide');
                        }
                    })
                }

            })


            $('body').on('click','.delete-project-group',function () {
                var button_val = $(this).val();
                $('#delete_project').val('del_project_gr');
                $('#delete_project').attr('data-id',button_val);
                $('#deletemodal').modal('show');
            })
            $('#delete_project').on('click',function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                e.preventDefault();
                var id = $(this).attr('data-id');
                var state = $(this).val();
               if(state == 'del_project_gr'){
                   $.ajax({
                       type: 'DELETE',
                       url : '{{url('dashboard/delprojectgroup')}}/'+id,
                       success:function (data) {
                           $('#pro-group'+data.id).remove();
                           $('#deletemodal').modal('hide');
                       }
                   })
               }
            })


            $('body').on('click','.edit-group',function () {
                var id = $(this).val();
                $('#edit_title_group').html("Sửa Nhóm");
                $('#savegroup').val('edit_group');
                $('#savegroup').attr('data-id',id);
                $('#greategroup').modal('show');
                $.get('{{url('/dashboard/getgroup')}}/'+id,function (data) {
                    var namegroup = $('#group').val(data.name);
                })
            })
            $("#savegroup").on('click',function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                e.preventDefault();
                var id = $(this).attr('data-id');
                var name = $("#group").val();
                var state = $(this).val();
                if(state == 'edit_group'){
                    $.ajax({
                        url: '{{url('/dashboard/editgroup')}}/'+id,
                        type:'POST',
                        data:{name:name},
                        dataType:'json',
                        success:function (data) {
                            var title = '<div id="group-title'+data.id+'">\n' +
                                '                 <h4 style="color:darksalmon"> <i style="color:darkgrey" class="fa fa-users"></i> '+data.name+' <button type="button" class="btn btn-xs btn-success edit-group" style="font-size:50%" value="'+data.id+'">Sửa</button> <button class="btn btn-xs btn-danger delete-group" style="font-size:50%" value="'+data.id+'">Xóa</button> </h4>\n' +
                                '            </div>';
                            $("#group-title"+data.id).replaceWith(title);
                            $('#greategroup').modal('hide');
                            console.log(data);
                        }
                    })
                }
            })


            $('body').on('click','.delete-group',function () {
                var button_val = $(this).val();
                $('#delete_project').val('del_group');
                $('#delete_project').attr('data-id',button_val);
                $('#deletemodal').modal('show');
            })
            $('#delete_project').on('click',function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                e.preventDefault();
                var id = $(this).attr('data-id');
                var state = $('#delete_project').val();
                if(state == 'del_group'){
                    $.ajax({
                        type:'DELETE',
                        url : '{{url('/dashboard/delgroup')}}/'+id,
                        success:function (data) {
                            $('#group'+id).remove();
                            $('#deletemodal').modal('hide');
                            console.log(data);
                        }
                    })
                }
            })
        });

    </script>
@stop>
