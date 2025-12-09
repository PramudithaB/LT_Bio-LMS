<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management Dashboard</title>
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
            cursor: pointer; /* Indicate clickable link */
        }
        #sidebar a:hover, #sidebar a.active {
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

        /* Card and Form Styles */
        .card {
            background-color: #1f2937;
            border: 1px solid #374151;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        
        /* Form Specific Styles */
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #d1d5db;
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #4b5563;
            background-color: #374151;
            color: #fff;
            box-sizing: border-box;
            transition: border-color 0.2s;
        }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.5);
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        .btn-submit {
            background-color: #4f46e5;
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .btn-submit:hover {
            background-color: #3b82f6;
        }

        /* Hide sections initially (SPA simulation) */
        .page-section {
            display: none;
            padding-top: 20px;
        }
        .page-section.active {
            display: block;
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
        <a href="{{ route('admindashboard') }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a href="#users">
            <i class="fas fa-users"></i> User Management
        </a>
        <a href="{{ route('classmanage') }}">
            <i class="fas fa-book-open"></i> Courses & Lectures
        </a>
        <a href="{{ route('feedbackmanage') }}">
            <i class="fas fa-book-open"></i> Feedback
        </a>
        <a href="{{route('lesson.lessoncreate')}}">
            <i class="fas fa-cog"></i> lessons
        </a>
         <a href="{{route('package.create')}}">
            <i class="fas fa-cog"></i> Packages
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
            <h1 class="current-title hidden-mobile" style="font-size: 1.5rem;">Add New Class</h1>
            <div class="flex items-center">
                <i class="fas fa-bell" style="margin-right: 20px; color: #9ca3af;"></i>
                <div style="width: 32px; height: 32px; background-color: #60a5fa; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #111827;">AD</div>
            </div>
        </header>

        <!-- ==================================================================== -->
        <!-- 1. DASHBOARD OVERVIEW SECTION (Hidden by Default) -->
        <!-- ==================================================================== -->
        <!-- Removed 'active' class -->
        <section id="overview" class="page-section">
            <h2 style="font-size: 1.8rem; margin-bottom: 20px;">Dashboard Overview</h2>
            <div class="kpi-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                
                <!-- KPI Card 1 -->
                <div class="kpi-card" style="background-color: #374151; color: #fff; padding: 20px; border-radius: 8px; border-left: 5px solid #4f46e5;">
                    <div class="value" style="font-size: 2rem; font-weight: 700;">4,582</div>
                    <div class="label" style="font-size: 0.9rem; color: #9ca3af;">Total Students</div>
                    <i class="fas fa-chart-line" style="float: right; font-size: 2rem; opacity: 0.5;"></i>
                </div>
                
                <!-- KPI Card 2 -->
                <div class="kpi-card" style="background-color: #374151; color: #fff; padding: 20px; border-radius: 8px; border-left: 5px solid #f59e0b;">
                    <div class="value" style="font-size: 2rem; font-weight: 700;">124</div>
                    <div class="label" style="font-size: 0.9rem; color: #9ca3af;">New Enrollments (Last 7 Days)</div>
                    <i class="fas fa-user-plus" style="float: right; font-size: 2rem; opacity: 0.5;"></i>
                </div>

                <!-- KPI Card 3 -->
                <div class="kpi-card" style="background-color: #374151; color: #fff; padding: 20px; border-radius: 8px; border-left: 5px solid #10b981;">
                    <div class="value" style="font-size: 2rem; font-weight: 700;">98.5%</div>
                    <div class="label" style="font-size: 0.9rem; color: #9ca3af;">Lecture Completion Rate</div>
                    <i class="fas fa-check-circle" style="float: right; font-size: 2rem; opacity: 0.5;"></i>
                </div>

                <!-- KPI Card 4 -->
                <div class="kpi-card" style="background-color: #374151; color: #fff; padding: 20px; border-radius: 8px; border-left: 5px solid #ef4444;">
                    <div class="value" style="font-size: 2rem; font-weight: 700;">$14,200</div>
                    <div class="label" style="font-size: 0.9rem; color: #9ca3af;">Monthly Revenue</div>
                    <i class="fas fa-dollar-sign" style="float: right; font-size: 2rem; opacity: 0.5;"></i>
                </div>
            </div>
            
            <h3 style="font-size: 1.5rem; margin: 40px 0 20px 0;">Recent Content Activity</h3>
            <div class="card" style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="padding: 12px 15px; text-align: left; background-color: #374151; color: #e5e7eb; font-weight: 700; text-transform: uppercase; font-size: 0.8rem; border-bottom: 1px solid #374151;">Lecture Title</th>
                            <th style="padding: 12px 15px; text-align: left; background-color: #374151; color: #e5e7eb; font-weight: 700; text-transform: uppercase; font-size: 0.8rem; border-bottom: 1px solid #374151;">Course</th>
                            <th style="padding: 12px 15px; text-align: left; background-color: #374151; color: #e5e7eb; font-weight: 700; text-transform: uppercase; font-size: 0.8rem; border-bottom: 1px solid #374151;">Last Updated</th>
                            <th style="padding: 12px 15px; text-align: left; background-color: #374151; color: #e5e7eb; font-weight: 700; text-transform: uppercase; font-size: 0.8rem; border-bottom: 1px solid #374151;">Status</th>
                            <th style="padding: 12px 15px; text-align: left; background-color: #374151; color: #e5e7eb; font-weight: 700; text-transform: uppercase; font-size: 0.8rem; border-bottom: 1px solid #374151;">Actions</th>
                        </tr>
                
                </table>
            </div>
        </section>
    
        <!-- ==================================================================== -->
        <!-- 2. CLASS ADD PAGE (Active by Default) -->
        <!-- ==================================================================== -->
        <!-- Added 'active' class -->
        <form action={{route('classstore')}} method="POST" enctype="multipart/form-data">
            @csrf
        <section id="class-add" class="page-section active">
            <h2 style="font-size: 1.8rem; margin-bottom: 20px;">Add New Class</h2>
            <div class="card">
                <form id="add-class-form">
                    <div class="form-group">
                        <label for="className">Class Name</label>
                        <input type="text" id="className" name="className" placeholder="e.g., Advanced JavaScript Patterns" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" placeholder="A brief summary of the course content and learning goals." required></textarea>
                    </div>
                    
                    <div style="display: flex; gap: 20px;">
                        <div class="form-group" style="flex: 1;">
                            <label for="teacherName">Teacher Name</label>
                            <input type="text" id="teacherName" name="teacherName" placeholder="e.g., Jane Doe" required>
                        </div>

                        <div class="form-group" style="flex: 1;">
                            <label for="classTime">Scheduled Time</label>
                            <input type="text" id="classTime" name="classTime" placeholder="e.g., Every Tuesday 19:00 - 21:00 EST" required>
                        </div>
                    </div>

                    <div style="display: flex; gap: 20px;">
                        <div class="form-group" style="flex: 1;">
                            <label for="sessionCount">Total Sessions</label>
                            <input type="number" id="sessionCount" name="sessionCount" placeholder="e.g., 12" required min="1">
                        </div>

                        <div class="form-group" style="flex: 1;">
                            <label for="Month">Month</label>
                            <select id="Month" name="month" required>
                                <option value="" disabled selected>Select Month</option>
                                <option value="January">January </option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="Auguest">Auguest</option>
                                <option value="September">September</option>
                                <option value="Octomber">Octomber</option>
                                <option value="November">November</option>
                                <option value="December">December</option>

                            </select>
                        </div>
                    </div>

                    {{-- Week 1

                     <!-- week 1 class  -->

                    <div style="display: flex; gap: 20px;">
    <div class="form-group" style="flex: 1;">
        <label for="week1Name">Week 1 Name:</label>
        <input type="text" id="week1Name" name="week1Name" placeholder="e.g., Introduction to HTML" required>
    </div>

    <div class="form-group" style="flex: 1;">
        <label for="week1Desc">Week 1 Description:</label>
        <input type="text" id="week1Desc" name="week1Desc" placeholder="e.g., Basics and structure" required>
    </div>
</div>

<div style="display: flex; gap: 20px; margin-top: 15px;">
    <div class="form-group" style="flex: 1;">
        <label for="week1Link">Week 1 Link:</label>
        <input type="url" id="week1Link" name="week1Link" placeholder="e.g., https://example.com/class" required>
    </div>

    <div class="form-group" style="flex: 1;">
        <label for="week1Files">Week 1 PDFs / Images:</label>
        <input type="file" id="week1Files" name="week1Files[]" multiple accept="image/*, application/pdf" required>
    </div>
</div>

<div style="display: flex; gap: 20px; margin-top: 15px;">
    <div class="form-group" style="flex: 1;">
        <label for="week1LongDesc">Week 1 Long Description:</label>
        <textarea id="week1LongDesc" name="week1LongDesc" placeholder="Write detailed description here..." required></textarea>
    </div>

    <div class="form-group" style="flex: 1;">
        <label for="specialNotice">Special Notice in Week 1:</label>
        <textarea id="specialNotice" name="specialNoticeW1" placeholder="Any important notes..." required></textarea>
    </div>
</div>
                 --}}

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-plus-circle" style="margin-right: 8px;"></i>Create Class
                    </button>
                </form>
            </div>
        </section>
        </form>
        <!-- ==================================================================== -->
        <!-- 3. USER MANAGEMENT SECTION (Placeholder) -->
        <!-- ==================================================================== -->
        <section id="users" class="page-section">
            <h2 style="font-size: 1.8rem; margin-bottom: 20px;">User Management</h2>
            <div class="card">
                <p>User list and permissions management tools go here.</p>
                <a href="#" style="color: #60a5fa;">View All Users</a>
            </div>
        </section>

        <!-- ==================================================================== -->
        <!-- 4. SETTINGS SECTION (Placeholder) -->
        <!-- ==================================================================== -->
        <section id="settings" class="page-section" style="padding-bottom: 40px;">
            <h2 style="font-size: 1.8rem; margin-bottom: 20px;">Platform Settings</h2>
            <div class="card">
                <p>System configuration and integration settings.</p>
            </div>
        </section>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.getElementById('menu-toggle');
            const sidebarLinks = sidebar.querySelectorAll('a[data-target]');
            const sections = document.querySelectorAll('.page-section');
            const currentTitle = document.querySelector('.current-title');

            // Map link target to a friendly title for the top bar
            const titleMap = {
                'overview': 'Dashboard Overview',
                'users': 'User Management',
                'class-add': 'Add New Class',
                'settings': 'Platform Settings'
            };

            // --- Function to switch pages ---
            function navigateToSection(targetId, linkElement) {
                // 1. Hide all sections and remove active class from all links
                sections.forEach(s => s.classList.remove('active'));
                sidebarLinks.forEach(l => l.classList.remove('active'));

                // 2. Show the target section and set link as active
                const targetSection = document.getElementById(targetId);
                if (targetSection) {
                    targetSection.classList.add('active');
                    linkElement.classList.add('active');
                    currentTitle.textContent = titleMap[targetId];
                }

                // 3. Close sidebar on mobile after navigation
                if (window.innerWidth <= 1024) {
                     sidebar.classList.remove('open');
                }
            }

            // --- Event Listeners ---

            // Sidebar navigation clicks
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = link.getAttribute('data-target');
                    if (targetId) {
                        navigateToSection(targetId, link);
                        // Ensure the browser URL reflects the change (for back button/refresh consistency)
                        history.pushState(null, '', link.getAttribute('href'));
                    }
                });
            });

            // Mobile Sidebar Toggle
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('open');
            });
            
            // Form Submission Handler (Placeholder)
            document.getElementById('add-class-form').addEventListener('submit', function(e) {
                e.preventDefault();
                console.log('Form Submitted!');
                
                // Collect form data (Example)
           

                // In a real application, you would send this to a backend API (e.g., using fetch)
                console.log('Class Data:', formData);

                // Simple success feedback
                alert('Class "' + formData.name + '" scheduled successfully!');
                
                // Clear form
                this.reset();
            });

            // Handle initial load based on URL hash (if available)
            const initialHash = window.location.hash.substring(1);
            if (initialHash) {
                const initialLink = document.querySelector(`a[data-target="${initialHash}"]`);
                if (initialLink) {
                    navigateToSection(initialHash, initialLink);
                }
            } else {
                // Default view is 'class-add' based on manual HTML structure
                currentTitle.textContent = titleMap['class-add'];
            }
        });
    </script>
</body>
</html>