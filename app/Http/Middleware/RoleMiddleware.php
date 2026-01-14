<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Gère une requête entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles  Liste des rôles autorisés (admin, responsable, etc.)
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Vérification si l'utilisateur est authentifié via le middleware 'auth'
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Récupérer le rôle de l'utilisateur connecté depuis la base de données
        $userRole = Auth::user()->roles;

        // 3. Vérification si ce rôle fait partie des rôles permis pour cette route
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // 4. Si l'utilisateur n'a pas le bon rôle, on le redirige vers le dashboard
        // avec un message d'alerte (Flash session)
        return redirect('/dashboard')->with('error', "Accès refusé : Votre profil ($userRole) ne permet pas d'accéder à cette ressource.");
    }
}