@extends('Tasks.master')
@section('content')
<h3>Bảng cá nhân</h3>
<div class="row"  >
    @foreach($projects as $project)
        @foreach($project as $pro)
    <div  class="col-sm-4 col-md-3 col-xl-2">
        <a href="">
            <div class="statistic-box purple">
                <div>
                    <div class="number" style="font-size:200%">
                        {{$pro['name']}}
                    </div>
                    <div class="caption">
                        {{$pro['description']}}
                    </div>
                </div>
            </div>
        </a>
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
@foreach($groups as $group)

<h4 style="color:darkgoldenrod"> {{$group['group']['name'] }} </h4>
<div class="row">
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
    <div class="col-sm-4 col-md-3 col-xl-2">
        <a href="{{ $group['id'] }}" class="addgroup">
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

@endforeach
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
                <button type="button" class="btn btn-primary" id="save">Save changes</button>
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
                <form action="">
                    <div class="form-group">
                        <label for="group">Thêm Nhóm</label>
                        <input type="text" class="form-control" id="group">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="savegroup">Save</button>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        $(document).ready(function(){
            $("body").on('click','#addboard',function(){
                $('#exampleModal').modal('show');
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
                $.ajax({
                    type: 'POST',
                    url: '{{route('postboard')}}',
                    data:{name:name,des:des,dealine:dealine},
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                        var das = '<div class="col-sm-4 col-md-3 col-xl-2">\n' +
                            '        <div class="statistic-box purple">\n' +
                            '            <div>\n' +
                            '                <div class="number" style="font-size:200%">\n' +
                            '                       '+data.name+'\n' +
                            '                </div>\n' +
                            '                <div class="caption">\n' +
                            '                    '+data.description+'\n' +
                            '                </div>\n' +
                            '            </div>\n' +
                            '        </div>\n' +
                            '    </div>';
                        $('#dashboardper').before(das);
                        $("#frdashboar").trigger("reset");
                        $('#exampleModal').modal('hide');
                    }
                })
            });
            $("body").on('click','.addgroup',function () {
                $('#exampleModal').modal('show');
                console.log('phan');
            })

            $("body").on('click','#gregroup',function(){
                $('#greategroup').modal('show');
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
                        }
                    })
                })
            })
        });

    </script>
@stop>