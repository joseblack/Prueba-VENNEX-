<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CreditRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Estado;
use Carbon\Carbon;

class GerenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->role_id != 4) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }
        $creditos = DB::table('credit_requests')
        ->join('estados', 'estados.id', '=', 'credit_requests.estado_id')
        ->join('tipocreditos', 'tipocreditos.id', '=', 'credit_requests.tipocredito_id')
        ->where('estado_id', 2)
        ->select('credit_requests.*', 'estados.name as estado', 'tipocreditos.name')
        ->get();

        return view('gerentes.index', ['creditos' => $creditos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(auth()->user()->role_id != 4) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }
        $creditRequest = DB::table('credit_requests')
                            ->join('tipocreditos', 'tipocreditos.id', '=', 'credit_requests.tipocredito_id')
                            ->where('credit_requests.id', '=', $id)
                            ->select('credit_requests.*', 'tipocreditos.percentage', 'tipocreditos.name')
                            ->get();

        $estados = Estado::all();
    
        return view('gerentes.edit', [
            'creditRequest' => $creditRequest,
            'estados' => $estados,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(auth()->user()->role_id != 4) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }
        $valorCuota = ($request->valor / $request->cuota) + $request->pocentaje;

        $creditRequest = CreditRequest::find($id);
        $creditRequest->estado_id = $request->estado;
        $creditRequest->numero_cuenta = $request->numCuenta;
        $creditRequest->valor_cuota = $valorCuota;
        $creditRequest->fecha_aprobacion = Carbon::now();
        $creditRequest->gerente_id = auth()->user()->id;
        $creditRequest->save();
        return redirect('/pendientes')->with('success','Solicitud actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
