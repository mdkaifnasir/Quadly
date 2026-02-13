<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Face Search - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Spline Sans', 'sans-serif'] },
                    colors: { primary: '#1e293b', accent: '#3b82f6', success: '#10b981', warning: '#f59e0b' }
                }
            }
        }
    </script>
</head>

<body class="bg-slate-50 font-sans h-screen flex overflow-hidden">

    <!-- Sidebar -->
    <?php $this->load->view('admin/partials/sidebar'); ?>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">

        <!-- Top Mobile Header -->
        <header class="lg:hidden h-16 bg-white border-b flex items-center justify-between px-4 shrink-0 z-20">
            <span class="material-symbols-outlined text-slate-500 text-2xl"
                onclick="document.querySelector('aside').classList.toggle('hidden')">menu</span>
            <h1 class="font-bold text-lg text-slate-800">Face Search</h1>
            <div class="w-8"></div>
        </header>

        <!-- Scrollable Area -->
        <div class="flex-1 overflow-y-auto w-full p-4 lg:p-8">
            <div class="max-w-6xl mx-auto space-y-6">

                <!-- Header & Controls -->
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-2xl lg:text-3xl font-bold text-slate-800 tracking-tight">Smart Face Search</h1>
                        <p class="text-slate-500 mt-1">Identify students or faculty using AI-powered face recognition.
                        </p>
                    </div>

                    <div class="flex items-center bg-white p-1 rounded-lg border border-slate-200 shadow-sm">
                        <button onclick="setMode('upload')" id="btn-mode-upload"
                            class="px-4 py-2 rounded-md text-sm font-bold transition-all bg-blue-50 text-blue-600">
                            Upload Photo / Group
                        </button>
                        <button onclick="setMode('webcam')" id="btn-mode-webcam"
                            class="px-4 py-2 rounded-md text-sm font-bold text-slate-500 hover:text-slate-700 transition-all">
                            Live Webcam
                        </button>
                    </div>
                </div>

                <!-- Main Grid -->
                <div class="grid lg:grid-cols-3 gap-8 items-start">

                    <!-- Left: Input Area (2 Columns) -->
                    <div class="lg:col-span-2 space-y-6">

                        <!-- Upload Mode UI -->
                        <div id="mode-upload"
                            class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col items-center justify-center min-h-[400px]">
                            <div id="upload-zone"
                                class="w-full h-96 border-2 border-dashed border-slate-300 rounded-xl bg-slate-50 flex flex-col items-center justify-center cursor-pointer hover:bg-blue-50 hover:border-blue-400 transition-all group relative overflow-hidden"
                                onclick="document.getElementById('search_photo').click()">

                                <div id="upload-placeholder" class="text-center">
                                    <div
                                        class="w-16 h-16 rounded-full bg-white shadow-sm flex items-center justify-center mb-4 mx-auto group-hover:scale-110 transition-transform">
                                        <span
                                            class="material-symbols-outlined text-blue-500 text-3xl">add_a_photo</span>
                                    </div>
                                    <p class="text-slate-600 font-semibold" id="upload-text">Click to upload photo</p>
                                    <p class="text-slate-400 text-sm mt-1">Supports Single or Group Photos</p>
                                </div>

                                <!-- Image Preview with Canvas Overlay -->
                                <div id="preview-container" class="relative max-w-full max-h-full hidden">
                                    <img id="input-image" class="max-h-full max-w-full object-contain" />
                                    <canvas id="overlay-canvas"
                                        class="absolute top-0 left-0 pointer-events-none"></canvas>
                                </div>
                            </div>
                            <input type="file" id="search_photo" class="hidden" accept="image/*"
                                onchange="performUploadSearch(this)">
                        </div>

                        <!-- Webcam Mode UI -->
                        <div id="mode-webcam"
                            class="hidden bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col items-center justify-center min-h-[400px]">
                            <div class="relative w-full rounded-xl overflow-hidden bg-black aspect-video">
                                <video id="webcam-video" class="w-full h-full object-cover transform scale-x-[-1]"
                                    autoplay muted></video>
                                <canvas id="webcam-canvas"
                                    class="absolute top-0 left-0 w-full h-full pointer-events-none transform scale-x-[-1]"></canvas>

                                <div id="webcam-overlay"
                                    class="absolute inset-0 flex items-center justify-center bg-slate-900/80 z-10">
                                    <button onclick="startWebcam()"
                                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg flex items-center gap-2 transition-all">
                                        <span class="material-symbols-outlined">videocam</span> Start Camera
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Settings Bar -->
                        <div
                            class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center gap-4 flex-1">
                                <span class="text-sm font-bold text-slate-700 whitespace-nowrap">Confidence
                                    Threshold:</span>
                                <input type="range" id="confidence-slider" min="0.1" max="0.9" step="0.1" value="0.5"
                                    class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-blue-600">
                                <span id="confidence-value"
                                    class="text-sm font-mono bg-slate-100 px-2 py-1 rounded">0.5</span>
                            </div>
                            <div id="status-msg" class="text-sm font-medium flex items-center gap-2 text-slate-500">
                                <span class="material-symbols-outlined animate-spin">progress_activity</span>
                                <span>Initializing...</span>
                            </div>
                        </div>

                    </div>

                    <!-- Right: Results & History -->
                    <div class="space-y-6">

                        <!-- Actions -->
                        <div class="bg-slate-800 text-white p-4 rounded-xl shadow-lg flex items-center justify-between">
                            <div>
                                <h3 class="font-bold text-lg" id="match-count">0 Matches</h3>
                                <p class="text-slate-400 text-xs">Waiting for input...</p>
                            </div>
                            <button onclick="window.print()"
                                class="p-2 bg-white/10 hover:bg-white/20 rounded-lg transition-colors"
                                title="Print / Export Report">
                                <span class="material-symbols-outlined">print</span>
                            </button>
                        </div>

                        <!-- Results List -->
                        <div class="space-y-3 max-h-[400px] overflow-y-auto custom-scrollbar" id="results-container">
                            <!-- Initial State -->
                            <div class="bg-white p-8 rounded-xl border border-slate-200 text-center text-slate-400">
                                <span class="material-symbols-outlined text-4xl mb-2 opacity-30">face</span>
                                <p>Detected matches will appear here.</p>
                            </div>
                        </div>

                        <!-- Recent History -->
                        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                            <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                                <h3 class="font-bold text-slate-700 text-sm">Recent Search History</h3>
                                <button onclick="loadHistory()"
                                    class="text-xs text-blue-600 hover:underline">Refresh</button>
                            </div>
                            <div id="history-list" class="divide-y divide-slate-100 max-h-[200px] overflow-y-auto">
                                <div class="p-4 text-center text-xs text-slate-400">Loading history...</div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- Bottom Nav -->
        <?php $this->load->view('admin/partials/bottom_nav'); ?>
    </main>

    <!-- Passing Database Descriptors to JS -->
    <script>
        const dbUsers = [
            <?php foreach ($users_with_faces as $user): ?>
                        {
                    id: "<?= $user->id ?>",
                    name: "<?= addslashes($user->first_name . ' ' . $user->last_name) ?>",
                    role: "<?= $user->role ?>",
                    student_id: "<?= $user->student_id ?>",
                    photo: "<?= base_url('uploads/' . $user->profile_photo) ?>",
                    descriptor: <?= $user->face_descriptor ?>
                },
            <?php endforeach; ?>
        ];
    </script>

    <script>
        const MODEL_URL = 'https://justadudewhohacks.github.io/face-api.js/models';
        let faceMatcher = null;
        let modelsLoaded = false;
        let currentStream = null;
        let webcamInterval = null;
        let isWebcamActive = false;

        // Settings
        const slider = document.getElementById('confidence-slider');
        const sliderVal = document.getElementById('confidence-value');
        let detectionThreshold = 0.5;

        slider.addEventListener('input', (e) => {
            detectionThreshold = parseFloat(e.target.value);
            sliderVal.innerText = detectionThreshold;
            // Optionally re-run detection on current image if in upload mode
            if (!isWebcamActive && document.getElementById('input-image').src) {
                // Re-trigger analysis logic (simplified for now)
            }
        });

        async function init() {
            try {
                updateStatus('loading', 'Loading AI Models...');

                await Promise.all([
                    faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL),
                    faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
                    faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL)
                ]);

                modelsLoaded = true;

                if (dbUsers.length > 0) {
                    const labeledDescriptors = dbUsers.map(user => {
                        const Float32Desc = new Float32Array(user.descriptor);
                        return new faceapi.LabeledFaceDescriptors(user.id, [Float32Desc]);
                    });
                    faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.6);
                    updateStatus('ready', `System Ready (${dbUsers.length} faces)`);
                } else {
                    updateStatus('warning', 'System Ready (No faces in DB)');
                }

                loadHistory(); // Load initial history

            } catch (err) {
                console.error(err);
                updateStatus('error', 'Error loading AI models');
            }
        }

        init();

        // --- Mode Switching ---
        function setMode(mode) {
            stopWebcam(); // Stop webcam if switching away

            if (mode === 'upload') {
                document.getElementById('mode-upload').classList.remove('hidden');
                document.getElementById('mode-webcam').classList.add('hidden');
                document.getElementById('btn-mode-upload').className = "px-4 py-2 rounded-md text-sm font-bold transition-all bg-blue-50 text-blue-600";
                document.getElementById('btn-mode-webcam').className = "px-4 py-2 rounded-md text-sm font-bold text-slate-500 hover:text-slate-700 transition-all";
            } else {
                document.getElementById('mode-upload').classList.add('hidden');
                document.getElementById('mode-webcam').classList.remove('hidden');
                document.getElementById('btn-mode-webcam').className = "px-4 py-2 rounded-md text-sm font-bold transition-all bg-blue-50 text-blue-600";
                document.getElementById('btn-mode-upload').className = "px-4 py-2 rounded-md text-sm font-bold text-slate-500 hover:text-slate-700 transition-all";
            }
        }

        // --- Upload Logic (Multi-Face) ---
        async function performUploadSearch(input) {
            if (!modelsLoaded) {
                alert("Please wait a moment for the AI models to initialize.");
                return;
            }
            if (!input.files || !input.files[0]) return;

            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = async (e) => {
                const img = document.getElementById('input-image');
                img.src = e.target.result;

                // Show preview area
                document.getElementById('upload-placeholder').classList.add('hidden');
                document.getElementById('preview-container').classList.remove('hidden');

                updateStatus('loading', 'Scanning image...');

                // Detect All Faces
                // Using SsdMobilenetv1Options for better accuracy
                const detections = await faceapi.detectAllFaces(img).withFaceLandmarks().withFaceDescriptors();

                displayResults(detections, 'upload');

                // Draw boxes
                const canvas = document.getElementById('overlay-canvas');
                const displaySize = { width: img.width, height: img.height }; // Native size? need to check checks
                // Need to wait for image load event essentially, but FileReader dataURL usually fast
                // Better approach:
                drawDetections(img, canvas, detections, displaySize);
            };
            reader.readAsDataURL(file);
            input.value = ''; // Reset input to allow re-uploading the same file
        }

        // --- Webcam Logic (Real-time) ---
        async function startWebcam() {
            const video = document.getElementById('webcam-video');
            const overlay = document.getElementById('webcam-overlay');

            try {
                currentStream = await navigator.mediaDevices.getUserMedia({ video: {} });
                video.srcObject = currentStream;
                overlay.classList.add('hidden');
                isWebcamActive = true;

                updateStatus('working', 'Webcam active. Scanning...');

                video.addEventListener('play', () => {
                    const canvas = document.getElementById('webcam-canvas');
                    const displaySize = { width: video.videoWidth, height: video.videoHeight };
                    faceapi.matchDimensions(canvas, displaySize);

                    webcamInterval = setInterval(async () => {
                        if (!isWebcamActive) return;

                        const detections = await faceapi.detectAllFaces(video, new faceapi.SsdMobilenetv1Options({ minConfidence: detectionThreshold }))
                            .withFaceLandmarks()
                            .withFaceDescriptors();

                        const resizedDetections = faceapi.resizeResults(detections, displaySize);
                        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);

                        // Custom Draw
                        if (faceMatcher) {
                            const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor));

                            results.forEach((result, i) => {
                                const box = resizedDetections[i].detection.box;
                                const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() });
                                drawBox.draw(canvas);
                            });

                            // Update Side Panel continuously? Maybe rate limit this
                            // For now, let's just draw on screen and maybe list unique people found in last 2 seconds
                            // To avoid spamming, we won't log every frame.

                            updateResultListFromWebcam(results);
                        }

                    }, 500); // Check every 500ms
                });

            } catch (err) {
                console.error(err);
                alert("Could not access webcam");
            }
        }

        function stopWebcam() {
            if (currentStream) {
                currentStream.getTracks().forEach(track => track.stop());
            }
            clearInterval(webcamInterval);
            document.getElementById('webcam-overlay').classList.remove('hidden');
            isWebcamActive = false;
        }

        // --- Shared Helpers ---

        function drawDetections(img, canvas, detections, dim) {
            // Need to ensure image dimensions are rendered dimensions
            // A bit tricky with "max-h-full" css. 
            // Simple approach: Match canvas to displayed image size

            // Wait for image render (next tick)
            setTimeout(() => {
                const displaySize = { width: img.clientWidth, height: img.clientHeight };
                faceapi.matchDimensions(canvas, displaySize);
                const resizedDetections = faceapi.resizeResults(detections, displaySize);

                if (faceMatcher) {
                    const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor));
                    results.forEach((result, i) => {
                        const box = resizedDetections[i].detection.box;
                        const label = result.label === 'unknown' ? 'Unknown' : dbUsers.find(u => u.id === result.label)?.name;
                        const drawBox = new faceapi.draw.DrawBox(box, { label: label + ` (${Math.round((1 - result.distance) * 100)}%)` });
                        drawBox.draw(canvas);
                    });
                }
            }, 100);
        }

        function displayResults(detections, type) {
            const container = document.getElementById('results-container');
            const countEl = document.getElementById('match-count');
            container.innerHTML = '';

            if (!detections || detections.length === 0) {
                updateStatus('warning', 'No faces detected');
                countEl.innerText = "0 Matches";
                return;
            }

            let matchesCount = 0;
            const uniqueFoundIds = new Set();

            if (faceMatcher) {
                detections.forEach(d => {
                    // Filter by slider threshold manually if needed, though simpler to rely on FindBestMatch distance
                    const match = faceMatcher.findBestMatch(d.descriptor);
                    // Match.distance < 0.6 usually. 
                    // Our slider sets minConfidence for DETECTION.
                    // Let's filter MATCH confidence:
                    const confidence = 1 - match.distance;
                    if (confidence < detectionThreshold) return;

                    if (match.label !== 'unknown') {
                        matchesCount++;
                        uniqueFoundIds.add(match.label);
                        const user = dbUsers.find(u => u.id === match.label);
                        appendUserCard(user, confidence);
                    }
                });
            }

            countEl.innerText = `${matchesCount} Matches`;
            countEl.nextElementSibling.innerText = `${detections.length} Faces Detected in Total`;

            if (matchesCount > 0) {
                updateStatus('success', `Found ${matchesCount} matches!`);
                logSearch(type, matchesCount);
                loadHistory(); // Refresh history
            } else {
                updateStatus('warning', 'Faces found, but no database matches.');
            }
        }

        // Debounce webcam results updates
        let lastWebcamUpdate = 0;
        function updateResultListFromWebcam(results) {
            const now = Date.now();
            if (now - lastWebcamUpdate < 2000) return; // Update UI every 2s max
            lastWebcamUpdate = now;

            const container = document.getElementById('results-container');
            const countEl = document.getElementById('match-count');

            // Only rebuild list if significantly different? 
            // For simplicity, clear and rebuild if matches found

            const validMatches = results.filter(m => m.label !== 'unknown' && (1 - m.distance) >= detectionThreshold);

            if (validMatches.length > 0) {
                container.innerHTML = '';
                const uniqueIds = [...new Set(validMatches.map(m => m.label))];

                uniqueIds.forEach(id => {
                    const user = dbUsers.find(u => u.id === id);
                    const bestConf = Math.max(...validMatches.filter(m => m.label === id).map(m => 1 - m.distance));
                    appendUserCard(user, bestConf);
                });

                countEl.innerText = `${uniqueIds.length} People Found`;
                countEl.nextElementSibling.innerText = "Live Verification Active";

                // Logging for webcam? Maybe only ONE log per session or per unique detection?
                // skipping auto-log for webcam loop to avoid spam
            }
        }

        function appendUserCard(user, confidence) {
            const container = document.getElementById('results-container');
            const percent = Math.round(confidence * 100);

            const html = `
                <div class="bg-white p-4 rounded-xl shadow-sm border border-green-200 flex items-start gap-4 animate-in fade-in slide-in-from-bottom-2">
                    <img src="${user.photo}" class="w-16 h-16 rounded-lg object-cover bg-slate-100 border border-slate-200">
                    <div class="flex-1">
                         <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-slate-800">${user.name}</h4>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-600">${user.role}</span>
                            </div>
                            <span class="text-green-600 text-xs font-bold bg-green-50 px-2 py-1 rounded-full">${percent}%</span>
                        </div>
                        <div class="mt-2 flex justify-between items-center">
                            <span class="text-xs text-slate-500">ID: ${user.student_id || 'N/A'}</span>
                            <div class="text-right">
                                <a href="<?= base_url('admin/edit_user/') ?>${user.id}" class="text-blue-600 font-bold text-xs hover:underline">Manage User &rarr;</a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }

        // --- Status & Logs ---
        function updateStatus(type, msg) {
            const el = document.getElementById('status-msg');
            let icon = 'info';
            let color = 'text-slate-500';

            if (type === 'loading') { icon = 'progress_activity'; el.querySelector('span').classList.add('animate-spin'); }
            else { el.querySelector('span').classList.remove('animate-spin'); }

            if (type === 'success') { icon = 'check_circle'; color = 'text-green-600'; }
            if (type === 'warning') { icon = 'warning'; color = 'text-amber-500'; }
            if (type === 'error') { icon = 'error'; color = 'text-red-500'; }

            el.className = `text-sm font-medium flex items-center gap-2 ${color}`;
            el.innerHTML = `<span class="material-symbols-outlined ${type === 'loading' ? 'animate-spin' : ''}">${icon}</span> <span>${msg}</span>`;
        }

        async function logSearch(type, count) {
            await fetch('<?= base_url('admin/log_face_search') ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ search_type: type, matches_found: count })
            });
        }

        async function loadHistory() {
            const res = await fetch('<?= base_url('admin/get_face_search_history') ?>');
            const logs = await res.json();
            const list = document.getElementById('history-list');

            if (!logs.length) {
                list.innerHTML = '<div class="p-4 text-center text-xs text-slate-400">No recent history</div>';
                return;
            }

            list.innerHTML = logs.map(log => `
                <div class="p-3 hover:bg-slate-50 flex items-center justify-between group">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-xs bg-slate-100 p-1 rounded ${log.search_type === 'webcam' ? 'text-red-500' : 'text-blue-500'}">
                                ${log.search_type === 'webcam' ? 'videocam' : 'image'}
                            </span>
                            <span class="text-xs font-bold text-slate-700">${log.matches_found} Matches</span>
                        </div>
                        <p class="text-[10px] text-slate-400 mt-1">by ${log.admin_name}</p>
                    </div>
                    <span class="text-[10px] text-slate-400 group-hover:text-slate-600">${log.time_ago}</span>
                </div>
            `).join('');
        }

    </script>
</body>

</html>