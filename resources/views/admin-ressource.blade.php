<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Responsable - DataCenter</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
    :root{
      --primary:#3b82f6;
      --accent:#22d3ee;
      --danger:#ef4444;
      --success:#22c55e;
      --warning:#f59e0b;

      --bg-main:#0b1220;
      --bg-glass:rgba(255,255,255,0.06);
      --border-glass:rgba(255,255,255,0.15);

      --text-main:#e5e7eb;
      --text-muted:#9ca3af;

      --radius:14px;
      --blur: blur(14px);
      --shadow: 0 12px 35px rgba(0,0,0,0.25);
    }

    *{ margin:0; padding:0; box-sizing:border-box; }

    body{
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display:flex;
      color:var(--text-main);
      background:
        radial-gradient(1200px 600px at 10% -10%, rgba(59,130,246,0.15), transparent),
        radial-gradient(800px 400px at 90% 10%, rgba(34,211,238,0.12), transparent),
        var(--bg-main);
    }

    /* Sidebar */
    .sidebar{
      width:200px;
      height:100vh;
      position:fixed;
      padding:20px;

      background: rgba(15,23,42,0.75);
      border-right: 1px solid var(--border-glass);
      backdrop-filter: var(--blur);
      box-shadow: 6px 0 25px rgba(0,0,0,0.25);

      transition: transform .25s ease;
      will-change: transform;
      z-index:1000;
    }

    .sidebar h2{
      font-size:1.05rem;
      margin-bottom:26px;
      text-align:center;
      font-weight:900;

      background: linear-gradient(135deg, var(--primary), var(--accent));
      -webkit-background-clip:text;
      -webkit-text-fill-color:transparent;
    }

    .user-info{
      background: linear-gradient(145deg, var(--bg-glass), rgba(255,255,255,0.02));
      border:1px solid var(--border-glass);
      padding:14px;
      border-radius: var(--radius);
      margin-bottom:20px;
      font-size:0.9rem;
      color:var(--text-main);
    }

    .nav-links{ list-style:none; }
    .nav-links li{ margin-bottom:10px; }

    .nav-links a{
      color: var(--text-muted);
      text-decoration:none;
      display:flex;
      align-items:center;
      gap:10px;
      padding:10px 10px;
      border-radius:10px;
      transition: 0.2s ease;
    }

    .nav-links a:hover{
      color: var(--text-main);
      background: rgba(255,255,255,0.06);
      transform: translateX(3px);
    }

    .nav-liksthis{
      background: rgba(255,255,255,0.06);
      border: 1px solid var(--border-glass);
      padding:10px;
      border-radius:10px;
      margin-bottom:10px;
      font-size:0.9rem;
    }

    /* Main content */
    .main-content{
      margin-left:200px;
      flex:1;
      padding:30px;
    }

    .header{
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-bottom:26px;
    }

    .header-left{
      display:flex;
      align-items:center;
      gap:12px;
    }

    .header h1{
      font-size:1.7rem;
      font-weight:900;
      letter-spacing:0.2px;
    }

    /* Stats Cards */
    .stats-container{
      display:grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap:18px;
      margin-bottom:22px;
    }

    .stat-card{
      background: linear-gradient(145deg, var(--bg-glass), rgba(255,255,255,0.02));
      border:1px solid var(--border-glass);
      backdrop-filter: var(--blur);
      box-shadow: var(--shadow);
      border-radius: var(--radius);
      padding:18px;
      border-left: 5px solid rgba(59,130,246,0.85);
    }

    .stat-card h3{
      color: var(--text-muted);
      font-size:0.75rem;
      text-transform: uppercase;
      letter-spacing:1px;
    }

    .stat-card .value{
      font-size:1.9rem;
      font-weight:900;
      color: var(--text-main);
      margin-top:10px;
    }

    .data-table-container{
  background:linear-gradient(145deg,var(--bg-glass),rgba(255,255,255,0.02));
  border:1px solid var(--border-glass);
  backdrop-filter:var(--blur);
  box-shadow:var(--shadow);
  border-radius:var(--radius);
  padding:24px;
}

.data-table-container h2{
  font-size:1.15rem;
  font-weight:900;
  margin-bottom:8px;
  color:var(--text-main);
}

.data-table{
  width:100%;
  border-collapse:separate;
  border-spacing:0 10px;
  margin-top:10px;
}

.data-table th{
  text-align:left;
  padding:12px;
  color:var(--text-muted);
  font-size:.78rem;
  text-transform:uppercase;
  letter-spacing:1px;
}

.data-table tr{
  background:linear-gradient(145deg,rgba(255,255,255,0.04),rgba(255,255,255,0.02));
  border-radius:10px;
}

