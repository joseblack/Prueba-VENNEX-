@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Solicitudes de creditos por aprobar') }}</div>

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
                                    <th>Cambiar estado</th>
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
                                                <a href="{{ route('pendientes.edit', $credito->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
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

<script>
setInterval(function(){
    location.reload();
}, 30000);
</script>
@endsection


