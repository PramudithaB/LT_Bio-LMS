<!DOCTYPE html>
<html lang="si">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LTBio - Lakshitha Thennakoon</title>
  <link rel="icon" type="image/jpeg" href="{{ asset('images/logo1.jpeg') }}" />
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

  <style>
    /* ---------------- Design tokens (Hybrid Red + Teal) ---------------- */
    :root{
      --bg-1: #f8fbfc;
      --bg-2: #f6f9fa;
      --surface: rgba(255,255,255,0.7);
      --glass: rgba(255,255,255,0.55);
      --text: #0f1720;
      --muted: #6b6f75;

      --accent-primary: #F53003;     /* red - brand */
      --accent-secondary: #17A2B8;   /* teal - bio vibe */

      --shadow-sm: 0 6px 18px rgba(11,12,16,0.06);
      --shadow-md: 0 16px 40px rgba(11,12,16,0.09);
      --shadow-strong: 0 30px 80px rgba(11,12,16,0.14);

      --radius-lg: 16px;
      --radius-md: 10px;
      --glass-blur: 10px;
      --transition: 420ms cubic-bezier(.2,.9,.3,1);
    }

    /* ---------------- Global Reset ---------------- */
    *{box-sizing:border-box; margin:0; padding:0; -webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale;}
    html,body{height:100%; font-family:'Instrument Sans', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; color:var(--text); background:linear-gradient(180deg,var(--bg-1),var(--bg-2));}
    img{display:block; max-width:100%; height:auto;}

    a{color:inherit; text-decoration:none}
    button{font-family:inherit}

    /* ---------------- Page layout ---------------- */
    nav{
      position:fixed; top:12px; left:50%; transform:translateX(-50%); width:calc(100% - 48px);
      max-width:1200px; z-index:1200;
      border-radius:12px; padding:10px 18px;
      background: linear-gradient(180deg, rgba(255,255,255,0.75), rgba(255,255,255,0.5));
      box-shadow:var(--shadow-sm);
      backdrop-filter: blur(var(--glass-blur));
      border: 1px solid rgba(11,12,16,0.04);
    }

    nav .container{display:flex; align-items:center; justify-content:space-between; gap:12px;}
    .logo{display:flex; align-items:center; gap:12px}
    .logo img{width:46px; height:46px; object-fit:cover; border-radius:50%; border:2px solid rgba(255,255,255,0.6); box-shadow:0 6px 22px rgba(23,162,184,0.07)}
    .logo span{font-weight:800; color:var(--accent-primary); font-size:1.05rem}

    nav ul{display:flex; gap:18px; align-items:center; list-style:none}
    nav ul li a{padding:8px 12px; border-radius:10px; color:var(--text); font-weight:600}
    nav ul li a:hover{background:linear-gradient(90deg, rgba(23,162,184,0.06), rgba(245,48,3,0.06)); transform:translateY(-3px); box-shadow:var(--shadow-sm)}

    /* Mobile nav fallback */
    .nav-toggle{display:none; background:none; border:0; padding:8px; cursor:pointer}
    .nav-toggle svg{display:block}

    @media (max-width:880px){
      nav{left:12px; transform:none; width:calc(100% - 24px); padding:10px}
      nav .container{gap:8px}
      nav ul{display:none} /* hidden by default on small screens */
      .nav-toggle{display:flex; align-items:center; justify-content:center}

      /* when nav has .open show vertical menu */
      nav.open ul{
        display:flex;
        flex-direction:column;
        gap:10px;
        align-items:stretch;
        position:absolute;
        left:12px;
        right:12px;
        top:calc(100% + 8px);
        background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(255,255,255,0.95));
        padding:12px;
        border-radius:12px;
        box-shadow:var(--shadow-sm);
        border: 1px solid rgba(11,12,16,0.04);
      }
      nav.open ul li a{display:block; padding:12px; border-radius:10px}
    }

    /* ---------------- Hero (3D stage) ---------------- */
    .hero{
      margin-top:96px;
      padding:56px 22px 36px;
      max-width:1200px; margin-left:auto; margin-right:auto;
      perspective:1400px;
    }
    .hero-inner{
      display:grid; grid-template-columns: 1fr 520px; gap:28px; align-items:center;
    }

    /* Left card (content) */
    .card-hero{
      background: linear-gradient(180deg, rgba(255,255,255,0.82), rgba(255,255,255,0.7));
      padding:34px; border-radius:var(--radius-lg);
      box-shadow:var(--shadow-strong);
      border:1px solid rgba(11,12,16,0.04);
      transform-style:preserve-3d;
      position:relative; overflow:visible;
    }

    .hero-subtitle{display:inline-block; font-weight:800; color:var(--accent-secondary); letter-spacing:0.12em; font-size:.78rem; margin-bottom:10px}
    .hero-title{font-size:3.2rem; font-weight:900; color:var(--accent-primary); line-height:1; margin-bottom:6px}
    .hero-name{font-size:2.1rem; font-weight:700; color:var(--text); margin-bottom:12px}
    .hero-description{color:var(--muted); font-weight:600; font-size:1.02rem; margin-bottom:18px}

    .badges{display:flex; gap:10px; margin-bottom:18px; flex-wrap:wrap}
    .badge{background:linear-gradient(180deg, rgba(23,162,184,0.06), rgba(245,48,3,0.03)); padding:8px 12px; border-radius:999px; font-weight:700; color:var(--text); box-shadow:0 10px 30px rgba(23,162,184,0.03)}

    .hero-actions{display:flex; gap:12px; align-items:center; flex-wrap:wrap}
    .btn{display:inline-flex; align-items:center; gap:10px; padding:12px 16px; border-radius:12px; font-weight:800; cursor:pointer; box-shadow:var(--shadow-md)}
    .btn-primary{background:linear-gradient(90deg,var(--accent-primary), #c21402); color:white; border: none}
    .btn-ghost{background:linear-gradient(180deg, rgba(255,255,255,0.85), rgba(255,255,255,0.68)); border:1px solid rgba(11,12,16,0.06); color:var(--text)}

    /* Right stage */
    .hero-stage{
      position:relative; border-radius:var(--radius-lg); overflow:visible;
      height:460px; display:flex; align-items:center; justify-content:center;
      background: linear-gradient(135deg, rgba(23,162,184,0.02), rgba(245,48,3,0.02));
      transform-style: preserve-3d;
      border:1px solid rgba(11,12,16,0.03);
      box-shadow: var(--shadow-md);
    }

    /* floating DNA stripe (decorative) */
    .dna-deco{
      position:absolute; left:-40px; top:20px; width:120px; height:420px; opacity:0.14; z-index:2;
      transform: translateZ(-80px) rotateZ(-6deg);
      pointer-events:none;
    }

    .hero-image-wrap{position:relative; width:420px; max-width:92%; transform-style:preserve-3d; z-index:10}
    .hero-image{
      border-radius:18px; overflow:hidden; border:6px solid rgba(255,255,255,0.6);
      box-shadow: 0 40px 120px rgba(11,12,16,0.16);
      transform: translateZ(60px);
      will-change:transform;
      background: linear-gradient(180deg,#fff,#fff5f5);
    }
    .hero-image img{display:block; width:100%; height:auto; object-fit:cover}

    .hero-bg-number{
      position:absolute; bottom:18px; left:20px; font-size:96px; font-weight:900; color:rgba(17,17,17,0.04);
      transform:translateZ(-160px);
      user-select:none;
    }

    .stats-badge{
      position:absolute; right:18px; bottom:18px; z-index:20; text-align:center;
      transform: translateZ(30px);
    }
    .stats-badge .icon{
      width:64px; height:64px; border-radius:50%; display:flex; align-items:center; justify-content:center;
      background:linear-gradient(180deg,var(--accent-primary), #b51a01); color:white; font-weight:900; box-shadow:0 18px 46px rgba(245,48,3,0.16);
    }
    .stats-badge p{color:white; margin-top:8px; font-weight:700}

    /* ---------------- Sections & cards ---------------- */
    section{max-width:1200px; margin:0 auto; padding:56px 22px}
    .section-subtitle{color:var(--accent-secondary); font-weight:800; letter-spacing:.12em; margin-bottom:8px; display:inline-block}
    .section-title{font-size:2.2rem; font-weight:900; color:var(--text); margin-bottom:16px}

    .about-content{display:grid; grid-template-columns: 1fr 420px; gap:28px; align-items:start}
    .about-text{background:linear-gradient(180deg, rgba(255,255,255,0.88), rgba(255,255,255,0.78)); padding:22px; border-radius:14px; box-shadow:var(--shadow-md); line-height:1.7; color:var(--text)}
    .about-features{display:grid; gap:14px}

    .feature-card{padding:18px; border-radius:12px; background: linear-gradient(180deg, rgba(255,255,255,0.9), rgba(255,255,255,0.75)); box-shadow:var(--shadow-sm); border-left:6px solid rgba(245,48,3,0.12); font-weight:700}

    /* institutes grid */
    .institutes-grid{display:grid; grid-template-columns: repeat(auto-fit, minmax(260px,1fr)); gap:20px}
    .institute-card{background:linear-gradient(180deg, rgba(255,255,255,0.95), rgba(255,255,255,0.85)); padding:16px; border-radius:14px; box-shadow:var(--shadow-md); transition:transform var(--transition), box-shadow var(--transition); transform-style:preserve-3d}
    .institute-card:hover{transform: translateY(-14px) rotateX(2deg); box-shadow:var(--shadow-strong)}
    .institute-image{height:160px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:52px; color:var(--accent-primary); background: linear-gradient(135deg, rgba(245,48,3,0.03), rgba(23,162,184,0.02))}

    /* results banner */
    .results-banner{background: linear-gradient(135deg,var(--accent-primary), #b71a01); color:white; padding:28px; border-radius:14px; box-shadow:0 28px 80px rgba(245,48,3,0.12); text-align:center; margin-bottom:18px}
    .results-stats{display:grid; grid-template-columns: repeat(auto-fit, minmax(180px,1fr)); gap:18px}
    .stat-card{background:white; padding:20px; border-radius:12px; text-align:center; box-shadow:var(--shadow-sm); transform: translateZ(20px)}

    .stat-number{font-size:2.2rem; font-weight:900; color:var(--accent-primary)}
    .stat-label{color:var(--muted); font-weight:700}

    /* gallery horizontal scroll */
    .gallery-grid{display:grid; grid-template-columns: repeat(auto-fit, minmax(220px,1fr)); gap:14px}
    .gallery-item{background:linear-gradient(180deg, rgba(255,255,255,0.9), rgba(255,255,255,0.8)); border-radius:12px; padding:12px; display:flex; align-items:center; justify-content:center; box-shadow:var(--shadow-sm); cursor:pointer; transition:transform var(--transition)}
    .gallery-item:hover{transform:translateY(-8px) rotateX(4deg)}

    /* feedback form */
    .feedback-panel{background:linear-gradient(180deg, rgba(255,255,255,0.95), rgba(255,255,255,0.85)); padding:18px; border-radius:12px; box-shadow:var(--shadow-md)}
    .feedback-grid{display:grid; grid-template-columns:1fr 1fr; gap:12px}
    .feedback-grid input, .feedback-grid textarea{padding:12px; border-radius:10px; border:1px solid rgba(11,12,16,0.06); background:transparent; font-weight:700}
    .feedback-grid textarea{grid-column:span 2; min-height:120px;}
    .feedback-grid button{grid-column:span 2; padding:12px; border-radius:10px; border:none; background:linear-gradient(90deg,var(--accent-primary), #b71a01); color:white; font-weight:900; cursor:pointer}

    /* footer */
    footer{background:linear-gradient(180deg,#0b0f12, #0f1417); color:rgba(255,255,255,0.9); padding:36px 22px}
    .footer-content{display:grid; grid-template-columns: repeat(auto-fit, minmax(220px,1fr)); gap:18px}
    .footer-section h3{color:var(--accent-primary); margin-bottom:8px}
    .footer-bottom{margin-top:18px; color:rgba(255,255,255,0.6); text-align:center}

    /* floating whatsapp */
    .float-wa{
      position:fixed; right:22px; bottom:22px; z-index:1400;
      width:64px; height:64px; border-radius:50%; display:flex; align-items:center; justify-content:center;
      background:linear-gradient(180deg,#25D366,#128C7E); box-shadow:0 20px 60px rgba(18,140,126,0.16);
      border:4px solid rgba(255,255,255,0.85);
      transition: transform 260ms ease;
    }
    .float-wa:hover{transform:translateY(-8px) scale(1.03)}

    /* reveal util */
    .fadeInUp{opacity:0; transform:translateY(20px) scale(.995)}
    .in-view{opacity:1; transform:translateY(0) scale(1); transition:opacity 600ms, transform 600ms}

    /* small screens */
    @media (max-width:980px){
      .hero-inner{grid-template-columns:1fr; gap:18px}
      .about-content{grid-template-columns:1fr}
      .hero-stage{height:420px}
      .hero-image-wrap{width:360px}
    }
    @media (max-width:560px){
      nav{left:0; transform:none; width:100%; padding:10px}
      .hero-stage{height:360px}
      .hero-image-wrap{width:100%}
      .feedback-grid{grid-template-columns:1fr}
      .feedback-grid textarea{grid-column:span 1}
    }

    /* reduce motion */
    @media (prefers-reduced-motion: reduce){
      *{transition:none!important; animation:none!important}
    }
  </style>
</head>

<body>
  <!-- NAVIGATION -->
  <nav>
    <div class="container">
      <a class="logo" href="#">
        <img src="{{ asset('images/logo1.jpeg') }}" alt="LTBio.lk Logo" />
        <span>LTbio.lk</span>
      </a>

      <!-- Mobile toggle (visible on small screens) -->
      <button class="nav-toggle" aria-label="Toggle navigation" id="navToggle" type="button">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
          <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>

      <ul id="mainNav">
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#institutes">Feedback</a></li>
        <li><a href="{{ route('login') }}">Login</a></li>
      </ul>
    </div>
  </nav>

  <!-- HERO -->
  <main class="hero" id="home">
    <div class="hero-inner">
      <!-- Left: content -->
      <div class="card-hero">
        <div class="hero-subtitle">ADVANCED LEVEL Biology</div>

        <h1 class="hero-title">Lakshitha</h1>
        <h2 class="hero-name">Thennakoon</h2>
        <p class="hero-description">BSc (UG) Biochemistry & Molecular Biology — University Of Colombo</p>

        <div class="badges" aria-hidden="true">
          <div class="badge">Online පන්තිය</div>
          
        </div>

        <div class="hero-actions" style="margin-top:8px;">
          <!-- Keep the routes/links intact -->
          <!-- Example primary CTA (if you want a different link, keep your href) -->
                    <a href="{{ route('login') }}" class="btn btn-primary" target="_blank" rel="noopener noreferrer">Login →</a>

        </div>

       
      </div>

      <!-- Right: 3D stage -->
      <div class="hero-stage" aria-hidden="true">
        <!-- decorative DNA SVG -->
        <svg class="dna-deco" viewBox="0 0 120 420" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <linearGradient id="g1" x1="0" x2="1">
              <stop offset="0" stop-color="#17A2B8"/>
              <stop offset="1" stop-color="#F53003"/>
            </linearGradient>
          </defs>
          <g fill="none" stroke="url(#g1)" stroke-width="2" stroke-linecap="round">
            <!-- only for decoration: a soft double-helix curve repetition -->
            <path d="M20 10 C40 40, 80 70, 20 100" opacity="0.9"/>
            <path d="M20 40 C40 70, 80 100, 20 130" opacity="0.8"/>
            <path d="M20 70 C40 100, 80 130, 20 160" opacity="0.7"/>
            <path d="M20 100 C40 130, 80 160, 20 190" opacity="0.6"/>
            <path d="M20 130 C40 160, 80 190, 20 220" opacity="0.5"/>
            <path d="M20 160 C40 190, 80 220, 20 250" opacity="0.45"/>
            <path d="M20 190 C40 220, 80 250, 20 280" opacity="0.4"/>
            <path d="M20 220 C40 250, 80 280, 20 310" opacity="0.35"/>
            <path d="M20 250 C40 280, 80 310, 20 340" opacity="0.3"/>
            <path d="M20 280 C40 310, 80 340, 20 370" opacity="0.25"/>
          </g>
        </svg>

        <div class="hero-image-wrap">
          <div class="hero-image" id="heroImageCard">
            <div class="hero-bg-number">837</div>
            <img src="{{ asset('images/profile1.jpeg') }}" alt="Lakshitha Thennakoon" />
          </div>

          <div class="stats-badge" role="status" aria-live="polite">
            <div class="icon">10+</div>
            <p style="font-size:13px">Distric Ranks</p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- ABOUT -->
  <section id="about">
    <div class="section-subtitle">WHO WE ARE</div>
    <h2 class="section-title">About Lakshitha Thennakoon</h2>

    <div class="about-content" style="margin-top:18px;">
      <div class="about-text fadeInUp">
        <p>කැකිරාව මධ්‍ය විද්‍යාලයෙන් සිප් සතර හදාරා අ.පො.ස. උසස් පෙළ විශිෂ්ට ප්‍රතිඵල ලබා ගනිමින් කොළඹ විශ්වවිද්‍යාලයට ඇතුළත් වීමට වරම් ලැබූ ලක්ෂිත තෙන්නකෝන්, ජීව රසායනය හා අනුක ජීව විද්‍යාව පිළිබඳ උපාධිය හදාරමින් සිටි අතර වසර දෙකක් පුරා ගුරු භූමිකාවට පණ පොවූ විට, කට්ටපාඩම් සංස්කෘතියෙන් බැහැර වූ නවීන හා කෙටි ක්‍රම මගින් සාම්ප්‍රදායික ජීව විද්‍යා ගුරුවරුන්ට ඉහළ අභියෝගයක් වෙමිනි.</p>
        <br>
        <p>සිය ගුරු භූමිකාව තුළ තමන්ගේ දරු පරම්පරාව වෙත ලබා දිය හැකි දැනුම හුදු පන්ති කාමරයට පමණක් සීමා නොකර
          ඔවුන්ගේ ජීවිත සාර්ථක කිරීමට අවශ්‍ය මගපෙන්වීම ද සිදු කරන්නේ සාම්ප්‍රදායික අධ්‍යාපන රටාවට අභියෝග
          කරමින් ය.</p>
      </div>

      <div style="display:flex; flex-direction:column; gap:12px;">
        <div class="feature-card fadeInUp">
          <h3 style="margin-bottom:6px">විශිෂ්ට අධ්‍යාපන</h3>
          <p style="font-weight:700; color:var(--muted)">BSc (UG)Biochemistry & Molecular Biology — University Of Colombo</p>
        </div>
        <div class="feature-card fadeInUp">
          <h3 style="margin-bottom:6px">වසර ගනනාවක පළපුරුද්ද</h3>
          <p style="font-weight:700; color:var(--muted)">2022 සිට ගණන් A සාමාර්ථයන් නිෂ්පාදනය</p>
        </div>
        <div class="feature-card fadeInUp">
          <h3 style="margin-bottom:6px">නවීන පහසුකම්</h3>
          <p style="font-weight:700; color:var(--muted)">Online පන්ති, Interactive පාඩම්, Digital සම්පත්</p>
        </div>
      </div>
    </div>
  </section>

  <!-- TELEGRAM CARDS & HORIZONTAL GALLERY -->
  <section id="institutes">
    <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">
      <div>
        <div class="section-subtitle">WHERE WE TEACH</div>
        <h2 class="section-title">Student's Feedback</h2>
      </div>

      <div style="display:flex; gap:12px; align-items:center;">
        <!-- Telegram card examples (links preserved) -->
        <a href="https://t.me/LTbio26" target="_blank" rel="noopener noreferrer" style="text-decoration:none">
          <div style="display:flex; align-items:center; gap:12px; padding:12px 16px; background:linear-gradient(90deg, rgba(245,48,3,0.06), rgba(23,162,184,0.04)); border-radius:12px; box-shadow:var(--shadow-sm)">
            <img src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg" width="34" alt="tg" />
            <div style="font-weight:900; color:var(--accent-primary)">2026 Biology Revision</div>
          </div>
        </a>

        <a href="https://t.me/LTbio26" target="_blank" rel="noopener noreferrer" style="text-decoration:none">
          <div style="display:flex; align-items:center; gap:12px; padding:12px 16px; background:linear-gradient(90deg, rgba(245,48,3,0.06), rgba(23,162,184,0.04)); border-radius:12px; box-shadow:var(--shadow-sm)">
            <img src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg" width="34" alt="tg" />
            <div style="font-weight:900; color:var(--accent-primary)">2027 Theory Biology</div>
          </div>
        </a>
      </div>
    </div>

    <!-- feedback form -->
<!-- feedback form -->
<div style="margin-top:18px; width:100%;">
    @if (session('success'))
        <div style="padding:10px; background:#d1fae5; color:#065f46; border-radius:8px; margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('feedbackstore') }}" method="POST" aria-label="Feedback form"
          style="background:#fff; padding:18px; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.08); width:100%; box-sizing:border-box;">
        @csrf
        <h3 style="margin-bottom:12px;">Submit Your Feedback</h3>

        <div class="feedback-grid" 
             style="display:grid; grid-template-columns:1fr 1fr; gap:12px; width:100%;">

            <input id="name" type="text" name="name" placeholder="Your Name" required
                   style="padding:12px; border:1px solid #ddd; border-radius:6px; font-size:15px; width:100%; box-sizing:border-box;" />

            <input id="email" type="email" name="email" placeholder="Email" required
                   style="padding:12px; border:1px solid #ddd; border-radius:6px; font-size:15px; width:100%; box-sizing:border-box;" />

            <input id="phone_number" type="text" name="phone_number" placeholder="Phone Number" required
                   style="padding:12px; border:1px solid #ddd; border-radius:6px; font-size:15px; width:100%; box-sizing:border-box;" />

            <textarea id="message" name="message" placeholder="Write your message..." required
                      style="padding:12px; border:1px solid #ddd; border-radius:6px; font-size:15px; width:100%; height:130px; box-sizing:border-box; grid-column:span 2; resize:none;"></textarea>

            <button type="submit" onclick="return validateFeedbackForm()"
                    style="padding:12px; background:#ff0000; color:white; border:none; border-radius:6px; font-size:16px; cursor:pointer; grid-column:span 2;">
                Submit
            </button>
        </div>
    </form>
</div>

<!-- Responsive media query (required for mobile) -->
<style>
@media (max-width: 640px) {
    .feedback-grid {
        grid-template-columns: 1fr !important;
    }
    .feedback-grid textarea,
    .feedback-grid button {
        grid-column: span 1 !important;
    }
}
</style>


    <!-- horizontal scrolling gallery -->
    <div style="margin-top:18px;">
      <div id="scrollBox" style="display:flex; gap:14px; overflow-x:auto; padding:10px; scroll-snap-type:x mandatory;">
        <img src="{{ asset('images/feed1.jpeg') }}" style="width:330px; height:350px; object-fit:cover; border-radius:12px; scroll-snap-align:start; flex:0 0 auto;">
        <img src="{{ asset('images/feed2.jpeg') }}" style="width:330px; height:350px; object-fit:cover; border-radius:12px; scroll-snap-align:start; flex:0 0 auto;">
        <img src="{{ asset('images/feed3.jpeg') }}" style="width:330px; height:350px; object-fit:cover; border-radius:12px; scroll-snap-align:start; flex:0 0 auto;">
        <img src="{{ asset('images/feed4.jpeg') }}" style="width:330px; height:350px; object-fit:cover; border-radius:12px; scroll-snap-align:start; flex:0 0 auto;">
      </div>
    </div>

    <!-- institutes cards -->
    <div style="margin-top:30px;">
      <h2 class="section-title">Outstanding Results</h2>

      <div class="results-stats" style="margin-top:14px;">
        <div class="stat-card">
          <div class="stat-number">4500+</div>
          <div class="stat-label">A සාමාර්ථ (2015-2023)</div>
        </div>
        <div class="stat-card">
          <div class="stat-number">837</div>
          <div class="stat-label">Island Ranks</div>
        </div>
        <div class="stat-card">
          <div class="stat-number">20+</div>
          <div class="stat-label">Years Experience</div>
        </div>
        <div class="stat-card">
          <div class="stat-number">15+</div>
          <div class="stat-label">Institute Locations</div>
        </div>
      </div>
    </div>
  </section>

 <section id="gallery">
    <div class="section-subtitle">SEE OUR WORK</div>
    <h2 class="section-title">Gallery</h2>

    <div class="gallery-grid" style="margin-top:16px;">
        <div class="gallery-item">Feed 1</div>
        <div class="gallery-item">Feed 2</div>
        <div class="gallery-item">Feed 3</div>
        <div class="gallery-item">Feed 4</div>
    </div>
</section>

<style>
#gallery {
  padding: 40px 0;
}

.gallery-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 20px;
}

.gallery-item {
  background: #e9e9e9;
  padding: 40px;
  text-align: center;
  border-radius: 10px;
  font-weight: bold;
}
</style>


  <!-- FOOTER -->
  <footer>
    <div class="footer-content">
      <div class="footer-section">
        <h3>Lakshitha Thennakoon</h3>
        <p>BSc (UG)Biochemistry & Molecular Biology — University Of Colombo</p>
      
      </div>

      <div class="footer-section">
        <h3>Quick Links</h3>
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="#institutes">Institutes</a>
        <a href="#results">Results</a>
      </div>

      <div class="footer-section">
        <h3>Contact Us</h3>
        <p>📞 +94 74 287 7640</p>
        <p>✉️ info@ltbio.edu.lk</p>
        <p>🌐 www.ltbio.edu.lk</p>
      </div>

      <div class="footer-section">
        <h3>Follow Us</h3>
        <a href="#">Facebook</a>
        <a href="#">YouTube</a>
        <a href="#">Telegram</a>
        <a href="#">WhatsApp</a>
      </div>
    </div>

    <div class="footer-bottom" style="margin-top:18px;">
  <p>
    &copy; 2025 ltbio.edu.lk - All Rights Reserved | Designed with 
    <a href="https://www.facebook.com/share/1DdkZfRCep/?mibextid=wwXIfr" 
       target="_blank" 
       style="color: inherit; text-decoration: underline;">
       Pixelwave IT Solutions
    </a>
  </p>
</div>

  </footer>

  <!-- WhatsApp floating button -->
  <a class="float-wa" href="https://wa.me/94742877640" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" aria-hidden="true">
      <path d="M21.8 4.2a11.9 11.9 0 0 0-17 0 11.9 11.9 0 0 0 0 17L2 22l3-2.1A11.9 11.9 0 0 0 21.8 4.2z" fill="white"></path>
      <path d="M17 14.2c-.5 1.4-2 2.5-3.1 2.7-.9.2-1.5.3-4.1-1.1-3.2-1.9-5.2-6.6-2.4-9.6 1.8-1.9 4.5-1.5 5.2-1.4.8.2 2 .6 2.9 1.6.8.9 1.2 1.9 1.3 2.6.1.6-.1 1.6-.8 2.2z" fill="#24C17B"></path>
    </svg>
  </a>

  <!-- ------------- Scripts: Interactions & 3D effect ------------- -->
  <script>
    // Smooth anchor scrolling (keep existing behaviour)
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        // allow real routes (like route('login')) to behave normally; hash links we smooth-scroll
        const href = this.getAttribute('href');
        if (!href.startsWith('#')) return;
        e.preventDefault();
        const target = document.querySelector(href);
        if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    });

    // Reveal on scroll (simple)
    (function(){
      const io = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('in-view');
            observer.unobserve(entry.target);
          }
        });
      }, {threshold: 0.12});

      document.querySelectorAll('.fadeInUp').forEach(el => io.observe(el));
      document.querySelectorAll('.feature-card, .institute-card, .stat-card, .gallery-item').forEach(el => el.classList.add('fadeInUp') && io.observe(el));
    })();

    // Hero image tilt (3D) — lightweight
    (function(){
      const card = document.getElementById('heroImageCard');
      if (!card) return;
      const img = card.querySelector('img');
      const bgNumber = card.querySelector('.hero-bg-number');

      function onMove(e){
        const rect = card.getBoundingClientRect();
        const cx = rect.left + rect.width/2;
        const cy = rect.top + rect.height/2;
        const dx = (e.clientX || (e.touches && e.touches[0].clientX)) - cx;
        const dy = (e.clientY || (e.touches && e.touches[0].clientY)) - cy;
        const rx = (dy / rect.height) * -8; // rotateX
        const ry = (dx / rect.width) * 10; // rotateY
        card.style.transform = `rotateX(${rx}deg) rotateY(${ry}deg) translateZ(20px)`;
        img.style.transform = `translateZ(60px) rotateX(${rx*0.6}deg) rotateY(${ry*0.6}deg)`;
        if (bgNumber) bgNumber.style.transform = `translateZ(-120px) translateX(${ry*2}px) translateY(${rx*1.2}px)`;
      }

      function reset(){
        card.style.transform = `rotateX(0deg) rotateY(0deg) translateZ(0px)`;
        img.style.transform = `translateZ(60px) rotateX(0deg) rotateY(0deg)`;
        if (bgNumber) bgNumber.style.transform = `translateZ(-160px)`;
      }

      card.addEventListener('mousemove', onMove);
      card.addEventListener('mouseleave', reset);
      card.addEventListener('touchmove', onMove, {passive:true});
      card.addEventListener('touchend', reset);
    })();

    // Draggable horizontal scroll
    (function(){
      const scrollBox = document.getElementById('scrollBox');
      if (!scrollBox) return;
      let isDown = false, startX, scrollLeft;
      scrollBox.addEventListener('mousedown', e => { isDown = true; startX = e.pageX - scrollBox.offsetLeft; scrollLeft = scrollBox.scrollLeft; });
      window.addEventListener('mouseup', () => isDown = false);
      scrollBox.addEventListener('mousemove', e => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - scrollBox.offsetLeft;
        const walk = (x - startX) * 1.6;
        scrollBox.scrollLeft = scrollLeft - walk;
      });
      scrollBox.addEventListener('wheel', e => {
        if (Math.abs(e.deltaX) < Math.abs(e.deltaY)) { e.preventDefault(); scrollBox.scrollLeft += e.deltaY; }
      }, {passive:false});
    })();

    // Small client-side validation for feedback form
    function validateFeedbackForm(){
      const name = document.getElementById('name').value.trim();
      const email = document.getElementById('email').value.trim();
      const phone = document.getElementById('phone_number').value.trim();
      const message = document.getElementById('message').value.trim();
      if (!name || !email || !phone || !message) {
        alert('Please fill all fields!');
        return false;
      }
      return true; // allow server submit
    }

    // Subtle floating animation for hero image
    setInterval(() => {
      const el = document.querySelector('#heroImageCard img');
      if (!el) return;
      el.animate([
        { transform: el.style.transform },
        { transform: el.style.transform + ' translateY(-8px)' },
        { transform: el.style.transform }
      ], { duration: 4200, iterations: 1 });
    }, 5200);

    // Mobile nav toggle: open/close, close when clicking outside, close on link click
    (function(){
      const nav = document.querySelector('nav');
      const toggle = document.getElementById('navToggle');
      const navList = document.getElementById('mainNav');

      if (!nav || !toggle) return;

      toggle.addEventListener('click', (e) => {
        e.stopPropagation();
        nav.classList.toggle('open');
        // toggle aria-expanded for accessibility
        const expanded = nav.classList.contains('open');
        toggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
      });

      // Close when clicking a nav link (mobile)
      navList.querySelectorAll('a').forEach(a => {
        a.addEventListener('click', () => {
          if (nav.classList.contains('open')) nav.classList.remove('open');
        });
      });

      // Click outside to close
      document.addEventListener('click', (e) => {
        if (!nav.contains(e.target) && nav.classList.contains('open')) {
          nav.classList.remove('open');
        }
      });

      // Close on Escape
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && nav.classList.contains('open')) nav.classList.remove('open');
      });
    })();
  </script>
</body>

</html>
