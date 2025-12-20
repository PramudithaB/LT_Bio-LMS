<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* minimal copy of admin styles (keeps sidebar look consistent) */
        body { font-family: 'Inter', sans-serif; margin:0; background:#1f2937; color:#f3f4f6; }
        #sidebar { width:250px; background:#111827; position:fixed; top:0; left:0; height:100%; padding-top:20px; box-sizing:border-box; }
        #sidebar a { padding:12px 20px; display:flex; align-items:center; color:#d1d5db; margin-bottom:5px; border-left:3px solid transparent; text-decoration:none; }
        #sidebar a:hover, #sidebar a.active { background:#374151; color:#fff; border-left-color:#4f46e5; }
        #main-content { margin-left:250px; padding:24px; box-sizing:border-box; min-height:100vh; }
        .card { background:#111827; border:1px solid #374151; padding:18px; border-radius:10px; margin-bottom:20px; }
        .data-table { width:100%; border-collapse:collapse; }
        .data-table th, .data-table td { padding:10px 12px; border-bottom:1px solid #374151; color:#e5e7eb; text-align:left; font-size:0.95rem; }
        .data-table th { background:#374151; text-transform:uppercase; font-size:0.8rem; color:#e5e7eb; }
        .btn { display:inline-block; padding:6px 10px; border-radius:6px; text-decoration:none; color:#fff; }
        .btn-edit { background:#4f46e5; }
        .btn-delete { background:#dc2626; }
        .summary-table { width:320px; border-collapse:collapse; margin-left:12px; }
        .summary-table th, .summary-table td { padding:8px 10px; border-bottom:1px solid #374151; color:#e5e7eb; }
        @media (max-width: 900px) {
            #sidebar { transform:translateX(-100%); position:fixed; }
            #main-content { margin-left:0; padding:16px; }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR (same links as admin dashboard) -->
    <nav id="sidebar" aria-label="Admin sidebar">
        <div style="text-align:center; padding:10px 0 24px 0;">
            <h2 style="font-size:1.2rem; color:#4f46e5; margin:0;">Admin Panel</h2>
            <p style="color:#9ca3af; margin:6px 0 0 0; font-size:0.85rem;">Content Management</p>
        </div>

        <a href="{{ route('admindashboard') }}">
            <i class="fas fa-tachometer-alt" style="width:18px; margin-right:10px;"></i> Dashboard
        </a>

        <a href="{{ route('admindashboard') }}">
            <i class="fas fa-chart-line" style="width:18px; margin-right:10px;"></i> Overview
        </a>

        <a href="{{ route('classmanage') }}">
            <i class="fas fa-book-open" style="width:18px; margin-right:10px;"></i> Courses & Lectures
        </a>

        <a href="{{ route('feedbackmanage') }}">
            <i class="fas fa-comment" style="width:18px; margin-right:10px;"></i> Feedback
        </a>

        <a href="{{ route('lesson.lessoncreate') }}">
            <i class="fas fa-layer-group" style="width:18px; margin-right:10px;"></i> Lessons
        </a>

        <a href="{{ route('package.create') }}">
            <i class="fas fa-box" style="width:18px; margin-right:10px;"></i> Packages
        </a>

        <!-- Active: User Management -->
        <a href="{{ route('usermanagement') }}" class="active" style="margin-top:6px;">
            <i class="fas fa-users" style="width:18px; margin-right:10px;"></i> User Management
        </a>

        <a href="{{ route('paymentmanage') }}">
            <i class="fas fa-file-invoice-dollar" style="width:18px; margin-right:10px;"></i> Payment Management
        </a>

        <div style="position:absolute; bottom:20px; width:100%; padding:0 20px; box-sizing:border-box;">
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" style="width:100%; text-align:left; border:none; background:#374151; border-radius:6px; padding:12px 20px; color:#d1d5db;">
                    <i class="fas fa-sign-out-alt" style="margin-right:10px;"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main id="main-content" role="main">
        <header style="display:flex; align-items:center; justify-content:space-between; gap:16px; margin-bottom:18px;">
            <div>
                <h1 style="margin:0; font-size:1.5rem; color:#e6edf3;">User Management</h1>
                <p style="margin:6px 0 0 0; color:#9ca3af;">Manage registered users and view exam-year summary.</p>
            </div>
            <div style="display:flex; gap:8px; align-items:center;">
                <a href="{{ route('register') }}" class="btn btn-edit" style="background:#10b981;">Create User</a>
            </div>
        </header>

        <div style="display:flex; gap:18px; flex-wrap:wrap;">
            @php
                // Group users by exam_year; map empty/null to "Unspecified", sort keys desc
                $grouped = collect($users)
                    ->groupBy(function($u){
                        $y = $u->exam_year ?? 'Unspecified';
                        return $y === '' ? 'Unspecified' : $y;
                    })->sortKeysDesc();
            @endphp

            <div style="flex:1 1 100%;">
                @if($grouped->isEmpty())
                    <div class="card">
                        <p style="color:#9ca3af;">No users found.</p>
                    </div>
                @else
                    @foreach($grouped as $year => $usersInYear)
                        <section class="card" style="margin-bottom:18px;">
                            <h3 style="margin:0 0 10px 0; font-size:1.05rem; color:#fff; font-weight:800;">
                                {{ $year }} <span style="color:#9ca3af; font-weight:600; margin-left:8px;">({{ $usersInYear->count() }})</span>
                            </h3>

                            <div style="overflow-x:auto; margin-top:8px;">
                                <table class="data-table" aria-describedby="users-{{ \Illuminate\Support\Str::slug($year) }}">
                                    <thead>
                                        <tr>
                                            <th style="width:48px;">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>WhatsApp</th>
                                            <th>ID Number</th>
                                            <th>Address</th>
                                            <th>Registered</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($usersInYear as $u)
                                            <tr>
                                                <td>{{ $u->id }}</td>
                                                <td>{{ $u->name }}</td>
                                                <td>{{ $u->email }}</td>
                                                <td>{{ $u->whatsapp_number ?? '-' }}</td>
                                                <td>{{ $u->id_number ?? '-' }}</td>
                                                <td style="max-width:320px; white-space:normal; color:#d1d5db;">{{ \Illuminate\Support\Str::limit($u->address ?? '-', 120) }}</td>
                                                <td>{{ optional($u->created_at)->format('Y-m-d') }}</td>
                                                <td>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-delete" style="font-size:0.78rem; padding:5px 8px; margin-left:6px;">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    @endforeach
                @endif
            </div>
         </div>
    </main>

</body>
</html>
