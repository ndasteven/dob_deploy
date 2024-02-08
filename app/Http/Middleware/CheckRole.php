<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
         // Vérifiez le rôle de l'utilisateur
         if ($request->user() && $request->user()->role === $role) {
            return $next($request);
        }
        // Redirigez l'utilisateur ou renvoyez une erreur selon vos besoins
        abort(403, 'Accès interdit. Vous n\'avez pas les permissions nécessaires.');
    }
    
}
