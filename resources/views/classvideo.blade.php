<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $lesson->name }} - Lecture Viewer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; margin: 0; background-color: #f4f7fa; color: #333; }
        #video-embed-container { position: relative; width: 100%; padding-top: 56.25%; }
        #video-embed-container iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
        #video-shield { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 5; background: rgba(0,0,0,0.001); }
        @media (min-width: 1024px) { #app > div { flex-direction: row !important; } }
    </style>
</head>

<body>

<div id="app" style="max-width: 1400px; margin: 0 auto; padding: 20px;">

    <!-- Header -->
    <header style="background-color: #ffffff; padding: 15px 30px; border-radius: 12px; margin-bottom: 20px; display: flex; justify-content: space-between;">
        <h1 style="font-size: 1.5rem; font-weight: 700; color: #1e40af;">
            {{ $lesson->classModel->className }} - {{ $lesson->name }}
        </h1>

        <a href="{{ route('class.lessons', $lesson->class_id) }}"
           style="background-color: #e2e8f0; padding: 8px 15px; border-radius: 8px; font-weight: 600; color: #4a5568;">
            <i class="fas fa-arrow-left" style="margin-right: 8px;"></i>Back to Class
        </a>
    </header>

    <!-- Layout -->
    <div style="display: flex; flex-direction: column; gap: 20px;">

        <!-- LEFT SIDE -->
        <div id="video-content" style="flex: 3 1 70%;">

            <!-- Video Player -->
            <div style="background-color: #1a202c; border-radius: 12px; overflow: hidden;">
                <div id="video-embed-container">

                    @php
                        // Extract YouTube ID
                        function getYoutubeId($url) {
                            preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                            return $matches[1] ?? null;
                        }
                        $videoId = getYoutubeId($lesson->link);
                    @endphp

                    @if($videoId)
                        <iframe
                            src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&modestbranding=1"
                            frameborder="0"
                            allowfullscreen>
                        </iframe>
                    @else
                        <p style="color: white; padding: 20px;">No video link available.</p>
                    @endif

                    <div id="video-shield"></div>
                </div>
            </div>

            <!-- Lesson Description -->
            <div style="background-color: #ffffff; padding: 30px; border-radius: 12px; margin-top: 20px;">
                <h2 style="font-size: 1.5rem; margin-bottom: 10px;">{{ $lesson->name }}</h2>

                <p style="color: #4a5568;">{{ $lesson->description }}</p>

                @if($lesson->notice)
                    <div style="margin-top: 20px; padding: 15px; background: #fff3cd; border-left: 4px solid #ffce3d;">
                        <strong>Notice:</strong> {{ $lesson->notice }}
                    </div>
                @endif

                <p style="margin-top: 15px;">
                    <strong>Status:</strong> {{ $lesson->is_paid ? 'Paid Lesson' : 'Free Lesson' }}
                </p>
            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div id="sidebar" style="flex: 1 1 30%;">

            <!-- Materials -->
            <div style="background-color: #ffffff; padding: 25px; border-radius: 12px; margin-bottom: 20px;">
                <h3 style="font-size: 1.25rem; margin-bottom: 15px;"><i class="fas fa-book-open"></i> Lesson Materials</h3>

                @if($lesson->file_path)
                    <a href="{{ asset('storage/'.$lesson->file_path) }}" target="_blank"
                       style="display: flex; align-items: center; padding: 10px; background: #e0f2fe; border: 1px solid #bfdbfe; border-radius: 8px; color: #1e40af; margin-bottom: 10px;">
                        <i class="fas fa-file-download" style="margin-right: 10px;"></i>
                        Download Attached File
                    </a>
                @else
                    <p>No materials uploaded.</p>
                @endif
            </div>

            <!-- Outline Placeholder -->
            <div style="background-color: #ffffff; padding: 25px; border-radius: 12px;">
                <h3 style="font-size: 1.25rem; margin-bottom: 15px;"><i class="fas fa-list-ol"></i> Course Outline</h3>

                <p style="color: #4a5568;">This will later show module outline for the class.</p>
            </div>

        </div>
    </div>
</div>

</body>
</html>
