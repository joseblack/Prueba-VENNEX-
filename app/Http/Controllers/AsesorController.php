<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\CreditRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Tipocredito;
use App\Models\Estado;

class AsesorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->role_id != 4) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }
        return view('asesores.index');
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
        if(auth()->user()->role_id != 4) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = 3;
        $user->save();
        return redirect('/asesores')->with('success','Asesor registrado!');
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
        if(auth()->user()->role_id != 3) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }
        $creditRequest = DB::table('credit_requests')
                            ->join('tipocreditos', 'tipocreditos.id', '=', 'credit_requests.tipocredito_id')
                            ->where('credit_requests.id', '=', $id)
                            ->select('credit_requests.*', 'tipocreditos.name')
                            ->get();

        $estados = Estado::all();
    
        return view('asesores.edit', [
            'creditRequest' => $creditRequest,
            'estados' => $estados,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(auth()->user()->role_id != 3) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }
        $creditRequest = CreditRequest::find($id);
        $creditRequest->estado_id = $request->estado;
        $creditRequest->observacion = $request->observacion;
        $creditRequest->save();
        return redirect('/solicitudes')->with('success','Solicitud actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function solicitudes() {

        if(auth()->user()->role_id != 3) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }
        $creditos = DB::table('credit_requests')
        ->join('estados', 'estados.id', '=', 'credit_requests.estado_id')
        ->join('tipocreditos', 'tipocreditos.id', '=', 'credit_requests.tipocredito_id')
        ->select('credit_requests.*', 'estados.name as estado', 'tipocreditos.name')
        ->get();

        return view('asesores.solicitudes', ['creditos' => $creditos]);
        
    }
}
