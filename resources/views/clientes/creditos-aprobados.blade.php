@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Creditos Aprobados') }}</div>

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
                                    <th>Valor de cuota</th>
                                    <th>Número cuotas</th>
                                    <th>Estado</th>
                                    <th>Tipo de credito</th>
                                    <th>Aprobado por</th>
                                    <th>Fecha aprobación</th>
                                </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach ($creditos as $credito)
                                        <tr class="table-primary">
                                            <td>{{$credito->valor}}</td>
                                            <td>{{$credito->valor_cuota}}</td>
                                            <td>{{$credito->cuota}}</td>
                                            <td>{{$credito->estado}}</td>
                                            <td>{{$credito->tipo}}</td>
                                            <td>{{$credito->name}}</td>
                                            <td>{{$credito->fecha_aprobacion}}</td>
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
@endsection




