<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Class Lecture Viewer</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Inline Styling (Minimal Global Reset) -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background-color: #f4f7fa;
            color: #333;
            line-height: 1.6;
        }
        h1, h2, h3, h4 {
            color: #1a202c;
            margin-top: 0;
        }
        a {
            text-decoration: none;
            color: #1e40af;
        }
        a:hover {
            text-decoration: underline;
        }
        /* Style for the responsive video container */
        #video-embed-container {
            position: relative;
            width: 100%;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
        }
        #video-embed-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        /* Video Shield: Blocks all external clicks */
        #video-shield {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: calc(100% - 40px); /* Leave bottom control bar accessible if needed, or set to 100% to block everything */
            z-index: 5; /* Ensure it's above the iframe (z-index: 1) */
            cursor: default;
            /* Transparent background, catches the click event */
            background: rgba(0, 0, 0, 0.001); 
        }

        /* Responsive Layout Switch for main content */
        @media (min-width: 1024px) {
            #app > div {
                flex-direction: row !important;
            }
        }
    </style>
</head>
<body style="min-height: 100vh;">

    <!-- Main Application Container -->
    <div id="app" style="max-width: 1400px; margin: 0 auto; padding: 20px;">

        <!-- Header -->
        <header style="background-color: #ffffff; padding: 15px 30px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); display: flex; justify-content: space-between; align-items: center;">
            <h1 style="font-size: 1.5rem; font-weight: 700; color: #1e40af;">[Course Name] - Lecture 5</h1>
            <a href="#" id="back-to-course-btn" style="background-color: #e2e8f0; color: #4a5568; padding: 8px 15px; border-radius: 8px; font-weight: 600; transition: background-color 0.2s; border: 1px solid #cbd5e0;">
                <i class="fas fa-arrow-left" style="margin-right: 8px;"></i>Back to Course
            </a>
        </header>

        <!-- Main Content Layout (Flexbox for Desktop, Stacked for Mobile) -->
        <div style="display: flex; flex-direction: column; gap: 20px;">

            <!-- Left Column: Video Player and Details (70% on large screen) -->
            <div id="video-content" style="flex: 3 1 70%;">
                
                <!-- Video Player Area -->
                <div style="background-color: #1a202c; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);">
                    <div id="video-embed-container">
                        <!-- 
                            YouTube Embed Source with modestbranding=1 (to hide logo) and autoplay=1.
                        -->
                        <iframe 
                            src="https://www.youtube.com/embed/qH3UdyY4DD4?autoplay=1&rel=0&modestbranding=1" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen 
                            style="z-index: 1;">
                        </iframe>

                        <!-- CLICK SHIELD: This transparent layer sits on top of the iframe to block all external navigation clicks. -->
                        <div id="video-shield"></div>
                    </div>
                </div>

                <!-- Video Description and Discussion Card -->
                <div style="background-color: #ffffff; padding: 30px; border-radius: 12px; margin-top: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);">
                    <h2 style="font-size: 1.5rem; margin-bottom: 15px; border-bottom: 2px solid #edf2f7; padding-bottom: 10px;">Lecture Overview: Introduction to API Design</h2>
                    <p style="margin-bottom: 15px; color: #4a5568;">
                        This lecture covers the fundamental principles of RESTful API design, including resource modeling, HTTP methods, and status codes. We explore the benefits of stateless architecture and best practices for versioning your APIs.
                    </p>
                    <h4 style="font-size: 1.1rem; margin-top: 20px; color: #2d3748;">Key Topics Covered:</h4>
                    <ul style="list-style-type: none; padding: 0;">
                        <li style="padding: 8px 0; border-bottom: 1px dashed #edf2f7;"><i class="fas fa-check-circle" style="color: #38a169; margin-right: 8px;"></i>Resource Naming Conventions</li>
                        <li style="padding: 8px 0; border-bottom: 1px dashed #edf2f7;"><i class="fas fa-check-circle" style="color: #38a169; margin-right: 8px;"></i>The Idempotence of PUT vs. POST</li>
                        <li style="padding: 8px 0;"><i class="fas fa-check-circle" style="color: #38a169; margin-right: 8px;"></i>Secure API Gateway Implementation</li>
                    </ul>
                </div>
            </div>

            <!-- Right Column: Materials and Outline (30% on large screen) -->
            <div id="sidebar" style="flex: 1 1 30%;">
                
                <!-- Materials Card -->
                <div style="background-color: #ffffff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); margin-bottom: 20px;">
                    <h3 style="font-size: 1.25rem; margin-bottom: 15px; color: #1e40af;"><i class="fas fa-book-open" style="margin-right: 10px;"></i>Lecture Materials</h3>
                    
                    <div style="margin-bottom: 15px;">
                        <a href="#" target="_blank" style="display: flex; align-items: center; padding: 10px; background-color: #ffe0e0; border: 1px solid #ffcccc; border-radius: 8px; color: #cc0000; font-weight: 600; transition: background-color 0.2s;">
                            <i class="fas fa-file-pdf" style="margin-right: 10px; font-size: 1.2rem;"></i>
                            <span style="flex-grow: 1;">Lecture Slides (PDF)</span>
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <a href="#" target="_blank" style="display: flex; align-items: center; padding: 10px; background-color: #e0f2fe; border: 1px solid #bfdbfe; border-radius: 8px; color: #1e40af; font-weight: 600; transition: background-color 0.2s;">
                            <i class="fas fa-file-alt" style="margin-right: 10px; font-size: 1.2rem;"></i>
                            <span style="flex-grow: 1;">Supplemental Reading (PDF)</span>
                            <i class="fas fa-download"></i>
                        </a>
                    </div>

                    <div>
                        <a href="#" style="display: flex; align-items: center; padding: 10px; background-color: #e6fffa; border: 1px solid #b2f5ea; border-radius: 8px; color: #38a169; font-weight: 600; transition: background-color 0.2s;">
                            <i class="fas fa-code" style="margin-right: 10px; font-size: 1.2rem;"></i>
                            <span style="flex-grow: 1;">Code Examples (.zip)</span>
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                </div>

                <!-- Outline Card -->
                <div style="background-color: #ffffff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);">
                    <h3 style="font-size: 1.25rem; margin-bottom: 15px; color: #2d3748;"><i class="fas fa-list-ol" style="margin-right: 10px;"></i>Course Outline</h3>
                    <ul style="list-style-type: none; padding: 0;">
                        <li style="padding: 10px 0; border-bottom: 1px solid #edf2f7; font-weight: 600;">1. Module 1: Basics</li>
                        <li style="padding: 10px 0; border-bottom: 1px solid #edf2f7;">2. Module 2: Security</li>
                        <li style="padding: 10px 0; border-bottom: 1px solid #edf2f7; background-color: #fffbeb; border-left: 4px solid #f6ad55; padding-left: 8px;">3. Module 3: Design Patterns (Current)</li>
                        <li style="padding: 10px 0; border-bottom: 1px solid #edf2f7;">4. Module 4: Deployment</li>
                        <li style="padding: 10px 0;">5. Final Project</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const app = document.getElementById('app');
            const videoContent = document.getElementById('video-content');
            const sidebar = document.getElementById('sidebar');
            const headerBtn = document.getElementById('back-to-course-btn');

            // Replace forbidden alert with console log for navigation button
            if (headerBtn) {
                headerBtn.onclick = function(e) {
                    e.preventDefault();
                    console.log('Navigating back to the main class page...');
                    // In a real app, you would change window.location.href here
                }
            }

            function applyResponsiveLayout() {
                // Apply flex-direction based on screen width for desktop view
                if (window.innerWidth >= 1024) {
                    app.querySelector('div').style.flexDirection = 'row';
                    videoContent.style.flex = '3 1 70%';
                    sidebar.style.flex = '1 1 30%';
                    sidebar.style.minWidth = '300px';
                } else {
                    // Stacked layout for mobile/tablet
                    app.querySelector('div').style.flexDirection = 'column';
                    videoContent.style.flex = '1 1 100%';
                    sidebar.style.flex = '1 1 100%';
                    sidebar.style.minWidth = 'auto';
                }
            }

            // Initial call and resize listener
            applyResponsiveLayout();
            window.addEventListener('resize', applyResponsiveLayout);
        });
    </script>
</body>
</html>