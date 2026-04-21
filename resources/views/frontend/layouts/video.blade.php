<!-- Latest News -->
<section class="my-5">
    <div class="container">
        <!-- Section Title -->
        <div class="row mb-4">
            <div class="col text-center">
                {{--<h2 class="fw-bold display-6 text-primary mb-5">{{ __('latest_news') }}</h2>--}}
            </div>
        </div>

        @php
            // Separate main and other videos dynamically
            $mainVideo = $videos->firstWhere('priority', 1);
            $otherVideos = $videos->reject(fn($v) => $v->id === optional($mainVideo)->id)->take(4);
        @endphp

        <!-- Main (Featured) Video -->
        @if ($mainVideo)
        <div class="row mb-5">
            <div class="col-12">
                <div class="position-relative d-block video-wrapper main-video-wrapper">
                    <video class="w-100 rounded shadow-lg main-video"
                        muted loop playsinline preload="auto"
                        poster="{{ asset('storage/galleries/' . $mainVideo->thumbnail_image) }}">
                        <source src="{{ asset('storage/galleries/' . $mainVideo->featured_image) }}" type="video/mp4">
                        আপনার ব্রাউজার ভিডিওটি প্লে করতে সক্ষম নয়।
                    </video>

                    <!-- Custom Controls for Main Video -->
                    <div class="custom-controls main-controls">
                        <div class="controls-top">
                            <button class="btn btn-light btn-sm volume-btn">
                                <i class="fas fa-volume-mute"></i>
                            </button>
                        </div>
                        <div class="controls-center">
                            <button class="btn btn-light btn-lg play-pause-btn">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                        <div class="controls-bottom">
                            <div class="time-display">
                                <span class="current-time">0:00</span>
                                <span class="time-separator">/</span>
                                <span class="duration">0:00</span>
                            </div>
                            <div class="progress-controls">
                                <div class="progress-container">
                                    <div class="progress-bar">
                                        <div class="progress-handle"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="controls-right">
                                <button class="btn btn-light btn-sm fullscreen-btn">
                                    <i class="fas fa-expand"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Video Title Overlay -->
                    <div class="position-absolute bottom-0 start-0 p-4 bg-dark bg-opacity-50 w-100 rounded-bottom video-title">
                        <h3 class="text-white fw-bold mb-2">{{ $mainVideo->title }}</h3>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Below 4 Video News -->
        <div class="row">
            @foreach ($otherVideos as $video)
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 video-wrapper small-video-wrapper">
                        <div class="position-relative">
                            <video 
                                class="card-img-top rounded-top small-video"
                                muted loop playsinline preload="metadata"
                                poster="{{ asset('storage/galleries/' . $video->thumbnail_image) }}"
                            >
                                <source src="{{ asset('storage/galleries/' . $video->featured_image) }}" type="video/mp4">
                            </video>

                            <!-- Custom Controls for Small Videos -->
                            <div class="custom-controls small-controls">
                                <div class="small-controls-center">
                                    <button class="btn btn-light btn-lg play-pause-btn">
                                        <i class="fas fa-play"></i>
                                    </button>
                                </div>
                                <div class="small-controls-bottom">
                                    <div class="small-bottom-timeline">
                                        <div class="small-time-display">
                                            <span class="current-time">0:00</span> / <span class="duration">0:00</span>
                                        </div>
                                        <div class="small-progress-container">
                                            <div class="small-progress-bar"></div>
                                        </div>
                                        <div class="small-controls-right">
                                            <button class="btn btn-light btn-sm volume-btn">
                                                <i class="fas fa-volume-mute"></i>
                                            </button>
                                            <button class="btn btn-light btn-sm fullscreen-btn">
                                                <i class="fas fa-expand"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-semibold text-dark mb-2">{{ $video->title }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mainVideo = document.querySelector('.main-video');
    const smallVideos = document.querySelectorAll('.small-video');
    const allVideos = [mainVideo, ...smallVideos];
    let currentlyPlaying = null;
    let isDragging = false;

    // Format time from seconds to MM:SS
    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
    }

    // Update time display for a video
    function updateTimeDisplay(video) {
        const videoWrapper = video.closest('.video-wrapper');
        const currentTimeEl = videoWrapper.querySelector('.current-time');
        const durationEl = videoWrapper.querySelector('.duration');
        
        if (currentTimeEl) {
            currentTimeEl.textContent = formatTime(video.currentTime);
        }
        if (durationEl && video.duration) {
            durationEl.textContent = formatTime(video.duration);
        }
    }

    // Seek to specific time
    function seekToTime(video, percent) {
        if (video.duration) {
            video.currentTime = percent * video.duration;
            updateTimeDisplay(video);
        }
    }

    // Initialize main video to play automatically
    if (mainVideo) {
        mainVideo.play().then(() => {
            currentlyPlaying = mainVideo;
            updateControlButtons();
        }).catch(() => {
            // Auto-play was blocked, wait for user interaction
        });
    }

    // Toggle mute/unmute
    function toggleMute(video) {
        video.muted = !video.muted;
        updateVolumeButtons();
    }

    // Toggle fullscreen
    function toggleFullscreen(videoWrapper) {
        const video = videoWrapper.querySelector('video');
        
        if (!document.fullscreenElement) {
            // Enter fullscreen
            if (videoWrapper.requestFullscreen) {
                videoWrapper.requestFullscreen();
            } else if (videoWrapper.webkitRequestFullscreen) {
                videoWrapper.webkitRequestFullscreen();
            } else if (videoWrapper.mozRequestFullScreen) {
                videoWrapper.mozRequestFullScreen();
            } else if (videoWrapper.msRequestFullscreen) {
                videoWrapper.msRequestFullscreen();
            }
            
            // Add fullscreen class for styling
            videoWrapper.classList.add('fullscreen-active');
            
        } else {
            // Exit fullscreen
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
            
            // Remove fullscreen class
            videoWrapper.classList.remove('fullscreen-active');
        }
    }

    // Play/Pause functionality
    function togglePlayPause(video) {
        if (video.paused) {
            // Pause currently playing video
            if (currentlyPlaying && currentlyPlaying !== video) {
                currentlyPlaying.pause();
            }
            // Play the clicked video
            video.play();
            currentlyPlaying = video;
        } else {
            video.pause();
            currentlyPlaying = null;
        }
        updateControlButtons();
    }

    // Update all control buttons
    function updateControlButtons() {
        allVideos.forEach(video => {
            if (!video) return;
            
            const controls = video.closest('.video-wrapper').querySelector('.custom-controls');
            const playPauseBtn = controls.querySelector('.play-pause-btn');
            if (playPauseBtn) {
                const icon = playPauseBtn.querySelector('i');
                if (video === currentlyPlaying) {
                    icon.className = 'fas fa-pause';
                    playPauseBtn.classList.add('playing');
                } else {
                    icon.className = 'fas fa-play';
                    playPauseBtn.classList.remove('playing');
                }
            }
        });
    }

    // Update volume buttons
    function updateVolumeButtons() {
        document.querySelectorAll('.volume-btn').forEach(btn => {
            const video = btn.closest('.video-wrapper').querySelector('video');
            const icon = btn.querySelector('i');
            if (video.muted) {
                icon.className = 'fas fa-volume-mute';
            } else {
                icon.className = 'fas fa-volume-up';
            }
        });
    }

    // Update fullscreen buttons
    function updateFullscreenButtons() {
        document.querySelectorAll('.fullscreen-btn').forEach(btn => {
            const icon = btn.querySelector('i');
            const videoWrapper = btn.closest('.video-wrapper');
            if (videoWrapper.classList.contains('fullscreen-active')) {
                icon.className = 'fas fa-compress';
            } else {
                icon.className = 'fas fa-expand';
            }
        });
    }

    // Progress bar dragging functionality for main video
    function setupProgressBar(video, progressContainer, progressBar) {
        let isDragging = false;

        function handleProgressClick(e) {
            if (!video.duration) return;
            
            const rect = progressContainer.getBoundingClientRect();
            const percent = (e.clientX - rect.left) / rect.width;
            seekToTime(video, percent);
        }

        function handleDragStart(e) {
            isDragging = true;
            document.addEventListener('mousemove', handleDrag);
            document.addEventListener('mouseup', handleDragEnd);
            handleDrag(e);
        }

        function handleDrag(e) {
            if (!isDragging || !video.duration) return;
            
            const rect = progressContainer.getBoundingClientRect();
            let percent = (e.clientX - rect.left) / rect.width;
            percent = Math.max(0, Math.min(1, percent));
            
            // Update progress bar visually during drag
            progressBar.style.width = (percent * 100) + '%';
        }

        function handleDragEnd(e) {
            if (!isDragging || !video.duration) return;
            
            const rect = progressContainer.getBoundingClientRect();
            let percent = (e.clientX - rect.left) / rect.width;
            percent = Math.max(0, Math.min(1, percent));
            
            seekToTime(video, percent);
            isDragging = false;
            
            document.removeEventListener('mousemove', handleDrag);
            document.removeEventListener('mouseup', handleDragEnd);
        }

        // Click to seek
        progressContainer.addEventListener('click', handleProgressClick);
        
        // Drag to seek
        progressContainer.addEventListener('mousedown', handleDragStart);
    }

    // Setup small video progress bars
    function setupSmallVideoProgress(video) {
        const progressContainer = video.closest('.video-wrapper').querySelector('.small-progress-container');
        const progressBar = progressContainer.querySelector('.small-progress-bar');
        
        function handleSmallProgressClick(e) {
            if (!video.duration) return;
            
            const rect = progressContainer.getBoundingClientRect();
            const percent = (e.clientX - rect.left) / rect.width;
            seekToTime(video, percent);
        }

        // Update progress bar for small video
        video.addEventListener('timeupdate', function() {
            if (this.duration) {
                const progress = (this.currentTime / this.duration) * 100;
                progressBar.style.width = progress + '%';
            }
            updateTimeDisplay(this);
        });

        // Click to seek on small video progress bar
        progressContainer.addEventListener('click', handleSmallProgressClick);
    }

    // Add event listeners
    document.querySelectorAll('.play-pause-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const video = this.closest('.video-wrapper').querySelector('video');
            togglePlayPause(video);
        });
    });

    document.querySelectorAll('.volume-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const video = this.closest('.video-wrapper').querySelector('video');
            toggleMute(video);
        });
    });

    document.querySelectorAll('.fullscreen-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const videoWrapper = this.closest('.video-wrapper');
            toggleFullscreen(videoWrapper);
        });
    });

    // Update progress bar and time for main video
    if (mainVideo) {
        const progressContainer = mainVideo.closest('.video-wrapper').querySelector('.progress-container');
        const progressBar = progressContainer.querySelector('.progress-bar');
        
        setupProgressBar(mainVideo, progressContainer, progressBar);
        
        mainVideo.addEventListener('timeupdate', function() {
            if (!isDragging && this.duration) {
                const progress = (this.currentTime / this.duration) * 100;
                progressBar.style.width = progress + '%';
            }
            updateTimeDisplay(this);
        });

        mainVideo.addEventListener('loadedmetadata', function() {
            updateTimeDisplay(this);
        });
    }

    // Setup progress bars and time for small videos
    smallVideos.forEach(video => {
        setupSmallVideoProgress(video);
        
        video.addEventListener('loadedmetadata', function() {
            updateTimeDisplay(this);
        });
    });

    // Fullscreen change event
    document.addEventListener('fullscreenchange', function() {
        updateFullscreenButtons();
        
        // If exiting fullscreen, remove the class from all video wrappers
        if (!document.fullscreenElement) {
            document.querySelectorAll('.video-wrapper').forEach(wrapper => {
                wrapper.classList.remove('fullscreen-active');
            });
        }
    });

    // Video end event to reset state
    allVideos.forEach(video => {
        if (!video) return;
        
        video.addEventListener('ended', function() {
            if (this === currentlyPlaying) {
                currentlyPlaying = null;
                updateControlButtons();
            }
        });
    });

    // Click on video to play/pause
    allVideos.forEach(video => {
        if (!video) return;
        
        video.addEventListener('click', function() {
            togglePlayPause(this);
        });
    });

    // Initialize volume buttons
    updateVolumeButtons();
});
</script>