.data-table td{
  padding:14px 12px;
  font-size:.95rem;
  color:var(--text-main);
  border-bottom:1px solid rgba(255,255,255,0.06);
  vertical-align:top;
}

.data-table tr td:first-child{
  border-top-left-radius:10px;
  border-bottom-left-radius:10px;
}

.data-table tr td:last-child{
  border-top-right-radius:10px;
  border-bottom-right-radius:10px;
}

.data-table tr:hover td{
  background:rgba(255,255,255,0.06);
}

.data-table small{color:var(--text-muted)}

.btn{
  padding:9px 16px;
  border-radius:10px;
  cursor:pointer;
  border:1px solid var(--border-glass);
  font-size:.85rem;
  font-weight:800;
  transition:.2s ease;
  background:rgba(255,255,255,0.06);
  color:var(--text-main);
}

.btn a{color:inherit;text-decoration:none}

.btn-reject,
.btn-danger{
  background:rgba(239,68,68,0.18);
  border-color:rgba(239,68,68,0.6);
  color:var(--danger);
}

.btn-reject:hover,
.btn-danger:hover{
  background:var(--danger);
  color:#fff;
  transform:translateY(-1px);
}

.btn-logout{
  width:100%;
  margin-top:18px;
}

.btn-logout:hover{
  background:rgba(239,68,68,0.22);
  border-color:rgba(239,68,68,0.6);
}

    /* Sidebar toggle */
    body.sidebar-closed .sidebar{
      transform: translateX(-220px);
    }
    body.sidebar-closed .main-content{
      margin-left:0;
    }

    .hamburger{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      width:42px;
      height:42px;
      border:1px solid var(--border-glass);
      border-radius:12px;
      background: rgba(255,255,255,0.06);
      color: var(--text-main);
      cursor:pointer;
      transition:0.2s ease;
    }
    .hamburger:hover{
      background: rgba(255,255,255,0.12);
      transform: translateY(-1px);
    }

    .overlay{
      display:none;
      position:fixed;
      inset:0;
      background: rgba(0,0,0,.45);
      z-index:900;
    }
    body.sidebar-open-mobile .overlay{ display:block; }
    body.sidebar-open-mobile .sidebar{ transform: translateX(0); }

    @media (min-width: 901px){
      body.sidebar-closed .sidebar:hover{ transform: translateX(0); }
      body.sidebar-closed .sidebar:hover ~ .main-content{ margin-left:200px; }
    }

    @media (max-width: 900px){
      .main-content{ margin-left:0; }
      body.sidebar-closed .sidebar{ transform: translateX(-220px); }
    }

    /* Chart canvas on dark */
    canvas{
      background: rgba(0,0,0,0.10);
      border-radius: 12px;
      border: 1px solid rgba(255,255,255,0.08);
      padding: 10px;
    }
    html, body { width: 100%; overflow-x: hidden; }

.main-content{
  width: calc(100% - 200px);  /* take exactly the remaining space */
  max-width: calc(100% - 200px);
  flex: none;                  /* don't grow beyond the screen */
}

body.sidebar-closed .main-content{
  width: 100%;
  max-width: 100%;
}
.data-table-container{
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}

.data-table{
  min-width: 1100px;
}

.data-table-container::-webkit-scrollbar{
  height: 10px;
}

.data-table-container::-webkit-scrollbar-thumb{
  background: rgba(255,255,255,0.12);
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,0.10);
}

.data-table-container::-webkit-scrollbar-track{
  background: rgba(0,0,0,0.18);
  border-radius: 999px;
}


  </style>
