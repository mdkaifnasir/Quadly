<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Campus Sign Up - Modern</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <!-- AI Moderation: TensorFlow.js and NSFWJS -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@3.11.0/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/nsfwjs@2.4.1/dist/nsfwjs.min.js"></script>
    <script id="tailwind-config">
        const csrfTokenName = '<?= $this->security->get_csrf_token_name() ?>';
        const csrfHash = '<?= $this->security->get_csrf_hash() ?>';

        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#6366f1",
                        "primary-dark": "#4f46e5",
                        "accent": "#ec4899",
                        "success": "#10b981",
                    },
                    fontFamily: {
                        "sans": ["Inter", "sans-serif"]
                    },
                },
            },
        }
    </script>
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .animate-slide-in-right {
            animation: slideInRight 0.6s ease-out forwards;
        }

        .animate-scale-in {
            animation: scaleIn 0.5s ease-out forwards;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(40px) saturate(180%);
            -webkit-backdrop-filter: blur(40px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px 0 rgba(99, 102, 241, 0.1),
                0 20px 60px -15px rgba(99, 102, 241, 0.15),
                inset 0 1px 0 0 rgba(255, 255, 255, 0.8);
        }

        .input-modern {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-color: white;
            background-image: none;
        }

        .input-modern:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.2);
        }

        /* Dropdown arrow styling */
        select.input-modern {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%236366f1' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1.25rem;
            padding-right: 2.5rem;
        }

        .btn-modern {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-modern:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px -10px rgba(99, 102, 241, 0.4);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .step-indicator {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .step-active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: scale(1.1);
        }

        .step-line {
            transition: all 0.6s ease;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Mobile optimizations */
        @media (max-width: 1024px) {
            .glass-card {
                background: rgba(255, 255, 255, 0.98);
            }

            .input-modern:focus {
                transform: none;
            }

            .btn-modern:hover {
                transform: none;
            }
        }

        /* Mobile logo */
        .mobile-logo {
            display: block;
        }

        @media (min-width: 1024px) {
            .mobile-logo {
                display: none;
            }
        }

        /* =========================
       MOBILE VIEW ONLY FIXES
       ========================= */
        @media (max-width: 640px) {

            /* Reduce overall padding */
            .glass-card {
                padding: 1rem !important;
                border-radius: 1.25rem;
            }

            /* Hide heavy animated background on mobile - DISABLED, we want it now */
            /* .absolute.inset-0 {
                display: none;
            } */


            /* Logo sizing */
            .mobile-logo img {
                height: 120px;
            }

            /* Headings scale */
            h1 {
                font-size: 2rem;
                line-height: 2.4rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            /* Stepper spacing */
            #stepper-line {
                width: 3rem;
            }

            .step-indicator {
                width: 2.5rem;
                height: 2.5rem;
                font-size: 0.875rem;
            }

            /* Form spacing */
            form.space-y-6>* {
                margin-top: 1rem !important;
            }

            /* Force single column for grids */
            .grid-cols-2 {
                grid-template-columns: 1fr !important;
            }

            /* Profile photo */
            #profile-preview-student {
                width: 96px;
                height: 96px;
            }

            /* Buttons touch-friendly */
            button {
                padding-top: 0.9rem;
                padding-bottom: 0.9rem;
                font-size: 0.95rem;
            }

            /* OTP section stacking */
            .flex.gap-3 {
                flex-direction: column;
            }

            /* ID upload container */
            #id_card_container_student {
                padding: 1.25rem;
                text-align: center;
            }

            /* Footer spacing */
            footer,
            p.text-center {
                margin-top: 1rem;
                font-size: 0.75rem;
            }
        }
    </style>
</head>

