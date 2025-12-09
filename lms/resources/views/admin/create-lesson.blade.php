<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Lesson | Admin</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body style="margin:0; font-family:Inter, sans-serif; background:#0f172a; color:white;">

    <!-- ========================= SIDEBAR ========================= -->
    <nav id="sidebar" style="
        width:260px;
        height:100vh;
        background:#111827;
        position:fixed;
        top:0;
        left:0;
        padding-top:25px;
        box-shadow:4px 0 15px rgba(0,0,0,0.4);
        border-right:1px solid rgba(255,255,255,0.05);
    ">
        <div style="text-align:center; padding:10px 0 30px 0;">
            <h2 style="font-size:1.8rem; color:#4f46e5; margin:0;">Admin Panel</h2>
            <p style="font-size:0.9rem; color:#9ca3af; margin:0;">Content Management</p>
        </div>

        <a href="#overview" class="active" style="
            display:flex; align-items:center;
            padding:14px 20px; color:#e5e7eb;
            font-size:1rem; gap:12px;
            text-decoration:none; border-radius:8px;
            margin:5px 12px; transition:0.25s;
            background:#1f2937;
        ">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        <a href="#users" style="
            display:flex; align-items:center;
            padding:14px 20px; color:#cbd5e1;
            gap:12px; text-decoration:none;
            margin:5px 12px; border-radius:8px;
            transition:0.25s;
        " onmouseover="this.style.background='#374151'" onmouseout="this.style.background='transparent'">
            <i class="fas fa-users"></i> User Management
        </a>

        <a href="{{ route('classmanage') }}" style="
            display:flex; align-items:center;
            padding:14px 20px; color:#cbd5e1;
            gap:12px; text-decoration:none;
            margin:5px 12px; border-radius:8px;
            transition:0.25s;
        " onmouseover="this.style.background='#374151'" onmouseout="this.style.background='transparent'">
            <i class="fas fa-book-open"></i> Courses & Lectures
        </a>

        <a href="{{ route('feedbackmanage') }}" style="
            display:flex; align-items:center;
            padding:14px 20px; color:#cbd5e1;
            gap:12px; text-decoration:none;
            margin:5px 12px; border-radius:8px;
            transition:0.25s;
        " onmouseover="this.style.background='#374151'" onmouseout="this.style.background='transparent'">
            <i class="fas fa-comment"></i> Feedback
        </a>

        <a href="{{route('lesson.lessoncreate')}}" style="
            display:flex; align-items:center;
            padding:14px 20px; color:#cbd5e1;
            gap:12px; text-decoration:none;
            margin:5px 12px; border-radius:8px;
            transition:0.25s;
        " onmouseover="this.style.background='#374151'" onmouseout="this.style.background='transparent'">
            <i class="fas fa-cog"></i> Lessons
        </a>

        <a href="{{route('package.create')}}" style="
            display:flex; align-items:center;
            padding:14px 20px; color:#cbd5e1;
            gap:12px; text-decoration:none;
            margin:5px 12px; border-radius:8px;
            transition:0.25s;
        " onmouseover="this.style.background='#374151'" onmouseout="this.style.background='transparent'">
            <i class="fas fa-cog"></i> Packages
        </a>

        <div style="
            position:absolute; bottom:20px; width:100%;
            padding:0 20px; box-sizing:border-box;
        ">
            <a href="#" style="
                display:flex; align-items:center;
                padding:14px 20px; background:#374151;
                color:white; border-radius:8px; gap:12px;
                text-decoration:none;
            ">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </nav>

    <!-- ========================= MAIN CONTENT ========================= -->

    <div style="margin-left:280px; padding:30px;">

        <h2 style="
            font-size:2rem; 
            margin-top:20px;
            color:#fff;
        ">Create Lesson</h2>

        <!-- ========================= FORM ========================= -->
        <form action="{{ route('lesson.lessonstore') }}" method="POST" enctype="multipart/form-data" style="
            margin-top:20px;
            background:#1f2937;
            padding:30px;
            border-radius:12px;
            width:70%;
            color:white;
            box-shadow:0 4px 20px rgba(0,0,0,0.4);
        ">
            @csrf

            <!-- Class Select -->
            <label style="display:block; margin-bottom:6px; font-weight:600;">Select Class</label>
            <select name="class_id" required style="
                width:100%; padding:12px; border-radius:8px;
                border:none; background:#374151; color:white;
                margin-bottom:20px;
            ">
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->className }}</option>
                @endforeach
            </select>

            <!-- Lesson Name -->
            <label style="display:block; margin-bottom:6px; font-weight:600;">Lesson Name</label>
            <input type="text" name="name" required style="
                width:100%; padding:12px; border-radius:8px;
                border:none; background:#374151; color:white;
                margin-bottom:20px;
            ">

            <!-- Description -->
            <label style="display:block; margin-bottom:6px; font-weight:600;">Description</label>
            <textarea name="description" style="
                width:100%; padding:12px; border-radius:8px;
                border:none; height:100px;
                background:#374151; color:white;
                margin-bottom:20px;
            "></textarea>

            <!-- Link -->
            <label style="display:block; margin-bottom:6px; font-weight:600;">Link (YouTube, Vimeo, Drive)</label>
            <input type="text" name="link" style="
                width:100%; padding:12px; border-radius:8px;
                border:none; background:#374151; color:white;
                margin-bottom:20px;
            ">

            <!-- File Upload -->
            <label style="display:block; margin-bottom:6px; font-weight:600;">Upload PDF / Image</label>
            <input type="file" name="file" style="
                width:100%; padding:12px; border-radius:8px;
                background:#374151; color:white;
                margin-bottom:20px;
            ">

            <!-- Notice -->
            <label style="display:block; margin-bottom:6px; font-weight:600;">Notice</label>
            <textarea name="notice" style="
                width:100%; padding:12px; border-radius:8px;
                border:none; height:100px;
                background:#374151; color:white;
                margin-bottom:20px;
            "></textarea>

            <!-- Paid -->
            <label style="display:block; margin-bottom:6px; font-weight:600;">Paid?</label>
            <select name="is_paid" required style="
                width:100%; padding:12px; border-radius:8px;
                border:none; background:#374151; color:white;
                margin-bottom:25px;
            ">
                <option value="0">No (Free)</option>
                <option value="1">Yes (Paid)</option>
            </select>

            <!-- Submit Button -->
            <button type="submit" style="
                width:100%; padding:15px;
                background:#4f46e5; border:none;
                color:white; border-radius:8px;
                font-size:1rem; font-weight:600;
                cursor:pointer; transition:0.2s;
            "
            onmouseover="this.style.background='#6366f1'"
            onmouseout="this.style.background='#4f46e5'">
                Create Lesson
            </button>
        </form>

    </div>

</body>
</html>
