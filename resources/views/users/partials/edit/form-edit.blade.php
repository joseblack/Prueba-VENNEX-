<form method="POST" action="{{ route('users.update', $user) }}" id="rolesEdit">
    @csrf
    @method('PUT')
    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
             name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-end">
            {{ __('Email') }}
        </label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control
            @error('email') is-invalid @enderror" name="email"
            value="{{ $user->email }}" autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="password" class="col-md-4 col-form-label text-md-end">
            {{ __('Contraseña nueva') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control
            @error('password') is-invalid @enderror" name="password"
             autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="rol" class="col-md-4 col-form-label text-md-end">
            {{ __('Rol') }}</label>

        <div class="col-md-6">
            
             <select class="form-control @error('rol') is-invalid @enderror"
              aria-label="Default select example" id="rol" name="rol" required>
                @foreach ($roles as $role)
                    @if($rolId == $role->id)
                    <option selected value="{{ $role->id }}">{{ $role->name }}</option>
                    @endif
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
              </select>

            @error('rol')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</form>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-edit-close">Close</button>
    <button type="input" class="btn btn-primary" form="rolesEdit">Save changes</button>
</div>