<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }


    public function destroy($id)
    {
        try {
            $usuario = User::findOrFail($id);
            $usuario->delete();
            return redirect()->route('admin.index')->with('success', 'Usuario eliminado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('usuarios.destroy.unique', $id)->with('error', $e->getMessage());
        }
    }


    public function create()
    {
        return view('usuarios.create.unique');
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]);

            User::create($request->all());

            return redirect()->route('admin.index')->with('success', 'Usuario creado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('usuarios.create.unique')->with('error', $e->getMessage());
        }
    }


    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    

    public function update(Request $request, $id)
    {
        try {
            $usuario = User::findOrFail($id);

            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $usuario->id,
                'password' => 'required',
            ]);

            $usuario->update($request->all());

            return redirect()->route('admin.index')->with('success', 'Usuario actualizado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('usuarios.edit', $id)->with('error', $e->getMessage());
        }
    }


    public function showProfile()
    {
        $usuario = Auth::user();
        return view('usuarioconfig.verperfil', compact('usuario'));
    }


    public function editProfile()
    {
        $usuario = Auth::user();
        return view('usuarioconfig.editperfil', compact('usuario'));
    }


    public function updateProfile(Request $request)
    {
        try {
            $usuario = Auth::user();
    
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $usuario->id,
                'current_password' => 'required',
                'new_password' => 'sometimes|nullable|min:8',
            ]);
    
            $currentPassword = $request->input('current_password');
            $newPassword = $request->input('new_password');
    

            if (password_verify($currentPassword, $usuario->password)) {
                $usuario->name = $request->input('name');
                $usuario->email = $request->input('email');
    

                if ($newPassword) {
                    $usuario->password = bcrypt($newPassword);
                }
    
                $usuario->save();
    
                return redirect()->route('usuarios.showProfile')->with('success', 'Perfil actualizado correctamente');
            } else {
                return redirect()->route('usuarios.editProfile')->with('error', 'La contraseña actual no coincide');
            }
        } catch (\Exception $e) {
            return redirect()->route('usuarios.editProfile')->with('error', $e->getMessage());
        }
    }
}
