@extends('layouts.app')

@section('title') Meus Eventos: - @endsection

@section('content')
    <div class="col-12 d-flex justify-content-between align-items-center my-3">
        <h2 class="fs-3">Meus Eventos: </h2>
        <a href="{{ route('admin.events.create') }}" class="btn btn-dark text-light text-capitalize">
            criar evento
        </a>
    </div>

    <table class="table table-striped table-hover">
        <caption class="mt-3"> {{ $events->links() }}</caption>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Evento</th>
            <th scope="col">Criado em:</th>
            <th scope="col" class="text-center">Ações:</th>
        </tr>
        </thead>

        <tbody>
        @forelse($events as $event)
            <tr>
                <th scope="row">{{ $event->id }}</th>
                <td>{{ $event->title }}</td>
                <td>{{ $event->created_at->format('d/m/Y H:i:s') }}</td>
                <td class="d-flex justify-content-center">
                    <a href="/evento/{{ $event->slug }}" title="Ver evento {{ $event->title }}" target="_blank"
                       class="btn btn-outline-dark btn-sm">Ver
                    </a>
                    <a href="{{ route('admin.events.edit', ['event' => $event->id]) }}"
                       title="Editar evento {{ $event->id }}"
                       class="btn btn-dark btn-sm mx-1">Editar
                    </a>
                    <a href="{{ route('admin.events.photos.index', ['event' => $event->id]) }}"
                       title="Editar evento {{ $event->id }}"
                       class="btn btn-outline-dark btn-sm mx-1">Galeria
                    </a>
                    <form action="{{ route('admin.events.destroy', ['event' => $event->id]) }}" method="post">
                        @csrf
                        @method('delete')

                        <button class="btn btn-dark btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="bg-dark fs-5 text-light text-center text-capitalize p-3">Nenhum evento
                    encontrado
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
