@props([
    'url' => null,
    'title' => 'Lesson Video',
    'autoplay' => false,
])

@php
    $videoId = null;
    $rawUrl = trim($url ?? '');

    if (!empty($rawUrl)) {
        // Direct 11-char ID
        if (preg_match('/^[A-Za-z0-9_-]{11}$/', $rawUrl)) {
            $videoId = $rawUrl;
        }
        // youtu.be/<id>
        elseif (preg_match('#youtu\.be/([A-Za-z0-9_-]{11})#', $rawUrl, $matches)) {
            $videoId = $matches[1];
        }
        // embed/<id> or shorts/<id> or v/<id>
        elseif (preg_match('#youtube\.com/(?:embed|shorts|v)/([A-Za-z0-9_-]{11})#', $rawUrl, $matches)) {
            $videoId = $matches[1];
        }
        // watch?v=<id> or ?v=<id> or &v=<id>
        elseif (preg_match('/[?&]v=([A-Za-z0-9_-]{11})/', $rawUrl, $matches)) {
            $videoId = $matches[1];
        }
    }
@endphp

<div class="relative w-full aspect-video rounded-2xl overflow-hidden shadow-2xl bg-slate-950 border border-slate-800/80 group">
    @if($videoId)
        <iframe
            id="youtube-player-frame"
            class="absolute inset-0 w-full h-full border-0"
            src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&modestbranding=1&enablejsapi=1{{ $autoplay ? '&autoplay=1' : '' }}"
            title="{{ $title }}"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen>
        </iframe>
    @else
        <div class="absolute inset-0 flex flex-col items-center justify-center p-8 text-center bg-gradient-to-b from-slate-900 to-slate-950 text-slate-300">
            <div class="w-16 h-16 rounded-full bg-slate-800/80 flex items-center justify-center mb-4 text-brand-500 border border-slate-700/50">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
            </div>
            <h4 class="text-lg font-bold text-white mb-1">No Video Available</h4>
            <p class="text-sm text-slate-400 max-w-sm">The video link for this lesson is either not provided or still being processed. Please check back shortly.</p>
        </div>
    @endif
</div>
