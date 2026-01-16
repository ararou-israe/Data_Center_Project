<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Espace Utilisateur Interne</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 20px;
        }

        h1, h2 {
            color: #2c3e50;
        }

        .ressource-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .ressource-card {
            background: white;
            border-radius: 10px;
            width: 190px;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .ressource-card:hover {
            transform: scale(1.03);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .card-header h3 {
            margin: 0;
            color: #2c3e50;
            font-size: 18px;
        }

        .code {
            background: #3498db;
            color: white;
            padding: 3px 8px;
            border-radius: 5px;
            font-size: 12px;
        }

        .card-body {
            margin-top: 10px;
        }

        .info {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
        }

        .etat {
            padding: 3px 8px;
            border-radius: 5px;
            font-size: 12px;
            color: white;
        }

        .disponible {
            background: #2ecc71;
        }

        form {
            margin-top: 30px;
            padding: 15px;
            border-radius: 10px;
            background: white;
            width: 450px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        form label {
            font-weight: bold;
        }

        form input, form select, form textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
        }

        button:hover {
            background: #2980b9;
        }

        table {
            margin-top: 30px;
            width: 100%;
            background: white;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        th {
            background: #3498db;
            color: white;
            padding: 10px;
            text-align: left;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .success-msg {
            color: green;
            margin-bottom: 20px;
        }

        .filtrer_ress {
            display: flex;
            gap: 10px;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: fit-content;
        }
    </style>
</head>

<body>

<header>
    <header>

    <h1>Réservation de Ressources Informatiques</h1>
    <nav>
    <ul>
     <li><a href="#ressources disponibles">ressources disponibles</a></li>
     <li><a href="#Formulaire de réservation">Formulaire de réservation</a></li>
        <li><a href="#Suivi de mes réservations">Suivi de mes réservations</a></li>
     <li><a href="#informations">Informations importatntes</a></li>
     <li><a href="#signal">Signaler un problème</a></li>
    </ul>
    </nav>
</header>

@if ($errors->has('dates'))
    <div style="background:#fee2e2;color:#991b1b;padding:15px;border-radius:10px;margin-bottom:20px;">
        {{ $errors->first('dates') }}
    </div>
@endif

@if(session('success'))
    <div class="success-msg">{{ session('success') }}</div>
@endif

<div>
    <form method="GET" action="{{ route('utilisateur.dashboard') }}" class="filtrer_ress">
        <input type="text" name="search" placeholder="entrer le nom de ressource" value="{{ request('search') }}">
        <button type="submit">filtrer</button>

        @if(request('search'))
            <a href="{{ route('utilisateur.dashboard') }}" style="text-decoration: none; background: #95a5a6; color: white; padding: 10px 15px; border-radius: 5px;">
                Effacer
            </a>
        @endif
    </form>
</div>

<h2 id="ressources disponibles">Ressources disponibles</h2>

<div class="ressource-container">
    @if(count($ressources) > 0)
        @foreach($ressources as $r)
            <div class="ressource-card">
                <div class="card-header">
                    <h3>{{ $r->nom }}</h3>
                    <span class="code">{{ $r->code }}</span>
                </div>

                <div class="card-body">
                    <div class="info"><span>CPU:</span><span>{{ $r->cpu }}</span></div>
                    <div class="info"><span>RAM:</span><span>{{ $r->ram }} GB</span></div>
                    <div class="info"><span>Stockage:</span><span>{{ $r->storage }} GB</span></div>
                    <div class="info"><span>OS:</span><span>{{ $r->os }}</span></div>

                    <div class="info">
                        <span>Etat:</span>
                        <span class="etat disponible">Disponible</span>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div style="background:#fff3cd;padding:15px;border-radius:10px;">
            Aucune ressource disponible trouvée.
        </div>
    @endif
</div>

<h2 id="Formulaire de réservation">Formulaire de réservation</h2>

<form method="POST" action="{{ route('reservation.store') }}">
    @csrf

    <label>Choisir une ressource</label>
    <select name="ressource_id" required>
        <option value="">-- Sélectionner --</option>
        @foreach($ressources as $r)
            <option value="{{ $r->id }}">{{ $r->nom }} - {{ $r->code }}</option>
        @endforeach
    </select>

    <label>Date début</label>
    <input type="date" name="date_debut" required>

    <label>Date fin</label>
    <input type="date" name="date_fin" required>

    <label>Projet/usage</label>
    <textarea name="justification" placeholder="Décrivez brièvement le projet ou l'usage de la ressource" required></textarea>

    <button type="submit">Envoyer la demande</button>
</form>

<h2 id="Suivi de mes réservations">Suivi de mes réservations</h2>

<table border="1">
    <thead>
        <tr>
            <th>Ressource</th>
            <th>Période</th>
            <th>Status</th>
            <th>Décision</th>
        </tr>
    </thead>

    <tbody>
        @if(count($reservations) > 0)
            @foreach($reservations as $res)
                <tr>
                    <td>{{ $res->ressource->nom }}</td>
                    <td>
                        Du {{ \Carbon\Carbon::parse($res->date_debut)->format('d/m/Y') }} <br>
                        Au {{ \Carbon\Carbon::parse($res->date_fin)->format('d/m/Y') }}
                    </td>
                    <td>{{ $res->status }}</td>
                    <td>{{ $res->decision_note ?? '---' }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4">Aucun historique trouvé</td>
            </tr>
        @endif
    </tbody>
</table>
<h2 id="signal">Signaler un problème</h2>

<h2 id="informations">Informations importantes</h2>
<details>
 <summary>Politique de réservation</summary>
 <ul>
    <li>Les réservations doivent être faites au moins 24h à l'avance</li>
    <li>Durée maximale : 14 jours</li>
    <li>Annulation possible jusqu'à 6h avant le début</li>
 </ul>
</details>


</body>
</html>