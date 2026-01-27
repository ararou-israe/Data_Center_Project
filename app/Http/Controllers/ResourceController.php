<?php

namespace App\Http\Controllers;

use App\Models\Ressource;

class ResourceController extends Controller
{
    /**
     * PUBLIC interface page
     * Used by / and /interface
     */
    public function index()
    {
        $ressources = Ressource::where('etat', '!=', 'indisponible')->get();
        return view('interface-main', compact('ressources'));
    }

    /**
     * Responsable dashboard
     */
    public function dashboard()
    {
        $ressources = Ressource::all();
        return view('responsable.dashboard', compact('ressources'));
    }
}
