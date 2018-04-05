@extends('Tasks.master')
@section('content')
    <div class="container-fluid container-scroll">
        <h3>{{$project->name}}</h3>
        <div class="addrow">
            <button type="button" class="btn btn-info" id="btn-add-board">Thêm bảng</button> <br><br>
        </div>
        <div class="scrollmenu">
            @if(!empty($project))
                    @foreach($project->boards as $boards)
                        <div class="tasks">
                            <div class="card" >
                                <div class="card-body">
                                    <ul class="list-group list-group-flush" >
                                        <li class="task-row" >
                                            <textarea readonly class="card-title form-control edit-area" id="{{$boards->id}}"  >{{$boards->name}}</textarea>
                                        </li>
                                        @foreach($boards->tasks as $task)
                                            <li class="task-row">
                                                <textarea readonly class="card-task form-control" id="{{$task->id}}">{{$task->title}}</textarea>
                                                <a class="delete-task"  data-id="{{$task->id}}"><i  class=" far fa-trash-alt fa-sm"></i></a>
                                            </li>

                                        @endforeach
                                    </ul>
                                    <a class="add-task">Thêm thẻ</a>
                                </div>
                            </div>
                            <a class="action"  data-id="{{$boards->id}}"><i  class=" far fa-edit fa-sm"></i></a>


                        </div>
                    @endforeach
             @endif
        </div>
    </div>
    <div class="modal fade" id="md-create-board" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo bảng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="fm-create-board" action="">
                        <div class="form-group">
                            <label for="name">Tên bảng</label>
                            <input type="text" class="form-control" id="name" name="name" >
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save-board">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="md-del-task" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xóa !</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                <div class="modal-body">
                    <p>Bạn có thực sự muốn xóa mục này !.</p>
                    <p>Ấn nút delete để xóa?</p>
                    <p class="debug-url"></p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a  id="comfirm-del-task" class="btn btn-danger btn-ok" >Delete</a>
                </div>
            </div>
        </div>
    </div>
        <div class="modal fade " id="md-detail-task" tabindex="-1" role="dialog" aria-labelledby="modalDetailTask" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDetailTask">Xóa !</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <a  id="comfirm-del-task" class="btn btn-danger btn-ok" >Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
    <script>

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });


            $(document).on('click','#btn-add-board',function(){
                $('#md-create-board').modal('show');
            });
            $('#save-board').on('click',function(e){
                e.preventDefault();

                var formData = {
                    'name' : $('input[name=name]').val(),
                    'description' : $('input[name=description]').val(),
                    'project_id' : '{{ $project->id }}'
                };
                //save board
                $.ajax({
                    type:'POST',
                    url: '{{ route('createboard') }}',
                    data: formData,
                    datatype:'json',
                    success: function(data){
                        console.log(data);
                        $('#md-create-board').modal('hide');
                        $('#fm-create-board').trigger('reset');
                        $('.scrollmenu').append("<div class='tasks'>" +
                            "                            <div class='card' >" +
                            "                                <div class='card-body'>" +
                            "                                    <ul class='list-group list-group-flush' >" +
                            "                                        <li class='task-row'>" +
                            "                                            <textarea readonly class='card-title form-control edit-area' id="+data.id+">"+data.name+"</textarea>" +
                            "                                        </li>" +
                            "                                    </ul>" +
                            "                                    <a class='add-task'>Thêm thẻ</a>" +
                            "                                </div>" +
                            "                            </div>" +
                            "                        </div>");
                    }
                });
            });
            //even on name board
            $(document).on('click','.edit-area',function(){
                $('.edit-area').attr('readonly');
                $('.edit-area').removeClass('onclick');
                $('#area-temp').remove();
                $('a.add-task').show();
                var board_id = $(this).attr('id');
                $('.action-row').remove();//hide btn save and cancel another
                $(this).removeAttr('readonly');
                $(this).addClass('onclick');//style on focus textarea
                $(this).parent().append("<div class='action-row my-2'><a class='btn btn-sm btn-primary btn-update-board p-x-5 mx-1' id='"+board_id+"'>Lưu</a>" +
                    "<a id='cancel-board' class='btn btn-sm btn-grey p-x-5 mx-1'>Hủy</a></div>");
            });
            //even update board
            $(document).on('click','.btn-update-board',function() {
                var board_id = $(this).attr('id');
                var name = $('#'+board_id).val();
                //save task
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url: '{{ route('updateboard') }}',
                    data: {
                        name:name,
                        board_id : board_id
                    },
                    datatype:'json',
                    success:function(data){
                        console.log(data);
                        $('textarea#'+data.id).attr('readonly');
                        $('textarea#'+data.id).removeClass('onclick');
                        $('.action-row').remove();
                        $('a.add-task').show();
                    }
                });
            });


            //even  create task
            $(document).on('click','.add-task',function(){
                $('.edit-area').attr('readonly');
                $('.edit-area').removeClass('onclick');
                $('.action-row').remove();
                $('a.add-task').show();
                $('#area-temp').remove();
                $(this).hide();
                $(this).parent().find('.list-group').append(
                    "<li class='task-row'>"+
                    "<textarea  id='area-temp' class='card-task form-control new-task onclick'></textarea>" +
                    "<div class='action-row my-2'>" +
                    "<a id='save-task' class='btn btn-sm btn-primary  p-x-5 mx-1'>Lưu</a>" +
                    "<a id='cancel-task' class='btn btn-sm btn-grey p-x-5 mx-1'>Hủy</a>"+
                    "</div>"+
                    "</li>"
                );
            });
            $(document).on('click','#save-task',function(){
                var name = $('#area-temp').val();
                var board_id = $(this).parents('ul.list-group').find('.card-title').attr('id');
                $.ajax({
                    type:'POST',
                    url: '{{ route('createtask') }}',
                    data:{name :name,board_id:board_id},
                    datatype:'json',
                    success: function(data) {
                        console.log(data);
                        $('.new-task').removeClass('onclick');
                        $('.new-task').attr({'readonly':true});
                        $('.action-row').remove();
                        $('#area-temp').parent().append("<a class='delete-task'  data-id='"+data.id+"'><i  class=' far fa-trash-alt fa-sm'></i></a>");
                        $('#area-temp').attr('id',data.id);
                        $('a.add-task').show();
                    }
                });
            });
            $(document).on('click','a.action',function(){
                // alert($(this).attr('data-id'));
            });

            $(document).on('click','a.delete-task',function(){
                var task_id = $(this).attr('data-id');
                $('#comfirm-del-task').attr('data-id',task_id);
                $('#md-del-task').modal('show');
            });
            $(document).on('click','a#comfirm-del-task',function(){
                var task_id = $(this).attr('data-id');
                $.ajax({
                    type:'POST',
                    url: '{{ route('deletetask')}}',
                    data:{task_id :task_id},
                    datatype:'json',
                    success: function(data) {
                        console.log(data);
                        $('#md-del-task').modal('hide');
                        $('textarea#'+data.id).parent().remove();
                    }
                });
            });

            //event view detail task
            $(document).on('click','textarea.card-task',function(){
               $('#md-detail-task').modal('show');
            });


        });
    </script>
@endsection
