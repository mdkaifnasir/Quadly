<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quadly Presentation Viewer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: #0f172a;
            /* Slate 900 */
        }

        #slide-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 1280px;
            height: 720px;
            background: white;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease, opacity 0.4s ease;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: all 0.2s;
            backdrop-filter: blur(4px);
            z-index: 100;
        }

        .nav-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-50%) scale(1.1);
        }

        #prev-btn {
            left: 20px;
        }

        #next-btn {
            right: 20px;
        }

        #controls {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.6);
            padding: 8px 16px;
            border-radius: 20px;
            color: white;
            font-family: sans-serif;
            font-size: 14px;
            backdrop-filter: blur(4px);
            display: flex;
            gap: 16px;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s;
            z-index: 100;
        }

        body:hover #controls {
            opacity: 1;
        }
    </style>
</head>

<body>

    <!-- Slide Container -->
    <div id="slide-container">
        <iframe id="slide-frame" src=""></iframe>
    </div>

    <!-- Navigation Buttons -->
    <div id="prev-btn" class="nav-btn" onclick="prevSlide()">
        <i class="fas fa-chevron-left"></i>
    </div>
    <div id="next-btn" class="nav-btn" onclick="nextSlide()">
        <i class="fas fa-chevron-right"></i>
    </div>

    <!-- Controls -->
    <div id="controls">
        <span id="slide-number">Slide 1 / 10</span>
        <div class="h-4 w-[1px] bg-gray-500"></div>
        <button onclick="toggleFullscreen()" class="hover:text-blue-400 transition-colors">
            <i class="fas fa-expand"></i>
        </button>
    </div>

    <script>
        // Configuration
        const slides = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'];
        let currentIndex = 0;
        const totalSlides = slides.length;
        const baseWidth = 1280;
        const baseHeight = 720;

        // Elements
        const frame = document.getElementById('slide-frame');
        const slideContainer = document.getElementById('slide-container');
        const slideNumberDisplay = document.getElementById('slide-number');

        // Initialize
        function init() {
            // Check URL params for starting slide
            const params = new URLSearchParams(window.location.search);
            const slideParam = params.get('slide');
            const foundIndex = slides.indexOf(slideParam);

            if (foundIndex !== -1) {
                currentIndex = foundIndex;
            }

            updateSlide();
            handleResize();
            window.addEventListener('resize', handleResize);
            document.addEventListener('keydown', handleKeydown);
        }

        // Core Functions
        function updateSlide() {
            const slideId = slides[currentIndex];

            // Update Counter
            slideNumberDisplay.textContent = `Slide ${currentIndex + 1} / ${totalSlides}`;

            // Add transition effect
            slideContainer.style.opacity = '0';
            setTimeout(() => {
                frame.src = `${slideId}.php`;
                frame.onload = () => {
                    slideContainer.style.opacity = '1';
                };
            }, 200);

            // Update URL without reload
            const newUrl = new URL(window.location);
            newUrl.searchParams.set('slide', slideId);
            window.history.pushState({}, '', newUrl);

            // Button State
            document.getElementById('prev-btn').style.opacity = currentIndex === 0 ? '0.3' : '1';
            document.getElementById('prev-btn').style.pointerEvents = currentIndex === 0 ? 'none' : 'auto';

            document.getElementById('next-btn').style.opacity = currentIndex === totalSlides - 1 ? '0.3' : '1';
            document.getElementById('next-btn').style.pointerEvents = currentIndex === totalSlides - 1 ? 'none' : 'auto';
        }

        function nextSlide() {
            if (currentIndex < totalSlides - 1) {
                currentIndex++;
                updateSlide();
            }
        }

        function prevSlide() {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlide();
            }
        }

        function handleKeydown(e) {
            if (e.key === 'ArrowRight' || e.key === ' ' || e.key === 'Enter') {
                nextSlide();
            } else if (e.key === 'ArrowLeft' || e.key === 'Backspace') {
                prevSlide();
            } else if (e.key === 'f') {
                toggleFullscreen();
            }
        }

        function handleResize() {
            const windowWidth = window.innerWidth;
            const windowHeight = window.innerHeight;

            // Calculate scale to fit
            const scaleX = windowWidth / baseWidth;
            const scaleY = windowHeight / baseHeight;
            const scale = Math.min(scaleX, scaleY) * 0.95; // 0.95 for margin

            slideContainer.style.transform = `translate(-50%, -50%) scale(${scale})`;
        }

        function toggleFullscreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        }

        // Start
        init();
    </script>
</body>

</html>