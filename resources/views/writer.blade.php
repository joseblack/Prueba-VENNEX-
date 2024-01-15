@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Simulación de credito') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('writegenerate.index') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="valor" class="col-md-4 col-form-label text-md-end">
                                {{ __('Valor crédito') }}
                            </label>

                            <div class="col-md-6">
                                <input id="valor" type="number" 
                                class="form-control  @error('valor') is-invalid @enderror"
                                 name="valor" value="{{ old('valor') }}" required autocomplete="valor" autofocus>

                                @error('valor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cuota" class="col-md-4 col-form-label text-md-end">
                                {{ __('Número de cuotas') }}</label>
    
                            <div class="col-md-6">
                                
                                 <select class="form-control @error('cutoa') is-invalid @enderror"
                                  aria-label="Default select example" id="cuota" name="cuota" required>
                                    <option selected value="">Seleccione...</option>
                                        <option value="6">6</option>
                                        <option value="12">12</option>
                                        <option value="24">24</option>
                                        <option value="36">36</option>
                                  </select>
    
                                @error('cuota')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tipocredito" class="col-md-4 col-form-label text-md-end">
                                {{ __('Tipo de crédito') }}</label>
    
                            <div class="col-md-6">
                                
                                 <select class="form-control @error('tipocredito') is-invalid @enderror"
                                  aria-label="Default select example" id="tipocredito" name="tipocredito" required>
                                    <option selected value="">Seleccione</option>
                                        <option value="2.5">Libre inversión</option>
                                        <option value="1.3">Vivienda</option>
                                  </select>
    
                                @error('tipocredito')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="observacion" class="col-md-4 col-form-label text-md-end">
                                {{ __('OpenIA') }}</label>

                            <div class="col-md-6">
                                 <textarea name="descripcion" class="form-control  @error('descripcion') is-invalid
                                    @enderror" name="descripcion" 
                                    id="exampleFormControlTextarea1" rows="3">{{ $content }}</textarea>

                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Simular crédito') }}
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
