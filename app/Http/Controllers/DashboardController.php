<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ressource;
use App\Models\Reservation;

class DashboardController extends Controller
{
    /**
     * Redirection et Affichage du Dashboard avec Statistiques Calculées
     */
    public function index()
    {
        $user = Auth::user();

        // 1. Redirection pour l'Admin
        if ($user->roles === 'admin') {
            return view('admin.dashboard'); 
        } 

        // 2. Logique pour le RESPONSABLE (Hajar)
        if ($user->roles === 'responsable') {
            $responsableId = $user->id;

            // Récupère les ressources gérées par ce responsable
            $ressources = Ressource::where('utilisateur_id', $responsableId)->get();

            // --- CALCULS DES STATISTIQUES TECHNIQUES ---
            $totalRam = $ressources->sum('ram');
            $totalStorage = $ressources->sum('storage');
            $totalCpu = $ressources->sum('cpu');
            // --------------------------------------------

            // Récupère les demandes en attente pour SES ressources
            // Note: On utilise 'status' car c'est généralement le nom en base pour les réservations
            $demandes = Reservation::whereHas('ressource', function($q) use ($responsableId) {
                $q->where('utilisateur_id', $responsableId);
            })->where('status', 'en attente')->get();

            return view('responsable.dashboard', [
                'ressources' => $ressources,
                'demandes' => $demandes,
                'commentaires' => [],
                'totalRam' => $totalRam,
                'totalStorage' => $totalStorage,
                'totalCpu' => $totalCpu
            ]);
        }

        // 3. Redirection pour l'Utilisateur Interne
        if ($user->roles === 'utilisateur_interne') {
            return view('utilisateur.dashboard');
        }

        return redirect('/');
    }

    /**
     * Gérer les demandes (Approuver/Refuser avec justification)
     */
    public function decider(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        
        if ($request->action === 'approuver') {
            $reservation->update(['status' => 'approuve']);
        } else {
            // Enregistre le motif obligatoire pour le prof
            $reservation->update([
                'status' => 'refuse',
                'justification' => $request->justification 
            ]);
        }

        return back()->with('success', 'Décision enregistrée avec succès.');
    }

    /**
     * Enregistrer une nouvelle ressource (Validation selon Migration)
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:ressource,code',
            'nom' => 'required|string',
            'cpu' => 'required|integer|min:1',
            'ram' => 'required|integer|min:1',
            'storage' => 'required|integer|min:1',
            'os' => 'required|in:Linux,Windows',
            'categorie_id' => 'required'
        ]);

        Ressource::create([
            'code' => $request->code,
            'nom' => $request->nom,
            'categorie_id' => $request->categorie_id,
            'utilisateur_id' => Auth::id(), 
            'cpu' => $request->cpu,
            'ram' => $request->ram,
            'storage' => $request->storage,
            'os' => $request->os,
            'etat' => 'disponible', // Etat par défaut selon votre migration
        ]);

        return back()->with('success', 'Ressource technique ajoutée à l\'inventaire.');
    }

    /**
     * Changer l'état d'une ressource (Maintenance / Désactiver)
     */
    public function updateStatus(Request $request, $id)
    {
        $ressource = Ressource::findOrFail($id);
        
        // Vérifie que la valeur envoyée est correcte par rapport à l'enum de la migration
        $nvelEtat = $request->status === 'desactive' ? 'indisponible' : $request->status;

        $ressource->update(['etat' => $nvelEtat]);

        return back()->with('success', 'L\'état de la ressource a été mis à jour.');
    }
}