@extends('Tasks.master')
@section('content')
    <div class="container-fluid container-scroll">
        <div class="addrow">
            <button type="button" class="btn btn-info" name="button">Thêm mục</button> <br><br>
        </div>
        <div class="scrollmenu">
            @if(!empty($project))
                    @foreach($project->boards as $boards)
                        <div class="tasks">
                            <div class="card" >
                                <div class="card-body">
                                    <textarea readonly class="card-title form-control" >{{$boards->name}}</textarea><i style="position: absolute;right: 20px;top:20px" class="fa  fa-edit float-right"></i>
                                    <ul class="list-group list-group-flush">
                                        @foreach($boards->tasks as $task)
                                            <textarea readonly class="card-task form-control" >{{$task->title}}</textarea><i style="position: absolute;right: 20px;top:20px" class="fa  fa-edit float-right"></i>
                                        @endforeach
                                    </ul>
                                    <a class="add-task">Thêm thẻ</a>
                                    <a class="save-task btn btn-sm btn-primary  p-x-5 mx-1">Lưu</a>
                                    <a class="cancel-task btn btn-sm btn-grey p-x-5 mx-1">Hủy</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
             @endif
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.card-title').on('click',function(){
                $(this).removeAttr('readonly');
                $(this).addClass('onclick');
            });
            $('.card-title').on('focusout',function(){
                $(this).attr('readonly');
                $(this).removeClass('onclick');
            });
            $('a.add-task').on('click',function(){
                $(this).hide();
                $(this).parent().find('.save-task').show();
                $(this).parent().find('.cancel-task').show();
                $(this).parent().find('.list-group').append(" <textarea  autofocus class='card-task form-control' ></textarea><i style='position: absolute;right: 20px;top:20px' class='fa  fa-edit float-right'></i>");

             });
            // $('.card-title').on('focusout',function(){
            //     $(this).show();
                // $(this).parent().find('.save-task').show();
                // $(this).parent().find('.cancel-task').show();
                // $(this).parent().find('.list-group').append(" <textarea autofocus class='card-task form-control' ></textarea><i style='position: absolute;right: 20px;top:20px' class='fa  fa-edit float-right'></i>");
            // });



        });
    </script>
@endsection
