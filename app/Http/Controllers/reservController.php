<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ressource;
use App\Models\Reservation;


use App\Models\SigProb;


class reservController extends Controller
{
    public function index(Request $request)
    {
        // afficher les Ressources disponibles avec un input de recherche
        $queryRessources = Ressource::where('etat', 'disponible');
        if ($request->filled('search')) {
            $queryRessources->where('nom', 'like', '%' . $request->search . '%');
        }
        $ressources = $queryRessources->get();

        //  afficher l historique de reservations avec un filtre
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
        if ($request->filled('filter_date_fin')) {
            $queryReserv->whereDate('date_fin', $request->filter_date_fin);
        }

        $reservations = $queryReserv->orderBy('date_debut', 'desc')->get();
     
       
     //suivi de signaler les problèmes
     $sigProbs = SigProb::where('utilisateur_id', auth()->id())
                        ->orderBy('created_at', 'desc')
                        ->get();
     return view('UtilisateurInterne', compact('ressources', 'reservations', 'sigProbs'));
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
    // gestion des conflits
    if ($conflit) {
        return back()->withErrors(['dates' => '  demande pas enregistrée. Veuillez choisir une autre date. La ressource est déjà réservée sur ces dates.'])->withInput();
    }

    // si il n ya pas de problem on cree  la réservation
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
 // Soumettre un signalement de problème
 public function storeSigProb(Request $request)
 {
    $request->validate([
        'ressource_id' => 'nullable|exists:ressource,id',
        'problem' => 'required|string|max:1000',
    ]);

    SigProb::create([
        'utilisateur_id' => auth()->id(),
        'ressource_id' => $request->ressource_id,
        'problem' => $request->problem,
        'reponse' => null, // il est vide au moment de signal de problem et si le responsable qui repond
    ]);

    return back()->with('success', 'Incident signalé.');
 }
}