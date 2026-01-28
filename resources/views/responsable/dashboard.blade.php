<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion du Parc - Responsable</title>
    <style>
    :root {
        --primary-blue: #3498db;
        --dark-slate: #2c3e50;
        --hero-gradient: linear-gradient(135deg, #3498db, #2980b9);
        --bg-light: #f4f7f9;
        --text-dark: #1a1a1b;
        --glass-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }

    body { 
        font-family: 'Inter', 'Segoe UI', sans-serif; 
        background-color: var(--bg-light); 
        color: var(--text-dark); 
        margin: 0;
    }
    .navbar-resp {
        background: #ffffff;
        padding: 10px 50px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eef2f6;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    }

    .brand-resp {
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: bold;
        font-size: 1.1em;
        color: var(--dark-slate);
    }

    .brand-resp img { height: 38px; }

    
    .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }

    
    .card { 
        background: #ffffff; 
        border-radius: 24px; 
        padding: 35px; 
        margin-bottom: 30px;
        
        
        border: 1px solid rgba(224, 230, 237, 0.5); 
        
        
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.03), 
                    0 2px 5px rgba(0, 0, 0, 0.02);
        
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    
    .card:hover { 
        transform: translateY(-5px); 
        box-shadow: 0 20px 40px rgba(52, 152, 219, 0.08); 
    }

    
    .card h2 {
        margin-top: 0;
        font-weight: 800;
        letter-spacing: -0.5px;
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }

    h1 { font-size: 2.2em; font-weight: 800; color: var(--dark-slate); margin-bottom: 10px; }
    h2 { font-size: 1.3em; display: flex; align-items: center; gap: 10px; color: var(--primary-blue); margin-bottom: 25px; }

    
    input, select { 
        padding: 14px 18px; 
        border: 2px solid #eef2f6; 
        border-radius: 12px; 
        background: #fff;
        font-size: 14px;
        color: var(--text-dark);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        width: 100%;
        box-sizing: border-box;
    }

    
    input:hover, select:hover {
        border-color: #d1d9e0;
        background: #fff;
    }

   
    input:focus, select:focus { 
        border-color: var(--primary-blue); 
        outline: none; 
        background: #fff; 
        box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.15), 0 4px 12px rgba(0, 0, 0, 0.05);
        transform: translateY(-1px); 
    }

    /*  les placeholders */
    input::placeholder {
        color: #94a3b8;
        font-style: italic;
    }

    .form-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); 
        gap: 20px; 
        align-items: end; 
    }ox-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1); 

  
.btn-add { 
    background-color: #3498db !important; 
    color: white !important;
    border: none !important; 
    padding: 16px !important; 
    border-radius: 12px !important; 
    font-weight: 800 !important; 
    text-transform: uppercase;
    cursor: pointer;
    grid-column: 1 / -1; 
    width: 100%;
    appearance: none;
    -webkit-appearance: none;
    transition: all 0.3s ease;
}

