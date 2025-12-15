<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Package</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" 
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* ====== SAME CSS AS YOUR MAIN PAGE ====== */
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background-color: #1f2937;
            color: #f3f4f6;
        }
        h1, h2 {
            margin: 0;
            font-weight: 600;
        }
        a { color: #60a5fa; text-decoration: none; }
        a:hover { color: #3b82f6; }

        /* Sidebar */
        #sidebar {
            width: 250px;
            background-color: #111827;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            padding-top: 20px;
            box-sizing: border-box;
        }
        #sidebar a {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            color: #d1d5db;
            margin-bottom: 5px;
            border-left: 3px solid transparent;
            transition: 0.2s;
        }
        #sidebar a:hover, #sidebar a.active {
            background-color: #374151;
            color: #fff;
            border-left-color: #4f46e5;
        }

        #sidebar a i {
            margin-right: 12px;
        }

        /* Main content */
        #main-content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Topbar */
        #topbar {
            background-color: #1f2937;
            padding: 10px 20px;
            border-bottom: 1px solid #374151;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
        }

        /* Card / Form Box */
        .card {
            background-color: #1f2937;
            border: 1px solid #374151;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        input, textarea, select {
            width: 100%;
            padding: 12px;
            background-color: #374151;
            border: 1px solid #4b5563;
            border-radius: 6px;
            color: white;
        }
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79,70,229,0.4);
        }

        button {
            background-color: #4f46e5;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
        }
        button:hover {
            background-color: #3b82f6;
        }

    </style>
</head>

<body>

    <!-- ====================== SIDEBAR ====================== -->
    <nav id="sidebar">
        <div style="text-align: center; padding: 10px 0 30px 0;">
            <h2 style="color:#4f46e5;">Admin Panel</h2>
            <p style="color:#9ca3af;">Content Management</p>
        </div>

        <a href="{{ route('admindashboard') }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        <a href="#">
            <i class="fas fa-users"></i> User Management
        </a>

        <a href="{{ route('classmanage') }}">
            <i class="fas fa-book"></i> Courses & Lectures
        </a>

        <a href="{{ route('feedbackmanage') }}">
            <i class="fas fa-comment"></i> Feedback
        </a>

        <a href="{{ route('lesson.lessoncreate') }}">
            <i class="fas fa-layer-group"></i> Lessons
        </a>

        <a href="{{ route('package.create') }}" class="active">
            <i class="fas fa-box"></i> Packages
        </a>

        <div style="position: absolute; bottom: 20px; width: 100%; padding: 0 20px;">
            <a href="#" style="background:#374151;border-radius:6px;">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </nav>

    <!-- ====================== MAIN CONTENT ====================== -->
    <div id="main-content">

        <!-- Top Bar -->
        <header id="topbar">
            <h1>Create Package</h1>
            <div style="display:flex;align-items:center;">
                <i class="fas fa-bell" style="margin-right:20px;color:#9ca3af;"></i>
                <div style="
                    width:32px;height:32px;
                    background:#60a5fa;
                    border-radius:50%;
                    display:flex;align-items:center;justify-content:center;
                    font-weight:bold;color:#111827;
                ">AD</div>
            </div>
        </header>

        <!-- Package Form -->
        <div class="card">
            <h2 style="margin-bottom:20px;">Add New Package</h2>

            <form action="{{ route('package.store') }}" method="POST">
                @csrf

                <div style="margin-bottom:15px;">
                    <label>Select Class</label>
                    <select name="class_id" required>
                        <option value="" disabled selected>-- Select Class --</option>
                        @foreach($classes as $c)
                            <option value="{{ $c->id }}">{{ $c->className }} @if($c->month) ({{ $c->month }}) @endif</option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom:15px;">
                    <label>Monthly Fee (Rs.)</label>
                    <input type="number" name="monthly_fee" required>
                </div>

                <div style="margin-bottom:15px;">
                    <label>Description</label>
                    <textarea name="description" rows="4"></textarea>
                </div>

                <button type="submit">
                    <i class="fas fa-plus-circle" style="margin-right:8px;"></i>
                    Create Package
                </button>
            </form>
        </div>

    </div>

</body>
</html>
