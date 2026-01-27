<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Espace Utilisateur Interne</title>

   <style>
    /* Reset général */
     * {
           box-sizing: border-box; 
           margin: 0;
           padding: 0;
       }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: linear-gradient(135deg, #f8fafc, #82ace2); 
             color: #362f71;
            line-height: 1.6;
        }


        .container {
           max-width: 1400px; 
           margin: 0 auto;
           padding: 20px 40px; 
       }

        /*header */
        header {
            background: linear-gradient(135deg, #1e40af, #3b82f6); 
            color: white;
            padding: 3rem 2rem;
            text-align: center;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); 
            margin-bottom: 2rem;
        }

        header h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3); 
        }

        /* Navigation */
        nav ul {
            display: flex;
            justify-content: center;
            list-style: none;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-top: 1rem;
        }
        nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            position: relative;
        }
        nav a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        /* Soulignement animé */
        nav a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: white;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        nav a:hover::after {
            width: 100%;
        }

        h2 {
            font-size: 2.2rem;
            color: #1e40af;
            border-bottom: 4px solid #3b82f6;
            padding-bottom: 0.5rem;
            margin-top: 3rem;
            margin-bottom: 1.5rem;
            text-align: left; 
            font-weight: 600;
        }


        form {
         background: white;
         padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            margin: 2rem auto;
            width: 100%;
            border: 1px solid #e5e7eb;
        }

        form label {
            display: block;
            font-weight: 600;
         margin-bottom: 0.8rem;
         color: #374151;
         font-size: 1.1rem;
        }

        form input, form select, form textarea {
            width: 100%;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: 2px solid #d1d5db;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        form input:focus, form select:focus, form textarea:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
            background: white;
        }

        button {
            background: linear-gradient(135deg, #10b981, #059669); 
            color: white;
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }


        .ressource-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
            margin: 2rem 0;
        }

        .ressource-card {
             background: white;
            border-radius: 16px;
            width: 220px;
            padding: 1.5rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }

        .ressource-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #f3f4f6;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }

        .card-header h3 {
            font-size: 1.3rem;
            color: #1e40af;
            font-weight: 700;
        }

        .code {
         background: #3b82f6;
         color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .card-body .info {
            display: flex;
            justify-content: space-between;
             margin-bottom: 0.8rem;
            font-size: 1rem;
            color: #6b7280;
        }


        table {
            width: 100%;
            margin: 2rem auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        th, td {
            padding: 1.2rem;
            text-align: center;
            border-bottom: 1px solid #f3f4f6;
        }

        th {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            color: white;
            font-weight: 700;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody tr:hover {
            background: #f8fafc;
            transition: background 0.2s ease;
        }

        .success-msg {
            background: #d1fae5;
            color: #065f46;
            padding: 1.5rem;
             border-radius: 12px;
            margin: 2rem auto;
            max-width: 800px;
         text-align: center;
            font-weight: 600;
            border: 1px solid #a7f3d0;
        }


        input:invalid, select:invalid, textarea:invalid {
            border-color: #ef4444;
        }

        input:valid, select:valid, textarea:valid {
            border-color: #10b981;
        }


        .filtrer_ressource {
            display: flex;
            gap: 1rem;
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            margin: 2rem auto;
            flex-wrap: wrap;
            justify-content: center;
            border: 1px solid #e5e7eb;
        }

        .suivi {
                background: white;
            padding: 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            margin: 2rem auto;
            border: 1px solid #e5e7eb;
        }


        details {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
            border: 1px solid #e5e7eb;
        }

        details summary {
            font-weight: 600;
            color: #1e40af;
            cursor: pointer;
        }

        details ul {
                margin-top: 1rem;
            padding-left: 1.5rem;
        }


        @media (max-width: 768px) {
            .container {
            padding: 20px 20px;
            }
            header h1 {
                font-size: 2.5rem;
         }
            nav ul {
                 flex-direction: column;
                 gap: 1rem;
         }
            .ressource-container {
                flex-direction: column;
                align-items: center;
            }
            .filtrer_ressource, .suivi {
                flex-direction: column;
            }
            table {
                font-size: 0.9rem;
                }
             th, td {
                 padding: 0.8rem;
            }
            form {
                padding: 2rem;
            }
   
        }
   </style>
    

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


</body>
</html>