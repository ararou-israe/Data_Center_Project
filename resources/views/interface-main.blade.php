<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>DataCenter Manager</title>

  <link rel="stylesheet" href="{{ asset('css/interface-main.css') }}">
</head>

<body>
   
<!-- ================= NAVBAR ================= -->
<header class="navbar">
  <div class="nav-inner">

    <a class="brand" href="/">
      <img src="{{ asset('images/logo.png') }}" class="logo-img">
      <span>DataCenter Manager</span>
    </a>

    <nav class="nav-links">
      <a href="#accueil">Accueil</a>
      <a href="#ressources">Ressources</a>
      <a href="#regles">Règles</a>
      <a href="#support">Support</a>
    </nav>

    <div class="nav-actions">
      <a class="btn" href="#">Se connecter</a>
      <a class="btn primary" href="#">S’inscrire</a>
    </div>

  </div>
</header>
<!-- ?????????????????????????her??????????????????????? -->
<!-- HERO SECTION (between navbar and cards) -->
<section class="hero-section">
    <!-- background effects -->
    <img class="hero-gradient" src="{{ asset('images/gradient.png') }}" alt="">
    <div class="hero-blur"></div>

    <div class="hero-inner">
        <!-- LEFT CONTENT -->
        <div class="hero-content">
            <div class="tag-box">
                <div class="tag">INTRUCTING & WEDBAR</div>
            </div>

            <h1>
                ENAIL FOR <br>
                DEVOLOPPER
            </h1>

            <p class="description">
                Consultez les ressources du Data Center,
                vérifiez la disponibilité et lancez vos demandes de réservation.
            </p>

            <a href="#" class="btn-signing-main">GET started ></a>
        </div>

        <!-- RIGHT ROBOT -->
        <spline-viewer
            class="hero-robot"
            url="https://prod.spline.design/JcIhzZR8V-9YIrHV/scene.splinecode">
        </spline-viewer>
    </div>
</section>

<script type="module" src="https://unpkg.com/@splinetool/viewer@1.12.36/build/spline-viewer.js"></script>
<!-- ================= MAIN ================= -->
<main class="wrap" id="ressources">

  <!-- ================= TABS (FIXED) ================= -->
  <div class="tabs" id="tabs">
    <button class="tab active" data-cat="serveur">Serveurs</button>
    <button class="tab" data-cat="vm">Machines virtuelles</button>
    <button class="tab" data-cat="stockage">Stockage</button>
    <button class="tab" data-cat="reseau">Équipements réseau</button>
  </div>

  <!-- ================= SLIDER ================= -->
  <section class="slider">

    <!-- LEFT ARROW -->
    <button class="nav prev" id="prev" aria-label="Previous">‹</button>

    <div class="viewport">
      <div class="track" id="track">

        @foreach($ressources as $r)
        <article class="card" data-type="{{ $r->type }}">

          <!-- CARD TOP -->
          <div class="card-top">
            <span class="code">{{ $r->code }} — {{ ucfirst($r->type) }}</span>
            <span class="badge {{ $r->etat }}">{{ ucfirst($r->etat) }}</span>

            <h3 class="card-title-top">{{ $r->nom }}</h3>

            <div class="specs">
              <span>CPU : {{ $r->cpu ?? '--' }} cores</span>
              <span>RAM : {{ $r->ram ?? '--' }} GB</span>
              <span>Stock : {{ $r->storage ?? '--' }} GB</span>
              <span>OS : {{ $r->os ?? '--' }}</span>
            </div>
          </div>

          <!-- CARD BOTTOM -->
          <div class="card-bottom">
            <h3>{{ $r->nom }}</h3>
            <p class="desc">{{ $r->description }}</p>

            <div class="card-footer">
              <button class="btn-view"><a class="ko"  href="#">View More</a></button>
            </div>
          </div>

        </article>
        @endforeach

      </div>
    </div>

    <!-- RIGHT ARROW -->
    <button class="nav next" id="next" aria-label="Next">›</button>

    <!-- DOTS (STATIC) -->
    <div class="dots">
      <span class="active"></span>
      <span></span>
      <span></span>
      <span></span>
    </div>

  </section>
</main>

<!-- ================= FOOTER (UNCHANGED) ================= -->
<footer id="onnn" class="footer">
  <div class="footer-content">
    <h2>DATA CENTER RESOURCES, BUILT FOR RELIABLE OPERATIONS</h2>

   <p> Designed for environments where performance, availability, and control matter, this platform centralizes the management of data center resources across servers,
     virtual machines, storage, and network equipment. Every component is tracked, structured, and accessible through a single, consistent interface. </p>
    <p> From academic infrastructures to professional IT environments, the system supports controlled reservation and allocation of resources based on clearly defined roles. Users request what they need.
       Administrators validate, supervise, and maintain full visibility over usage, capacity, and availability—without manual workarounds. </p> 
    <p> Built on structured data management, the platform enforces traceability at every step. Each reservation, modification, and assignment is logged,
       making resource usage transparent and auditable over time. </p>
     <p> The platform is designed to scale with real infrastructure. Whether managing a limited training lab or a multi-resource data center, it supports efficient utilization,
       reduces administrative overhead, and ensures resources are used responsibly and securely. </p>

<a href="#top" class="footer-logo-link">
  <img src="{{ asset('images/logo-noire.png') }}" class="footer-logo">
</a>

  </div>
</footer>

<div class="footer-divider"></div>

<footer class="dc-footer">
  <div class="footer-container">

    <div class="footer-column">
      <h4>RESOURCES</h4>
      <ul>
     <li><a href="#ressources" data-cat="serveur">Servers</a></li>
    <li><a href="#ressources" data-cat="vm">Virtual Machines</a></li>
    <li><a href="#ressources" data-cat="stockage">Storage</a></li>
    <li><a href="#ressources" data-cat="reseau">Network Equipment</a></li>

      </ul>
    </div>

    <div class="footer-column">
      <h4>RESERVATIONS</h4>
      <ul>
        <li><a href="#">New Reservation</a></li>
        <li><a href="#">My Reservations</a></li>
        <li><a href="#">Pending Requests</a></li>
      </ul>
    </div>

    <div class="footer-column">
      <h4>SUPPORT</h4>
      <ul>
        <li><a href="#support">Help Center</a></li>
        <li><a href="#regles">Usage Rules</a></li>
        <li><a href="#">Maintenance Calendar</a></li>
        <li><a href="#">Incident Reporting</a></li>
      </ul>
    </div>

    <div class="footer-column">
      <h4>PLATFORM</h4>
      <ul>
        <li><a href="#">About the Platform</a></li>
        <li><a href="#">User Roles & Permissions</a></li>
        <li><a href="#">Statistics & Reports</a></li>
        <li><a href="#">Security & Access Control</a></li>
      </ul>
    </div>

  </div>

  <div class="footer-bottom">
    © 2026 – Data Center Resource Management Platform
    <span>Academic Project | Laravel & MySQL</span>
  </div>
</footer>

<script src="{{ asset('js/interface-main.js') }}" defer></script>
</body>
</html>
