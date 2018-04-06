@extends('Tasks.master')
@section('style')
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
@endsection
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
                                        <a class="action" data-id="{{$boards->id}}"><i  class=" far fa-edit fa-sm"></i></a>
                                    <a class="add-task">Thêm thẻ</a>
                                </div>
                            </div>



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
    <div class="modal fade " id="md-detail-task" tabindex="1" role="dialog" aria-labelledby="title-task" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="width: 100%">
                        <textarea readonly class="card-title form-control edit-area" id="task-title"  data-id=""></textarea>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class=""><h5>Danh sách việc cần làm !</h5></div>
                    <div  id="content-task">


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="md-del-task" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Xóa !</h5>
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
                            "                                    <a class='action'  data-id='"+data.id+"'><i  class=' far fa-edit fa-sm'></i></a>" +
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
                    "<a  class='cancel btn btn-sm btn-grey p-x-5 mx-1'>Hủy</a></div>");
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


            //even view create task
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
                    "<a  class='cancel btn btn-sm btn-grey p-x-5 mx-1'>Hủy</a>"+
                    "</div>"+
                    "</li>"
                );
            });
            //even save task
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
            $(document).on('click','a#cancel-board',function(){
                $('.edit-area').attr('readonly');
                $('.edit-area').removeClass('onclick');
                $('.action-row').remove();
                $('a.add-task').show();
                $('#area-temp').remove();
            });
            $(document).on('click','a.cancel',function(){
                $('textarea').attr('readonly');
                $('textarea').removeClass('onclick');
                $('.action-row').remove();
                $('a.add-task').show();
                $('a.add-todo').show();
                $('#area-temp').remove();
            });
            //event view detail task
            $(document).on('click','textarea[readonly].card-task',function(){
               $('#md-detail-task').modal('show');
               var task_id = $(this).attr('id');
               console.log(task_id);
               $.ajax({
                   type:'POST',
                   url: '{{route('detailtask')}}',
                   data: {task_id:task_id},
                   datatype:'json',
                   success:function(data){

                       console.log(data);
                       $('#task-title').attr('readonly',false);
                       $('#task-title').attr('data-id',data[0][0].id)
                       $('#task-title').html(data[0][0].title);
                       $('#content-task').html(" <ul class='list-group list-group-flush' id='list-todos'>" +
                           "                    </ul>" +
                           "                    <a class='add-todo'>Thêm công việc...</a>" +
                           "                    <div  class='mt-3'>" +
                           "                        <h5 class='mt-3'>Comments</h5>" +
                           "                        <div class='wp-comments'>" +
                           "                                    <textarea  class='comment-box form-control mb-3' rows='2'  ></textarea>" +
                           "                        </div>" +
                           "                        <ul id='comments'>" +
                           "                        </ul>" +
                           "                    </div>");
                       $.each(data[1], function(i, todo) {
                            $('#list-todos').append("<li class='todo-row' data-id='"+todo.id+"'>" +
                                "   <textarea readonly class='card-todo form-control' data-id='"+todo.id+"'>"+todo.content+"</textarea>" +
                                "   <a class='delete-todo'  data-id='"+todo.id+"'><i  class='far fa-trash-alt fa-sm'></i></a>" +
                                "   </li>");
                       });
                       $.each(data[0][0].comments, function(i, todo) {
                           console.log(todo.user.name);
                          $('#comments').append("<li>" +
                                  "<div class='user-cmt row'>" +
                                      "<div class='col-md-1 '><img class='rounded-circle' src='{{asset('')}}/Images/favicon.png' width='40px' height='40px'></div>" +
                                      "<div class='col-md-11 px-4'><i> "+todo.user.name+"</i><small class='px-2'>"+todo.created_at+"</small>" +
                                      "<p>"+todo.content+"</p></div>" +
                                  "</div>" +
                              "</li>");
                       });
                   }
               });
            });
            //even view update task
            $(document).on('click','#task-title',function(){
                $('.edit-area').attr('readonly');
                $('.edit-area').removeClass('onclick');
                $('#area-temp').remove();
                var task_id = $(this).attr('data-id');
                $('.action-row').remove();//hide btn save and cancel another
                $(this).removeAttr('readonly');
                $(this).addClass('onclick');//style on focus textarea
                $(this).parent().append("<div class='action-row my-2'><a class='btn btn-sm btn-primary  p-x-5 mx-1' id='btn-update-task' data-id='"+task_id+"'>Lưu</a>" +
                    "<a  class='cancel btn btn-sm btn-grey p-x-5 mx-1'>Hủy</a></div>");
            });
            //even update task
            $(document).on('click','#btn-update-task',function(){
                var name = $('#task-title').val();
                var task_id = $(this).attr('data-id');
                $.ajax({
                    type:'POST',
                    url: '{{ route('updatetask') }}',
                    data:{name :name,task_id:task_id},
                    datatype:'json',
                    success: function(data) {
                        console.log(data);
                        $('#task-title').removeClass('onclick');
                        $('#task-title').attr({'readonly':true});
                        $('.action-row').remove();
                    }
                });
            });

            //even onclick content todos
            $(document).on('click','.card-todo[readonly]',function(){
                $('.card-todo').attr('readonly');
                $('.card-todo').removeClass('onclick');
                var todo_id = $(this).attr('data-id');
                $('.action-row').remove();//hide btn save and cancel another
                $(this).removeAttr('readonly');
                $(this).addClass('onclick');//style on focus textarea
                $(this).parent().append("<div class='action-row my-2'><a class='btn btn-sm btn-primary btn-update-todo p-x-5 mx-1' data-id='"+todo_id+"'>Lưu</a>" +
                    "<a  class='cancel btn btn-sm btn-grey p-x-5 mx-1'>Hủy</a></div>");
            });

            $(document).on('click','.btn-update-todo',function(){
                var content = $(this).parents('li.todo-row').find('textarea.onclick').val();
                var todo_id = $(this).attr('data-id');

                $.ajax({
                    type:'POST',
                    url: '{{ route('updatetodo') }}',
                    data:{content :content,todo_id:todo_id},
                    datatype:'json',
                    success: function(data) {
                        console.log(data);
                        $('.card-todo').removeClass('onclick');
                        $('.card-todo').attr({'readonly':true});
                        $('.action-row').remove();
                    }
                });
            });

            //even view create todo
            $(document).on('click','.add-todo',function(){
                var task_id = $('textarea#task-title').attr('data-id');
                $('.edit-area').attr('readonly');
                $('.edit-area').removeClass('onclick');
                $('.action-row').remove();
                $('a.add-todo').show();
                $('#area-temp').remove();
                $(this).hide();
                $(this).parent().find('.list-group').append(
                    "<li class='todo-row'>"+
                    "<textarea  id='area-temp' class='card-todo form-control onclick'></textarea>" +
                    "<div class='action-row my-2'>" +
                    "<a id='save-todo' class='btn btn-sm btn-primary  p-x-5 mx-1' data-id='"+task_id+"'>Lưu</a>" +
                    "<a  class='cancel btn btn-sm btn-grey p-x-5 mx-1'>Hủy</a>"+
                    "</div>"+
                    "</li>"
                );
            });
            // save todo
            $(document).on('click','#save-todo',function(){
                var task_id = $(this).attr('data-id');
                var content = $('textarea.onclick').val();
                $.ajax({
                    type:'POST',
                    url: '{{ route('createtodo') }}',
                    data:{content :content,task_id:task_id},
                    datatype:'json',
                    success: function(data) {
                        $('.card-todo').removeClass('onclick');
                        $('.card-todo').attr({'readonly':true});
                        $('.action-row').remove();
                        $('#area-temp').remove();
                        $('a.add-todo').show();
                        $('#list-todos').append("<li class='todo-row' data-id='"+data.id+"'>" +
                            "   <textarea readonly class='card-todo form-control' data-id='"+data.id+"'>"+data.content+"</textarea>" +
                            "   <a class='delete-todo'  data-id='"+data.id+"'><i  class='far fa-trash-alt fa-sm'></i></a>" +
                            "   </li>");
                    }
                });
            });
            $(document).on('click','.delete-todo',function(){
                var todo_id = $(this).attr('data-id');
                $.ajax({
                    type:'POST',
                    url: '{{ route('deletetodo') }}',
                    data:{todo_id :todo_id},
                    datatype:'json',
                    success: function(data) {
                        $("li.todo-row[data-id='"+todo_id+"']").remove();
                    }
                });
            });
            $(document).on('keypress','textarea.comment-box',function(e){
                var keycode = (e.keyCode ? e.keyCode : e.which);
                if(keycode == '13'){
                    var comment = $(this).val();
                    $(this).blur();
                    $(this).val("");
                    var task_id = $('textarea#task-title').attr('data-id');
                    // console.log(comment);
                    if(comment){
                        $.ajax({
                            type:'POST',
                            url: '{{ route('comment') }}',
                            data:{comment :comment,task_id:task_id},
                            datatype:'json',
                            success: function(data) {
                                console.log(data);
                                $('#comments').append("<li>" +
                                "<div class='user-cmt row'>" +
                                "<div class='col-md-1 '><img class='rounded-circle' src='{{asset('')}}/Images/favicon.png' width='40px' height='40px'></div>" +
                                "<div class='col-md-11 px-4'><i> "+data[0].user.name+"</i><small class='px-2'>"+data[0].created_at+"</small>" +
                                "<p>"+data[0].content+"</p></div>" +
                                "</div>" +
                                "</li>");
                            }
                        });
                    }
                }
            });

        });
    </script>
@endsection