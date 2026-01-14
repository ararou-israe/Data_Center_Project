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
            <li><a href="#"><i class="fa-solid fa-calendar-check"></i> Demandes (5)</a></li>
            <li><a href="#"><i class="fa-solid fa-tools"></i> Maintenance</a></li>
        </ul>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-logout">Déconnexion</button>
        </form>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Tableau de bord Responsable</h1>
            <span style="color: #718096;">{{ date('d/m/Y') }}</span>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <h3>Ressources supervisées</h3>
                <div class="value">24</div>
            </div>
            <div class="stat-card" style="border-left-color: #ed8936;">
                <h3>Demandes en attente</h3>
                <div class="value">05</div>
            </div>
            <div class="stat-card" style="border-left-color: #48bb78;">
                <h3>Réservations Actives</h3>
                <div class="value">12</div>
            </div>
        </div>

        <div class="data-table-container">
            <h2>Dernières demandes de réservation</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Type</th>
                        <th>Ressource</th>
                        <th>Période</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Saad Ararou</strong><br><small>Doctorant</small></td>
                        <td>Machine Virtuelle</td>
                        <td>VM-Pro-02</td>
                        <td>14 Jan - 20 Jan</td>
                        <td>
                            <button class="btn btn-approve">Approuver</button>
                            <button class="btn btn-reject">Refuser</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    

</body>
</html>
