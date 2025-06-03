<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('panel');
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {

        $credentials = $request->only('email', 'password');

        // Verificar si se seleccionó "recordarme"
        $remember = $request->has('remember');

        // Autenticación con attempt
        if (!Auth::attempt($credentials, $remember)) {
            return back()->withErrors([
                'email' => 'Credenciales incorrectas',
            ]);
        }

        // Autenticación exitosa
        $user = Auth::user();

        return redirect()->route('panel')->with('success', 'Bienvenido ' . $user->name);
    }
}
