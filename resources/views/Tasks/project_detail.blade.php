@extends('Tasks.master')
@section('content')
    <div class="container-fluid container-scroll">
        <div class="addrow">
            <button type="button" class="btn btn-info" id="btn-add-board">Thêm bảng</button> <br><br>
        </div>
        <div class="scrollmenu">
            @if(!empty($project))
                    @foreach($project->boards as $boards)
                        <div class="tasks">
                            <div class="card" >
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="task-row">
                                            <textarea readonly class="card-title form-control edit-area" >{{$boards->name}}</textarea>
                                        </li>
                                        @foreach($boards->tasks as $task)
                                            <li class="task-row">
                                                <textarea readonly class="card-task form-control" >{{$task->title}}</textarea>
                                            </li>
                                        @endforeach
                                    </ul>
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
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

        $(document).ready(function(){

            // event on focusin and focusout edit area
            $('.edit-area').on('focusin',function(){
                $('.action-row').remove();//hide btn save and cancel another
                $('#area-temp').remove();//remove textarea temp
                $('a.add-task').show();//show btn add task
                $(this).removeAttr('readonly');
                $(this).addClass('onclick');//style on focus textarea
                $(this).parent().append("<div class='action-row my-2'><a id='save-task' class='btn btn-sm btn-primary  p-x-5 mx-1'>Lưu</a>" +
                                         "<a id='cancel-task' class='btn btn-sm btn-grey p-x-5 mx-1'>Hủy</a></div>");
            });
            $('.edit-area').on('focusout',function(){
                $('.action-row').remove();
                $('#area-temp').remove();
                $(this).attr('readonly');
                $(this).removeClass('onclick');
                $(this).parent().find('.action-row').remove();
            });

            // event on add task
            $('a.add-task').on('click',function(){
                $('.action-row').remove();
                $('a.add-task').show();
                $('#area-temp').remove();
                $(this).hide();
                $(this).parent().find('.list-group').append(
                    "<li class='task-row'>"+
                        "<textarea  id='area-temp' class='card-task form-control  onclick'></textarea>" +
                        "<div class='action-row my-2'>" +
                            "<a id='save-task' class='btn btn-sm btn-primary  p-x-5 mx-1'>Lưu</a>" +
                            "<a id='cancel-task' class='btn btn-sm btn-grey p-x-5 mx-1'>Hủy</a>"+
                        "</div>"+
                    "</li>"
                );
             });
            // $('#area-temp').on('focusin',function(){
            //     alert('bbbbbb');
            // });
            // $('#area-temp').on('focusin',function(){
            //     alert('aaaa');
            //     $(this).parent().remove();
            // });

            $('#btn-add-board').on('click',function(){
               $('#md-create-board').modal('show');
               $('#save').on('click',function(e){
                   e.preventDefault();
                   $.ajaxSetup({
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                       }
                   });
                   var formData = {
                       'name' : $('input[name=name]').val(),
                       'description' : $('input[name=description]').val(),
                       'project_id' : '{{ $project->id }}'
                   };
                   $.ajax({
                       type:'POST',
                       url: '{{ route('createboard') }}',
                       data: formData,
                       datatype:'json',
                       success: function(data){
                           console.log(data);
                           $('#md-create-board').modal('hide');
                       }
                   });
               });
            });


        });
    </script>
@endsection
