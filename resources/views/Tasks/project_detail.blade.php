@extends('Tasks.master')
@section('style')
    <link rel="stylesheet" type="text/css" href="//www.htmlcommentbox.com/static/skins/bootstrap/twitter-bootstrap.css?v=0" />
    <style type="text/css">#HCB_comment_box #HCB_comment_form_box{padding-bottom:1em}#HCB_comment_box .hcb-link{cursor:pointer}#HCB_comment_box .hcb-icon{border:0px transparent none}#HCB_comment_box textarea {display:block;width:100%;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 100%}#HCB_comment_box blockquote{margin:10px;overflow:hidden}#HCB_comment_box .hcb-err{color:red}#HCB_comment_box .hcb-comment-tb{margin:0}#HCB_comment_box .comment{position:relative}#HCB_comment_box .comment .likes{position:absolute;top:0;right:0;opacity:0.8}#HCB_comment_box .comment .hcb-comment-tb a{visibility:hidden}#HCB_comment_box .comment:hover .hcb-comment-tb a{visibility:visible}#HCB_comment_box .gravatar{padding-right:2px}#HCB_comment_box input{margin-left:0}#HCB_comment_box input[type="file"]{display:none}#HCB_comment_box input.inputfile{width:.1px;height:.1px;opacity:0;overflow:hidden;position:absolute;z-index:-1}#HCB_comment_box input.inputfile+label {display: inline-block; position: relative; top: 5px; cursor: pointer}input.inputfile+label img {width: 22px; height: 22px}</style>
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
                                    <a class="action"  data-id="{{$boards->id}}"><i  class=" far fa-edit fa-sm"></i></a>
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
                                <textarea readonly class="card-title form-control edit-area" id="task-title"  ></textarea>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group list-group-flush" id="list-todos">

                            </ul>
                            <a class="add-task">Thêm công việc</a>
                            <div id="HCB_comment_box" class="mt-3">
                                <ul id="comments">

                                </ul>
                                <h5 class="mt-3">Comments</h5>
                                <div class="">
                                    <textarea  class="comment-box form-control" rows="2" placeholder="Enter your comment here">
                                    </textarea>
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
                    "<a  class='cancel btn btn-sm btn-grey p-x-5 mx-1'>Hủy</a>"+
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
            $(document).on('click','a#cancel-board',function(){
                $('.edit-area').attr('readonly');
                $('.edit-area').removeClass('onclick');
                $('.action-row').remove();
                $('a.add-task').show();
                $('#area-temp').remove();
            });
            $(document).on('click','a.cancel',function(){
                $('.edit-area').attr('readonly');
                $('.edit-area').removeClass('onclick');
                $('.action-row').remove();
                $('a.add-task').show();
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

                       $('#task-title').html(data[0].title);
                       $.each(data[1], function(i, todo) {
                            $('#list-todos').html("<li class='task-row' data-id='"+data[1].id+"'>" +
                                "   <textarea readonly class='card-task form-control' data-id='"+data[1].id+"'>"+todo.content+"</textarea>" +
                                "   <a class='delete-task'  data-id='"+data[1].id+"'><i  class='far fa-trash-alt fa-sm'></i></a>" +
                                "   </li>");
                       });
                       $.each(data[1], function(i, todo) {
                          $('#comments').html("<li><div class='user-cmt'><img src='{{asset('')}}/Images/favicon.png' width='30px' height='30px'><span><span> "+todo.name+"</span><br><p>"+todo.content+"</p></span></div></li>");
                       });

                   }
               });
            });
        });
    </script>
@endsection