</head>
<body >

    
    <div class="overlay" id="overlay"></div>

    <div class="sidebar" id="sidebar">
        <h2><i class="fa-solid fa-server"></i> MGMT DataCenter</h2>
        <div class="user-info">
            <p><i class="fa-solid fa-user-tie"></i> Responsable :</p>
            <strong>{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</strong>
        </div>
        <ul class="nav-links">
            <li ><a href="{{ route('/admin/dashboard') }}"><i class="fa-solid fa-chart-line"></i> Statistiques</a></li>
            <li ><a href="{{ route('/admin/users') }}"><i class="fa-solid fa-user-tie"></i> Gère les utilisateurs</a></li>
            <li class="nav-liksthis"><a href="{{ route('/admin/ressources') }}"><i class="fa-solid fa-microchip"></i> Gère les ressources</a></li>
            <li><a href="{{ route('/admin/users') }}#Demandes"><i class="fa-solid fa-calendar-check"></i> Demandes ({{$sizedemond}})</a></li>
        </ul>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-logout">Déconnexion</button>
        </form>
    </div>

    <div class="main-content" id="mainContent">
        <div class="header">
            
            <div class="header-left">
                <button class="hamburger" id="toggleSidebar" type="button" aria-label="Ouvrir/Fermer le menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h1>Gestion des ressource</h1>
            </div>

            <span style="color: #718096;">{{ date('d/m/Y') }}</span>
        </div>
  <div class="data-table-container">
            <h2>les  ressources disponible</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>action</th>
                        <th>categorie</th>
                        <th>code</th>
                        <th>nom</th>
                        <th>etat</th>
                        <th>discription</th>
                        <th>cpu</th>
                        <th>rame</th>
                        <th>storeg</th>
                        <th>os</th>
                        <th>type_stokage</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                    </tr>

                </thead>
                <tbody>
                 @foreach($ressources_d as $p)
                     <tr>

                        <td>
                        <form action="/maintenance/{{$p->id}}" method="POST" style="display:inline;">
                          @csrf
                          @method('PUT')
                          <button type="submit" class="btn btn-approve">
                          mes en maintenance
                          </button>
                          </form>
                            <br>
                            <br>
                            <form action="/delete-user/{{$p->id}}" method="POST">
                            @csrf
                            @method('DELETE')                            
                            <button class="btn btn-reject">désactiver</button>
                            </form>

                        </td>
                        <td>{{ $p->categorie->nom ?? '' }}</td>
                        <td>{{$p->cod}}</td>
                        <td>{{$p->nom}}</td>
                        <td>{{$p->etat}}</td>
                        <td>{{$p->discription}}</td>
                        <td>{{$p->cpu}}</td>
                        <td>{{$p->rame}}</td>
                        <td>{{$p->storeg}}</td>
                        <td>{{$p->os}}</td>
                        <td>{{$p->type_stokage}}</td>
                        <td>{{$p->created_at}}</td>
                        <td>{{$p->updated_at}}</td>
                    </tr>
                 @endforeach
                </tbody>
            </table>
        </div>
     <br>
     <div class="data-table-container">
            <h2>ressources en maintenance</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>action</th>
                        <th>categorie</th>
                        <th>code</th>
                        <th>nom</th>
                        <th>etat</th>
                        <th>discription</th>
                        <th>cpu</th>
                        <th>rame</th>
                        <th>storeg</th>
                        <th>os</th>
                        <th>type_stokage</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                    </tr>

                </thead>
                <tbody>
                 @foreach($ressources_m as $p)
                     <tr>

                        <td>
                            <button class="btn btn-approve"><a href="/edit-user/{{$p->id}}">modifier</a></button>
                            <br>
                            <br>
                            <form action="/active/{{$p->id}}" method="POST" style="display:inline;">
                          @csrf
                          @method('PUT')
                          <button type="submit" class="btn btn-approve">
                          active
                          </button>
                          </form>

                        </td>
                        <td>{{ $p->categorie->nom ?? '' }}</td>
                        <td>{{$p->cod}}</td>
                        <td>{{$p->nom}}</td>
                        <td>{{$p->etat}}</td>
                        <td>{{$p->discription}}</td>
                        <td>{{$p->cpu}}</td>
                        <td>{{$p->rame}}</td>
                        <td>{{$p->storeg}}</td>
                        <td>{{$p->os}}</td>
                        <td>{{$p->type_stokage}}</td>
                        <td>{{$p->created_at}}</td>
                        <td>{{$p->updated_at}}</td>
                    </tr>
                 @endforeach
                </tbody>
            </table>
        </div>
     <br>
 
    </div>

    
    <script>
        (function () {
            const toggleBtn = document.getElementById('toggleSidebar');
            const overlay = document.getElementById('overlay');

            function isMobile() {
                return window.matchMedia('(max-width: 900px)').matches;
            }

            function openMobile() {
                document.body.classList.remove('sidebar-closed');
                document.body.classList.add('sidebar-open-mobile');
            }

            function closeMobile() {
                document.body.classList.add('sidebar-closed');
                document.body.classList.remove('sidebar-open-mobile');
            }

            toggleBtn.addEventListener('click', function () {
                
                if (!isMobile()) {
                    document.body.classList.toggle('sidebar-closed');
                    return;
                }

               
                if (document.body.classList.contains('sidebar-open-mobile')) {
                    closeMobile();
                } else {
                    openMobile();
                }
            });

            
            overlay.addEventListener('click', function () {
                closeMobile();
            });

       
            window.addEventListener('resize', function () {
                if (!isMobile()) {
                    document.body.classList.remove('sidebar-open-mobile');
                } else {
     
                    document.body.classList.add('sidebar-closed');
                }
            });
        })();
    </script>

</body>
</html>
