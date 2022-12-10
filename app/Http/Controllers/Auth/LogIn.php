<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostAuthLogInRequest;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LogIn extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(PostAuthLogInRequest $request)
    {
        $validated = $request->validated();
        if (Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password']], ($validated['rememberMe'] ?? '') == "on")) {
            $request->session()->regenerate();
            if ($request->user()->type == 'ADMIN') {
                return redirect()->route('admin.rooms.index');
            } else if ($request->user()->type == 'CLIENT') {
                return redirect()->route('admin.rooms.index');
            }
        }
        return back()->withErrors(['status' => 'Error al Iniciar Sesión, por favor revise sus credenciales'])
            ->withInput([
                'email' => $validated['email'],
                'rememberMe' => $validated['rememberMe'] ?? '',
            ]);
    }
}
