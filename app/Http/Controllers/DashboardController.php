<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();

    if ($user->roles === 'admin') {
        return redirect()->route('admin.dashboard');
    } 
    
    if ($user->roles === 'responsable') {
        return redirect()->route('responsable.dashboard');
    }

    if ($user->roles === 'utilisateur_interne') {
        return redirect()->route('utilisateur.dashboard');
    }

    return redirect('/');
    }
}