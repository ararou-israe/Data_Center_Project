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
        .sidebar { width: 200px; height: 100vh; background: #2d3748; color: white; position: fixed; padding: 20px; }
        .sidebar h2 { font-size: 1.2rem; margin-bottom: 30px; color: #63b3ed; text-align: center; }
        .user-info { background: #4a5568; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-size: 0.9rem; }
        .nav-links { list-style: none; }
        .nav-links li { margin-bottom: 15px; }
        .nav-links a { color: #cbd5e0; text-decoration: none; display: flex; align-items: center; gap: 10px; transition: 0.3s; }
        .nav-links a:hover { color: white; transform: translateX(5px); }
        .nav-liksthis  {background:rgb(63, 63, 63); padding: 10px; border-radius: 8px; margin-bottom: 25px; font-size: 0.9rem; }

        /* Main Content */
        .main-content { margin-left: 200px; flex: 1; padding: 30px; }
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

        /* ============================
           ✅ ADDED: Sidebar toggle UI
           (no changes to existing UI)
        ============================ */

        /* Smooth slide */
        .sidebar{
            transition: transform .25s ease;
            will-change: transform;
            z-index: 1000;
        }

        /* Hidden state */
        body.sidebar-closed .sidebar{
            transform: translateX(-220px);
        }

        /* When sidebar is hidden, main content shifts left */
        body.sidebar-closed .main-content{
            margin-left: 0;
        }

        /* Hamburger button */
        .hamburger{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            width:40px;
            height:40px;
            border:none;
            border-radius:8px;
            background:#2d3748;
            color:white;
            cursor:pointer;
        }
        .hamburger:hover{
            background:#4a5568;
        }

        /* Header left group (button + title) */
        .header-left{
            display:flex;
            align-items:center;
            gap:12px;
        }

        /* Overlay for mobile (click outside to close) */
        .overlay{
            display:none;
            position:fixed;
            inset:0;
            background: rgba(0,0,0,.35);
            z-index: 900;
        }
        body.sidebar-open-mobile .overlay{
            display:block;
        }
        body.sidebar-open-mobile .sidebar{
            transform: translateX(0);
        }

        /* Hover-open behavior on desktop only */
        @media (min-width: 901px){
            body.sidebar-closed .sidebar:hover{
                transform: translateX(0);
            }
            body.sidebar-closed .sidebar:hover ~ .main-content{
                margin-left: 200px;
            }
        }

        /* Mobile behavior */
        @media (max-width: 900px){
            .main-content{ margin-left: 0; }
            body.sidebar-closed .sidebar{ transform: translateX(-220px); }
        }

    </style>
</head>
<body >

    <!-- ✅ ADDED: overlay -->
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
            <!-- ✅ CHANGED ONLY HERE: add hamburger button -->
            <div class="header-left">
                <button class="hamburger" id="toggleSidebar" type="button" aria-label="Ouvrir/Fermer le menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h1>Gestion des ressources</h1>
            </div>

            <span style="color: #718096;">{{ date('d/m/Y') }}</span>
        </div>
  

    </div>

    <!-- ✅ ADDED: tiny JS (no libraries) -->
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
                // Desktop: toggle sidebar-closed
                if (!isMobile()) {
                    document.body.classList.toggle('sidebar-closed');
                    return;
                }

                // Mobile: use overlay mode
                if (document.body.classList.contains('sidebar-open-mobile')) {
                    closeMobile();
                } else {
                    openMobile();
                }
            });

            // Click outside (overlay) to close on mobile
            overlay.addEventListener('click', function () {
                closeMobile();
            });

            // If resizing from mobile to desktop, remove mobile state
            window.addEventListener('resize', function () {
                if (!isMobile()) {
                    document.body.classList.remove('sidebar-open-mobile');
                } else {
                    // keep closed by default on mobile
                    document.body.classList.add('sidebar-closed');
                }
            });
        })();
    </script>

</body>
</html>
