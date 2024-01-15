<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tipocredito;
use App\Models\CreditRequest;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->role_id != 2) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }
        $tipoCreditos = Tipocredito::all();
        return view('clientes.index', ['tiposcreditos' => $tipoCreditos]);
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
        if(auth()->user()->role_id != 2) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }

        $validated = $request->validate([
            'valor' => ['required', 'numeric'],
            'cuota' => ['required', 'numeric'],
            'tipocredito' => ['required', 'numeric'],
        ]);
        
        $creditReques = new CreditRequest();
        $creditReques->valor = $request->valor;
        $creditReques->cuota = $request->cuota;
        $creditReques->descripcion = $request->descripcion;
        $creditReques->estado_id = 1;
        $creditReques->tipocredito_id = $request->tipocredito;
        $creditReques->user_id = auth()->user()->id;
        $creditReques->save();
        return redirect('/creditos')->with('success','Radicada su solicitu de crédito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(auth()->user()->role_id != 2) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }
        $creditRequest = CreditRequest::find($id);
        return view('clientes.partials.form-delete', ['creditRequest' => $creditRequest]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(auth()->user()->role_id != 2) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }
        $creditRequest = CreditRequest::find($id);
        
        if ($creditRequest->estado_id != 3) {
            $creditRequest->delete();
            return back()->with('success','Solicitud de credito cancelada!');
        } else {
            return back()->with('success','La solicitud ya fue aprobada no la puede cancelar!');
        }
    }

    public function showCredits() {
        if(auth()->user()->role_id != 2) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }
        $creditos = DB::table('credit_requests')
        ->where('user_id', '=', auth()->user()->id)
        ->where('estado_id', '!=', 3)
        ->join('estados', 'estados.id', '=', 'credit_requests.estado_id')
        ->join('tipocreditos', 'tipocreditos.id', '=', 'credit_requests.tipocredito_id')
        ->select('credit_requests.*', 'estados.name as estado', 'tipocreditos.name')
        ->get();

        return view('clientes.creditos', ['creditos' => $creditos]);
    }

    public function showCreditsApproved() {
        if(auth()->user()->role_id != 2) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }
        $creditos = DB::table('credit_requests')
        ->where('user_id', '=', auth()->user()->id)
        ->where('estado_id', '=', 3)
        ->join('estados', 'estados.id', '=', 'credit_requests.estado_id')
        ->join('tipocreditos', 'tipocreditos.id', '=', 'credit_requests.tipocredito_id')
        ->join('users', 'users.id', '=', 'credit_requests.gerente_id')
        ->select('credit_requests.*', 'estados.name as estado', 
        'tipocreditos.name as tipo', 'users.name')
        ->get();

        return view('clientes.creditos-aprobados', ['creditos' => $creditos]);
    }
}
