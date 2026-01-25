<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Responsable - DataCenter</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f2f5; display: flex; }

        /* Sidebar */
        .sidebar { width: 260px; height: 100vh; background: #2d3748; color: white; position: fixed; padding: 20px; }
        .sidebar h2 { font-size: 1.2rem; margin-bottom: 30px; color: #63b3ed; text-align: center; }
        .user-info { background: #4a5568; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-size: 0.9rem; }
        .nav-links { list-style: none; }
        .nav-links li { margin-bottom: 15px; }
        .nav-links a { color: #cbd5e0; text-decoration: none; display: flex; align-items: center; gap: 10px; transition: 0.3s; }
        .nav-links a:hover { color: white; transform: translateX(5px); }

        /* Main Content */
        .main-content { margin-left: 260px; flex: 1; padding: 30px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        
        /* Stats Cards */
        .stats-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #4299e1; }
        .stat-card h3 { color: #718096; font-size: 0.9rem; text-transform: uppercase; }
        .stat-card .value { font-size: 1.8rem; font-weight: bold; color: #2d3748; margin-top: 10px; }

        /* Table */
        .data-table-container { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .data-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .data-table th { text-align: left; padding: 12px; border-bottom: 2px solid #edf2f7; color: #4a5568; }
        .data-table td { padding: 12px; border-bottom: 1px solid #edf2f7; font-size: 0.95rem; }
        
        /* Buttons */
        .btn { padding: 8px 16px; border-radius: 5px; cursor: pointer; border: none; font-size: 0.85rem; font-weight: 600; }
        .btn-approve { background: #48bb78; color: white; }
        .btn-reject { background: #f56565; color: white; margin-left: 5px; }
        .btn-logout { background: #e53e3e; color: white; width: 100%; margin-top: 20px; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2><i class="fa-solid fa-server"></i> MGMT DataCenter</h2>
        <div class="user-info">
            <p><i class="fa-solid fa-user-tie"></i> Responsable :</p>
            <strong>{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</strong>
        </div>
        <ul class="nav-links">
            <li><a href="#"><i class="fa-solid fa-chart-line"></i> Vue d'ensemble</a></li>
            <li><a href="#"><i class="fa-solid fa-microchip"></i> Mes Ressources</a></li>
            <li><a href="#"><i class="fa-solid fa-calendar-check"></i> Demandes</a></li>
            <li><a href="#"><i class="fa-solid fa-tools"></i> Maintenance</a></li>
        </ul>
        <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-logout" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 10px;">
        <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
    </button>
</form>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Tableau de bord Responsable</h1>
            <span style="color: #718096;">{{ date('d/m/Y') }}</span>
        </div>

        @if(session('success'))
            <div style="background: #c6f6d5; color: #22543d; padding: 12px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #38a169;">
                <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="stats-container">
    <div class="stat-card">
        <h3><i class="fa-solid fa-server"></i> Ressources</h3>
        <div class="value">{{ $ressources->count() }}</div>
    </div>

    <div class="stat-card" style="border-left-color: #9f7aea;">
        <h3><i class="fa-solid fa-memory"></i> Capacité RAM</h3>
        <div class="value">{{ $totalRam }} <small style="font-size: 0.9rem;">Go</small></div>
        <div style="width: 100%; background: #edf2f7; height: 8px; border-radius: 4px; margin-top: 10px;">
            <div style="width: 70%; background: #9f7aea; height: 100%; border-radius: 4px;"></div>
        </div>
    </div>

    <div class="stat-card" style="border-left-color: #f6ad55;">
        <h3><i class="fa-solid fa-hard-drive"></i> Stockage Total</h3>
        <div class="value">{{ $totalStorage }} <small style="font-size: 0.9rem;">Go</small></div>
    </div>

    <div class="stat-card" style="border-left-color: #f56565;">
        <h3><i class="fa-solid fa-bell"></i> Alertes Demandes</h3>
        <div class="value">{{ $demandes->count() }}</div>
    </div>
</div>
        <div class="data-table-container">
            <h2>Dernières demandes de réservation</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Ressource</th>
                        <th>Période</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($demandes as $demande)
                    <tr>
                        <td><strong>{{ $demande->utilisateur->prenom }}</strong><br><small>{{ $demande->utilisateur->type }}</small></td>
                        <td>{{ $demande->ressource->nom }}</td>
                       <td>{{ $demande->start_at }} - {{ $demande->end_at }}</td>
                        <td>
                            <form action="{{ route('reservation.decider', $demande->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="action" value="approuver">
                                <button type="submit" class="btn btn-approve">Approuver</button>
                            </form>
                            <form action="{{ route('reservation.decider', $demande->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="action" value="refuser">
                                <input type="text" name="justification" placeholder="Motif..." required style="padding: 5px; border-radius: 4px; border: 1px solid #cbd5e0; font-size: 0.8rem;">
                                <button type="submit" class="btn btn-reject">Refuser</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="data-table-container" style="margin-top: 30px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h2><i class="fa-solid fa-microchip"></i> Inventaire des Ressources</h2>
                <button onclick="openModal()" class="btn btn-approve" style="background: #3182ce;">
                    <i class="fa-solid fa-plus"></i> Ajouter une ressource
                </button>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Code / Nom</th>
                        <th>Spécifications Techniques</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ressources as $ressource)
                    <tr>
                        <td><small>{{ $ressource->code }}</small><br><strong>{{ $ressource->nom }}</strong></td>
                        <td>
                            <div style="font-size: 0.85rem; color: #4a5568;">
                                <span><i class="fa-solid fa-microchip"></i> {{ $ressource->cpu }} vCPU</span> | 
                                <span><i class="fa-solid fa-memory"></i> {{ $ressource->ram }} Go</span> | 
                                <span><i class="fa-solid fa-hard-drive"></i> {{ $ressource->storage }} Go</span><br>
                                <small><i class="fa-brands fa-{{ strtolower($ressource->os) }}"></i> {{ $ressource->os }}</small>
                            </div>
                        </td>
                        <td>
                            @if($ressource->etat == 'disponible')
                                <span style="color: #48bb78;"><i class="fa-solid fa-circle-check"></i> Disponible</span>
                            @elseif($ressource->etat == 'maintenance')
                                <span style="color: #ed8936;"><i class="fa-solid fa-wrench"></i> Maintenance</span>
                            @else
                                <span style="color: #e53e3e;"><i class="fa-solid fa-circle-xmark"></i> Indisponible</span>
                            @endif
                        </td>
                        <td>
                            <button title="Modifier" style="background:none; border:none; color:#4a5568; cursor:pointer;"><i class="fa-solid fa-pen-to-square"></i></button>
                            <form action="{{ route('ressource.status', $ressource->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="status" value="maintenance">
                                <button type="submit" title="Maintenance" style="background:none; border:none; color:#ed8936; cursor:pointer; margin-left:8px;"><i class="fa-solid fa-hammer"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="data-table-container" style="margin-top: 30px; border-left: 5px solid #e53e3e;">
            <h2><i class="fa-solid fa-comments"></i> Modération des discussions</h2>
            <div style="margin-top: 15px;">
                @forelse($commentaires as $com)
                    <div style="background: #f8fafc; padding: 12px; border-radius: 8px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center; border: 1px solid #e2e8f0;">
                        <div>
                            <strong>{{ $com->user_name }} :</strong> {{ $com->message }}
                        </div>
                        <form action="{{ route('commentaires.delete', $com->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-reject" style="padding: 5px 10px; border-radius: 4px; border:none; cursor:pointer;"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                @empty
                    <p style="color: #a0aec0; font-style: italic;">Aucun message à modérer.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div id="addModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:1000; backdrop-filter: blur(4px);">
        <div style="background:white; width:500px; margin:50px auto; padding:25px; border-radius:12px; box-shadow: 0 20px 25px rgba(0,0,0,0.1);">
            <h2 style="color: #2d3748; border-bottom: 2px solid #edf2f7; padding-bottom: 10px; margin-bottom: 20px;">
                <i class="fa-solid fa-server" style="color: #3182ce;"></i> Nouvelle Ressource
            </h2>
            <form action="{{ route('ressource.store') }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                    <div>
                        <label style="font-weight:600; font-size: 0.9rem;">Code</label>
                        <input type="text" name="code" placeholder="SRV-100" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #cbd5e0;">
                    </div>
                    <div>
                        <label style="font-weight:600; font-size: 0.9rem;">Nom</label>
                        <input type="text" name="nom" placeholder="Serveur Web" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #cbd5e0;">
                    </div>
                </div>

                <input type="hidden" name="categorie_id" value="1">

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; background: #f7fafc; padding: 15px; border-radius: 8px; margin-bottom: 15px;">
                    <div>
                        <label style="font-size: 0.8rem; font-weight: bold;">CPU (Cœurs)</label>
                        <input type="number" name="cpu" required style="width:100%; padding:6px; border:1px solid #ccc;">
                    </div>
                    <div>
                        <label style="font-size: 0.8rem; font-weight: bold;">RAM (Go)</label>
                        <input type="number" name="ram" required style="width:100%; padding:6px; border:1px solid #ccc;">
                    </div>
                    <div>
                        <label style="font-size: 0.8rem; font-weight: bold;">Stockage (Go)</label>
                        <input type="number" name="storage" required style="width:100%; padding:6px; border:1px solid #ccc;">
                    </div>
                    <div>
                        <label style="font-size: 0.8rem; font-weight: bold;">OS</label>
                        <select name="os" style="width:100%; padding:6px; border:1px solid #ccc;">
                            <option value="Linux">Linux</option>
                            <option value="Windows">Windows</option>
                        </select>
                    </div>
                </div>

                <div style="text-align:right;">
                    <button type="button" onclick="closeModal()" class="btn" style="background:#cbd5e0; margin-right: 10px;">Annuler</button>
                    <button type="submit" class="btn btn-approve">Enregistrer la ressource</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() { document.getElementById('addModal').style.display = 'block'; }
        function closeModal() { document.getElementById('addModal').style.display = 'none'; }
    </script>
</body>
</html>