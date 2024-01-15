<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(auth()->user()->role_id != 1) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }

        $users = User::where('name', 'LIKE', '%'. $request->user . '%')->paginate();
        $roles = Role::all();
        return view('users.index', ['users' => $users, 'roles' => $roles]);
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
        if(auth()->user()->role_id != 1) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'rol' => ['required'],
            ]);
    
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->role_id = $request->rol;
            $user->save();
            return redirect('/users')->with('success','Usuario registrado!');
        } catch (\Throwable $th) {
            echo $th;
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if(auth()->user()->role_id != 1) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }
        return view('users.partials.delete.form-delete', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(auth()->user()->role_id != 1) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }
        $user = User::find($id);
        $roles = Role::all();
        $rolId = $user->role_id;
        
        return view('users.partials.edit.form-edit', [
            'user' => $user, 'roles' => $roles, 'rolId' => $rolId
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
       
        // if(auth()->user()->role_id != 1) {
        //     return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        // }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'rol' => ['required'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if (!is_null($request->password)) {
            $user->password =
            ($user->password == $request->password) ? $user->password : Hash::make($request->password);
        }
        $user->role_id = $request->rol;
        $user->save();
        return redirect('/users')->with('success','Usuario actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if(auth()->user()->role_id != 1) {
            return   redirect('/home')->with('warning','No tienes permisos para esta ruta!');
        }
        $user->delete();
        return back()->with('success','Usuario eliminado!');
    }
}
