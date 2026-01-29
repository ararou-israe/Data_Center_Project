<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ressource;
use App\Models\categorie; 
use App\Models\reservation; 
use App\Models\utilisateur; 
use App\Models\SigProb;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
/*        $ressources = ressource::all();
        $resrvations_a= reservation::where('status', 'En attente')->get() ;
        $resrvations_d= reservation::where('status', 'En attente')->get() ;
        $usersenatend =utilisateur::where('status', 'en attente')->get() ;
        $usersactuiel= utilisateur::where('status', 'active')->get() ;
        $categories=categorie::all();
        $size_userd= utilisateur::where('status', 'en attente')->count();
        $size_usersa= utilisateur::where('status', 'active')->count();
        $size_resrv_a= reservation::where('status', 'En attente')->count();
        $size_resrv_d= reservation::where('status', 'En attente')->count();
        $size_incidents=SigProb::count();
        $sizeressources=ressource::count();*/
class AdminController extends Controller
{
    public function dashboard()
    {
        $size_userd= utilisateur::where('status', 'en attente')->count();
        $size_usersa= utilisateur::where('status', 'active')->count();
        $size_resrv_a= reservation::where('status', 'active')->count();
        $size_resrv_d= reservation::where('status', 'En attente')->count();
        $size_incidents=SigProb::count();
        $sizeressources=ressource::count();
        $sizeressources_i=ressource::where('etat', 'indisponible')->count();
        $sizeressources_m=ressource::where('etat', 'maintenance')->count();
  
$rows = reservation::selectRaw('DATE(created_at) as day, COUNT(*) as total')
->where('created_at', '>=', now()->subDays(364)->startOfDay())
->groupBy('day')
->orderBy('day')
->get();


$labels = [];
$values = [];

$start = now()->subDays(364)->startOfDay();

for ($i = 0; $i < 365; $i++) {
$date = $start->copy()->addDays($i)->format('Y-m-d');
$labels[] = $date;

$match = $rows->firstWhere('day', $date);
$values[] = $match ? (int)$match->total : 0;
}

        return view('Administrateur', compact('labels','values','sizeressources_i','sizeressources_m','size_userd','size_usersa','size_resrv_a','size_resrv_d','size_incidents','sizeressources'));
    }
    public function user()
    {
        $usersactuiel= utilisateur::where('status', 'active')->get() ;
        $usersenatend = utilisateur::where('status', 'en attente')->get() ;
        $sizedemond=utilisateur::where('status', 'en attente')->count();
        return view('admin-user', compact('usersactuiel','usersenatend','sizedemond'));
    }
    public function ressource()
    {
        $ressources = ressource::all();
        $ressources_d = ressource::where('etat', '!=', 'maintenance')->get();
        $ressources_m= ressource::where('etat', 'maintenance')->get() ;
        $sizedemond=utilisateur::where('status', 'en attente')->count();
        return view('admin-ressource', compact('ressources','ressources_d','ressources_m','sizedemond'));
    }
    public function edit_user(utilisateur $user )
    {
        $what = 'u' ;
        $sizedemond=utilisateur::where('status', 'en attente')->count();
        return view('admin-edit', compact('what','user','sizedemond'));

    }
    public function update_user(Request $request, utilisateur $user)
{
    // Validate inputs
    $validated = $request->validate([
        'nom'    => ['required', 'string', 'max:255'],
        'prenom' => ['required', 'string', 'max:255'],
        'email'  => ['required', 'email', 'max:255', Rule::unique('utilisateur', 'email')->ignore($user->id)],
        'roles'  => ['required', Rule::in(['utilisateur_interne','responsable','admin' ])],
    ]);
   
    // Update user
    $user->update($validated);

    // redirect back with message
    return redirect("/edit-user/{$user->id}")
        ->with('success', 'Utilisateur mis à jour avec succès.');
}
public function delete_user(utilisateur $user)
{
$user->delete();
return redirect("/admin/users");
}
public function apruve_user(utilisateur $user)
{
    $user->update([
        'status' => 'active',
    ]);

    return redirect()->back()->with('success', 'Utilisateur approuvé avec succès.');
}
public function delete_ressources(utilisateur $user)
{
$user->delete();
return redirect("/admin/users");
}
public function maintenance(ressource $ressource)
{
    $ressource->update([
        
        'etat' => 'maintenance',
    ]);

    return redirect()->back()->with('success', 'ressource en maintenance.');
}
public function activate(ressource $ressource)
{
    $ressource->update([
        
        'etat' => 'disponible',
    ]);

    return redirect()->back()->with('success', 'ressource active.');
}

}