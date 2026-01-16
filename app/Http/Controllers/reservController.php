<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ressource;
use App\Models\Reservation;
use App\Models\Notifications;

class reservController extends Controller
{
    public function index(Request $request)
    {
        // --- 1. Ressources (recherche simple)
        $queryRessources = Ressource::where('etat', 'disponible');
        if ($request->filled('search')) {
            $queryRessources->where('nom', 'like', '%' . $request->search . '%');
        }
        $ressources = $queryRessources->get();

        // --- 2. Historique réservations avec filtres
        $queryReserv = Reservation::where('utilisateur_id', auth()->id());

        if ($request->filled('filter_ressource')) {
            $queryReserv->whereHas('ressource', function($q) use ($request) {
                $q->where('nom', 'like', '%' . $request->filter_ressource . '%');
            });
        }

        if ($request->filled('filter_status')) {
            $queryReserv->where('status', $request->filter_status);
        }

        if ($request->filled('filter_date')) {
            $queryReserv->whereDate('date_debut', $request->filter_date);
        }

        $reservations = $queryReserv->orderBy('date_debut', 'desc')->get();
        return view('UtilisateurInterne', compact('ressources', 'reservations'));

     
    }

    public function store(Request $request)
{
    $request->validate([
        'ressource_id' => 'required',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'justification' => 'required',
    ]);

    // Vérifier si la ressource est déjà réservée sur cette période
    $conflit = Reservation::where('ressource_id', $request->ressource_id)
                ->where(function($query) use ($request) {
                    $query->whereBetween('date_debut', [$request->date_debut, $request->date_fin])
                          ->orWhereBetween('date_fin', [$request->date_debut, $request->date_fin])
                          ->orWhere(function($q) use ($request) {
                              $q->where('date_debut', '<=', $request->date_debut)
                                ->where('date_fin', '>=', $request->date_fin);
                          });
                })
                ->exists();

    if ($conflit) {
        return back()->withErrors(['dates' => '  demande pas enregistrée. Veuillez choisir une autre date. La ressource est déjà réservée sur ces dates.'])->withInput();
    }

    // Si pas de conflit, créer la réservation
    Reservation::create([
        'utilisateur_id' => auth()->id(),
        'ressource_id' => $request->ressource_id,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
        'justification' => $request->justification,
        'status' => 'En attente',
        'decision_note' => null
    ]);

    return back()->with('success', 'Votre demande a été envoyée');
}
}