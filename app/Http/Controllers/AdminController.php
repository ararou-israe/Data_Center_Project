<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ressource;
use App\Models\categorie; 
use App\Models\reservation; 
use App\Models\utilisateur; 
use App\Models\SigProb;
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
    ->where('created_at', '>=', now()->subDays(30))
    ->groupBy('day')
    ->orderBy('day')
    ->get();
    $labels = [];
    $values = [];

    $start = now()->subDays(29)->startOfDay();
    for ($i = 0; $i < 30; $i++) {
       $d = $start->copy()->addDays($i)->format('Y-m-d');
       $labels[] = $d;
       $match = $rows->firstWhere('day', $d);
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
        $usersactuiel= utilisateur::where('status', 'active')->get() ;
        $usersenatend = utilisateur::where('status', 'en attente')->get() ;
        $sizedemond=utilisateur::where('status', 'en attente')->count();
        return view('admin-ressource', compact('usersactuiel','usersenatend','sizedemond'));
    }
}