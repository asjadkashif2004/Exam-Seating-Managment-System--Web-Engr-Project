{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app')

@section('title', 'Exam Seating Management — Welcome')

@push('head')
<style>
/* ============================
   MODERN COLORFUL THEME
   ============================ */
:root {
    --brand:#7c3aed;  /* Purple main */
    --brand2:#06b6d4; /* Cyan accent */
    --brand3:#ec4899; /* Pink accent */
    --ink:#0f172a;
    --muted:#64748b;
    --card:#ffffff;
    --bg:#fafbff;
}

/* Page background with blobs */
body {
    background: var(--bg);
    position: relative;
    overflow-x: hidden;
}

.bg-blob {
    position: absolute;
    width: 480px;
    height: 480px;
    border-radius: 50%;
    filter: blur(140px);
    opacity: .6;
    z-index: -1;
}
.blob-1 { background:#c084fc; top:-120px; left:-80px; }
.blob-2 { background:#5eead4; top:220px; right:-100px; }
.blob-3 { background:#f472b6; bottom:-250px; left:30%; }

/* Floating animated shapes */
.float {
    animation: float 6s ease-in-out infinite;
}
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-18px); }
    100% { transform: translateY(0px); }
}

/* HERO */
.hero {
    padding: 7rem 0;
    position: relative;
}

/* Buttons */
.btn-brand {
    background: var(--brand);
    color:white;
    padding:.9rem 1.4rem;
    border-radius:14px;
    font-weight:600;
    box-shadow:0 14px 32px rgba(124,58,237,.25);
    transition:.25s;
}
.btn-brand:hover {
    transform: translateY(-3px);
    box-shadow:0 18px 40px rgba(124,58,237,.35);
}

.btn-outline-brand {
    border:2px solid var(--brand2);
    color: var(--brand2);
    padding:.9rem 1.4rem;
    border-radius:14px;
    font-weight:600;
    transition:.25s;
}
.btn-outline-brand:hover {
    background:var(--brand2);
    color:white;
    transform: translateY(-3px);
}

/* Illustration Card */
.illus-box {
    background:white;
    border-radius:22px;
    padding:2rem;
    box-shadow: 0 18px 40px rgba(0,0,0,.07);
}

/* Stats */
.stat-card {
    background:white;
    padding:1.2rem;
    border-radius:18px;
    box-shadow:0 10px 26px rgba(0,0,0,.06);
    text-align:center;
    border:1px solid #f1f5f9;
}
.stat-num {
    font-size:2.2rem;
    font-weight:800;
    color:var(--ink);
}
.stat-label {
    color:var(--muted);
    font-size:.9rem;
}

/* Features */
.feature-tile {
    background:white;
    padding:2rem 1.5rem;
    border-radius:20px;
    box-shadow:0 20px 40px rgba(0,0,0,.05);
    transition:.25s;
    border:1px solid #e5e7f0;
}
.feature-tile:hover {
    transform:translateY(-8px);
    box-shadow:0 30px 50px rgba(0,0,0,.10);
}
.feature-icon {
    width:70px; height:70px;
    border-radius:20px;
    background:linear-gradient(135deg,var(--brand),var(--brand3));
    display:grid; place-items:center;
    color:white; font-size:1.8rem;
    margin-bottom:1rem;
}

/* Marquee */
.marquee {
    white-space: nowrap;
    overflow:hidden;
    border-radius:16px;
    background:white;
    box-shadow:0 10px 30px rgba(0,0,0,.05);
    padding:.7rem .8rem;
    margin-top:1rem;
}
.marquee span {
    display:inline-block;
    padding-right:3rem;
    font-weight:600;
    color:#475569;
    animation:scroll 14s linear infinite;
}
@keyframes scroll {
    from { transform:translateX(0); }
    to { transform:translateX(-50%); }
}

/* Reveal */
.reveal { opacity:0; transform: translateY(30px); transition:.7s ease; }
.reveal.show { opacity:1; transform:none; }

</style>
@endpush


@section('content')

{{-- BACKGROUND BLOBS --}}
<div class="bg-blob blob-1 float"></div>
<div class="bg-blob blob-2 float"></div>
<div class="bg-blob blob-3 float"></div>



{{-- ===============================
     HERO SECTION
     =============================== --}}
<section class="hero">
    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6 reveal">
                <h1 class="display-4 fw-bold" style="color:var(--ink);line-height:1.15;">
                    Make exam seating <span style="color:var(--brand3);">beautiful,</span>
                    <br>
                    accurate & <span style="color:var(--brand2);">effortless.</span>
                </h1>

                <p class="lead mt-3" style="color:var(--muted); font-size:1.15rem;">
                    Auto-generate seat plans, allocate rooms, track students and print stunning PDF sheets —
                    all powered by a vibrant modern interface.
                </p>

                <div class="mt-4 d-flex flex-wrap gap-3">
                    @auth
                        <a href="/dashboard" class="btn-brand"><i class="bi bi-speedometer me-1"></i> Go to Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-brand"><i class="bi bi-rocket-takeoff me-1"></i> Start Now</a>
                        <a href="{{ route('register') }}" class="btn-outline-brand">Create Account</a>
                    @endauth
                </div>

                {{-- LIVE STATS --}}
                <div class="row g-3 mt-5">
                    <div class="col-4">
                        <div class="stat-card">
                            <div class="stat-num">{{ \App\Models\Room::count() }}</div>
                            <div class="stat-label">Rooms</div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="stat-card">
                            <div class="stat-num">{{ \App\Models\Student::count() }}</div>
                            <div class="stat-label">Students</div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="stat-card">
                            <div class="stat-num">{{ \App\Models\User::where('role','staff')->count() }}</div>
                            <div class="stat-label">Staff</div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- HERO ILLUSTRATION --}}
            <div class="col-lg-6 reveal">
                <div class="illus-box">
                    <img src="https://img.freepik.com/premium-vector/man-with-online-test-concept-distance-education-training-learning-student-completes-assignments-exam-knowledge-information-talented-schooler-cartoon-flat-vector-illustration_118813-16970.jpg?semt=ais_hybrid&w=740&q=80"
                         class="img-fluid float"
                         alt="Exam Seating Illustration">
                </div>
            </div>

        </div>

        {{-- MARQUEE --}}
        <div class="marquee reveal mt-4">
            <span>✨ Capacity-aware allocations</span>
            <span>🪄 Random seating generator</span>
            <span>📄 Beautiful PDF layout sheets</span>
            <span>🔍 Student search portal</span>
            <span>🎨 Clean modern UI</span>
        </div>
    </div>
