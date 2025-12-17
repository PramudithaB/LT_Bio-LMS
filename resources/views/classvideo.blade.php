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

      
    </header>

    <!-- Layout -->
    <div style="display: flex; flex-direction: column; gap: 20px;">

        <!-- LEFT SIDE -->
        <div id="video-content" style="flex: 3 1 70%;">

            <!-- Video Player -->
            <div style="background-color: #1a202c; border-radius: 12px; overflow: hidden; position:relative;">
                <div id="video-embed-container">

                    @php
                        // Improved YouTube ID extraction: supports v=, youtu.be/, /embed/
                        function getYoutubeId($url) {
                            if (! $url) return null;
                            // If already an embed id
                            if (preg_match('/^[A-Za-z0-9_-]{11}$/', $url)) {
                                return $url;
                            }
                            // youtu.be/ID
                            if (preg_match('#youtu\.be/([A-Za-z0-9_-]{11})#', $url, $m)) {
                                return $m[1];
                            }
                            // v=ID in query
                            if (preg_match('/[\\?&]v=([A-Za-z0-9_-]{11})/', $url, $m)) {
                                return $m[1];
                            }
                            // /embed/ID
                            if (preg_match('#/embed/([A-Za-z0-9_-]{11})#', $url, $m)) {
                                return $m[1];
                            }
                            // last 11 chars fallback
                            if (preg_match('/([A-Za-z0-9_-]{11})$/', $url, $m)) {
                                return $m[1];
                            }
                            return null;
                        }
                        $videoId = getYoutubeId($lesson->link);
                        $origin = urlencode(request()->getSchemeAndHttpHost());
                    @endphp

                    @if($videoId)
                        {{-- iframe: include origin & playsinline; keep mute=1 so autoplay can start --}}
                        <iframe
                            id="lessonIframe"
                            src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&modestbranding=1&enablejsapi=1&autoplay=1&mute=1&playsinline=1&origin={{ $origin }}"
                            frameborder="0"
                            allow="autoplay; encrypted-media; fullscreen; picture-in-picture"
                            allowfullscreen>
                        </iframe>

                        <!-- Unmute overlay (shown if programmatic unmute is blocked) -->
                        <div id="unmuteOverlay" style="display:none; position:absolute; inset:0; z-index:12; display:flex; align-items:center; justify-content:center; pointer-events:auto;">
                            <button id="unmuteBtn" style="background:rgba(0,0,0,0.7); color:#fff; border:none; padding:12px 18px; border-radius:8px; font-weight:700; cursor:pointer;">
                                Unmute & Play
                            </button>
                        </div>

                        <!-- Play/Pause control (visible overlay) -->
                        <div id="playPauseOverlay" style="position:absolute; left:18px; bottom:18px; z-index:13; pointer-events:auto;">
                            <button id="playPauseBtn" aria-pressed="false"
                                style="background:rgba(0,0,0,0.6); color:#fff; border:none; padding:8px 12px; border-radius:8px; font-weight:700; cursor:pointer;">
                                Pause
                            </button>
                        </div>
                     @else
                         <p style="color: white; padding: 20px;">No playable YouTube link found. If this is an external video, open it in a new tab.</p>
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
                    <a href="{{ route('storage.file', ['encoded' => base64_encode($lesson->file_path)]) }}" target="_blank"
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

<!-- Initialize Lucide Icons -->
<script>
	lucide.createIcons();
</script>

