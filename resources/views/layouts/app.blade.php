
<!--Main Nav bar system settings-->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title', 'ESE System')</title>

  {{-- Bootstrap & Icons --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  {{-- Fonts --}}
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    :root{
      --brand:#0b5ed7;
      --brand-2:#37b24d;
      --ink:#0f172a;
      --muted:#5b6777;
      --bg:#f7f9fc;
      --card:#ffffff;
      --pill:#e7f1ff;
      --divider:#eef2f7;
      --gradient: linear-gradient(180deg, #f9fbff 0%, #f2f6ff 100%);
    }
    html,body{ height:100%; background: var(--bg); color: var(--muted); font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, sans-serif; }
    .navbar-brand b{ color: var(--ink); }
    .hero{
      background: var(--gradient);
      border-bottom: 1px solid var(--divider);
    }
    .hero .display-5{
      color: var(--ink);
      font-weight: 800;
      letter-spacing: -0.02em;
    }
    .lead{ color: #445065; }
    .btn-brand{ background: var(--brand); border-color: var(--brand); }
    .btn-brand:hover{ background:#094cb2; border-color:#094cb2; }
    .btn-outline-brand{ border-color: var(--brand); color: var(--brand); background: #fff; }
    .btn-outline-brand:hover{ background: var(--brand); color:#fff; }
    .btn-wow{
      box-shadow: 0 6px 18px rgba(11,94,215,.12);
      transition: transform .18s ease, box-shadow .18s ease, background .18s ease, border-color .18s ease;
    }
    .btn-wow:hover{
      transform: translateY(-2px);
      box-shadow: 0 10px 26px rgba(11,94,215,.18);
    }
    .section-title{
      color: var(--ink);
      font-weight: 700;
      letter-spacing: -0.01em;
    }
    .card{
      border: 1px solid var(--divider);
      box-shadow: 0 6px 18px rgba(16,24,40,.03);
      background: var(--card);
    }
    .icon-pill{
      background: var(--pill);
      color: var(--brand);
      border-radius: 999px;
      padding: .4rem .7rem;
      font-weight: 600;
      font-size: .8rem;
    }
    .feature-icon{
      width: 44px; height: 44px; border-radius: 12px;
      display: grid; place-items: center;
      background: #eaf2ff; color: var(--brand); font-size: 1.25rem;
    }
    .step{
      display:flex; gap:.85rem; align-items:flex-start;
    }
    .step .num{
      width:34px; height:34px; border-radius:10px; display:grid; place-items:center;
      background:#eaf2ff; color:var(--brand); font-weight:700;
    }
    .list-check li{ margin:.4rem 0; }
    .list-check i{ color: var(--brand-2); margin-right:.5rem; }
    .footer{ border-top: 1px solid var(--divider); color:#6b7685; }
    .badge-soft{ background:#eef7ff; color:#0b5ed7; border:1px solid #e1efff; font-weight:600; }

    /* === Elegant Navbar Enhancements === */
    .navbar-glass{
      background: rgba(255,255,255,.82);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border: 1px solid var(--divider);
      box-shadow: 0 8px 24px rgba(16,24,40,.06);
      transition: box-shadow .25s ease, background .25s ease, transform .25s ease;
    }
    .navbar-glass.scrolled{
      background: rgba(255,255,255,.94);
      box-shadow: 0 10px 30px rgba(16,24,40,.10);
    }
    .brand-gradient{
      background: linear-gradient(90deg, #0b5ed7 0%, #5c9dff 60%, #37b24d 100%);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }
    .navbar-brand:hover{ transform: translateY(-1px); }
    .navbar .nav-link{
      position: relative; font-weight: 600; color: var(--muted); padding: .6rem .9rem;
      transition: color .2s ease;
    }
    .navbar .nav-link:hover, .navbar .nav-link:focus{ color: var(--ink); }
    .navbar .nav-link::after{
      content:""; position:absolute; left:12px; right:12px; bottom:.35rem;
      height:2px; background: var(--brand); transform: scaleX(0);
      transform-origin: left; transition: transform .25s ease; border-radius: 3px;
    }
    .navbar .nav-link:hover::after{ transform: scaleX(1); }
    .navbar .nav-link.active{ color: var(--ink); }
    .navbar .nav-link.active::after{ transform: scaleX(1); }
    .navbar-toggler{ border: 1px solid var(--divider); }
    .navbar-toggler:focus, .navbar-toggler:hover{
      box-shadow: 0 0 0 .2rem rgba(11,94,215,.15);
      border-color: #cfe2ff;
    }
    .navbar-glass:hover{ transform: translateY(-1px); }
    .badge-dot{
      display:inline-block; width:8px; height:8px; border-radius:999px; background:#37b24d; margin-left:.35rem;
      box-shadow: 0 0 0 4px #eaf7ee;
    }
  </style>

  @stack('head')
</head>
<body>

  {{-- Top Nav (Elegant) --}}
  <nav class="navbar navbar-expand-lg navbar-glass sticky-top">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <i class="bi bi-grid-3x3-gap-fill fs-5 text-primary"></i>
            <b class="brand-gradient">ESE System</b>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Minimal Clean Nav -->
        <div id="nav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto align-items-lg-center">

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-brand btn-wow me-2">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-wow">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>

                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-brand btn-wow me-2">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-brand btn-wow">
                                <i class="bi bi-person-plus-fill me-1"></i> Register
                            </a>
                        @endif
                    @endauth
                @endif

            </ul>
        </div>
    </div>
  </nav>

  {{-- Main --}}
  <main>
    @yield('content')
  </main>

  {{-- Footer --}}
  <footer class="footer bg-white py-4 mt-5">
    <div class="container d-flex flex-column flex-lg-row justify-content-between align-items-center">
      <div class="small">© {{ date('Y') }} ESE System. All rights reserved.</div>
      <div class="small"><span class="badge badge-soft rounded-pill">v1.0</span></div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  {{-- Stronger shadow after scroll --}}
  <script>
    document.addEventListener('scroll', function () {
      const nav = document.querySelector('.navbar-glass');
      if (!nav) return;
      if (window.scrollY > 8) nav.classList.add('scrolled');
      else nav.classList.remove('scrolled');
    }, { passive: true });
  </script>

  @stack('scripts')
</body>
</html>
