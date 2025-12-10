<nav id="sidebar" style="width:260px; background:#1f2937; height:100vh; padding:20px; color:white; position:fixed;">
    
    <div style="text-align: center; padding: 10px 0 30px 0;">
        <h2 style="font-size: 1.8rem; color: #4f46e5;">Admin Panel</h2>
        <p style="font-size: 0.9rem; color: #9ca3af;">Content Management</p>
    </div>

    <!-- MENU ITEMS -->
    <a href="{{ route('admindashboard') }}" style="display:block; padding:10px; color:white;">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>

    <a href="#users" style="display:block; padding:10px; color:white;">
        <i class="fas fa-users"></i> User Management
    </a>

    <a href="{{ route('classmanage') }}" style="display:block; padding:10px; color:white;">
        <i class="fas fa-book-open"></i> Courses & Lectures
    </a>

    <a href="{{ route('feedbackmanage') }}" style="display:block; padding:10px; color:white;">
        <i class="fas fa-comment"></i> Feedback
    </a>

    <a href="{{ route('lesson.lessoncreate') }}" style="display:block; padding:10px; color:white;">
        <i class="fas fa-cog"></i> Lessons
    </a>

    <a href="{{ route('package.create') }}" style="display:block; padding:10px; color:white;">
        <i class="fas fa-cog"></i> Packages
    </a>

    <!-- LOGOUT -->
    <div style="position: absolute; bottom: 20px; width: 100%; padding: 0 20px;">
        <a href="#" style="display:block; padding:10px; background:#374151; border-radius:6px; color:white;">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</nav>



<!-- MAIN CONTENT (CREATE LESSON FORM) -->
<div style="margin-left:280px; padding:30px;">

    <h2 style="font-size:24px; margin-bottom:20px;">Create Lesson</h2>

    <form action="{{ route('lesson.lessonstore') }}" method="POST" enctype="multipart/form-data" style="max-width:600px;">
        @csrf

        <!-- Select Class -->
        <label>Select Class</label>
        <select name="class_id" required style="width:100%; padding:8px; margin-bottom:12px;">
            @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->className }}</option>
            @endforeach
        </select>

        <!-- Lesson Name -->
        <label>Lesson Name</label>
        <input type="text" name="name" required style="width:100%; padding:8px; margin-bottom:12px;">

        <!-- Description -->
        <label>Description</label>
        <textarea name="description" style="width:100%; padding:8px; margin-bottom:12px;"></textarea>

        <!-- Video / External Link -->
        <label>Link (YouTube, Vimeo, Google Drive, etc.)</label>
        <input type="text" name="link" style="width:100%; padding:8px; margin-bottom:12px;">

        <!-- PDF/Image Upload -->
        <label>Upload PDF or Image</label>
        <input type="file" name="file" style="margin-bottom:12px;">

        <!-- Notice -->
        <label>Notice</label>
        <textarea name="notice" style="width:100%; padding:8px; margin-bottom:12px;"></textarea>

        <!-- Paid Version -->
        <label>Paid?</label>
        <select name="is_paid" required style="width:100%; padding:8px; margin-bottom:12px;">
            <option value="0">No (Free)</option>
            <option value="1">Yes (Paid)</option>
        </select>

        <button type="submit" 
                style="padding:10px 20px; background:#4f46e5; color:white; border:none; border-radius:5px;">
            Create Lesson
        </button>

    </form>
</div>
