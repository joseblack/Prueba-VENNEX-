<!--form para eliminar-->
<form action="{{ route('creditos.destroy', $creditRequest->id) }}" method="post" id="delete">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">¿Seguro deseas cancelar la solicitud de prestamo {{ $creditRequest->valor }}?</h5>
        {{-- {{ $url }} --}}
    </div>
</form>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
    id="btn-delete">Close</button>
    <button type="submit" class="btn btn-danger" form="delete">Delete user</button>
</div>
