@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Creditos en solicitud') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-borderless
                        table-primary table-bordered align-middle">
                        <caption>Usuarios</caption>
                            <thead class="table-light">
                                <tr>
                                    <th>Valor</th>
                                    <th>Descripción</th>
                                    <th>Número cuotas</th>
                                    <th>Estado</th>
                                    <th>Tipo de credito</th>
                                    <th>Fecha solicitud</th>
                                    <th>Cancelar</th>
                                </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach ($creditos as $credito)
                                        <tr class="table-primary">
                                            <td>{{$credito->valor}}</td>
                                            <td>{{$credito->descripcion}}</td>
                                            <td>{{$credito->cuota}}</td>
                                            <td>{{$credito->estado}}</td>
                                            <td>{{$credito->name}}</td>
                                            <td>{{$credito->created_at}}</td>
                                            
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-sm btn-danger btn-trash"
                                                    id="btn-trash"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    data="{{ route('creditos.show', $credito->id) }}">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                        {{-- {{ $creditos->withQueryString()->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.modal-delete')
@endsection

@section('js_after')
<script src="{{ asset('js/general-delete.js') }}" defer></script>
@endsection


