<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ressource;
use App\Models\Reservation;
use App\Models\SigProb;

class DashboardController extends Controller
{
    
  
     
    public function index()
    {
        $user = Auth::user();

        // Redirection pour l'Admin
        if ($user->roles === 'admin') {
            return view('admin.dashboard'); 
        } 

            // Logique pour le RESPONSABLE 
        if ($user->roles === 'responsable') {
            $responsableId = $user->id;

            // Récupère les ressources gérées par ce responsable
            $ressources = Ressource::where('utilisateur_id', $responsableId)->get();

            // Récupère les demandes en attente pour SES ressources
            
            $demandes = Reservation::whereHas('ressource', function($q) use ($responsableId) {
                $q->where('utilisateur_id', $responsableId);
            })->where('status', 'en attente')->get();         
            // Récupérer les signalements/discussions sur SES ressources
           $signalements = SigProb::whereHas('ressource', function($q) use ($responsableId) {
                $q->where('utilisateur_id', $responsableId);
            })->latest()->get();

        return view('responsable.dashboard', compact('ressources', 'demandes', 'signalements'));
        }

           

        //  Redirection pour l'Utilisateur Interne
        if ($user->roles === 'utilisateur_interne') {
            return view('utilisateur.dashboard');
        }

        return redirect('/');
    }
    
    public function decider(Request $request, $id)
{
    $request->validate([
        'action' => 'required|in:approuver,refuser',
        'justification' => 'required|string|max:255'
    ]);

    
    $nouveauStatut = ($request->action === 'approuver') ? 'Approuvée' : 'Refusée';

    try {
        \DB::table('reservation')->where('id', $id)->update([
            'status' => $nouveauStatut,
            'decision_note' => $request->justification,
            'updated_at' => now()
        ]);

        return back()->with('success', "Action réussie : Statut mis à jour en '$nouveauStatut'.");
    } catch (\Exception $e) {
        
        return back()->with('error', "Erreur SQL : " . $e->getMessage());
    }
}
    
    public function detruireSignalement($id)
    {
        $signal = SigProb::findOrFail($id);
        $signal->delete();
        
        return back()->with('success', 'Le message a été modéré (supprimé).');
    }

   
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

       Ressource::create(array_merge($request->all(), [
            'utilisateur_id' => Auth::id(),
            'etat' => 'disponible'
        ]));

        return back()->with('success', 'Ressource ajoutée.');
    }

    
     // Modifier/Mettre en maintenance/Désactiver
     
    public function updateStatus(Request $request, $id)
    {
        $ressource = Ressource::findOrFail($id);
        
        // On met à jour l'état : 'disponible', 'maintenance', ou 'indisponible' (désactiver)
        $ressource->update(['etat' => $request->etat]);

        return back()->with('success', 'État de la ressource mis à jour.');
    }
}

    
