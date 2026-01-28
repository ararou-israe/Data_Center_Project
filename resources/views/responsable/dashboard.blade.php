<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion du Parc - Responsable</title>
    <style>
        :root {
            --primary: #3b82f6;
            --primary-soft: rgba(59,130,246,0.18);
            --accent: #22d3ee;
            --danger: #ef4444;
            --success: #22c55e;
            --warning: #f59e0b;
            --bg-main: #0b1220;
            --bg-glass: rgba(255,255,255,0.06);
            --border-glass: rgba(255,255,255,0.15);
            --text-main: #e5e7eb;
            --text-muted: #9ca3af;
            --radius: 14px;
            --blur: blur(14px);
        }

        body {
            margin: 0;
            font-family: 'Inter','Segoe UI',sans-serif;
            background:
                radial-gradient(1200px 600px at 10% -10%, rgba(59,130,246,0.15), transparent),
                radial-gradient(800px 400px at 90% 10%, rgba(34,211,238,0.12), transparent),
                var(--bg-main);
            color: var(--text-main);
        }

        .navbar-resp {
            background: rgba(15,23,42,0.75);
            backdrop-filter: var(--blur);
            border-bottom: 1px solid var(--border-glass);
            padding: 16px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 20;
        }

        .brand-resp {
            display: flex;
            align-items: center;
            gap: 14px;
            font-weight: 700;
        }

        .brand-resp span {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .container {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .card {
            background: linear-gradient(145deg, var(--bg-glass), rgba(255,255,255,0.02));
            backdrop-filter: var(--blur);
            border: 1px solid var(--border-glass);
            border-radius: var(--radius);
            padding: 40px;
            margin-bottom: 50px;
        }

        h1 { font-size: 1.9rem; margin-bottom: 12px; }
        h2 { font-size: 1.3rem; margin-bottom: 28px; }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 26px;
        }

        input, select {
            background: rgba(255,255,255,0.07);
            border: 1px solid var(--border-glass);
            color: var(--text-main);
            border-radius: 10px;
            padding: 12px 14px;
        }

        /* Boutons principaux */
        .btn-add {
            grid-column: 1 / -1;
            margin-top: 10px;
            padding: 16px;
            border-radius: 14px;
            font-weight: 800;
            letter-spacing: 0.6px;
            background: linear-gradient(135deg, var(--primary), #2563eb);
            box-shadow: 0 10px 30px rgba(59,130,246,0.35);
            transition: .25s ease;
            cursor: pointer;
            border: none;
            color: white;
        }

        /* Groupe de boutons d'action */
        .action-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-action {
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            border: 1px solid var(--border-glass);
            color: white;
            cursor: pointer;
            transition: all 0.2s;
            background: rgba(255,255,255,0.05);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-action:hover { background: rgba(255,255,255,0.15); transform: translateY(-1px); }
        
        /* Variants Couleurs Actions */
        .btn-approve { background: rgba(34,197,94,0.2); border-color: var(--success); color: var(--success); }
        .btn-approve:hover { background: var(--success); color: white; }

        .btn-reject { background: rgba(239,68,68,0.2); border-color: var(--danger); color: var(--danger); }
        .btn-reject:hover { background: var(--danger); color: white; }

        .btn-toggle-on { background: rgba(34,211,238,0.15); border-color: var(--accent); color: var(--accent); }
        .btn-toggle-off { background: rgba(156,163,175,0.15); border-color: var(--text-muted); color: var(--text-muted); }

        .btn-logout {
            padding: 10px 20px;
            border-radius: 12px;
            background: rgba(255,255,255,0.08);
            border: 1px solid var(--border-glass);
            color: white;
            transition: .2s;
            cursor: pointer;
        }
        .btn-logout:hover { background: var(--danger); border-color: var(--danger); }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 16px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.05); }
        th { color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; }

        .badge {
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
        }
        .disponible { background: rgba(34,197,94,.18); color: var(--success); }
        .maintenance { background: rgba(245,158,11,.2); color: var(--warning); }
        .indisponible { background: rgba(239,68,68,.25); color: var(--danger); }
    </style>
</head>

<body>
    <header class="navbar-resp">
        <div class="brand-resp">
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
        <p style="color: #94a3b8; margin-bottom: 40px;">Gérez vos ressources et validez les demandes en temps réel.</p>

        @if(session('success'))
            <div class="alert alert-success" style="background:rgba(34,197,94,0.2); color:var(--success); border: 1px solid var(--success); padding:15px; border-radius:10px; margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <h2>➕ Ajouter une nouvelle ressource</h2>
            <form action="{{ route('ressource.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <input type="text" name="nom" placeholder="Nom de la ressource" required>
                    <input type="text" name="code" placeholder="Code unique" required>
                    <select name="os" required>
                        <option value="Linux">Système : Linux</option>
                        <option value="Windows">Système : Windows</option>
                    </select>
                    <input type="number" name="cpu" placeholder="CPU (Cores)" required min="1">
                    <input type="number" name="ram" placeholder="RAM (Go)" required min="1">
                    <input type="number" name="storage" placeholder="Stockage (Go)" required min="1">
                    <input type="hidden" name="categorie_id" value="1"> 
                    <button type="submit" class="btn-add">ENREGISTRER LA RESSOURCE</button>
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
                        <th>Specs</th>
                        <th>État</th>
                        <th>Actions de maintenance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ressources as $r)
                    <tr>
                        <td><strong>{{ $r->code }}</strong></td>
                        <td>{{ $r->nom }} <br> <small style="color: var(--text-muted);">{{ $r->os }}</small></td>
                        <td>{{ $r->cpu }} Cores / {{ $r->ram }} Go</td>
                        <td><span class="badge {{ $r->etat }}">{{ $r->etat }}</span></td>
                        <td>
                            <div class="action-group">
                                <form action="{{ route('ressource.status', $r->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="etat" value="{{ $r->etat == 'maintenance' ? 'disponible' : 'maintenance' }}">
                                    <button type="submit" class="btn-action">
                                        {{ $r->etat == 'maintenance' ? '🔧 Sortir' : '🛠️ Maintenance' }}
                                    </button>
                                </form>

                                <form action="{{ route('ressource.status', $r->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="etat" value="{{ $r->etat == 'indisponible' ? 'disponible' : 'indisponible' }}">
                                    <button type="submit" class="btn-action {{ $r->etat == 'indisponible' ? 'btn-toggle-on' : 'btn-toggle-off' }}">
                                        {{ $r->etat == 'indisponible' ? '🔓 Activer' : '🔒 Désactiver' }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card" style="border-top: 4px solid var(--primary);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h2 style="margin: 0;">📥 Consultation des demandes entrantes</h2>
        <span style="background: var(--primary); color: white; padding: 6px 16px; border-radius: 999px; font-size: 13px; font-weight: 600; box-shadow: 0 4px 15px rgba(59,130,246,0.3);">
            {{ $demandes->count() }} demande(s) à examiner
        </span>
    </div>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Demandeur</th>
                <th>Ressource demandée</th>
                <th>Période / Motif</th>
                <th>Action Responsable</th>
            </tr>
        </thead>
        <tbody>
            @foreach($demandes as $d)
            <tr style="border-bottom: 1px solid var(--border-glass);">
                <td style="padding: 18px;">
                    <span style="display: block; font-weight: 600;">{{ $d->utilisateur->nom }} {{ $d->utilisateur->prenom }}</span>
                </td>
                <td style="padding: 18px;">
                    <span class="badge disponible" style="text-transform: none;">{{ $d->ressource->nom }}</span>
                </td>
                <td style="padding: 18px;">
                    <div style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.4;">
                        {{ $d->justification }}
                    </div>
                </td>
                <td style="padding: 18px;">
                    <form action="{{ route('responsable.decider', $d->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 10px;">
                        @csrf
                        <input type="text" name="justification" placeholder="Note ou motif..." required 
                               style="background: rgba(255,255,255,0.05); border: 1px solid var(--border-glass); color: white; border-radius: 8px; padding: 8px 12px; font-size: 0.85rem;">
                        
                        <div class="action-group" style="display: flex; gap: 6px;">
                            <button type="submit" name="action" value="approuver" class="btn-action btn-approve" style="flex: 1; justify-content: center;">
                                ✅ Approuver
                            </button>

                            <button type="submit" name="action" value="planifier" class="btn-action btn-toggle-on" style="flex: 1; justify-content: center; border-color: var(--accent);">
                                📅 Planifier
                            </button>

                            <button type="submit" name="action" value="refuser" class="btn-action btn-reject" style="flex: 1; justify-content: center;">
                                ❌ Refuser
                            </button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
            @if($demandes->isEmpty())
            <tr>
                <td colspan="4" style="text-align: center; padding: 40px; color: var(--text-muted);">
                    Aucune demande en attente pour le moment.
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

    <div class="card" style="border-top: 5px solid var(--warning);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="color: var(--warning); margin: 0; display: flex; align-items: center; gap: 10px;">
            <span>🛡️</span> Modération & Alertes Problèmes Réservations
        </h3>
        <span style="font-size: 0.8rem; color: var(--text-muted);">Contrôle des problèmes signalés par les utilisateurs</span>
    </div>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 2px solid var(--border-glass);">
                <th style="padding: 12px; color: var(--text-muted); font-size: 0.8rem;">Ressource</th>
                <th style="padding: 12px; color: var(--text-muted); font-size: 0.8rem;">Utilisateur</th>
                <th style="padding: 12px; color: var(--text-muted); font-size: 0.8rem;">Problème signalé</th>
                <th style="padding: 12px; color: var(--text-muted); font-size: 0.8rem; text-align: center;">Action / Réponse</th>
            </tr>
        </thead>
        <tbody>
            @forelse($signalements as $s)
                <tr style="border-bottom: 1px solid var(--border-glass); transition: background 0.3s;" 
                    onmouseover="this.style.background='rgba(255,255,255,0.02)'" 
                    onmouseout="this.style.background='transparent'">
                    
                    <!-- Nom de la ressource -->
                    <td style="padding: 15px;">
                        <span style="color: var(--accent); font-weight: 600;">{{ $s->ressource->nom }}</span>
                    </td>

                    <!-- Utilisateur qui a signalé -->
                    <td style="padding: 15px;">
                        <span style="font-size: 0.9rem;">{{ $s->utilisateur->prenom ?? 'Utilisateur' }}</span>
                    </td>

                    <!-- Description du problème -->
                    <td style="padding: 15px;">
                        <div style="background: rgba(0,0,0,0.2); padding: 8px 12px; border-radius: 8px; font-size: 0.9rem; border-left: 3px solid var(--warning);">
                            {{ $s->problem }}
                        </div>
                    </td>

                    <!-- Réponse / Action du responsable -->
                    <td style="padding: 15px; text-align: center;">
                        @if($s->reponse)
                            <!-- Si le responsable a déjà répondu -->
                            <div style="background: rgba(34,197,94,0.2); color: #22c55e; padding: 6px 10px; border-radius: 6px; font-size: 0.85rem;">
                                ✅ Répondu : {{ $s->reponse }}
                            </div>
                        @else
                            <!-- Formulaire de réponse -->
                            <form action="{{ route('responsable.repondreSignal', $s->id) }}" method="POST" style="display:flex; gap:5px;">
                                @csrf
                                <input type="text" name="reponse" placeholder="Réponse du responsable" required
                                       style="flex-grow:1; padding:5px; border:1px solid #ccc; border-radius:4px; font-size:0.85rem;">
                                <button type="submit" style="background:#10b981; color:white; border:none; padding:5px 10px; border-radius:4px; font-size:0.85rem; cursor:pointer;">
                                    Répondre
                                </button>
                            </form>
                        @endif

                        <!-- Bouton supprimer signalement -->
                        <form action="{{ route('responsable.moderation', $s->id) }}" method="POST" 
                              onsubmit="return confirm('Supprimer ce signalement définitivement ?')" style="margin-top:5px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-reject" style="width: 100%; justify-content: center;">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="padding: 40px; text-align: center; color: var(--text-muted); font-style: italic;">
                        ✨ Aucun problème signalé pour le moment.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>