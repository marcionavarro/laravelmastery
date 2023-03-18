@extends('layouts.site')

@section('title') Evento: {{ $event->title }} - @endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <h2>Confirmação de Inscrição</h2>
        </div>
        <hr>
    </div>

    <div class="row mt-5">
        <div class="col-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $event->start_event->format('d/m/Y H:i') }}</h6>
                    <p class="card-text">{{ $event->description }}.</p>
                    <a href="{{ route('enrollment.proccess') }}" class="card-link btn btn-dark btn-lg">Confirmar Inscrição</a>
                </div>
            </div>
        </div>
    </div>

@endsection
