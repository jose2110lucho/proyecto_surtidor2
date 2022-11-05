<div class="d-flex">
    <a href="{{ route('vehiculos.show', $id) }}" class="my-auto"><i class="fa fa-eye fa-fw" aria-hidden="true"></i></a>
    <a href="{{ route('vehiculos.edit', $id) }}" class="mx-2"><i class="fas fa-pen fa-fw"></i></a>

    <form action="{{ route('vehiculos.destroy', $id) }}" method="POST" class="my-auto ">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-link text-danger my-n2 mx-n2"><i class="fas fa-trash fa-fw"></i></button>
    </form>
</div>
