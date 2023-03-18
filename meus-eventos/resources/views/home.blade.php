@extends('layouts.site')

@section('title') Principais Eventos - @endsection

@section('content')
    {{--    @include('messages.bootstrap.messages')--}}

    <div class="row">
        <div class="col-12">
            <h2>Eventos</h2>
        </div>
        <hr>
    </div>

    <div class="row mb-4">
        @forelse($events as $event)
            <div class="col-4">
                <div class="card h-100">
                    <img
                        src="{{$event->banner ? asset('storage/' . $event->banner)
                               : 'https://via.placeholder.com/640x480.png/343A40?text=SEM+IMAGEM'}}"
                        class="card-img-top" alt="Banner do Evento {{ $event->title }}">

                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            Acontence em - {{ $event->start_event->format('d/m/Y H:i')}}</h6>
                        <p class="card-text">{{ $event->description}}</p>

                        @if($event->user)
                            <p>Evento Organizado por: <a href="" class="text-dark">{{ $event->user->name }}</a></p>
                        @else
                            <p class="text-info">Organizador não encontrado.</p>
                        @endif

                    </div>
                    <div class="footer">
                        <a href="{{ route('event.single', ['event' => $event->slug]) }}"
                           class="btn btn-dark btn-sm my-2 mx-2">Ver Evento
                        </a>
                    </div>
                </div>
            </div>
            @if(($loop->iteration % 3)  == 0)
    </div>
    <div class="row mb-4">
        @endif
        @empty
            <div class="col-12">
                <div class="alert text-white text-center fs-5 bg-dark">
                    Nenhum evento encontrado neste site...
                </div>
            </div>
        @endforelse
    </div>

    <div class="col-12 d-flex justify-content-center mb-5">
        {{ $events->links() }}
    </div>
@endsection