.btn-add:hover { 
    background-color: #2980b9 !important; /* Bleu plus foncé au survol */
    transform: translateY(-3px); 
    box-shadow: 0 8px 20px rgba(52, 152, 219, 0.3); 
}
    /* Tableaux  */
    table { width: 100%; border-collapse: collapse; }
    th { text-align: left; padding: 18px; color: #94a3b8; font-size: 0.8em; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; }
    td { padding: 18px; border-bottom: 1px solid #f8fafc; font-size: 0.95em; }

    /* Status  */
    .badge { padding: 5px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
    .disponible { background: #dcfce7; color: #166534; }
    .maintenance { background: #fef9c3; color: #854d0e; }
    .indisponible { background: #fee2e2; color: #991b1b; }

    /* Boutons de déconnexion et actions */
    .btn-logout { background: #f1f5f9; color: #475569; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.2s; }
    .btn-logout:hover { background: #e2e8f0; color: #1e293b; }
</style>
</head>
<body>
  <header class="navbar-resp">
        <div class="brand-resp">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>DataCenter Manager <small style="font-weight:normal; color:#94a3b8;">| Dashboard Responsable</small></span>
        </div>
        
        <div style="display: flex; align-items: center; gap: 20px;">
            <span>Bienvenue, <strong>{{ Auth::user()->prenom }}</strong></span>
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="btn-logout">Quitter 🚪</button>
            </form>
        </div>
    </header>

    <div class="container">
        <h1>Supervision du Parc</h1>
        <p style="color: #64748b; margin-bottom: 40px;">Gérez vos ressources et validez les demandes en temps réel.</p>

        @if(session('success'))
            <div class="alert alert-success" style="background:#dcfce7; color:#166534; padding:15px; border-radius:10px; margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

    <div class="card">
        <h2>➕ Ajouter une nouvelle ressource</h2>

        @if ($errors->any())
        <div class="alert" style="background-color: #e74c3c; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <ul style="margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form action="{{ route('ressource.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <input type="text" name="nom" placeholder="Nom de la ressource (ex: Serveur AI)" required>
                <input type="text" name="code" placeholder="Code unique (ex: SRV-01)" required>
                <select name="os" required>
                    <option value="Linux">Système : Linux</option>
                    <option value="Windows">Système : Windows</option>
                </select>
                <input type="number" name="cpu" placeholder="CPU (Cores)" required min="1">
                <input type="number" name="ram" placeholder="RAM (Go)" required min="1">
                <input type="number" name="storage" placeholder="Stockage (Go)" required min="1">
                <input type="hidden" name="categorie_id" value="1"> <button type="submit" class="btn-add">ENREGISTRER LA RESSOURCE</button>
            </div>
        </form>
    </div>

    <div class="card">
        <h2>🖥️ Parc des ressources supervisées</h2>
        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Nom / OS</th>
                    <th>Specs (CPU/RAM/DD)</th>
                    <th>État Actuel</th>
                    <th>Actions (Maintenance / Désactiver)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ressources as $r)
                <tr>
                    <td><strong>{{ $r->code }}</strong></td>
                    <td>{{ $r->nom }} <br> <small style="color: #666;">{{ $r->os }}</small></td>
                    <td>{{ $r->cpu }} Cores / {{ $r->ram }} Go / {{ $r->storage }} Go</td>
                    <td>
                        <span class="badge {{ $r->etat }}">
                            {{ $r->etat }}
                        </span>
                    </td>
                    <td class="action-group">
                        <form action="{{ route('ressource.status', $r->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="etat" value="{{ $r->etat == 'maintenance' ? 'disponible' : 'maintenance' }}">
                            <button type="submit" class="btn-action btn-maint">
                                {{ $r->etat == 'maintenance' ? '🔧 Sortir Maintenance' : '🛠️ Maintenance' }}
                            </button>
                        </form>

                        <form action="{{ route('ressource.status', $r->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="etat" value="{{ $r->etat == 'indisponible' ? 'disponible' : 'indisponible' }}">
                            <button type="submit" class="btn-action {{ $r->etat == 'indisponible' ? 'btn-react' : 'btn-desact' }}">
                                {{ $r->etat == 'indisponible' ? '🔓 Réactiver' : '🔒 Désactiver' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="card" style="margin-top: 30px; border-top: 4px solid #3498db;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>📥 Consultation des demandes entrantes</h2>
        <span style="background: #3498db; color: white; padding: 5px 12px; border-radius: 15px; font-size: 14px;">
            {{ $demandes->count() }} demande(s) à examiner
        </span>
    </div>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                <th style="padding: 15px; text-align: left; color: #2c3e50;">Demandeur</th>
                <th style="padding: 15px; text-align: left; color: #2c3e50;">Ressource demandée</th>
                <th style="padding: 15px; text-align: left; color: #2c3e50;">Période / Motif</th>
                <th style="padding: 15px; text-align: left; color: #2c3e50;">Action Responsable</th>
            </tr>
        </thead>
        <tbody>
            @foreach($demandes as $d)
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 15px;">{{ $d->utilisateur->nom }} {{ $d->utilisateur->prenom }}</td>
                <td style="padding: 15px;"><strong>{{ $d->ressource->nom }}</strong></td>
                <td style="padding: 15px;">{{ $d->justification }}</td>
                <td style="padding: 15px;">
                <form action="{{ route('responsable.decider', $d->id) }}" method="POST" style="display: flex; gap: 5px;">
                @csrf
               <input type="text" name="justification" placeholder="Note technique..." required 
               style="padding: 5px; border: 1px solid #ccc; border-radius: 4px; flex-grow: 1;">
    
              <button type="submit" name="action" value="approuver" 
              style="background: #27ae60; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
              Approuver
              </button>
    
            <button type="submit" name="action" value="refuser" 
            style="background: #e74c3c; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
            Refuser
           </button>
            </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
        </div>
     <div style="margin-top: 40px; background: white; padding: 25px; border-radius: 12px; shadow: 0 4px 6px rgba(0,0,0,0.1); border-top: 5px solid #e67e22;">
    <h3 style="color: #d35400; display: flex; align-items: center; gap: 10px;">
        <span>🛡️</span> Modération & Alertes Ressources
    </h3>
    

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f39c12; color: white; text-align: left;">
                <th style="padding: 12px;">Ressource</th>
                <th style="padding: 12px;">Signalement / Message</th>
                <th style="padding: 12px;">Auteur</th>
                <th style="padding: 12px; text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($signalements as $s)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px;"><strong>{{ $s->ressource->nom }}</strong></td>
                    <td style="padding: 12px; color: #444;">{{ $s->description }}</td>
                    <td style="padding: 12px; color: #7f8c8d;">{{ $s->utilisateur->nom ?? 'Inconnu' }}</td>
                    <td style="padding: 12px; text-align: center;">
                        <form action="{{ route('responsable.moderation', $s->id) }}" method="POST" onsubmit="return confirm('Confirmer la modération (suppression) ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: #e74c3c; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; transition: 0.3s;">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="padding: 30px; text-align: center; color: #95a5a6;">Aucun message ou alerte à modérer pour vos ressources.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>