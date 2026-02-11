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
        #video-shield { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 5; background: rgba(0,0,0,0.001); pointer-events: none; } /* allow touches to reach iframe (fix fullscreen on mobile) */
        @media (min-width: 1024px) { #app > div { flex-direction: row !important; } }

        /* ====== SEEK BAR STYLES (custom red theme) ====== */
        #seekBar {
            width: 360px;
            height: 6px;
            border-radius: 6px;
            background: rgba(255,255,255,0.12);
            -webkit-appearance: none;
            appearance: none;
            overflow: hidden;
            vertical-align: middle;
        }

        /* WebKit track + thumb */
        #seekBar::-webkit-slider-runnable-track {
            height: 6px;
            border-radius: 6px;
            background: rgba(255,255,255,0.12);
        }
        #seekBar::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #F53003; /* brand red */
            margin-top: -4px; /* center thumb on track */
            box-shadow: 0 3px 8px rgba(245,48,3,0.28);
            border: 2px solid rgba(255,255,255,0.9);
        }

        /* Firefox */
        #seekBar::-moz-range-track {
            height: 6px;
            border-radius: 6px;
            background: rgba(255,255,255,0.12);
        }
        #seekBar::-moz-range-progress {
            height: 6px;
            background: #F53003;
            border-radius: 6px;
        }
        #seekBar::-moz-range-thumb {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #F53003;
            border: none;
            box-shadow: 0 3px 8px rgba(245,48,3,0.28);
        }

        /* IE/Edge fallback */
        #seekBar::-ms-track {
            height: 6px;
            background: transparent;
            border-color: transparent;
            color: transparent;
        }
        #seekBar::-ms-fill-lower {
            background: #F53003;
            border-radius: 6px;
        }
        #seekBar::-ms-fill-upper {
            background: rgba(255,255,255,0.12);
            border-radius: 6px;
        }

        /* Double-tap overlay areas */
        .double-tap-area {
            position: absolute;
            top: 0;
            height: 100%;
            width: 50%;
            z-index: 11; /* above shield, below controls (controls z-index:13) */
            background: transparent;
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
            display: block;
            pointer-events: auto; /* explicitly capture taps for detection */
        }
        .double-tap-area.left { left: 0; }
        .double-tap-area.right { right: 0; }

        /* Visual feedback for skip */
        .dt-feedback {
            position: absolute;
            z-index: 14;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            pointer-events: none;
            color: #fff;
            font-weight: 800;
            font-size: 34px;
            text-shadow: 0 6px 22px rgba(0,0,0,0.6);
            opacity: 0;
            transition: opacity .28s ease, transform .28s ease;
        }
        .dt-feedback.show { opacity: 1; transform: translate(-50%,-70%); }
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
                            allowfullscreen
                            webkitallowfullscreen
                            mozallowfullscreen>
                        </iframe>

                        <!-- Double-tap areas (left = back 10s, right = forward 10s) -->
                        <div class="double-tap-area left" data-side="left" aria-hidden="true"></div>
                        <div class="double-tap-area right" data-side="right" aria-hidden="true"></div>

                        <!-- feedback element -->
                        <div id="dtFeedback" class="dt-feedback" aria-hidden="true"></div>

                        <!-- Unmute overlay (shown if programmatic unmute is blocked) -->
                        <div id="unmuteOverlay" style="display:none; position:absolute; inset:0; z-index:12; display:flex; align-items:center; justify-content:center; pointer-events:auto;">
                            <button id="unmuteBtn" style="background:rgba(0,0,0,0.7); color:#fff; border:none; padding:12px 18px; border-radius:8px; font-weight:700; cursor:pointer;">
                                Unmute & Play
                            </button>
                        </div>

                        <!-- Player controls: Play/Pause, Speed -, Speed label, Speed +, Quality select -->
                        <div id="player-controls" style="position:absolute; left:18px; bottom:18px; z-index:13; pointer-events:auto; display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
                            <button id="playPauseBtn" aria-pressed="false"
                                style="background:rgba(0,0,0,0.6); color:#fff; border:none; padding:8px 12px; border-radius:8px; font-weight:700; cursor:pointer;">
                                Pause
                            </button>

                            <button id="speedDownBtn" title="Slower"
                                style="background:rgba(0,0,0,0.45); color:#fff; border:none; padding:6px 10px; border-radius:8px; font-weight:700; cursor:pointer;">
                                - 
                            </button>

                            <span id="speedLabel" style="min-width:44px; text-align:center; color:#fff; font-weight:700; background:rgba(0,0,0,0.25); padding:6px 8px; border-radius:8px;">1x</span>

                            <button id="speedUpBtn" title="Faster"
                                style="background:rgba(0,0,0,0.45); color:#fff; border:none; padding:6px 10px; border-radius:8px; font-weight:700; cursor:pointer;">
                                +
                            </button>

                            <select id="qualitySelect" aria-label="Playback quality"
                                    style="background:rgba(0,0,0,0.45); color:#fff; border:none; padding:6px 8px; border-radius:8px; font-weight:700;">
                                <option value="">Quality</option>
                            </select>

                            <!-- Seek bar and timing -->
                            <div style="display:flex; align-items:center; gap:8px; margin-left:8px;">
                                <span id="currentTime" style="color:#fff; font-size:12px; min-width:48px; text-align:center;">0:00</span>
                                <input id="seekBar" type="range" min="0" max="100" value="0"
                                       style="width:360px; accent-color:#fff; appearance:none; height:6px; background:rgba(255,255,255,0.12); border-radius:6px;">
                                <span id="durationTime" style="color:#fff; font-size:12px; min-width:48px; text-align:center;">0:00</span>
                            </div>

                            <!-- Fullscreen -->
                            <button id="fullscreenBtn" title="Fullscreen"
                                style="background:rgba(0,0,0,0.45); color:#fff; border:none; padding:6px 10px; border-radius:8px; font-weight:700; cursor:pointer;">
                                ⛶
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

    // container used for fullscreen
    const embedContainer = document.getElementById('video-embed-container');

    // Load YT API if not already present
    if (!window.YT) {
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScript = document.getElementsByTagName('script')[0];
        firstScript.parentNode.insertBefore(tag, firstScript);
    }

    let player;
    let seekTimer = null;
    let isUserSeeking = false;

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

        // Populate playback rates & quality options if available
        try {
            // Playback rates
            const rates = (typeof event.target.getAvailablePlaybackRates === 'function')
                ? event.target.getAvailablePlaybackRates()
                : [];
            // store availableRates on window for later use
            window._availableRates = Array.isArray(rates) && rates.length ? rates : [0.25,0.5,0.75,1,1.25,1.5,1.75,2];

            // Update speed label
            updateSpeedLabel();

            // Quality levels
            const qLevels = (typeof event.target.getAvailableQualityLevels === 'function')
                ? event.target.getAvailableQualityLevels()
                : [];
            const qualitySelect = document.getElementById('qualitySelect');
            if (qualitySelect) {
                // clear existing options but keep placeholder
                qualitySelect.innerHTML = '<option value="">Quality</option>';
                const unique = Array.isArray(qLevels) && qLevels.length ? qLevels : ['small','medium','large','hd720','hd1080','highres','default'];
                // Map known codes to readable labels
                const labelMap = { small:'144p', medium:'360p', large:'480p', hd720:'720p', hd1080:'1080p', highres:'High', default:'Auto' };
                unique.forEach(q => {
                    const opt = document.createElement('option');
                    opt.value = q;
                    opt.textContent = labelMap[q] || q;
                    qualitySelect.appendChild(opt);
                });

                // set current quality if possible
                try { 
                    const current = event.target.getPlaybackQuality && event.target.getPlaybackQuality();
                    if (current) qualitySelect.value = current;
                } catch(e){ /* ignore */ }
            }
        } catch(err){
            console.warn('populate rates/quality failed', err);
        }

        // Setup seek bar and timers
        setupSeekBar();

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

    // --- New: Playback speed helpers ---
    function getCurrentRate() {
        try {
            if (window.lessonPlayer && typeof window.lessonPlayer.getPlaybackRate === 'function') {
                return parseFloat(window.lessonPlayer.getPlaybackRate()) || 1;
            }
        } catch(e){}
        return 1;
    }

    function setPlaybackRate(rate) {
        try {
            if (window.lessonPlayer && typeof window.lessonPlayer.setPlaybackRate === 'function') {
                window.lessonPlayer.setPlaybackRate(rate);
            }
        } catch(e){
            console.warn('setPlaybackRate failed', e);
        }
        updateSpeedLabel();
    }

    function updateSpeedLabel() {
        const lbl = document.getElementById('speedLabel');
        if (!lbl) return;
        const r = getCurrentRate();
        lbl.textContent = (Math.round(r * 100) / 100) + 'x';
    }

    function changeSpeed(delta) {
        let rates = window._availableRates || [0.25,0.5,0.75,1,1.25,1.5,1.75,2];
        rates = Array.from(new Set(rates)).sort((a,b)=>a-b);
        const curr = getCurrentRate();
        // find nearest index
        let idx = rates.findIndex(v => v >= curr - 1e-6);
        if (idx === -1) idx = rates.length - 1;
        let newIdx = idx;
        if (delta > 0) {
            newIdx = Math.min(rates.length - 1, idx + 1);
        } else {
            newIdx = Math.max(0, idx - 1);
        }
        const newRate = rates[newIdx] || curr;
        setPlaybackRate(newRate);
    }

    // --- New: Quality change helper ---
    function setQuality(q) {
        try {
            if (window.lessonPlayer && typeof window.lessonPlayer.setPlaybackQuality === 'function') {
                window.lessonPlayer.setPlaybackQuality(q);
            } else {
                console.warn('setPlaybackQuality not available on this player');
            }
        } catch(e){
            console.warn('setQuality failed', e);
        }
    }

    // SEEK BAR IMPLEMENTATION
    function setupSeekBar() {
        const seekBar = document.getElementById('seekBar');
        const currentTimeEl = document.getElementById('currentTime');
        const durationEl = document.getElementById('durationTime');
        if (!seekBar || !window.lessonPlayer) return;

        // helper: set background gradient to show filled portion
        function updateSeekBackground() {
            try {
                const max = parseFloat(seekBar.max) || 1;
                const val = parseFloat(seekBar.value) || 0;
                const pct = Math.max(0, Math.min(100, (val / max) * 100));
                // gradient: filled = red, rest = subtle track color
                seekBar.style.background = `linear-gradient(90deg, #F53003 ${pct}%, rgba(255,255,255,0.12) ${pct}%)`;
            } catch(e) {
                // ignore
            }
        }

        // set duration once available
        try {
            const dur = window.lessonPlayer.getDuration();
            if (dur && isFinite(dur) && dur > 0) {
                seekBar.max = Math.floor(dur);
                durationEl.textContent = formatTime(dur);
            } else {
                // poll duration for a short while if not ready
                setTimeout(() => {
                    const d2 = window.lessonPlayer.getDuration();
                    if (d2 && isFinite(d2) && d2 > 0) {
                        seekBar.max = Math.floor(d2);
                        durationEl.textContent = formatTime(d2);
                        updateSeekBackground();
                    }
                }, 800);
            }
        } catch(e){}

        // initial background update
        updateSeekBackground();

        // update seek periodically
        if (seekTimer) clearInterval(seekTimer);
        seekTimer = setInterval(() => {
            if (!window.lessonPlayer || isUserSeeking) return;
            try {
                const t = window.lessonPlayer.getCurrentTime();
                const dur = window.lessonPlayer.getDuration();
                if (isFinite(t) && dur && isFinite(dur)) {
                    seekBar.value = Math.floor(t);
                    currentTimeEl.textContent = formatTime(t);
                    durationEl.textContent = formatTime(dur);
                    updateSeekBackground(); // <-- reflect progress visually
                }
            } catch(e){}
        }, 500);

        // User interactions
        let hold = false;
        seekBar.addEventListener('input', function(e){
            // show preview time while dragging
            isUserSeeking = true;
            const val = parseFloat(this.value);
            currentTimeEl.textContent = formatTime(val);
            updateSeekBackground(); // <-- update while dragging
        }, { passive:true });

        seekBar.addEventListener('change', function(e){
            // commit seek
            const val = parseFloat(this.value);
            try {
                window.lessonPlayer.seekTo(val, true);
            } catch(err){ console.warn('seekTo failed', err); }
            isUserSeeking = false;
            updateSeekBackground(); // ensure background matches final value
        });
    }

    function formatTime(seconds) {
        if (!isFinite(seconds) || seconds < 0) return '0:00';
        seconds = Math.floor(seconds);
        const m = Math.floor(seconds / 60);
        const s = seconds % 60;
        return m + ':' + (s < 10 ? '0' + s : s);
    }

    // FULLSCREEN HELPERS
    function toggleFullscreen() {
        if (!embedContainer) return;
        const el = embedContainer;
        if (!document.fullscreenElement && !document.webkitFullscreenElement) {
            if (el.requestFullscreen) {
                el.requestFullscreen();
            } else if (el.webkitRequestFullscreen) {
                el.webkitRequestFullscreen();
            } else if (el.msRequestFullscreen) {
                el.msRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
    }

    // Wire fullscreen button
    const fsBtn = document.getElementById('fullscreenBtn');
    if (fsBtn) {
        fsBtn.addEventListener('click', function(e){
            e.stopPropagation();
            toggleFullscreen();
        });
    }

    // Cleanup on page unload
    window.addEventListener('beforeunload', function(){
        if (seekTimer) clearInterval(seekTimer);
    });

    // Attach handlers to buttons and select
    const ppBtn = document.getElementById('playPauseBtn');
    if (ppBtn) {
        ppBtn.addEventListener('click', function(e){
            e.stopPropagation();
            togglePlayPause();
        });
    }

    const speedUpBtn = document.getElementById('speedUpBtn');
    if (speedUpBtn) speedUpBtn.addEventListener('click', function(e){ e.stopPropagation(); changeSpeed(1); });

    const speedDownBtn = document.getElementById('speedDownBtn');
    if (speedDownBtn) speedDownBtn.addEventListener('click', function(e){ e.stopPropagation(); changeSpeed(-1); });

    const qualitySelect = document.getElementById('qualitySelect');
    if (qualitySelect) {
        qualitySelect.addEventListener('change', function(){
            const q = this.value;
            if (!q) return;
            setQuality(q);
            // reflect selection visually
        });
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

    // --- Double-tap / double-click skip (±10s) ---
    function clamp(v, a, b){ return Math.max(a, Math.min(b, v)); }

    function showDTFeedback(text){
        const fb = document.getElementById('dtFeedback');
        if (!fb) return;
        fb.textContent = text;
        fb.classList.add('show');
        clearTimeout(fb._t);
        fb._t = setTimeout(()=> fb.classList.remove('show'), 650);
    }

    function seekBy(delta){
        try {
            if (!window.lessonPlayer || typeof window.lessonPlayer.getCurrentTime !== 'function') return;
            const dur = window.lessonPlayer.getDuration() || 0;
            const curr = window.lessonPlayer.getCurrentTime() || 0;
            const target = clamp(curr + delta, 0, dur || Number.MAX_SAFE_INTEGER);
            window.lessonPlayer.seekTo(target, true);
            showDTFeedback((delta > 0 ? '+' : '') + Math.floor(delta) + 's');
        } catch(e){
            console.warn('seekBy failed', e);
        }
    }

    function attachDoubleTapAreas(){
        const areas = document.querySelectorAll('.double-tap-area');
        if (!areas || !areas.length) return;

        areas.forEach(area => {
            // Desktop dblclick
            area.addEventListener('dblclick', (ev)=>{
                const side = area.dataset.side;
                seekBy(side === 'right' ? 10 : -10);
            });

            // Mobile: custom double-tap detection
            let lastTouch = 0;
            let lastX = 0, lastY = 0;
            area.addEventListener('touchend', function(e){
                const t = Date.now();
                const touch = (e.changedTouches && e.changedTouches[0]) || {};
                const dx = Math.abs((touch.clientX || 0) - lastX);
                const dy = Math.abs((touch.clientY || 0) - lastY);
                const tapInterval = t - lastTouch;
                // consider it a double-tap if within 300ms and movement small
                if (tapInterval > 0 && tapInterval < 330 && dx < 30 && dy < 30) {
                    const side = area.dataset.side;
                    seekBy(side === 'right' ? 10 : -10);
                    lastTouch = 0; // reset
                } else {
                    lastTouch = t;
                    lastX = touch.clientX || 0;
                    lastY = touch.clientY || 0;
                }
            }, {passive:true});
        });
    }

    // expose a handler for unmute button so overlay works on mobile
    const unmuteBtn = document.getElementById('unmuteBtn');
    if (unmuteBtn) {
        unmuteBtn.addEventListener('click', function(){
            try {
                if (window.lessonPlayer && typeof window.lessonPlayer.unMute === 'function') {
                    window.lessonPlayer.unMute();
                    window.lessonPlayer.setVolume && window.lessonPlayer.setVolume(100);
                    window.lessonPlayer.playVideo && window.lessonPlayer.playVideo();
                } else {
                    // fallback: reload iframe with autoplay=1&mute=0 (best-effort)
                    const iframe = document.getElementById('lessonIframe');
                    if (iframe) {
                        const src = new URL(iframe.src);
                        src.searchParams.set('autoplay', '1');
                        src.searchParams.set('mute', '0');
                        iframe.src = src.toString();
                    }
                }
            } catch(e){ console.warn('unmuteBtn click failed', e); }
            document.getElementById('unmuteOverlay') && (document.getElementById('unmuteOverlay').style.display = 'none');
        });
    }

    // call attach once API ready; also attempt attach early for UI to be responsive
    attachDoubleTapAreas();
    // ensure it's present after player ready as well
    const origOnReady = window.onYouTubeIframeAPIReady;
    // existing onPlayerReady called by YT API will run attachDoubleTapAreas via onPlayerReady's setupSeekBar call
    // but keep safe: run again after small delay
    setTimeout(attachDoubleTapAreas, 800);

    // ...existing code...
})();
</script>
</body>
</html>
