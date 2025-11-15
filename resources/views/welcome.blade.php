{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app')

@section('title', 'Exam Seating Management — Welcome')

@push('head')
<style>
  /* ===== Theme polish ===== */
  :root{
    --brand:#0b5ed7;           /* Primary */
    --brand-2:#37b24d;         /* Accent */
    --ink:#0f172a;             /* Headlines */
    --muted:#5b6777;           /* Body text */
    --bg:#f7f9fc;              /* Page bg (from layout) */
    --card:#ffffff;            /* Card bg */
    --divider:#eef2f7;
    --grad-1: linear-gradient(120deg,#f6faff 0%,#eef6ff 40%,#e6f7ff 100%);
    --grad-hero: radial-gradient(1200px 600px at 20% -10%, #dcebff 0%, rgba(220,235,255,0) 60%),
                 radial-gradient(900px 500px at 90% -20%, #eafaf4 0%, rgba(234,250,244,0) 55%);
  }

  /* ===== Utilities / Animations ===== */
  .btn-wow{
    transform: translateY(0);
    transition: transform .2s ease, box-shadow .2s ease, background .2s ease, border-color .2s ease;
    box-shadow: 0 10px 20px rgba(11,94,215,.12);
  }
  .btn-wow:hover{
    transform: translateY(-2px);
    box-shadow: 0 14px 28px rgba(11,94,215,.18);
  }
  .btn-outline-brand.btn-wow{
    box-shadow:none;
  }

  .tile{
    background: var(--card);
    border:1px solid var(--divider);
    border-radius: 16px;
    padding: 1.1rem;
    transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    box-shadow: 0 6px 18px rgba(16,24,40,.04);
  }
  .tile:hover{
    transform: translateY(-6px);
    border-color: rgba(11,94,215,.22);
    box-shadow: 0 16px 32px rgba(16,24,40,.10);
  }

  .feature-icon{
    width: 48px; height: 48px; border-radius: 14px;
    display:grid; place-items:center;
    background: #eaf2ff; color: var(--brand); font-size: 1.25rem;
  }

  .hero{
    background: var(--grad-hero), var(--grad-1);
    border-bottom: 1px solid var(--divider);
    position: relative; overflow: hidden;
  }
  .hero-badge{
    display:inline-flex; align-items:center; gap:.5rem;
    background: rgba(255,255,255,.7);
    border:1px solid #e7eef9;
    padding:.4rem .75rem; border-radius:999px;
    backdrop-filter: blur(6px);
    font-weight:600; color:#0b5ed7;
  }

  .kpi{
    display:flex; flex-direction:column; align-items:center; justify-content:center;
  }
  .kpi .num{ font-weight:800; letter-spacing:-.02em; color:var(--ink); font-size:clamp(1.25rem, 2.6vw, 1.7rem);}
  .kpi .lbl{ font-size:.85rem; color:#6a7686;}

  /* Animated pulse dot (live) */
  .pulse-dot{
    width:10px;height:10px;border-radius:999px;background:#20c997; position:relative;
  }
  .pulse-dot::after{
    content:''; position:absolute; inset:-6px; border-radius:999px;
    border:2px solid rgba(32,201,151,.5); animation:pulse 1.8s ease-out infinite;
  }
  @keyframes pulse{
    0%{ transform:scale(.4); opacity:.9; }
    90%{ transform:scale(1.5); opacity:0; }
    100%{ transform:scale(1.5); opacity:0; }
  }

  /* Seat grid illustration */
  .seat-grid{
    display:grid; grid-template-columns: repeat(8, 18px); gap:8px; justify-content:center;
  }
  .seat{
    width:18px;height:18px;border-radius:4px;background:#eaf2ff; border:1px solid #cfe1ff;
    transition: transform .2s ease, background .2s ease, border-color .2s ease;
  }
  .seat:nth-child(4n){ background:#eafaf4; border-color:#c9f0e1; }
  .seat:hover{ transform: translateY(-3px); background:#e1edff; border-color:#b8d6ff; }

  /* Glass cards */
  .glass{
    background: rgba(255,255,255,.7); backdrop-filter: blur(10px);
    border:1px solid rgba(231, 238, 249, .8); border-radius:16px;
    box-shadow: 0 10px 30px rgba(16,24,40,.08);
  }

  /* Marquee */
  .marquee{
    white-space:nowrap; overflow:hidden; border:1px solid var(--divider);
    background:#fff; border-radius:12px; padding:.55rem .75rem;
  }
  .marquee span{
    display:inline-block; padding-right:2rem; animation:scroll 22s linear infinite;
    color:#3a4a60; font-weight:600;
  }
  @keyframes scroll{
    from{ transform:translateX(0); }
    to{ transform:translateX(-50%); }
  }

  /* Section spacing */
  .section-title{
    color:var(--ink); font-weight:800; letter-spacing:-.01em;
  }

  /* Scroll reveal (tiny) */
  .reveal{ opacity:0; transform: translateY(16px); transition: .6s ease; }
  .reveal.show{ opacity:1; transform:none; }

  /* Small hover for hero CTAs */
  .hero-cta .btn{ border-radius:12px; padding:.75rem 1.15rem; }
</style>
@endpush

@section('content')

  {{-- HERO --}}
  <section class="hero py-5 py-lg-6">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-lg-7">
          <span class="hero-badge">
            <i class="bi bi-stars"></i>
            Seamless Exam Seating
            <span class="pulse-dot ms-1"></span>
          </span>

          <h1 class="display-5 fw-800 mt-3 mb-2" style="color:var(--ink); letter-spacing:-.02em;">
            Plan exam seating in minutes—beautifully.
          </h1>
          <p class="lead mb-4" style="color:#475569;">
            Import data, generate smart placements, and print room sheets in one click.
          </p>

          <div class="d-flex flex-wrap gap-2 hero-cta">
            @if (Route::has('login'))
              @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-brand btn-lg btn-wow">
                  <i class="bi bi-lightning-charge-fill me-1"></i> Go to Dashboard
                </a>
              @else
                <a href="{{ route('login') }}" class="btn btn-brand btn-lg btn-wow">
                  <i class="bi bi-rocket-takeoff-fill me-1"></i> Get Started
                </a>
                @if (Route::has('register'))
                  <a href="{{ route('register') }}" class="btn btn-outline-brand btn-lg btn-wow">
                    Create Account
                  </a>
                @endif
              @endauth
            @endif
          </div>

          <div class="row mt-4 g-3">
            <div class="col-4">
              <div class="tile text-center py-3">
                <div class="kpi">
                  <div class="num">12</div>
                  <div class="lbl">Rooms</div>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="tile text-center py-3">
                <div class="kpi">
                  <div class="num">486</div>
                  <div class="lbl">Students</div>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="tile text-center py-3">
                <div class="kpi">
                  <div class="num">3</div>
                  <div class="lbl">Active Plans</div>
                </div>
              </div>
            </div>
          </div>

          <div class="marquee mt-4">
            <span><i class="bi bi-check-circle-fill text-success me-1"></i> Capacity-aware allocation</span>
            <span><i class="bi bi-check-circle-fill text-success me-1"></i> Neighbour rules</span>
            <span><i class="bi bi-check-circle-fill text-success me-1"></i> One-click PDFs</span>
            <span><i class="bi bi-check-circle-fill text-success me-1"></i> Role-based access</span>
            <span><i class="bi bi-check-circle-fill text-success me-1"></i> CSV import/export</span>
            <span><i class="bi bi-check-circle-fill text-success me-1"></i> Live dashboard</span>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="glass p-4">
            <div class="d-flex align-items-center mb-3">
              <div class="feature-icon me-2"><i class="bi bi-grid-3x3-gap-fill"></i></div>
              <div>
                <div class="fw-semibold text-dark">Seat Layout Preview</div>
                <div class="small text-muted">Illustrative arrangement</div>
              </div>
            </div>
            <div class="seat-grid my-3">
              @for($i=0;$i<72;$i++)
                <div class="seat"></div>
              @endfor
            </div>
            <div class="d-flex gap-2 mt-3">
              <span class="badge rounded-pill text-bg-light border"><i class="bi bi-shield-check me-1 text-success"></i> Validated</span>
              <span class="badge rounded-pill text-bg-light border"><i class="bi bi-filetype-pdf me-1 text-danger"></i> PDF Ready</span>
              <span class="badge rounded-pill text-bg-light border"><i class="bi bi-clock-history me-1 text-primary"></i> Real-time</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- FEATURE STRIP (short & punchy) --}}
  <section class="py-5">
    <div class="container">
      <h2 class="section-title mb-4">Fast, focused tools</h2>
      <div class="row g-3 g-lg-4">
        <div class="col-6 col-md-3">
          <div class="tile h-100 text-center p-3 reveal">
            <div class="feature-icon mx-auto mb-2"><i class="bi bi-upload"></i></div>
            <div class="fw-semibold text-dark">CSV Import</div>
            <div class="small text-muted">Students & Rooms</div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="tile h-100 text-center p-3 reveal" style="transition-delay:.08s">
            <div class="feature-icon mx-auto mb-2"><i class="bi bi-cpu"></i></div>
            <div class="fw-semibold text-dark">Auto Allocate</div>
            <div class="small text-muted">Capacity + Neighbours</div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="tile h-100 text-center p-3 reveal" style="transition-delay:.16s">
            <div class="feature-icon mx-auto mb-2"><i class="bi bi-arrow-left-right"></i></div>
            <div class="fw-semibold text-dark">Smart Swap</div>
            <div class="small text-muted">Safe re-validation</div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="tile h-100 text-center p-3 reveal" style="transition-delay:.24s">
            <div class="feature-icon mx-auto mb-2"><i class="bi bi-filetype-pdf"></i></div>
            <div class="fw-semibold text-dark">Print-Ready</div>
            <div class="small text-muted">Room sheets & slips</div>
          </div>
        </div>
      </div>

      <div class="text-center mt-4">
        @if (Route::has('login'))
          @auth
            <a href="{{ url('/dashboard') }}" class="btn btn-brand btn-lg btn-wow">
              <i class="bi bi-plus-circle me-1"></i> Create Seating Plan
            </a>
          @else
            <a href="{{ route('login') }}" class="btn btn-brand btn-lg btn-wow me-2">
              <i class="bi bi-box-arrow-in-right me-1"></i> Login
            </a>
            @if (Route::has('register'))
              <a href="{{ route('register') }}" class="btn btn-outline-brand btn-lg btn-wow">
                Register
              </a>
            @endif
          @endauth
        @endif
      </div>
    </div>
  </section>
@endsection

@push('scripts')
<script>
  // tiny scroll reveal
  const els = document.querySelectorAll('.reveal');
  const io = new IntersectionObserver((entries)=>{
    entries.forEach(e => { if(e.isIntersecting){ e.target.classList.add('show'); io.unobserve(e.target); }});
  }, { threshold:.2 });
  els.forEach(el => io.observe(el));
</script>
@endpush
