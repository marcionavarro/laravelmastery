@extends('layouts.app')

@section('title') Criar Evento: - @endsection

@section('content')
    <div class="col-8 d-flex justify-content-between align-items-center my-3 mx-auto">
        <h2 class="fs-3">Criar Evento: </h2>
        <a href="{{ route('admin.events.index') }}" class="btn btn-dark text-light">
            Eventos
        </a>
    </div>

    <div class="row">
        <div class="col-8 mx-auto">

            {{--
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            --}}

            <form action="{{ route('admin.events.store') }}" method="post" enctype="multipart/form-data">
                @csrf


                <div class="mb-3">
                    <label for="formFile" class="form-label">Carregar um Banner para o Evento</label>
                    <input class="form-control" type="file" id="formFile" name="banner">
                </div>

                {{--<div class="form-group">
                    <label>Carregar um Banner para o Evento</label>
                    <input type="file" name="banner" class="form-control @error('banner') is-invalid @enderror">
                    @error('banner')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>--}}

                <div class="mb-3">
                    <label for="" class="form-label">Titulo</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id=""
                           name="title" value="{{ old('title') }}">
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Descrição rápida do evento.</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id=""
                           name="description" value="{{ old('description') }}">
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Fale mais sobre o evento</label>
                    <textarea id="" class="form-control @error('body') is-invalid @enderror" name="body"
                              cols="30" rows="5">{{ old('body') }}</textarea>
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
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6 mb-3">
                        <label for="" class="form-label">Quando vai acontecer ?</label>
                        <input type="datetime-local" class="form-control @error('start_event') is-invalid @enderror"
                               id=""
                               name="start_event" value="{{ old('start_event') }}">
                        @error('start_event')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-dark">Cria Evento</button>
            </form>
        </div>
    </div>

@endsection()