</section>




{{-- ===============================
     FEATURES GRID
     =============================== --}}
<section class="py-5">
    <div class="container">

        <h2 class="fw-bold text-center mb-5 reveal" style="color:var(--ink);">
            Tools that make exam planning simple & fun
        </h2>

        <div class="row g-4">

            <div class="col-md-3">
                <div class="feature-tile reveal">
                    <div class="feature-icon"><i class="bi bi-upload"></i></div>
                    <h5>CSV Import</h5>
                    <p class="text-muted small">Upload all students & rooms in seconds.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="feature-tile reveal" style="transition-delay:.1s">
                    <div class="feature-icon"><i class="bi bi-shuffle"></i></div>
                    <h5>Random Generator</h5>
                    <p class="text-muted small">Instant shuffling with smart spacing.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="feature-tile reveal" style="transition-delay:.2s">
                    <div class="feature-icon"><i class="bi bi-search"></i></div>
                    <h5>Student Search</h5>
                    <p class="text-muted small">Let students quickly find their rooms.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="feature-tile reveal" style="transition-delay:.3s">
                    <div class="feature-icon"><i class="bi bi-filetype-pdf"></i></div>
                    <h5>PDF Export</h5>
                    <p class="text-muted small">Generate print-ready room sheets.</p>
                </div>
            </div>

        </div>

        <div class="text-center mt-5 reveal">
            @auth
                <a href="/dashboard" class="btn-brand btn-lg">
                    <i class="bi bi-plus-circle me-1"></i> Create Seating Plan
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-brand btn-lg me-2">Login</a>
                <a href="{{ route('register') }}" class="btn-outline-brand btn-lg">Register</a>
            @endauth
        </div>

    </div>
</section>


@endsection

@push('scripts')
<script>
/* Minimal reveal-on-scroll */
const reveals = document.querySelectorAll('.reveal');
const io = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{
        if(e.isIntersecting){
            e.target.classList.add('show');
            io.unobserve(e.target);
        }
    })
},{threshold:.2});
reveals.forEach(r=>io.observe(r));
</script>
@endpush
