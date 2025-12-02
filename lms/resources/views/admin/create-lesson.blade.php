<h2>Create Lesson</h2>

<form action="{{ route('lesson.lessonstore') }}" method="POST" enctype="multipart/form-data">
    @csrf


    <!-- Select Class -->
    <label>Select Class</label>
    <select name="class_id" required>
        @foreach($classes as $class)
            <option value="{{ $class->id }}">{{ $class->className }}</option>
        @endforeach
    </select>

    <!-- Lesson Name -->
    <label>Lesson Name</label>
    <input type="text" name="name" required>

    <!-- Description -->
    <label>Description</label>
    <textarea name="description"></textarea>

    <!-- Video / External Link -->
    <label>Link (YouTube, Vimeo, Google Drive, etc.)</label>
    <input type="text" name="link">

    <!-- PDF/Image Upload -->
    <label>Upload PDF or Image</label>
    <input type="file" name="file">

    <!-- Notice -->
    <label>Notice</label>
    <textarea name="notice"></textarea>

    <!-- Paid Version -->
    <label>Paid?</label>
    <select name="is_paid" required>
        <option value="0">No (Free)</option>
        <option value="1">Yes (Paid)</option>
    </select>

    <button type="submit">Create Lesson</button>
</form>
