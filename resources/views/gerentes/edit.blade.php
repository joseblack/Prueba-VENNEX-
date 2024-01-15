@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Solicitudes por aprobar') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('pendientes.update', $creditRequest[0]->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="valor" class="col-md-4 col-form-label text-md-end">
                                {{ __('Valor crédito') }}
                            </label>

                            <div class="col-md-6">
                            <input type="hidden" name="porcentaje" value="{{ $creditRequest[0]->percentage }}">
                                <input id="valor" type="number" 
                                class="form-control  @error('valor') is-invalid @enderror"
                                 name="valor" value="{{ $creditRequest[0]->valor }}" required autocomplete="valor"
                                  autofocus readonly>

                                @error('valor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cuota" class="col-md-4 col-form-label text-md-end">
                                {{ __('Número de cuotas') }}
                            </label>

                            <div class="col-md-6">
                                <input id="cuota" type="number" 
                                class="form-control  @error('cuota') is-invalid @enderror"
                                 name="cuota" value="{{ $creditRequest[0]->cuota }}" required autocomplete="cuota"
                                  autofocus readonly>

                                @error('cuota')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="descripcion" class="col-md-4 col-form-label text-md-end">
                                {{ __('Descripción cliente') }}</label>

                            <div class="col-md-6">
                                 <textarea name="descripcion" class="form-control  @error('descripcion') is-invalid
                                    @enderror" name="descripcion"
                                id="exampleFormControlTextarea1" rows="3" readonly>{{$creditRequest[0]->descripcion}}
                                </textarea>

                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tipocredito" class="col-md-4 col-form-label text-md-end">
                                {{ __('Tipo de credito') }}
                            </label>

                            <div class="col-md-6">
                                <input id="tipocredito" type="text"
                                class="form-control  @error('tipocredito') is-invalid @enderror"
                                 name="tipocredito" value="{{ $creditRequest[0]->name }}" required
                                  autocomplete="tipocredito"
                                  autofocus readonly>

                                @error('tipocredito')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="estado" class="col-md-4 col-form-label text-md-end">
                                {{ __('Estado') }}</label>
    
                            <div class="col-md-6">
                                
                                 <select class="form-control @error('estado') is-invalid @enderror"
                                  aria-label="Default select example" id="estado" name="estado" required>

                                    @foreach ($estados as $estado)
                                        @if($estado->id != 2 and $estado->id != 1)
                                            <option
                                            value="{{ $estado->id }}">{{ $estado->name }}</option>
                                        @endif
                                    @endforeach
                                  </select>
    
                                @error('estado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="observacion" class="col-md-4 col-form-label text-md-end">
                                {{ __('Observaciones del asesor') }}</label>

                            <div class="col-md-6">
                                 <textarea name="observacion" class="form-control  @error('observacion') is-invalid
                                    @enderror" name="observacion"
                                id="exampleFormControlTextarea1" rows="3" readonly>{{ $creditRequest[0]->observacion }}
                            </textarea>

                                @error('observacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="numCuenta" class="col-md-4 col-form-label text-md-end">
                                {{ __('Numero de cuenta') }}
                            </label>

                            <div class="col-md-6">
                                <input id="numCuenta" type="number" 
                                class="form-control  @error('numCuenta') is-invalid @enderror"
                                 name="numCuenta" value="" required autocomplete="numCuenta"
                                  autofocus max="9999999999">

                                @error('numCuenta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Aprobar/Rechazar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_after')
<script>
var input = document.getElementById('numCuenta');
input.addEventListener('input', function() {
  if (this.value.length > 10) {
    this.value = this.value.slice(0, 10);
  }
});

</script>
@endsection