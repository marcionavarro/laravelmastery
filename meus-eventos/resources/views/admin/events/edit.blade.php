@extends('layouts.app')

@section('title') Editar Evento: - @endsection

@section('content')
    <div class="col-8 d-flex justify-content-between align-items-center my-3 mx-auto">
        <h2 class="fs-3">Editar Evento: # {{ $event->id }}</h2>
        <a href="{{ route('admin.events.index') }}" class="btn btn-dark text-light">
            Eventos
        </a>
    </div>

    <div class="row">
        <div class="col-8 mx-auto">
            <form action="{{ route('admin.events.update', ['event' => $event->id]) }}" method="post"
                  enctype="multipart/form-data" class="pb-5">
                @csrf
                @method('PUT')

                <div class="form-group my-5">
                    <div class="row">
                        <div class="col-12">
                            Banner Evento
                            <hr>
                        </div>

                        <div class="col-8">
                            <label>Carregar um Banner para o Evento</label>
                            <input type="file" name="banner"
                                   class="form-control img-thumbnail @error('banner') is-invalid @enderror" width="100"
                                   height="100">
                            @error('banner')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <img
                                src="{{ $event->banner ? asset('storage/' . $event->banner) :
                                        'https://via.placeholder.com/640x480.png/343A40?text=SEM+IMAGEM' }}"
                                alt="Banner do evento {{ $event->title }}" class="img-fluid">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Titulo</label>
                    <input type="text" class="form-control  @error('title') is-invalid @enderror" id="" name="title"
                           value="{{ $event->title }}">
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Descrição rápida do evento.</label>
                    <input type="text" class="form-control  @error('description') is-invalid @enderror" id=""
                           name="description" value="{{ $event->description }}">
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Fale mais sobre o evento</label>
                    <textarea id="" class="form-control  @error('body') is-invalid @enderror" name="body" cols="30"
                              rows="5">{{ $event->body }}</textarea>
                    @error('body')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label for="" class="form-label">Quais categorias o Evento Pertence ?</label>
                        <select class="form-control" name="categories[]" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        @if($event->categories->contains($category)) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6 mb-3">
                        <label for="" class="form-label">Quando vai acontecer ?</label>
                        <input type="datetime-local" class="form-control  @error('start_event') is-invalid @enderror"
                               id=""
                               name="start_event" value="{{ str_replace(' ', 'T', $event->start_event) }}">
                        @error('start_event')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-dark">Editar Evento</button>
            </form>
        </div>
    </div>

@endsection()
