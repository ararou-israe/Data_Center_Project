<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource; // On supposera que le modèle existe

class ResourceController extends Controller
{
    public function dashboard()
    {
        // Simulation de données en attendant la base de données
        $ressources = [
            ['id' => 1, 'nom' => 'Serveur Dell R740', 'type' => 'Physique', 'cpu' => 32, 'ram' => 64, 'status' => 'Disponible'],
            ['id' => 2, 'nom' => 'VM-Ubuntu-Docker', 'type' => 'Virtuelle', 'cpu' => 4, 'ram' => 8, 'status' => 'Maintenance'],
            ['id' => 3, 'nom' => 'Cluster Stockage', 'type' => 'Stockage', 'cpu' => 0, 'ram' => 128, 'status' => 'Disponible'],
        ];

        return view('responsable.dashboard', compact('ressources'));
    }
}



// <?php

// namespace App\Http\Controllers;

// use App\Models\Ressource;

// class ResourceController extends Controller
// {
//     /**
//      * PUBLIC interface page
//      * Used by / and /interface
//      */
//     public function index()
//     {
//         $ressources = Ressource::where('etat', '!=', 'indisponible')->get();
//         return view('interface-main', compact('ressources'));
//     }

//     /**
//      * Responsable dashboard
//      */
//     public function dashboard()
//     {
//         $ressources = Ressource::all();
//         return view('responsable.dashboard', compact('ressources'));
//     }
// }
 hada howa l code li khdamli hada li drti makhdamch ok 
