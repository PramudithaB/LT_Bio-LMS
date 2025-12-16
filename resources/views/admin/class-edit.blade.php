<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Class</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            width: 100%;
            padding: 40px;
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 2rem;
        }

        .breadcrumb {
            margin-bottom: 30px;
            color: #666;
        }

        .breadcrumb a {
            color: #667eea;
            text-decoration: none;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #667eea;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ route('admindashboard') }}"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        </div>

        <h1><i class="fas fa-edit"></i> Edit Class</h1>
        <p style="color: #666; margin-bottom: 30px;">Update the class information below</p>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('class.update', $class->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="className">
                    <i class="fas fa-chalkboard"></i> Class Name *
                </label>
                <input type="text" id="className" name="className" value="{{ old('className', $class->className) }}" required>
            </div>

            <div class="form-group">
                <label for="description">
                    <i class="fas fa-align-left"></i> Description
                </label>
                <textarea id="description" name="description">{{ old('description', $class->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="teacherName">
                    <i class="fas fa-user-tie"></i> Teacher Name
                </label>
                <input type="text" id="teacherName" name="teacherName" value="{{ old('teacherName', $class->teacherName) }}">
            </div>

            <div class="form-group">
                <label for="classTime">
                    <i class="fas fa-clock"></i> Class Time
                </label>
                <input type="text" id="classTime" name="classTime" value="{{ old('classTime', $class->classTime) }}" placeholder="e.g., Mon-Fri 9:00 AM">
            </div>

            <div class="form-group">
                <label for="sessionCount">
                    <i class="fas fa-list-ol"></i> Session Count
                </label>
                <input type="number" id="sessionCount" name="sessionCount" value="{{ old('sessionCount', $class->sessionCount) }}" min="1">
            </div>

            <div class="form-group">
                <label for="month">
                    <i class="fas fa-calendar"></i> Month
                </label>
                <input type="text" id="month" name="month" value="{{ old('month', $class->month) }}" placeholder="e.g., January 2025">
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Class
                </button>
                <a href="{{ route('admindashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</body>
</html>
