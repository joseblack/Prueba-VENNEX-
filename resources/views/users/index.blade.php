@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Administrar usuarios') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#createUsersModal">
                                    <i class="bi bi-plus"></i>Crear usuarios
                                </button>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('users.index')}}"
                                    class="d-flex flex-row align-items-center justify-content-end">
                                    <label class="my-1 me-2" for="user">Usuario:</label>
                                    <input type="search" class="my-1 me-sm-2 w-auto" id="user" 
                                    placeholder="Nombre usuario" name="user">
                                    <button type="submit" class="btn btn-sm btn-primary my-1">
                                        <i class="bi bi-search" id="search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-borderless
                        table-primary table-bordered align-middle">
                        <caption>Usuarios</caption>
                            <thead class="table-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach ($users as $user)
                                        <tr class="table-primary">
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                <a href="{{ route('users.edit', $user->id) }}" type="button"
                                                    class="btn btn-warning btn-sm linkUsers"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editeRolesModal">
                                                        <i class="bi bi-pencil-fill"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-sm btn-danger btn-trash"
                                                    id="btn-trash"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    data="{{ route('users.show', $user) }}">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                        {{ $users->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.modal-delete')
@include('users.partials.create.create-modal')
@include('users.partials.edit.edit-modal')
@endsection

@section('js_after')
<script src="{{ asset('js/usersEdit.js') }}" defer></script>
<script src="{{ asset('js/general-delete.js') }}" defer></script>
@endsection
