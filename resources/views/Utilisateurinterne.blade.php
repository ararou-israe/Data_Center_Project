<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Espace Utilisateur Interne</title>
    <link rel="stylesheet" href="{{ asset('css/utilisateurinterne.css') }}">    

</head>

<body>
    

    <header>
    

     <h1>Réservation de Ressources Informatiques</h1>
       <nav>
        <ul>
           <li><a href="#ressources-disponibles">ressources disponibles</a></li>
           <li><a href="#Formulaire-réservation">Formulaire de réservation</a></li>
           <li><a href="#Suivi-réservations">Suivi de mes réservations</a></li>
    
           <li><a href="#signal">Signaler un problème</a></li>
     
           <li><a href="#informations">Informations importatntes</a></li>
        </ul>
      </nav>
    </header>
<div class="container">

  @if ($errors->has('dates'))
       <div style="background:#fee2e2;color:#991b1b;padding:15px;border-radius:10px;margin-bottom:20px;">
          {{ $errors->first('dates') }}
      </div>
   @endif

    @if(session('success'))
        <div class="success-msg">{{ session('success') }}</div>
    @endif



    <h2 id="ressources-disponibles">Ressources disponibles</h2>

    <div>
        <form method="GET" action="{{ route('utilisateur.dashboard') }}" class="filtrer_ressource" >
             <input type="text" name="search" placeholder="entrer le nom de ressource" value="{{ request('search') }}">
            <button type="submit">filtrer</button>

            @if(request('search'))
             <a href="{{ route('utilisateur.dashboard') }}" style="text-decoration: none; background: #95a5a6; color: white; padding: 10px 15px; border-radius: 5px;">
                Effacer
             </a>
         @endif
     </form>
    </div>
    <div class="ressource-container">
        @if(count($ressources) > 0)
            @foreach($ressources as $row)
                <div class="ressource-card">
                    <div class="card-header">
                        <h3>{{ $row->nom }}</h3>
                        <span class="code">{{ $row->code }}</span>
                    </div>

                    <div class="card-body">
                     @if($row->cpu)
                        <div class="info">
                            <span>CPU:</span>
                            <span>{{ $row->cpu }}</span>
                        </div>
                    @endif

                    @if($row->ram)
                        <div class="info">
                            <span>RAM:</span>
                            <span>{{ $row->ram }} GB</span>
                        </div>
                    @endif

                   @if($row->storage)
                       <div class="info">
                          <span>Stockage:</span>
                          <span>{{ $row->storage }} GB</span>
                        </div>
                    @endif

                   @if($row->bande_passante)
                       <div class="info">
                           <span>Bande passante:</span>
                           <span>{{ $row->bande_passante }} Mbps</span>
                      </div>
                   @endif

                   @if($row->type_stockage)
                       <div class="info">
                          <span>Type stockage:</span>
                          <span>{{ $row->type_stockage }}</span>
                       </div>
                    @endif

                   @if($row->os)
                       <div class="info">
                           <span>OS:</span>
                          <span>{{ $row->os }}</span>
                      </div>
                   @endif

                   @if($row->emplacement)
                        <div class="info">
                           <span>Emplacement:</span>
                           <span>{{ $row->emplacement }}</span>
                      </div>
                 
                    @endif
                </div>
            </div>
       @endforeach
        @else
            <div style="background:#fff3cd;padding:15px;border-radius:10px;">
             Aucune ressource disponible trouvée.
            </div>
        @endif
    </div>

    <h2 id="Formulaire-réservation">Formulaire de réservation</h2>

    <form method="POST" action="{{ route('reservation.store') }}">
        @csrf

        <label>Choisir une ressource</label>
        <select name="ressource_id" required>
            <option value="">-- Sélectionner --</option>
            @foreach($ressources as $row)
                <option value="{{ $row->id }}">{{ $row->nom }} - {{ $row->code }}</option>
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

    <h2 id="Suivi-réservations">Suivi de mes réservations</h2>
    <div class="suivi">


        <form method="GET" action="{{ route('utilisateur.dashboard') }}" style="display: flex; gap: 10px; flex-wrap: wrap; box-shadow: none; width: 100%; padding:0; margin:0;">
            <input type="text" name="filter_ressource" placeholder="Nom de la ressource..." value="{{ request('filter_ressource') }}" style="flex: 1; ">
        
            <select name="filter_status" style="flex: 1; margin: 0;">
                    <option value="">Tous les états</option>
                    <option value="En attente" {{ request('filter_status') == 'En attente' ? 'selected' : '' }}>En attente</option>
                    <option value="Approuvée" {{ request('filter_status') == 'Approuvée' ? 'selected' : '' }}>Approuvée</option>
                    <option value="Refusée" {{ request('filter_status') == 'Refusée' ? 'selected' : '' }}>Refusée</option>
            </select>

            <input type="date" name="filter_date" value="{{ request('filter_date') }}" style="flex: 1; margin: 0;">
            <input type="date" name="filter_date_fin" value="{{ request('filter_date_fin') }}" style="flex: 1; margin: 0;">

            <button type="submit" style="margin: 0;">Filtrer l'historique</button>
            <a href="{{ route('utilisateur.dashboard') }}" style="padding: 10px; color: #666;">Réinitialiser</a>
        </form>


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
    </div>
    <h2 id="signal">Signaler un problème</h2>

    <form method="POST" action="{{ route('sigProb.store') }}">
        @csrf

        <label>Sélectionnez la ressource (optionnel)</label>
        <select name="ressource_id">
            <option value="">-- Aucune --</option>
            @foreach($ressources as $row)
                <option value="{{ $row->id }}">{{ $row->nom }} - {{ $row->code }}</option>
            @endforeach
        </select>

        <label>Votre Problème</label>
            <textarea name="problem" placeholder="Entrez votre problème..." required></textarea>

        <button type="submit">Signaler</button>

        <h2 id="suivi-signalements">Suivi de mes signalements</h2>


     <table>
            <thead>
             <tr>
                    <th>Ressource</th>
                    <th>Problème</th>
                    <th>Réponse</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @if($sigProbs->count() > 0)
                    @foreach($sigProbs as $sig)
                        <tr>
                            <td>{{ $sig->ressource ? $sig->ressource->nom : 'Général' }}</td>
                            <td>{{ Str::limit($sig->problem, 50) }}</td>
                            <td>{{ $sig->reponse ? $sig->reponse : 'En attente' }}</td>
                            <td>{{ $sig->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">Aucun signalement trouvé.</td>
                    </tr>
                @endif
            </tbody>
        </table>

    </form>

    <h2 id="informations">Informations importantes</h2>
    <details>
        <summary>Politique de réservation</summary>
        <ul>
            <li>Les réservations doivent être faites au moins 24h à l'avance</li>
            <li>Durée maximale : 14 jours</li>
            <li>Annulation possible jusqu'à 6h avant le début</li>
        </ul>
    </details>

</div>
    <footer>
        <address >
            <h3>Contact</h3>
            <p>Département Data</p>    

            <p>Téléphone: <a href="tel:+2120666123456">+212(0)666123456</a></p>
            <p>administrateur : <a href="mailto:saad.med@example.com">saad.med@example.com</a></p>
            
        </address>
        <p>&copy; 2025 Data Center. Tous droits réservés.</p>
    </footer>
</body>


</html>