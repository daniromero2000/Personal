@extends('dashboard.master')

@section('content')

<div class="form-group">
    <label for="my-select">Post</label>
    <div class="col-6">
        <div class="form-row">
            <div class="col-10">
                <form action="{{ route('postComment.post',1) }}" id="filterForm">
                    <select id="filterPost" class="form-control">
                        @foreach ($posts as $p)
                        <option value="{{ $p->id }}" {{ $post->id == $p->id ? 'selected' : '' }}>
                            {{ Str::limit($p->title, 20)  }}
                        </option>
                        @endforeach
                    </select>
                </form>
            </div>
            <div class="col-2">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </div>
    </div>
</div>
@if (count($postComments ) > 0)

<table class="table">
    <thead>
        <tr>
            <td> Id </td>
            <td> Titulo </td>
            <td> Usuario </td>
            <td> Estado </td>
            <td> Creación </td>
            <td> Actualización </td>
            <td> Acciones </td>
        </tr>
    </thead>
    <tbody>
        @foreach ($postComments as $postComment)
        <tr>

            <td> {{ $postComment->id }} </td>
            <td> {{ $postComment->title }} </td>
            <td> {{ $postComment->user->name}} </td>
            <td> <span
                    class="badge badge-{{ $postComment->approved == 1 ? "success" : "danger" }}">{{ $postComment->approved == 1 ? "Aprovado" : "Rechazado" }}</span>
            </td>
            <td> {{ $postComment->created_at->format('d-m-Y') }} </td>
            <td> {{ $postComment->updated_at->format('d-m-Y') }} </td>
            <td>
                <button data-toggle="modal" data-target="#showModal" data-id="{{ $postComment->id }}"
                    class="btn btn-primary">Ver</button>
                <button data-id="{{ $postComment->id }}"
                    class="approved btn btn-{{ $postComment->approved == 1 ? "danger" : "success" }}">{{ $postComment->approved == 1 ? "Rechazar" : "Aprovar" }}</button>
                <button data-toggle="modal" data-target="#deleteModal" data-id="{{ $postComment->id }}"
                    class="btn btn-danger">Eliminar</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $postComments->links() }}

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Seguro que desea borrar el registro seleccionado?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                <form id="formDelete" method="POST" action="{{ route('postComment.destroy',0) }}"
                    data-action="{{ route('postComment.destroy',0) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>


            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="message"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll(".approved").forEach(button => button.addEventListener("click",function(){
    // console.log(":" +button.getAttribute("data-id"))

    var id = button.getAttribute("data-id");
    var formData = new FormData();
    formData.append("_token",'{{ csrf_token() }}');

     fetch("{{ URL::to("/") }}/dashboard/postComment/proccess/"+id,{
         method: 'POST',
         body:formData
     })
        .then(response => response.json())
        .then(aprroved => {
            if(aprroved == 0){
                button.classList.remove('btn-danger');
                button.classList.add('btn-success');
                button.innerHTML = "Aprovar";
            }else{
                button.classList.remove('btn-success');
                button.classList.add('btn-danger');
                button.innerHTML = "Rechazar";
            }

        });

    // $.ajax({
    //         method: "POST",
    //         url: "{{ URL::to("/") }}/dashboard/postComment/proccess/"+id,
    //         data: {'_token' : '{{ csrf_token() }}'}
    //         })
    //     .done(function(aprroved){
    //         if(aprroved == 0){
    //             $(button).removeClass('btn-danger');
    //             $(button).addClass('btn-success');
    //             $(button).text("Aprovar");
    //         }else{
    //             $(button).removeClass('btn-success');
    //             $(button).addClass('btn-danger');
    //             $(button).text("Rechazar");
    //         }
    //     });


}))


    window.onload = function(){
        $('#showModal').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        // $.ajax({
        //     method: "GET",
        //     url: "{{ URL::to("/") }}/dashboard/postComment/j-show/"+id
        // })
        // .done(function(comment){
        //     modal.find('.modal-title').text(comment.title)
        //     modal.find('.message').text(comment.message)
        // });

        fetch("{{ URL::to("/") }}/dashboard/postComment/j-show/"+id)
        .then(response => response.json())
        .then(comment => {
            modal.find('.modal-title').text(comment.title)
            modal.find('.message').text(comment.message);
        });

    });

        $('#deleteModal').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

        action = $('#formDelete').attr('data-action').slice(0,-1)
        action += id
        console.log(action)

        $('#formDelete').attr('action',action)

        var modal = $(this)
        modal.find('.modal-title').text('Vas a borrar el POST: ' + id)
        });
    }

</script>

@else
<div class="card mt-5">
    <div class="card-body">
        <p class="card-text">No hay comenterarios para este post</p>
    </div>
</div>

@endif
<script>
    //     window.onload = function(){
//         $("#filterForm").submit(function(){
//             // console.log($(this).val())
//             var action = $(this).attr('action');
//             action = action.replace(/[0-9]/g,$("#filterPost").val());
//             console.log(action)
//             $(this).attr('action',action)
//         });
//     }

//
</script>
@endsection
