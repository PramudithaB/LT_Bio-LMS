{{-- <table style="width:100%; border-collapse: collapse; margin-top:20px;">
    <thead>
        <tr style="background:#007bff; color:white;">
            <th style="padding:10px; text-align:left;">Name</th>
            <th style="padding:10px; text-align:left;">Message</th>
            <th style="padding:10px; text-align:left;">Email</th>
            <th style="padding:10px; text-align:left;">Phone_Number</th>
            <th style="padding:10px; text-align:left;">Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($feedbacks as $fb)
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px; color:#333; font-weight:bold;">
                    {{ $fb->name }}
                </td>

                <td style="padding:10px; color:#555;">
                    {{ $fb->message }}
                </td>

                <td style="padding:10px; color:#555;">
                    {{ $fb->email }}
                </td>

                <td style="padding:10px; color:#555;">
                    {{ $fb->phone_number }}
                </td>

                <td style="padding:10px;">
                    <!-- Edit Button -->
                    <button type="submit"  
                       style="padding:5px 10px; background:#ffc107; color:white; border:none; border-radius:5px; text-decoration:none; margin-right:5px;">
                        Approve
                    </button>

                    <!-- Delete Button -->
                   
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                style="padding:5px 10px; background:#dc3545; color:white; border:none; border-radius:5px; cursor:pointer;">
                            Delete
                        </button>
                    </form>
                </td> 

                
            </tr>
        @endforeach
    </tbody>
</table> --}}

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
        
    <table style="width:100%; border-collapse: collapse; margin-top:20px;">
    <thead>
        <tr style="background:#007bff; color:white;">
            <th style="padding:10px; text-align:left;">Name</th>
            <th style="padding:10px; text-align:left;">Message</th>
            <th style="padding:10px; text-align:left;">Email</th>
            <th style="padding:10px; text-align:left;">Phone_Number</th>
            <th style="padding:10px; text-align:left;">Actions</th>
            <th style="padding:10px; text-align:left;">Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach($feedbacks as $fb)
        
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px; color:#fff; font-weight:bold;">
                    {{ $fb->name }}
                </td>

                <td style="padding:10px; color:#fff;">
                    {{ $fb->message }}
                </td>

                <td style="padding:10px; color:#fff;">
                    {{ $fb->email }}
                </td>

                <td style="padding:10px; color:#fff;">
                    {{ $fb->phone_number }}
                </td>

               

                <td style="padding:10px;">
                    <!-- Edit Button -->
                    <!-- APPROVE BUTTON -->
                    <form action="{{ route('feedbackapprove', $fb->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')

                        <button type="submit"  
                            style="padding:5px 10px; background:#ffc107; color:white; border:none; border-radius:5px; text-decoration:none; margin-right:5px;">
                            Approve
                        </button>
                    </form>

                    <!-- DELETE BUTTON -->
                    <form action="{{ route('feedbackdelete', $fb->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit" 
                            style="padding:5px 10px; background:#dc3545; color:white; border:none; border-radius:5px; cursor:pointer;">
                            Delete
                        </button>
                    </form>

                    <td style="padding:10px; color:#fff;">
                        @if($fb->status == 'approved')
                            <span style="color:#22c55e; font-weight:bold;">Approved</span>
                        @else
                            <span style="color:#f59e0b; font-weight:bold;">Pending</span>
                        @endif
                    </td>


                    {{-- </form> --}}
                </td> 

                
            </tr>
        @endforeach
    </tbody>
    </table> 
        
    </div>

    
</body>
</html>


