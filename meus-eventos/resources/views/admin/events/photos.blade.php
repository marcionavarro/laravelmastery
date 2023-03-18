@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        <div class="col-8 mx-auto">
            <form action="{{ route('admin.events.photos.store', $event) }}" method="post" enctype="multipart/form-data">
                @csrf

                <h3>Subir fotos do Evento</h3>
                <div class="form-group">
                    <input type="file" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror"
                           multiple>
                    @error('photos.*')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button class="btn btn-dark">Enviar fotos do Evento</button>
            </form>
            <hr>

        </div>
    </div>

    <div class="row pb-5">
        @forelse($photos as $photo)
            <div class="col-3 d-flex p-1 position-relative">
                <img src="{{ asset('storage/' . $photo->photo) }}"
                     alt="Fotos do Evento {{ $photo->title}}" class="img-thumbnail">
                <form action="{{ route('admin.events.photos.destroy', [$event, $photo])  }}" method="post"
                      class="position-absolute m-1 p-1">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm text-white">Remover Foto</button>
                </form>
            </div>
        @empty
            <div class="col-10  text-white text-center bg-dark mx-auto p-3">
                <h5>Este evento ainda não possui fotos na galeria</h5>
            </div>
        @endforelse
        <div class="col-12 d-flex justify-content-center mt-5">
            {{ $photos->links() }}
        </div>
    </div>
@endsection
