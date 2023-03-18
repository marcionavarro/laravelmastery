@extends('layouts.site')

@section('title') Evento: {{ $event->title }} - @endsection
@section('content')
    <div class="card text-white bg-dark">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fs-3">Evento: {{ $event->title }}</h2>
                <div>
                    {{--<a href="{{ url('/') }}" class="btn btn-outline-success btn-sm  text-decoration-none">Voltar para home</a>--}}
                    <a href="{{ route('enrollment.start', $event->slug) }}"
                       class="btn btn-outline-light btn-sm  text-decoration-none">
                        Inscrever-se
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body bg-white">
            <h5 class="card-subtitle text-muted mb-4">
                Evento acontecerá em - {{ $event->start_event->format('d/m/Y H:i')}}
            </h5>


            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                            type="button" role="tab" aria-controls="nav-about" aria-selected="true">Sobre
                    </button>

                    @if($event->photos->count())
                        <button class="nav-link" id="nav-photos-tab" data-bs-toggle="tab" data-bs-target="#nav-photos"
                                type="button" role="tab" aria-controls="nav-photos" aria-selected="false">Fotos
                        </button>
                    @endif

                </div>
            </nav>

            <div class="tab-content  bg-white" id="nav-tabContent">
                <div class="tab-pane fade show active border-0" id="nav-about" role="tabpanel"
                     aria-labelledby="nav-about-tab">

                    <div class="card my-4">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{$event->banner ?  asset('storage/' . $event->banner)
                                            : 'https://via.placeholder.com/640x480.png/343A40?text=SEM+IMAGEM' }}"
                                     class="card-img-top"
                                     alt="Banner do Evento {{ $event->title }}">
                            </div>
                            <div class="col-md-8 text-dark">
                                <div class="card-body">
                                    {{ $event->body }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                @if($event->photos->count())
                    <div class="tab-pane fade" id="nav-photos" role="tabpanel" aria-labelledby="nav-photos-tab">

                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-2 my-4">
                            @foreach($event->photos as $photo)
                                <div class="col">
                                    <div class="card">
                                        <img src="{{ asset('storage/' . $photo->photo) }}" class="card-img-top"
                                             alt="Fotos do evento {{ $event->title }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

        </div>
        <div class="card-footer text-white">
            2 days ago
        </div>
    </div>
@endsection
