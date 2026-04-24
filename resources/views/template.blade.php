<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>TechFinder</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

  {{-- ✅ Bootstrap Icons pour les icônes des toasts --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet"/>

  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;600;800&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --primary: #0a0a0a;
      --accent: #00e5ff;
      --accent2: #ff3c6f;
      --bg: #f4f1eb;
      --nav-bg: #0a0a0a;
      --text: #0a0a0a;
      --muted: #666;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Syne', sans-serif;
      background-color: var(--bg);
      color: var(--text);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .navbar-custom {
      background-color: var(--nav-bg);
      padding: 0;
      border-bottom: 3px solid var(--accent);
    }

    .navbar-brand-custom {
      font-family: 'Space Mono', monospace;
      font-weight: 700;
      font-size: 1.2rem;
      color: var(--accent) !important;
      letter-spacing: -0.03em;
      padding: 0.9rem 1.5rem;
      border-right: 1px solid #222;
      text-decoration: none;
      transition: background 0.2s;
    }
    .navbar-brand-custom:hover { background: #111; }

    .nav-links {
      display: flex;
      list-style: none;
      margin: 0;
      padding: 0;
      flex: 1;
    }

    .nav-links li a {
      display: block;
      color: #ccc;
      text-decoration: none;
      font-size: 0.82rem;
      font-weight: 600;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      padding: 1rem 1.2rem;
      border-right: 1px solid #222;
      transition: color 0.2s, background 0.2s;
    }
    .nav-links li a:hover {
      color: #fff;
      background: #111;
    }

    .btn-connexion {
      font-family: 'Space Mono', monospace;
      font-size: 0.78rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--primary);
      background: var(--accent);
      border: none;
      padding: 0.9rem 1.5rem;
      border-left: 1px solid #222;
      cursor: pointer;
      transition: background 0.2s, color 0.2s;
      text-decoration: none;
      margin-left: auto;
    }
    .btn-connexion:hover {
      background: var(--accent2);
      color: #fff;
    }

    .main-content {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
      padding: 4rem 2rem;
    }

    .main-content::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(0,0,0,0.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,0,0,0.06) 1px, transparent 1px);
      background-size: 40px 40px;
      pointer-events: none;
    }

    .welcome-block {
      position: relative;
      text-align: center;
      z-index: 1;
    }

    .welcome-label {
      font-family: 'Space Mono', monospace;
      font-size: 0.7rem;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 1rem;
    }

    .welcome-title {
      font-family: 'Syne', sans-serif;
      font-size: clamp(4rem, 12vw, 9rem);
      font-weight: 800;
      line-height: 1;
      letter-spacing: -0.04em;
      color: var(--primary);
      position: relative;
    }

    .welcome-title span {
      position: relative;
      display: inline-block;
    }

    .welcome-title span::after {
      content: '';
      display: block;
      height: 6px;
      background: var(--accent);
      width: 100%;
      margin-top: 0.2em;
      transform: scaleX(0);
      transform-origin: left;
      animation: lineReveal 0.8s 0.5s cubic-bezier(.16,1,.3,1) forwards;
    }

    @keyframes lineReveal {
      to { transform: scaleX(1); }
    }

    .welcome-sub {
      margin-top: 1.5rem;
      font-size: 0.95rem;
      color: var(--muted);
      letter-spacing: 0.02em;
    }

    .corner {
      position: absolute;
      width: 20px;
      height: 20px;
      border-color: var(--accent);
      border-style: solid;
      opacity: 0.5;
    }
    .corner-tl { top: 1.5rem; left: 1.5rem; border-width: 2px 0 0 2px; }
    .corner-tr { top: 1.5rem; right: 1.5rem; border-width: 2px 2px 0 0; }
    .corner-bl { bottom: 4rem; left: 1.5rem; border-width: 0 0 2px 2px; }
    .corner-br { bottom: 4rem; right: 1.5rem; border-width: 0 2px 2px 0; }

    .welcome-block {
      animation: fadeUp 0.7s cubic-bezier(.16,1,.3,1) both;
    }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    footer {
      background-color: var(--nav-bg);
      border-top: 2px solid #1a1a1a;
      padding: 0.75rem 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .footer-left {
      font-family: 'Space Mono', monospace;
      font-size: 0.75rem;
      color: var(--accent);
      letter-spacing: 0.1em;
      text-transform: uppercase;
    }

    .footer-right {
      font-family: 'Space Mono', monospace;
      font-size: 0.75rem;
      color: #555;
      letter-spacing: 0.05em;
    }

    @media (max-width: 640px) {
      .nav-links li a { padding: 0.8rem 0.7rem; font-size: 0.72rem; }
      .btn-connexion { padding: 0.8rem 1rem; font-size: 0.72rem; }
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar-custom d-flex align-items-stretch">
    <a href="#" class="navbar-brand-custom">TechFinder</a>
    <ul class="nav-links">
      <li><a href="/web/competences">Competences</a></li>
      <li><a href="/web/utilisateurs">Users</a></li>
      <li><a href="#">Informations</a></li>
      <li><a href="#">Us-Con</a></li>
    </ul>
    <a href="#" class="btn-connexion">Connexion</a>
  </nav>

  @yield('main')

  <!-- FOOTER -->
  <footer>
    <span class="footer-left">3il 3</span>
    <span class="footer-right">© 2026</span>
  </footer>

  {{-- ✅ Conteneur Toast --}}
  <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999">

    @if(session('success'))
      <div class="toast align-items-center text-bg-success border-0 show" role="alert">
        <div class="d-flex">
          <div class="toast-body">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto"
                  data-bs-dismiss="toast"></button>
        </div>
      </div>
    @endif

    @if(session('error'))
      <div class="toast align-items-center text-bg-danger border-0 show" role="alert">
        <div class="d-flex">
          <div class="toast-body">
            <i class="bi bi-x-circle me-2"></i>
            {{ session('error') }}
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto"
                  data-bs-dismiss="toast"></button>
        </div>
      </div>
    @endif

    @if(session('warning'))
      <div class="toast align-items-center text-bg-warning border-0 show" role="alert">
        <div class="d-flex">
          <div class="toast-body">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('warning') }}
          </div>
          <button type="button" class="btn-close me-2 m-auto"
                  data-bs-dismiss="toast"></button>
        </div>
      </div>
    @endif

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  {{-- ✅ Script disparition automatique après 4 secondes --}}
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toast').forEach(function (toastEl) {
            // ✅ Initialisation Bootstrap obligatoire
            const toast = new bootstrap.Toast(toastEl, {
                autohide: true,
                delay: 4000
            });
            toast.show();
        });
    });
</script>

</body>
</html>
