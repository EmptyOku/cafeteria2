<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Usuario; // <-- Usa tu modelo Usuario

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autenticación usando el modelo Usuario y la tabla usuarios
        $credentials = $request->only('correo', 'password');
        $loginField = filter_var($credentials['correo'], FILTER_VALIDATE_EMAIL) ? 'correo' : 'nombre';
        $attempt = Auth::guard('web')->attempt([
            $loginField => $credentials['correo'],
            'password' => $credentials['password'],
        ], $request->filled('remember'));

        if (!$attempt) {
            return back()->withErrors([
                'correo' => 'Las credenciales no coinciden con nuestros registros.',
            ]);
        }

        $request->session()->regenerate();

        // Redirección según el rol del usuario
        $user = Auth::user();
        if ($user->hasRole('administrador')) {
            return redirect()->intended(route('dashboard', absolute: false));
        }
        if ($user->hasRole('empleado')) {
            return redirect()->intended('/empleado/home');
        }
        if ($user->hasRole('cliente')) {
            return redirect()->intended('/cliente/home');
        }

        // Redirección por defecto si no tiene rol
        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
