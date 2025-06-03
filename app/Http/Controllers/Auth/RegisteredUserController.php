<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario; // Usa tu modelo Usuario
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:usuarios,correo'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->name,
            'correo' => $request->email,
            'contrasena' => Hash::make($request->password),
            'rol' => 'cliente', // Asigna el rol cliente por defecto
        ]);

        // Si usas Spatie, asigna el rol
        if (method_exists($usuario, 'assignRole')) {
            $usuario->assignRole('cliente');
        }

        event(new Registered($usuario));

        Auth::login($usuario);

        return redirect(route('dashboard', absolute: false));
    }
}
