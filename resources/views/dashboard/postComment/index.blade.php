@extends('dashboard.master')

@section('content')
@if (count($postComments ) > 0)

<table class="table">
    <thead>
        <tr>
            <td> Id </td>
            <td> Titulo </td>
            <td> Usuario </td>
            <td> Email </td>
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
            <td> {{ $postComment->user->email}} </td>
            <td> {{ $postComment->created_at->format('d-m-Y') }} </td>
            <td> {{ $postComment->updated_at->format('d-m-Y') }} </td>
            <td> <a href="{{ route('postComment.show',$postComment->id) }}" class="btn btn-primary">Ver</a> <button
                    data-toggle="modal" data-target="#deleteModal" data-id="{{ $postComment->id }}"
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

<script>
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
})
</script>

@else
<div class="card mt-5">
    <div class="card-body">
        <p class="card-text">No hay comenterarios para este post</p>
    </div>
</div>

@endif
@endsection