<!-- YouTube IFrame API + improved unmute/play flow -->
<script>
(function(){
    const iframe = document.getElementById('lessonIframe');
    if (!iframe) return;

    // Load YT API if not already present
    if (!window.YT) {
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScript = document.getElementsByTagName('script')[0];
        firstScript.parentNode.insertBefore(tag, firstScript);
    }

    let player;
    window.onYouTubeIframeAPIReady = function() {
        try {
            player = new YT.Player('lessonIframe', {
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange,
                    'onError': onPlayerError
                }
            });
        } catch (err) {
            console.error('YT Player init error', err);
            document.getElementById('unmuteOverlay').style.display = 'flex';
        }
    };

    function onPlayerReady(event){
        // expose player globally for control
        window.lessonPlayer = event.target;

        console.info('Player ready — attempting autoplay (muted).');
        try {
            // Start muted playback (most browsers allow muted autoplay)
            event.target.mute();
            event.target.playVideo();
        } catch (e) {
            console.warn('playVideo muted failed', e);
        }

        // After a short delay attempt to unmute (may be blocked)
        setTimeout(function(){
            try {
                event.target.unMute();
                event.target.setVolume(100);
                setTimeout(checkMuted, 300);
            } catch (err) {
                console.warn('Programmatic unmute blocked or errored', err);
                showOverlay();
            }
        }, 600);

        // update play/pause button initial label based on state
        updatePlayPauseButton();
    }

    function onPlayerStateChange(e){
        // update button label when state changes
        updatePlayPauseButton();
    }

    function onPlayerError(e){
        console.error('YT Player error', e.data);
        showOverlay();
    }

    function checkMuted(){
        try {
            if (!window.lessonPlayer) return showOverlay();
            if (window.lessonPlayer.isMuted && window.lessonPlayer.isMuted()) {
                showOverlay();
                return;
            }
            if (typeof window.lessonPlayer.getVolume === 'function' && window.lessonPlayer.getVolume() === 0) {
                showOverlay();
                return;
            }
            hideOverlay();
        } catch (err) {
            console.warn('checkMuted error', err);
            showOverlay();
        }
    }

    function showOverlay(){
        const ov = document.getElementById('unmuteOverlay');
        if (ov) ov.style.display = 'flex';
    }
    function hideOverlay(){
        const ov = document.getElementById('unmuteOverlay');
        if (ov) ov.style.display = 'none';
    }

    // Play / Pause toggle
    function isPlaying() {
        if (!window.lessonPlayer || typeof window.lessonPlayer.getPlayerState !== 'function') return false;
        // YT states: 1 = playing, 2 = paused, 0 = ended, 3 = buffering
        return window.lessonPlayer.getPlayerState() === 1;
    }

    function updatePlayPauseButton() {
        const btn = document.getElementById('playPauseBtn');
        if (!btn) return;
        try {
            if (isPlaying()) {
                btn.textContent = 'Pause';
                btn.setAttribute('aria-pressed', 'true');
            } else {
                btn.textContent = 'Play';
                btn.setAttribute('aria-pressed', 'false');
            }
        } catch(e){ /* ignore */ }
    }

    function togglePlayPause() {
        if (!window.lessonPlayer) {
            // fallback: reload iframe to autoplay if needed
            const iframe = document.getElementById('lessonIframe');
            if (iframe) iframe.src = iframe.src; 
            return;
        }
        try {
            if (isPlaying()) {
                window.lessonPlayer.pauseVideo();
            } else {
                window.lessonPlayer.playVideo();
            }
            // short delay then update label
            setTimeout(updatePlayPauseButton, 200);
        } catch (e) {
            console.warn('togglePlayPause error', e);
        }
    }

    // Attach handlers to Play/Pause button
    const ppBtn = document.getElementById('playPauseBtn');
    if (ppBtn) {
        ppBtn.addEventListener('click', function(e){
            e.stopPropagation();
            togglePlayPause();
        });
    }

    // user gesture to unmute
    const unmuteBtn = document.getElementById('unmuteBtn');
    if (unmuteBtn) {
        unmuteBtn.addEventListener('click', function(){
            if (window.lessonPlayer) {
                try {
                    window.lessonPlayer.unMute();
                    window.lessonPlayer.setVolume(100);
                    window.lessonPlayer.playVideo();
                } catch(e){
                    const iframe = document.getElementById('lessonIframe');
                    if (iframe) {
                        var src = iframe.src.replace(/([&?])mute=1(&|$)/, '$1mute=0$2');
                        iframe.src = src;
                    }
                }
            }
            hideOverlay();
            updatePlayPauseButton();
        }, { once: true });
    }

    // Keyboard: Space toggles play/pause when page has focus
    document.addEventListener('keydown', function(e){
        // ignore if user focused an input/textarea
        const tag = (document.activeElement && document.activeElement.tagName) || '';
        if (tag === 'INPUT' || tag === 'TEXTAREA') return;
        if (e.code === 'Space' || e.key === ' ') {
            e.preventDefault();
            togglePlayPause();
        }
    });

    // If YT API doesn't load after X seconds, show overlay so user can play
    setTimeout(function(){
        if (!window.YT || !window.YT.Player) {
            console.warn('YT API not available — showing overlay fallback.');
            showOverlay();
        }
    }, 3000);
})();
</script>
</body>
</html>