<style>
.video-wrapper {
    position: relative;
    cursor: pointer;
    overflow: hidden;
}

/* Fullscreen styles */
.video-wrapper.fullscreen-active {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: #000;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.video-wrapper.fullscreen-active video {
    width: 100% !important;
    height: 100% !important;
    object-fit: contain;
    border-radius: 0 !important;
}

.video-wrapper.fullscreen-active .video-title {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 10000;
}

/* Main Video Controls */
.main-video-wrapper .custom-controls {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 15px;
    background: linear-gradient(to bottom, 
        rgba(0,0,0,0.3) 0%, 
        transparent 30%, 
        transparent 70%, 
        rgba(0,0,0,0.4) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 10;
}

.main-video-wrapper:hover .custom-controls {
    opacity: 1;
}

/* Small Video Controls (Reels Style with Bottom Timeline) */
.small-video-wrapper .custom-controls {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 10px;
    background: rgba(0, 0, 0, 0.3);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 10;
}

.small-video-wrapper:hover .custom-controls {
    opacity: 1;
}

.small-controls-center {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-grow: 1;
}

.small-controls-bottom {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-top: auto;
}

.small-bottom-timeline {
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
}

.small-time-display {
    color: white;
    font-size: 0.75rem;
    font-weight: 500;
    background: rgba(0, 0, 0, 0.5);
    padding: 2px 8px;
    border-radius: 12px;
    min-width: 70px;
    text-align: center;
}

.small-progress-container {
    flex-grow: 1;
    height: 4px;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 2px;
    overflow: hidden;
    cursor: pointer;
    position: relative;
    transition: height 0.2s ease;
}

.small-progress-container:hover {
    height: 6px;
}

.small-progress-bar {
    height: 100%;
    background: #ff0000;
    width: 0%;
    border-radius: 2px;
    transition: width 0.1s ease;
    position: relative;
}

.small-progress-bar::after {
    content: '';
    position: absolute;
    right: -4px;
    top: 50%;
    transform: translateY(-50%);
    width: 8px;
    height: 8px;
    background: #ff0000;
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.2s ease;
}

.small-progress-container:hover .small-progress-bar::after {
    opacity: 1;
}

.small-controls-right {
    display: flex;
    gap: 5px;
}

.controls-top {
    display: flex;
    justify-content: flex-end;
}

.controls-center {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-grow: 1;
}

.controls-bottom {
    display: flex;
    align-items: center;
    gap: 10px;
}

.controls-right {
    display: flex;
    gap: 5px;
}

.time-display {
    display: flex;
    align-items: center;
    gap: 5px;
    color: white;
    font-size: 0.85rem;
    font-weight: 500;
    min-width: 80px;
}

.progress-controls {
    flex-grow: 1;
    display: flex;
    align-items: center;
}

.progress-container {
    flex-grow: 1;
    height: 4px;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 2px;
    overflow: visible;
    cursor: pointer;
    position: relative;
    transition: height 0.2s ease;
}

.progress-container:hover {
    height: 6px;
}

.progress-bar {
    height: 100%;
    background: #ff0000;
    width: 0%;
    border-radius: 2px;
    position: relative;
    transition: width 0.1s ease;
}

.progress-handle {
    position: absolute;
    right: -6px;
    top: 50%;
    transform: translateY(-50%);
    width: 12px;
    height: 12px;
    background: #ff0000;
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.2s ease;
    box-shadow: 0 0 4px rgba(0,0,0,0.5);
}

.progress-container:hover .progress-handle {
    opacity: 1;
}

/* Main video controls */
.main-controls .play-pause-btn {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0.9;
    transition: all 0.3s ease;
}

.main-controls .volume-btn,
.main-controls .fullscreen-btn {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0.8;
    transition: all 0.3s ease;
}

/* Small video controls (Reels Style) */
.small-controls .play-pause-btn {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0.9;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.9);
}

.small-controls .volume-btn,
.small-controls .fullscreen-btn {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0.8;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.8);
}

/* Hover effects */
.play-pause-btn:hover,
.volume-btn:hover,
.fullscreen-btn:hover {
    opacity: 1 !important;
    transform: scale(1.1);
}

/* Hide native controls */
video {
    cursor: pointer;
    width: 100%;
    height: auto;
}

video::-webkit-media-controls {
    display: none !important;
}

/* Ensure video fills container in fullscreen */
.video-wrapper:fullscreen {
    width: 100vw !important;
    height: 100vh !important;
    background: #000;
}

.video-wrapper:fullscreen video {
    width: 100% !important;
    height: 100% !important;
    object-fit: contain;
}

/* Card styling for small videos */
.small-video-wrapper .card-img-top {
    height: 200px;
    object-fit: cover;
}

/* Responsive design for small videos */
@media (max-width: 768px) {
    .small-bottom-timeline {
        flex-wrap: wrap;
        gap: 5px;
    }
    
    .small-time-display {
        min-width: 60px;
        font-size: 0.7rem;
    }
    
    .small-controls-right {
        gap: 3px;
    }
}
</style>