<body class="min-h-screen">

    <div class="min-h-screen flex items-center justify-center py-4 px-2 sm:px-6 lg:px-8 relative overflow-x-hidden">

        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute top-20 left-20 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse">
            </div>
            <div class="absolute top-40 right-20 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"
                style="animation-delay: 2s;"></div>
            <div class="absolute -bottom-8 left-40 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"
                style="animation-delay: 4s;"></div>

            <!-- Mobile Specific Fun Elements -->
            <div class="lg:hidden absolute top-1/3 left-1/2 w-8 h-8 bg-red-300 rounded-full opacity-60 animate-ping">
            </div>

        </div>

        <!-- Main Container -->
        <div class="w-full max-w-6xl mx-auto relative z-10">
            <!-- Mobile Logo (Gradient Text Only) -->
            <div class="mobile-logo text-center mb-8 lg:hidden">
                <h1 class="text-4xl font-extrabold">
                    <span class="gradient-text">Quadly</span>
                </h1>
            </div>

            <div class="grid lg:grid-cols-2 gap-8 items-center">

                <!-- Left Side - Branding -->
                <div class="hidden lg:block animate-fade-in-up">
                    <div class="text-center lg:text-left space-y-6 p-8">
                        <div class="inline-flex items-center gap-3 mb-8">
                            <img src="<?= base_url('assets/images/logo.png?v=' . time()) ?>" alt="CampusConnect Logo"
                                class="h-44 w-auto floating">
                        </div>

                        <h1 class="text-5xl xl:text-6xl font-extrabold leading-tight">
                            Welcome to <br />
                            <span class="gradient-text">Quadly</span>
                        </h1>

                        <p class="text-gray-600 text-lg leading-relaxed max-w-md">
                            Join thousands of students and faculty in the ultimate campus community platform. Your
                            journey starts here.
                        </p>

                        <div class="flex gap-4 pt-4">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white">school</span>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800">10,000+</p>
                                    <p class="text-sm text-gray-600">Students</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-cyan-400 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white">groups</span>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800">500+</p>
                                    <p class="text-sm text-gray-600">Faculty</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Registration Form Card -->
                <div class="lg:animate-slide-in-right w-full">
                    <div class="glass-card rounded-2xl sm:rounded-3xl p-4 sm:p-8 lg:p-10 shadow-2xl w-full">

                        <!-- Header -->
                        <div class="flex items-center justify-between mb-6 sm:mb-8">
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-800">Create Account</h2>
                            <a href="<?= base_url('auth/login') ?>"
                                class="text-xs sm:text-sm font-semibold text-primary hover:text-primary-dark transition-colors whitespace-nowrap">
                                Log In →
                            </a>
                        </div>

                        <!-- Student Registration Form -->
                        <form id="student-form" action="<?= base_url('auth/register_submit') ?>" method="POST"
                            enctype="multipart/form-data" class="space-y-6" enctype="multipart/form-data"
                            class="space-y-6">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="user_type" value="student">
                            <input type="hidden" name="face_descriptor" id="face_descriptor_student">
                            <input type="hidden" name="qr_code_data" id="qr_code_data_student">
                            <input type="hidden" name="student_id" id="student_id_val_student">

                            <!-- Stepper Indicator -->
                            <div class="flex items-center justify-center mb-8">
                                <div id="stepper-1"
                                    class="step-indicator w-10 h-10 rounded-full flex items-center justify-center font-bold text-white step-active shadow-lg">
                                    1
                                </div>
                                <div id="stepper-line" class="step-line h-1 w-24 bg-gray-200 mx-3 rounded-full"></div>
                                <div id="stepper-2"
                                    class="step-indicator w-10 h-10 rounded-full flex items-center justify-center font-bold text-gray-400 bg-gray-200 shadow-lg">
                                    2
                                </div>
                            </div>

                            <!-- Step 1: Personal Information -->
                            <div id="step-1-content" class="space-y-5 animate-scale-in">

                                <!-- AI Moderation Removed -->

                                <!-- Profile Photo Removed as per request - will be added in Edit Profile -->


                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                                    <input
                                        class="input-modern w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                        placeholder="Enter your full name" type="text" name="full_name" required />
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Gender</label>
                                        <select
                                            class="input-modern w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                            name="gender">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Date of
                                            Birth</label>
                                        <input
                                            class="input-modern w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                            type="date" name="dob" required />
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">College /
                                        Department</label>
                                    <select
                                        class="input-modern w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                        name="major">
                                        <option value="">Select College / Department</option>
                                        <?php if (isset($departments)): ?>
                                            <?php foreach ($departments as $dept): ?>
                                                <option value="<?= htmlspecialchars($dept->name) ?>">
                                                    <?= htmlspecialchars($dept->name) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <button type="button" id="btn-continue-step1" onclick="nextStep(2)"
                                    class="btn-modern w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300">
                                    Continue to Verification →
                                </button>
                            </div>

                            <!-- Step 2: Verification -->
                            <div id="step-2-content" class="hidden space-y-5">

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                                    <input
                                        class="input-modern w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                        placeholder="name@example.com" type="email" name="email" />
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Mobile Number</label>
                                    <input
                                        class="input-modern w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                        placeholder="+91 98765 43210" type="tel" name="mobile" />
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                                        <input
                                            class="input-modern w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                            placeholder="••••••••" type="password" name="password" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm
                                            Password</label>
                                        <input
                                            class="input-modern w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                            placeholder="••••••••" type="password" name="password_confirm" />
                                    </div>
                                </div>

                                <!-- OTP Section -->
                                <div
                                    class="bg-gradient-to-br from-purple-50 to-pink-50 p-5 rounded-2xl border border-purple-100">
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">Email Verification
                                        OTP</label>
                                    <div class="flex gap-3">
                                        <input
                                            class="input-modern flex-1 px-4 py-3 rounded-xl border-2 border-purple-200 focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none text-center tracking-widest font-bold transition-all"
                                            maxlength="6" placeholder="000000" type="text" name="otp_student" />
                                        <button type="button" onclick="sendOTP('student')"
                                            class="px-6 bg-white border-2 border-purple-200 rounded-xl font-semibold text-sm text-primary hover:bg-purple-50 transition-all">
                                            Send OTP
                                        </button>
                                    </div>
                                </div>

                                <!-- ID Upload -->
                                <div id="id_card_container_student"
                                    class="border-3 border-dashed border-purple-200 rounded-2xl p-8 flex flex-col items-center justify-center cursor-pointer hover:border-primary hover:bg-purple-50/50 transition-all duration-300"
                                    onclick="triggerIDUpload('student')">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center mb-3">
                                        <span class="material-symbols-outlined text-primary text-3xl">badge</span>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-700" id="id_card_text_student">Upload
                                        Student ID Card with QR Code</p>
                                    <p class="text-xs text-gray-500 mt-1" id="id_card_subtext_student">Click to browse
                                    </p>
                                    <input type="file" id="id_card_student" name="id_card" class="hidden"
                                        accept="image/*" onchange="scanQRCode('student')">
                                </div>

                                <label
                                    class="flex items-center gap-3 cursor-pointer p-4 rounded-xl hover:bg-gray-50 transition-all">
                                    <input type="checkbox" name="terms"
                                        class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary transition-all"
                                        id="terms_student" />
                                    <span class="text-sm text-gray-600">I agree to the <span
                                            class="text-primary font-semibold">Terms & Conditions</span></span>
                                </label>

                                <!-- Error Message Container -->
                                <div id="error-container"
                                    class="<?= $this->session->flashdata('error') ? 'block' : 'hidden' ?> p-4 mb-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl transition-all animate-shake">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-red-500">error</span>
                                        <p id="error-message" class="text-sm font-semibold text-red-700">
                                            <?= $this->session->flashdata('error') ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="flex gap-3 pt-2">
                                    <button type="button" onclick="nextStep(1)"
                                        class="flex-1 bg-gray-100 text-gray-700 font-bold py-4 rounded-xl hover:bg-gray-200 transition-all duration-300">
                                        ← Back
                                    </button>
                                    <button type="submit"
                                        class="btn-modern flex-[2] bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300">
                                        Complete Registration ✓
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>

                    <!-- Footer -->
                    <p class="text-center text-sm text-gray-600 mt-6">
                        © <?= date('Y') ?> Campus Connect. All rights reserved.
                    </p>
                </div>

            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/tesseract.js@5/dist/tesseract.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>

    <script>
        // --- STEPPER LOGIC WITH ANIMATIONS ---
        function nextStep(step) {
            const step1 = document.getElementById('step-1-content');
            const step2 = document.getElementById('step-2-content');
            const ind1 = document.getElementById('stepper-1');
            const ind2 = document.getElementById('stepper-2');
            const line = document.getElementById('stepper-line');

            if (step === 2) {
                // Validation for Step 1
                const name = document.querySelector('input[name="full_name"]').value;
                if (!name) {
                    alert("Please enter your name");
                    return;
                }

                // Animate out step 1
                step1.style.opacity = '0';
                step1.style.transform = 'translateX(-30px)';

                setTimeout(() => {
                    step1.classList.add('hidden');
                    step2.classList.remove('hidden');
                    step2.classList.add('animate-scale-in');
                    step2.style.opacity = '1';
                    step2.style.transform = 'translateX(0)';
                }, 300);

                // Update stepper
                ind1.classList.remove('step-active');
                ind1.classList.add('bg-success');
                ind1.innerHTML = '<span class="material-symbols-outlined text-sm">check</span>';

                line.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';

                ind2.classList.remove('bg-gray-200', 'text-gray-400');
                ind2.classList.add('step-active');
            } else {
                // Animate back to step 1
                step2.style.opacity = '0';
                step2.style.transform = 'translateX(30px)';

                setTimeout(() => {
                    step2.classList.add('hidden');
                    step1.classList.remove('hidden');
                    step1.classList.add('animate-scale-in');
                    step1.style.opacity = '1';
                    step1.style.transform = 'translateX(0)';
                }, 300);

                // Reset stepper
                ind1.classList.add('step-active');
                ind1.classList.remove('bg-success');
                ind1.innerText = "1";

                line.style.background = '#e5e7eb';

                ind2.classList.add('bg-gray-200', 'text-gray-400');
                ind2.classList.remove('step-active');
            }
        }

        // --- EXISTING LOGIC (PRESERVED) ---
        const MODEL_URL = 'https://justadudewhohacks.github.io/face-api.js/models';
        let faceModelsLoaded = false;
        async function loadFaceModels() {
            try {
                await Promise.all([
                    faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL),
                    faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
                    faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL)
                ]);
                faceModelsLoaded = true;
            } catch (err) { console.error("Error loading FaceAPI models:", err); }
        }
        loadFaceModels();

        // Error Handling Functions
        function showRegistrationError(message) {
            const container = document.getElementById('error-container');
            const messageEl = document.getElementById('error-message');
            if (container && messageEl) {
                messageEl.textContent = message;
                container.classList.remove('hidden');
                container.classList.add('block');
            }
        }

        function clearRegistrationError() {
            const container = document.getElementById('error-container');
            if (container) {
                container.classList.add('hidden');
                container.classList.remove('block');
            }
        }

        function validateFileSize(file, maxSizeMB = 2) { // 2MB is a reasonable limit for profile photos
            if (file && file.size > maxSizeMB * 1024 * 1024) {
                return false;
            }
            return true;
        }

        // Profile Photo Processing Removed


        function triggerIDUpload(type) {
            document.getElementById('id_card_' + type).click();
        }

        // QR Code Scanning Function
        async function scanQRCode(type) {
            const fileInput = document.getElementById('id_card_' + type);
            const textElement = document.getElementById('id_card_text_' + type);
            const subtextElement = document.getElementById('id_card_subtext_' + type);
            const containerElement = document.getElementById('id_card_container_' + type);
            const qrDataInput = document.getElementById('qr_code_data_' + type);

            if (!fileInput.files || !fileInput.files[0]) {
                return;
            }

            const file = fileInput.files[0];

            // Clear previous errors
            clearRegistrationError();

            // Validate file size (5MB limit for ID card)
            if (!validateFileSize(file, 5)) {
                showRegistrationError("ID Card file is larger than the permitted size (5MB).");
                fileInput.value = '';
                textElement.innerHTML = '❌ File Too Large';
                textElement.classList.remove('text-primary');
                textElement.classList.add('text-red-600');
                subtextElement.textContent = 'Maximum size: 5MB';
                containerElement.classList.remove('border-primary');
                containerElement.classList.add('border-red-400');
                return;
            }

            // Update UI to show scanning
            textElement.innerHTML = '<span class="animate-pulse">Scanning QR Code...</span>';
            textElement.classList.remove('text-success', 'text-red-600');
            textElement.classList.add('text-primary');
            subtextElement.textContent = 'Please wait...';
            containerElement.classList.remove('border-green-400', 'border-red-400');
            containerElement.classList.add('border-primary');

            const reader = new FileReader();

            reader.onload = async function (e) {
                const img = new Image();
                img.onload = async function () {
                    // Create canvas to process image
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    canvas.width = img.width;
                    canvas.height = img.height;
                    ctx.drawImage(img, 0, 0);

                    // Get image data for QR scanning
                    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);

                    // Scan for QR code using jsQR
                    const code = jsQR(imageData.data, imageData.width, imageData.height);

                    if (code && code.data) {
                        // QR Code found - extract student ID from URL
                        const qrUrl = code.data;

                        // Expected format: https://acapp.in/WebApp/WebApp/Student/AdmissionVerification/1090/42156
                        // Extract the last number (student ID)
                        const urlParts = qrUrl.split('/');
                        const studentId = urlParts[urlParts.length - 1];

                        // Validate that we got a valid student ID (numeric)
                        if (studentId && /^\d+$/.test(studentId)) {
                            // Use the full URL as unique identifier
                            await validateQRCodeWithServer(qrUrl, type, studentId);
                        } else {
                            textElement.innerHTML = '❌ Invalid QR Code Format';
                            textElement.classList.remove('text-primary');
                            textElement.classList.add('text-red-600');
                            subtextElement.textContent = 'QR code does not contain valid admission data';
                            containerElement.classList.remove('border-primary');
                            containerElement.classList.add('border-red-400');
                            qrDataInput.value = '';
                            fileInput.value = '';
                        }
                    } else {
                        // No QR code found
                        textElement.innerHTML = '❌ No QR Code Found';
                        textElement.classList.remove('text-primary');
                        textElement.classList.add('text-red-600');
                        subtextElement.textContent = 'Please upload a valid ID card with QR code';
                        containerElement.classList.remove('border-primary');
                        containerElement.classList.add('border-red-400');
                        qrDataInput.value = '';
                        fileInput.value = ''; // Clear the file input
                    }
                };
                img.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }

        // Validate QR code with server
        async function validateQRCodeWithServer(qrData, type, studentId) {
            const textElement = document.getElementById('id_card_text_' + type);
            const subtextElement = document.getElementById('id_card_subtext_' + type);
            const containerElement = document.getElementById('id_card_container_' + type);
            const qrDataInput = document.getElementById('qr_code_data_' + type);
            const fileInput = document.getElementById('id_card_' + type);

            textElement.innerHTML = '<span class="animate-pulse">Validating QR Code...</span>';
            subtextElement.textContent = 'Checking database...';

            const formData = new FormData();
            formData.append('qr_data', qrData);
            if (typeof csrfTokenName !== 'undefined') {
                formData.append(csrfTokenName, csrfHash);
            }

            try {
                const response = await fetch('<?= base_url('auth/validate_qr_code') ?>', {
                    method: 'POST',
                    body: formData
                });

                // Log response for debugging
                console.log('Response status:', response.status);
                console.log('Response OK:', response.ok);

                const data = await response.json();
                console.log('Response data:', data);

                if (data.status === 'success') {
                    // QR code is valid and not used
                    textElement.innerHTML = '✓ Valid ID Card';
                    textElement.classList.remove('text-primary', 'text-red-600');
                    textElement.classList.add('text-success');
                    subtextElement.textContent = 'Student ID: ' + studentId + ' verified';
                    containerElement.classList.remove('border-primary', 'border-red-400');
                    containerElement.classList.add('border-green-400');
                    qrDataInput.value = qrData; // Store QR data for submission
                    document.getElementById('student_id_val_' + type).value = studentId; // Store extracted Student ID
                } else {
                    // QR code already used or invalid
                    textElement.innerHTML = '❌ USED ID CARD';
                    textElement.classList.remove('text-primary', 'text-success');
                    textElement.classList.add('text-red-600');
                    subtextElement.innerHTML = '<span class="text-red-500 font-bold">This ID has already been used!</span>';
                    containerElement.classList.remove('border-primary');
                    containerElement.classList.add('border-red-400');
                    qrDataInput.value = '';
                    fileInput.value = ''; // Clear the file input
                    // Show visible toast or alert
                    alert("⚠️ REGISTRATION BLOCKED:\n\n" + data.message);
                }
            } catch (error) {
                console.error('Validation error:', error);
                textElement.innerHTML = '⚠️ Validation Error';
                textElement.classList.add('text-red-600');
                subtextElement.textContent = 'Could not verify ID. Try again.';
            }
        }

        async function sendOTP(type) {
            const emailInput = document.querySelector('input[name="email"]');
            if (!emailInput || !emailInput.value) {
                alert("Please enter email first");
                return;
            }

            const formData = new FormData();
            formData.append('email', emailInput.value);
            formData.append('type', type);
            if (typeof csrfTokenName !== 'undefined') {
                formData.append(csrfTokenName, csrfHash);
            }

            const btn = event.target;
            const originalText = btn.innerText;
            btn.innerHTML = '<span class="animate-pulse">Sending...</span>';
            btn.disabled = true;

            try {
                const response = await fetch('<?= base_url('auth/send_otp') ?>', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();

                if (data.status === 'success') {
                    if (data.debug_otp) {
                        alert('DEBUG MODE: Email might fail on free hosting. Your OTP is: ' + data.debug_otp);
                        document.querySelector('input[name="otp_' + type + '"]').value = data.debug_otp;
                    } else {
                        alert(data.message);
                    }
                } else {
                    alert('Error: ' + data.message);
                }
            } catch (e) {
                console.error(e);
                alert('Connection error. Please try again.');
            } finally {
                btn.innerText = originalText;
                btn.disabled = false;
            }
        }
    </script>
</body>

</html>