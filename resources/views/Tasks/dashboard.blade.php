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
<div class="row"  >
    @foreach($projects as $project)
        @foreach($project as $pro)
    <div class="col-sm-4 col-md-3 col-xl-2" id="pro{{$pro['id']}}">
        <div class="statistic-box purple">
            <div>
                <button type="button" class="btn btn-danger btn-xs delete-dashboard icon-delete float-right" value="{{$pro['id']}}"><i class="fa fa-times"></i></button>
                <button type="button" class="btn btn-warning btn-xs icon-delete float-left edit-dashboard" value="{{$pro['id']}}"> <i class="fa fa-edit"></i> </button>
                <div class="number" style="font-size:200%">
                    <a href="" style="color:#fff">
                    {{$pro['name']}}
                    </a>
                </div>
                <div class="caption">
                    <a href="" style="color:#fff">
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
        <h4 style="color:darkgoldenrod"> {{$group['group']['name'] }} </h4>
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
                <div class="col-sm-4 col-md-3 col-xl-2">
                    <div class="statistic-box green">
                        <div>
                            <div class="number" style="font-size:200%">
                                {{ $project['name'] }}
                            </div>
                            <div class="caption">
                                {{  $project['description'] }}
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
                <h5 class="modal-title" id="exampleModalLabel">Tạo Group</h5>
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
                <button type="submit" class="btn btn-primary" id="savegroup" >Save</button>
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

            $("#gregroup").on('click',function(){
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
                $.ajax({
                    type: 'POST',
                    url: '{{route('postgroup')}}',
                    data: {name:name},
                    success: function (data) {
                        console.log(data);
                        var add = '<h4 style="color:darkgoldenrod"> '+data[0].name+' </h4>\n' +
                            '<div class="row">\n' +
                            '<div  id="gr'+data[1].id+'" class="col-sm-4 col-md-3 col-xl-2">\n' +
                            '                <a class="addgroup" data="'+data[1].id+'">\n' +
                            '                    <div class="statistic-box red">\n' +
                            '                        <div>\n' +
                            '                            <div class="number">\n' +
                            '                                Bảng\n' +
                            '                            </div>\n' +
                            '                            <div class="caption">\n' +
                            '                                Thêm bảng\n' +
                            '                            </div>\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                </a>\n' +
                            '            </div>';
                        '</div>';
                        $("#rowgroup").append(add);
                        $('#greategroup').modal('hide');
                        $('#formcreategroup').trigger("reset");
                    }
                })
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
                            var add = '<div class="col-sm-4 col-md-3 col-xl-2">\n' +
                                '                    <div class="statistic-box green">\n' +
                                '                        <div>\n' +
                                '                            <div class="number" style="font-size:200%">\n' +
                                '                                '+data[0].name+' \n' +
                                '                            </div>\n' +
                                '                            <div class="caption">\n' +
                                '                                '+data[0].description+' \n' +
                                '                            </div>\n' +
                                '                        </div>\n' +
                                '                    </div>\n' +
                                '                </div>';
                            $("#gr"+data[1][0].id).before(add);
                            $("#frdashboar").trigger("reset");
                            $('#exampleModal').modal('hide');
                            console.log(data);
                        }
                    })
                }
            })
            $('body').on('click','.delete-dashboard',function () {
                $('#deletemodal').modal('show');
                var button_val = $(this).val();
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
                $.ajax({
                    type : 'POST',
                    url : '{{url('/dashboard/deletepersonal')}}/'  +id,
                    success:function(data){
                        $('#pro'+data[0].id).remove();
                        $('#deletemodal').modal('hide');
                    },
                })
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
                $.ajax({
                    type:'PUT',
                    url: '{{url('/dashboard/editboardpersonal')}}/'+id,
                    data:{name:name,description:des,dealine:dealine},
                    dataType:'json',
                    success:function(data){
                        $('#exampleModal').modal('hide');
                        console.log(data);
                    }
                })
            })
        });
    </script>
@stop>