<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Admin Dashboard</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Inline Styling -->
    <style>
        /* Global Reset and Typography */
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background-color: #1f2937; /* Dark background */
            color: #f3f4f6;
            line-height: 1.5;
        }
        h1, h2, h3, h4 {
            color: #f3f4f6;
            margin-top: 0;
            font-weight: 600;
        }
        a {
            text-decoration: none;
            color: #60a5fa;
            transition: color 0.2s;
        }
        a:hover {
            color: #3b82f6;
        }

        /* Utility Classes (Inline Emulation) */
        .flex { display: flex; }
        .flex-col { flex-direction: column; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .p-4 { padding: 1rem; }
        .m-4 { margin: 1rem; }
        .rounded-lg { border-radius: 0.5rem; }
        .shadow-xl { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }

        /* Dashboard Layout */
        #dashboard-container {
            min-height: 100vh;
        }
        #sidebar {
            width: 250px;
            background-color: #111827; /* Deeper dark blue for sidebar */
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            transition: transform 0.3s ease-in-out;
            transform: translateX(0);
            z-index: 20;
            padding-top: 20px;
            box-sizing: border-box;
        }
        #main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease-in-out;
            width: calc(100% - 250px);
            box-sizing: border-box;
        }
        #topbar {
            background-color: #1f2937;
            padding: 10px 20px;
            border-bottom: 1px solid #374151;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        /* Sidebar Navigation */
        #sidebar a {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            color: #d1d5db;
            font-size: 1rem;
            margin-bottom: 5px;
            border-left: 3px solid transparent;
            transition: background-color 0.2s, border-left-color 0.2s;
        }
        #sidebar a:hover, #sidebar .active {
            background-color: #374151;
            border-left-color: #4f46e5; /* Indigo accent */
            color: #fff;
        }
        #sidebar a i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        /* Mobile Styles */
        #menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 1.5rem;
            cursor: pointer;
        }
        @media (max-width: 1024px) {
            #sidebar {
                transform: translateX(-100%);
            }
            #sidebar.open {
                transform: translateX(0);
            }
            #main-content {
                margin-left: 0;
                width: 100%;
            }
            #menu-toggle {
                display: block;
            }
            .hidden-mobile {
                display: none;
            }
        }

        /* Card and Table Styles */
        .card {
            background-color: #1f2937;
            border: 1px solid #374151;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .kpi-card {
            background-color: #374151;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            border-left: 5px solid #4f46e5;
        }
        .kpi-card .value {
            font-size: 2rem;
            font-weight: 700;
        }
        .kpi-card .label {
            font-size: 0.9rem;
            color: #9ca3af;
        }
        
        /* Data Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table th, .data-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #374151;
        }
        .data-table th {
            background-color: #374151;
            color: #e5e7eb;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.8rem;
        }
        .data-table tr:hover {
            background-color: #2c3a4d;
        }
        .data-table button {
            background: none;
            border: 1px solid #4f46e5;
            color: #60a5fa;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s, color 0.2s;
        }
        .data-table button:hover {
            background-color: #4f46e5;
            color: #fff;
        }
    </style>
</head>
<body id="dashboard-container">

    <!-- Sidebar -->
    <nav id="sidebar">
        <div style="text-align: center; padding: 10px 0 30px 0;">
            <h2 style="font-size: 1.8rem; color: #4f46e5;">Admin Panel</h2>
            <p style="font-size: 0.9rem; color: #9ca3af;">Content Management</p>
        </div>
        <a href="#overview" class="active">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a href="#users">
            <i class="fas fa-users"></i> User Management
        </a>
        <a href="#content">
            <i class="fas fa-book-open"></i> Courses & Lectures
        </a>
        <a href="#settings">
            <i class="fas fa-cog"></i> Settings
        </a>
        <div style="position: absolute; bottom: 20px; width: 100%; padding: 0 20px; box-sizing: border-box;">
            <a href="#" style="border-left: none; background-color: #374151; border-radius: 6px;">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div id="main-content">
        
        <!-- Top Bar / Header -->
        <header id="topbar" class="flex items-center justify-between">
            <button id="menu-toggle"><i class="fas fa-bars"></i></button>
            <h1 class="hidden-mobile" style="font-size: 1.5rem;">Welcome Back, Admin!</h1>
            <div class="flex items-center">
                <i class="fas fa-bell" style="margin-right: 20px; color: #9ca3af;"></i>
                <div style="width: 32px; height: 32px; background-color: #60a5fa; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #111827;">AD</div>
            </div>
        </header>

        <!-- Section: Overview -->
        <section id="overview" style="padding-top: 20px;">
            <h2 style="font-size: 1.8rem; margin-bottom: 20px;">Dashboard Overview</h2>
            <div class="kpi-grid">
                
                <!-- KPI Card 1 -->
                <div class="kpi-card">
                    <div class="value">4,582</div>
                    <div class="label">Total Students</div>
                    <i class="fas fa-chart-line" style="float: right; font-size: 2rem; opacity: 0.5;"></i>
                </div>
                
                <!-- KPI Card 2 -->
                <div class="kpi-card" style="border-left-color: #f59e0b;">
                    <div class="value">124</div>
                    <div class="label">New Enrollments (Last 7 Days)</div>
                    <i class="fas fa-user-plus" style="float: right; font-size: 2rem; opacity: 0.5;"></i>
                </div>

                <!-- KPI Card 3 -->
                <div class="kpi-card" style="border-left-color: #10b981;">
                    <div class="value">98.5%</div>
                    <div class="label">Lecture Completion Rate</div>
                    <i class="fas fa-check-circle" style="float: right; font-size: 2rem; opacity: 0.5;"></i>
                </div>

                <!-- KPI Card 4 -->
                <div class="kpi-card" style="border-left-color: #ef4444;">
                    <div class="value">$14,200</div>
                    <div class="label">Monthly Revenue</div>
                    <i class="fas fa-dollar-sign" style="float: right; font-size: 2rem; opacity: 0.5;"></i>
                </div>
            </div>
        </section>

        <!-- Section: Recent Content Activity -->
        <section id="content-activity" style="padding-top: 40px;">
            <h2 style="font-size: 1.8rem; margin-bottom: 20px;">Recent Content Activity</h2>
            <div class="card" style="overflow-x: auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Lecture Title</th>
                            <th>Course</th>
                            <th>Last Updated</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Intro to API Design</td>
                            <td>Backend Fundamentals</td>
                            <td>2025-11-20</td>
                            <td style="color: #10b981;">Published</td>
                            <td><button>Edit</button></td>
                        </tr>
                        <tr>
                            <td>CSS Grid Layouts</td>
                            <td>Frontend Mastery</td>
                            <td>2025-11-18</td>
                            <td style="color: #f59e0b;">Draft</td>
                            <td><button>Edit</button></td>
                        </tr>
                        <tr>
                            <td>Database Migrations</td>
                            <td>DevOps Essentials</td>
                            <td>2025-11-15</td>
                            <td style="color: #10b981;">Published</td>
                            <td><button>Edit</button></td>
                        </tr>
                        <tr>
                            <td>React Hooks Deep Dive</td>
                            <td>Frontend Mastery</td>
                            <td>2025-11-10</td>
                            <td style="color: #ef4444;">Archived</td>
                            <td><button>Restore</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        
        <!-- Placeholder Sections for Navigation -->
        <section id="users" style="padding-top: 40px;">
            <h2 style="font-size: 1.8rem; margin-bottom: 20px;">User Management</h2>
            <div class="card">
                <p>User list and permissions management tools go here.</p>
                <a href="#" style="color: #60a5fa;">View All Users</a>
            </div>
        </section>

        <section id="settings" style="padding-top: 40px; padding-bottom: 40px;">
            <h2 style="font-size: 1.8rem; margin-bottom: 20px;">Platform Settings</h2>
            <div class="card">
                <p>System configuration and integration settings.</p>
            </div>
        </section>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const menuToggle = document.getElementById('menu-toggle');
            const sidebarLinks = sidebar.querySelectorAll('a');

            // --- Mobile Sidebar Toggle Logic ---
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('open');
            });
            
            // Close sidebar when a link is clicked (useful for mobile)
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 1024) {
                         sidebar.classList.remove('open');
                    }
                    
                    // Simple simulated tab switching
                    sidebarLinks.forEach(l => l.classList.remove('active'));
                    link.classList.add('active');
                });
            });

            // --- Scrollspy/Active Link Simulation (for desktop/large screens) ---
            window.addEventListener('scroll', function() {
                const scrollPos = window.scrollY + 100; // Offset for fixed topbar

                document.querySelectorAll('section[id]').forEach(section => {
                    if (section.offsetTop <= scrollPos && section.offsetTop + section.offsetHeight > scrollPos) {
                        // Activate corresponding sidebar link
                        sidebarLinks.forEach(link => {
                            if (link.getAttribute('href') === '#' + section.id) {
                                sidebarLinks.forEach(l => l.classList.remove('active'));
                                link.classList.add('active');
                            }
                        });
                    }
                });
            });

            // Set initial active link
            sidebarLinks[0].classList.add('active');
        });
    </script>
</body>
</html>