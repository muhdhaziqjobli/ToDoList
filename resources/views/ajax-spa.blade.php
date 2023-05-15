@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="height: 100vh; background-color:;">
    <div class="card" style="width: 18rem;">
        <div class="card-header text-center">
            To-Do List
        </div>

        <ul class="list-group list-group-flush">
        <div id="list">
            
        </div>
        

        <div class="card-footer">
            <input type="text" id="content" class="form-control">
        </div>
    </ul>
    </div>
</div>
@endsection

@push('js')
<script>
//Token Setup
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//Get Data
function getTodos() {
    $.ajax({
        url:"{{ route('todos.show',0) }}",
        method:'GET',
        dataType: 'json',

        success:function(response){
            $("#list").html("");

            if(response['data'] != null){
                row = response['data'].length;
            }

            if(row > 0){
                for(var i=0; i<row; i++){
                    var id = response['data'][i].id;
                    var content = response['data'][i].content;

                    var append_string = 
                    '<li class="list-group-item" onMouseOver="show('+id+')" onMouseOut="hide('+id+')">' +
                        content +
                        '<button id="btn-'+id+'" class="btn btn-outline-danger btn-sm float-end visually-hidden" onClick="destroy('+id+')">-</button>' +
                    '</li>';
    
                    $("#list").append(append_string);
                }
            } else{
                var append_string = "<h1>" +
                    "No record found." +
                "</h1>";

                $("#list").append(append_string);
            }
        },
        error:function(error){
            console.log(error)
        }
    });
}

//Submit Data
$("#content").keypress(function(e){
    if(e.keyCode == '13') {
        $.ajax({
            url:"{{ route('todos.store') }}",
            method:'POST',
            data:{
                    content:$('#content').val()
                },

            success:function(response){
                if(response.success){
                    console.log(response.message)
                    getTodos();
                    $("#content").val('');
                }else{
                    alert("Error")
                }
            },
            error:function(error){
                console.log(error)
            }
        });
    }
});

//Destroy Data
function destroy(id) {
    var url = "{{ route('todos.destroy', ":id") }}";
    url = url.replace(':id', id);

    $.ajax({
        url: url,
        method: 'DELETE',
        dataType: 'json',

        success: function(response){
            console.log(response.message)
            getTodos();
        },
        error: function(error){
            console.log(error)
        }
    });
}

//Show delete button
function show(id) {
    $("#btn-"+id).removeClass('visually-hidden');
}

//Hide delete button
function hide(id) {
    $("#btn-"+id).addClass('visually-hidden');
}

//On Document Ready
$(document).ready(function(){
    getTodos();
});
</script>
@endpush