<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LTBio - Lakshitha Thennakoon</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #FDFDFC;
            color: #1b1b18;
            line-height: 1.6;
        }
        
        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            z-index: 1000;
            padding: 1rem 2rem;
        }
        
        nav .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        nav .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #F53003;
        }
        
        nav ul {
            list-style: none;
            display: flex;
            gap: 2rem;
        }
        
        nav ul li a {
            text-decoration: none;
            color: #1b1b18;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        nav ul li a:hover {
            color: #F53003;
        }
        
        /* Hero Section */
        .hero {
            margin-top: 80px;
            padding: 4rem 2rem;
            background: linear-gradient(135deg, #fff2f2 0%, #ffffff 100%);
        }
        
        .hero .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 3rem;
            background: white;
            box-shadow: 0 0 1px rgba(0,0,0,0.05), 0 1px 3px rgba(0,0,0,0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        
        .hero-content {
            flex: 1;
            min-width: 300px;
            padding: 3rem;
        }
        
        .hero-subtitle {
            font-size: 0.875rem;
            color: #706f6c;
            font-weight: 500;
            letter-spacing: 0.1em;
            margin-bottom: 1rem;
        }
        
        .hero-title {
            font-size: 4rem;
            font-weight: 700;
            color: #F53003;
            line-height: 1;
            margin-bottom: 0.5rem;
        }
        
        .hero-name {
            font-size: 2.5rem;
            font-weight: 600;
            color: #1b1b18;
            margin-bottom: 1.5rem;
        }
        
        .hero-description {
            font-size: 1.125rem;
            font-weight: 500;
            margin-bottom: 2rem;
        }
        
        .badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }
        
        .badge {
            padding: 0.5rem 1rem;
            background: #E5E5E3;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .btn-primary {
            padding: 0.875rem 1.5rem;
            background: #1b1b18;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            transition: background 0.3s;
            display: inline-block;
        }
        
        .btn-primary:hover {
            background: #000;
        }
        
        .btn-secondary {
            padding: 0.875rem 1.5rem;
            border: 1px solid rgba(25, 20, 0, 0.2);
            color: #1b1b18;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            transition: border-color 0.3s;
            display: inline-block;
        }
        
        .btn-secondary:hover {
            border-color: #000;
        }
        
        .hero-image {
            flex: 1;
            min-width: 300px;
            position: relative;
            background: #fff2f2;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: 2rem;
            min-height: 600px;
        }
        
        .hero-image-bg-number {
            position: absolute;
            bottom: 2rem;
            left: 2rem;
            font-size: 8rem;
            font-weight: 800;
            color: rgba(255, 255, 255, 0.1);
            user-select: none;
        }
        
        .hero-image img {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 400px;
            object-fit: cover;
        }
        
        .stats-badge {
            position: absolute;
            bottom: 2rem;
            right: 2rem;
            text-align: center;
        }
        
        .stats-badge-icon {
            width: 56px;
            height: 56px;
            background: #F53003;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(245, 48, 3, 0.3);
            margin: 0 auto 0.5rem;
        }
        
        .stats-badge p {
            font-weight: 600;
            margin: 0.25rem 0;
        }
        
        .stats-badge small {
            font-size: 0.75rem;
            color: #706f6c;
            text-decoration: underline;
        }
        
        /* Section Styles */
        section {
            padding: 5rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #1b1b18;
        }
        
        .section-subtitle {
            font-size: 0.875rem;
            color: #F53003;
            font-weight: 600;
            letter-spacing: 0.1em;
            margin-bottom: 0.5rem;
        }
        
        /* About Section */
        .about-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
            margin-top: 3rem;
        }
        
        .about-text {
            font-size: 1.125rem;
            line-height: 1.8;
            color: #1b1b18;
        }
        
        .about-features {
            display: grid;
            gap: 1.5rem;
        }
        
        .feature-card {
            padding: 1.5rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-left: 4px solid #F53003;
        }
        
        .feature-card h3 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: #1b1b18;
        }
        
        .feature-card p {
            color: #706f6c;
        }
        
        /* Institutes Section */
        .institutes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .institute-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .institute-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        
        .institute-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #fff2f2 0%, #ffe5e5 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }
        
        .institute-content {
            padding: 1.5rem;
        }
        
        .institute-card h3 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: #1b1b18;
        }
        
        .institute-card p {
            color: #706f6c;
            margin-bottom: 1rem;
        }
        
        .institute-meta {
            display: flex;
            gap: 1rem;
            font-size: 0.875rem;
            color: #706f6c;
        }
        
        .institute-meta span {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        /* Results Section */
        .results-banner {
            background: linear-gradient(135deg, #F53003 0%, #d42900 100%);
            color: white;
            padding: 3rem;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .results-banner h2 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .results-banner p {
            font-size: 1.25rem;
            opacity: 0.95;
        }
        
        .results-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .stat-card {
            text-align: center;
            padding: 2rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: #F53003;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #706f6c;
            font-weight: 500;
        }
        
        /* Gallery */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }
        
        .gallery-item {
            aspect-ratio: 4/3;
            background: linear-gradient(135deg, #fff2f2 0%, #ffe5e5 100%);
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #F53003;
            cursor: pointer;
            transition: transform 0.3s;
        }
        
        .gallery-item:hover {
            transform: scale(1.05);
        }
        
        /* Footer */
        footer {
            background: #1b1b18;
            color: white;
            padding: 3rem 2rem;
            text-align: center;
        }
        
        footer .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .footer-section h3 {
            margin-bottom: 1rem;
            color: #F53003;
        }
        
        .footer-section p,
        .footer-section a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
        }
        
        .footer-section a:hover {
            color: white;
        }
        
        .footer-bottom {
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            nav ul {
                display: none;
            }
            
            .hero-title {
                font-size: 3rem;
            }
            
            .hero-name {
                font-size: 2rem;
            }
            
            .hero-image {
                min-height: 400px;
            }
            
            .results-banner h2 {
                font-size: 2rem;
            }
            
            .stat-number {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
  <nav>
    <div class="container">

        <a class="logo" href="#">
            <img src="{{ asset('images/logo1.jpeg') }}" alt="LTBio.lk Logo" />
            <span>LTBio.lk</span>
        </a>

        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#institutes">Institutes</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
        </ul>

    </div>
</nav>

<style>
    nav .container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 10px; /* space between image & text */
        text-decoration: none;
    }

    .logo img {
        width: 50px; /* smaller size here */
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
    }

    .logo span {
        font-size: 20px;
        font-weight: bold;
        color: #ff0000;
    }

    nav ul {
        display: flex;
        align-items: center;
        gap: 20px;
        list-style: none;
    }

    nav ul li a {
        text-decoration: none;
        color: #000;
        font-size: 16px;
    }
</style>


    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <!-- Left Content -->
            <div class="hero-content">
                <p class="hero-subtitle">ADVANCE LEVEL Biology</p>
                <h1 class="hero-title">Lakshitha</h1>
                <h2 class="hero-name">Thennakoon</h2>
                <p class="hero-description">B.Sc. (Engineering) Hons, University of Colombo</p>
                
                <div class="badges">
                    <span class="badge">SyZyGy</span>
                    <span class="badge">IMS</span>
                    <span class="badge">Pencil opera</span>
                    <span class="badge">Online පන්තිය</span>
                </div>
                
                <div class="hero-buttons">
                    <a href="#" class="btn-primary">TELEGRAM BOT</a>
                    <a href="#" class="btn-secondary">CHAT WITH US →</a>
                </div>
            </div>
            
            <!-- Right Image -->
            <div class="hero-image">
                <div class="hero-image-bg-number">837</div>
                <img src="{{asset('images/profile1.jpeg')}}" alt="Charitha Dissanayake">
             
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about">
        <p class="section-subtitle">WHO WE ARE</p>
        <h2 class="section-title">About Charitha Dissanayake</h2>
        
        <div class="about-content">
            <div class="about-text">
                <p>අ.පො.ස. උසස්පෙළ විශිෂ්ට ප්රථිඵල මගින් මොරටුව විශ්ව විද්යාලයෙන් සිය ගෞරව උපාධිය ලබාගත් චරිත දිසානායක යනු, ශ්‍රී ලංකාවේ උපකාරක පන්ති ක්ෂේත්‍රය උඩු යටිකුරු කළ රසායන විද්‍යා ගුරුවරයා ය.</p>
                <br>
                <p>සිය ගුරු භූමිකාව තුළ තමන්ගේ දරු පරම්පරාව වෙත ලබා දිය හැකි දැනුම හුදු පන්ති කාමරයට පමණක් සීමා නොකර ඔවුන්ගේ ජීවිත සාර්ථක කිරීමට අවශ්‍ය මගපෙන්වීම ද සිදු කරන්නේ සාම්ප්‍රදායික අධ්‍යාපන රටාවට අභියෝග කරමින් ය.</p>
            </div>
            
            <div class="about-features">
                <div class="feature-card">
                    <h3>🎓 විශිෂ්ට අධ්‍යාපන</h3>
                    <p>B.Sc. (Engineering) Hons, මොරටුව විශ්ව විද්‍යාලය</p>
                </div>
                <div class="feature-card">
                    <h3>📚 දශක 2ක පළපුරුද්ද</h3>
                    <p>2015 සිට දහස් ගණන් A සාමාර්ථයන් නිෂ්පාදනය</p>
                </div>
                <div class="feature-card">
                    <h3>💻 නවීන පහසුකම්</h3>
                    <p>Online පන්ති, Interactive පාඩම්, Digital සම්පත්</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Institutes Section -->
    <section id="institutes">
        <p class="section-subtitle">WHERE WE TEACH</p>
        <h2 class="section-title">Student's Feedback</h2>
          <section id="institutes">
    <!-- Full-width Image Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 100px; width: 100%;">
        <img src="{{ asset('images/feed1.jpeg') }}" style="width: 330px; height: 350px; object-fit: cover;">
        <img src="{{ asset('images/feed2.jpeg') }}" style="width: 330px; height: 350px; object-fit: cover;">
        <img src="{{ asset('images/feed3.jpeg') }}" style="width: 330px; height: 350px; object-fit: cover;">
        <img src="{{ asset('images/feed4.jpeg') }}" style="width: 330px; height: 350px; object-fit: cover;">
        <img src="{{ asset('images/feed2.jpeg') }}" style="width: 330px; height: 350px; object-fit: cover;">
        <img src="{{ asset('images/feed3.jpeg') }}" style="width: 330px; height: 350px; object-fit: cover;">

        <!-- Add more images as needed -->
    </div>
</section>
        </div>
    </section>

    <!-- Results Section -->
    <section id="results">
        <div class="results-banner">
            <h2>2023 A සාමාර්ථ</h2>
            <p>දශක දෙකකට ආසන්න කාලයක සිට ප්‍රතිඵල මගින් වැඩිම A+ සංචිත ප්‍රමාණයක හිමිකරුවා</p>
        </div>
        
        <p class="section-subtitle">OUR ACHIEVEMENTS</p>
        <h2 class="section-title">Outstanding Results</h2>
        
        <div class="results-stats">
            <div class="stat-card">
                <div class="stat-number">4500+</div>
                <p class="stat-label">A සාමාර්ථ (2015-2023)</p>
            </div>
            <div class="stat-card">
                <div class="stat-number">837</div>
                <p class="stat-label">Island Ranks</p>
            </div>
            <div class="stat-card">
                <div class="stat-number">20+</div>
                <p class="stat-label">Years Experience</p>
            </div>
            <div class="stat-card">
                <div class="stat-number">15+</div>
                <p class="stat-label">Institute Locations</p>
            </div>
        </div>
        
        <h3 class="section-title" style="margin-top: 3rem;">Success Gallery</h3>
        <div class="gallery-grid">
            <div class="gallery-item">📸 පන්ති කාමරය</div>
            <div class="gallery-item">🏆 විජයග්‍රාහකයින්</div>
            <div class="gallery-item">📚 අධ්‍යයන සැසිය</div>
            <div class="gallery-item">🎓 උපාධි දිනය</div>
            <div class="gallery-item">👨‍🎓 සිසුන්</div>
            <div class="gallery-item">💻 Online පන්ති</div>
            <div class="gallery-item">🧪 Lab පාඩම්</div>
            <div class="gallery-item">📖 සම්පත්</div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Charitha Dissanayake</h3>
                    <p>B.Sc. (Engineering) Hons<br>University of Moratuwa</p>
                    <p>Leading Chemistry Educator in Sri Lanka</p>
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
                    <p>📞 +94 XX XXX XXXX</p>
                    <p>✉️ info@chemistry.lk</p>
                    <p>🌐 www.chemistry.lk</p>
                </div>
                
                <div class="footer-section">
                    <h3>Follow Us</h3>
                    <a href="#">Facebook</a>
                    <a href="#">YouTube</a>
                    <a href="#">Telegram</a>
                    <a href="#">WhatsApp</a>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2024 Chemistry.lk - All Rights Reserved | Designed with ❤️ for Education</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Add scroll effect to navbar
        let lastScroll = 0;
        const nav = document.querySelector('nav');
        
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                nav.style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
            } else {
                nav.style.boxShadow = '0 1px 3px rgba(0,0,0,0.1)';
            }
            
            lastScroll = currentScroll;
        });
    </script>
</body>
</html>