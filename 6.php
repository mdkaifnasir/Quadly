<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Key Modules &amp; Functionality</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .bg-pattern-dots {
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 24px 24px;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-[1280px] h-[720px] bg-white relative overflow-hidden shadow-2xl flex flex-col">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-pattern-dots opacity-30 pointer-events-none"></div>
        <!-- Header -->
        <header class="px-16 pt-6 pb-2 flex justify-between items-end border-b border-gray-100 z-10 relative bg-white">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-8 h-1 bg-teal-500 rounded-full"></span>
                    <p class="text-sm font-bold text-teal-600 tracking-widest uppercase">5. Capabilities</p>
                </div>
                <h1 class="text-4xl font-extrabold text-blue-900">Key Modules &amp; Functionality</h1>
            </div>
            <div class="text-right">
                <p class="text-gray-400 font-medium text-sm">Detailed Feature Breakdown</p>
            </div>
        </header>
        <!-- Main Content Grid -->
        <main class="flex-1 px-16 py-4 z-10 relative overflow-hidden">
            <div class="grid grid-cols-3 gap-4 h-full">
                <!-- Module 1: Registration -->
                <div
                    class="bg-white border border-blue-100 rounded-xl p-4 shadow-sm card-hover transition-all duration-300 flex flex-col relative overflow-hidden group animate-fade-in opacity-0">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110">
                    </div>
                    <div class="flex items-center gap-4 mb-4 relative z-10">
                        <div
                            class="w-12 h-12 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center text-xl shadow-sm">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">Registration</h3>
                    </div>
                    <div class="space-y-3 flex-1">
                        <p class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fas fa-check text-blue-500 mt-1 text-xs"></i>
                            <span><strong>Role-Specific Forms:</strong> Tailored data collection for Students (PRN) and
                                Faculty (ID).</span>
                        </p>
                        <p class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fas fa-check text-blue-500 mt-1 text-xs"></i>
                            <span><strong>Smart Verification:</strong> OCR &amp; QR scanning to validate physical ID
                                cards instantly.</span>
                        </p>
                        <p class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fas fa-check text-blue-500 mt-1 text-xs"></i>
                            <span><strong>Face AI Enrollment:</strong> Captures biometrics during signup for secure
                                future logins.</span>
                        </p>
                    </div>
                </div>
                <!-- Module 2: Login -->
                <div
                    class="bg-white border border-teal-100 rounded-xl p-4 shadow-sm card-hover transition-all duration-300 flex flex-col relative overflow-hidden group animate-fade-in opacity-0 delay-100">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-teal-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110">
                    </div>
                    <div class="flex items-center gap-4 mb-4 relative z-10">
                        <div
                            class="w-12 h-12 rounded-lg bg-teal-100 text-teal-600 flex items-center justify-center text-xl shadow-sm">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">Login System</h3>
                    </div>
                    <div class="space-y-3 flex-1">
                        <p class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fas fa-check text-teal-500 mt-1 text-xs"></i>
                            <span><strong>Face Recognition:</strong> "Login-by-Face" compares live camera input with
                                stored descriptors.</span>
                        </p>
                        <p class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fas fa-check text-teal-500 mt-1 text-xs"></i>
                            <span><strong>Secure Auth:</strong> Traditional email/password access using BCrypt
                                encryption.</span>
                        </p>
                        <p class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fas fa-check text-teal-500 mt-1 text-xs"></i>
                            <span><strong>OTP Recovery:</strong> PHPMailer-based One-Time Password system for lost
                                credentials.</span>
                        </p>
                    </div>
                </div>
                <!-- Module 3: Profile -->
                <div
                    class="bg-white border border-indigo-100 rounded-xl p-4 shadow-sm card-hover transition-all duration-300 flex flex-col relative overflow-hidden group animate-fade-in opacity-0 delay-200">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-indigo-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110">
                    </div>
                    <div class="flex items-center gap-4 mb-4 relative z-10">
                        <div
                            class="w-12 h-12 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center text-xl shadow-sm">
                            <i class="fas fa-id-badge"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">User Profile</h3>
                    </div>
                    <div class="space-y-3 flex-1">
                        <p class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fas fa-check text-indigo-500 mt-1 text-xs"></i>
                            <span><strong>Identity Hub:</strong> Customizable bio, avatar management, and social
                                links.</span>
                        </p>
                        <p class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fas fa-check text-indigo-500 mt-1 text-xs"></i>
                            <span><strong>Activity Timeline:</strong> Centralized view of user Threads, Replies, and
                                Reposts.</span>
                        </p>
                        <p class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fas fa-check text-indigo-500 mt-1 text-xs"></i>
                            <span><strong>Profile QR:</strong> Dynamic QR generation for quick networking and profile
                                sharing.</span>
                        </p>
                    </div>
                </div>
                <!-- Module 4: Feed (Campus Connect) -->
                <div
                    class="bg-white border border-pink-100 rounded-xl p-4 shadow-sm card-hover transition-all duration-300 flex flex-col relative overflow-hidden group animate-fade-in opacity-0">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-pink-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110">
                    </div>
                    <div class="flex items-center gap-4 mb-4 relative z-10">
                        <div
                            class="w-12 h-12 rounded-lg bg-pink-100 text-pink-600 flex items-center justify-center text-xl shadow-sm">
                            <i class="fas fa-stream"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">Campus Feed</h3>
                    </div>
                    <div class="space-y-3 flex-1">
                        <p class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fas fa-check text-pink-500 mt-1 text-xs"></i>
                            <span><strong>Multimedia Support:</strong> Rich text, image, and video posts with responsive
                                layouts.</span>
                        </p>
                        <p class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fas fa-check text-pink-500 mt-1 text-xs"></i>
                            <span><strong>Engagement Suite:</strong> Likes, threaded comments, and quote-sharing
                                features.</span>
                        </p>
                        <p class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fas fa-check text-pink-500 mt-1 text-xs"></i>
                            <span><strong>Priority Logic:</strong> Algorithm prioritizes verified faculty broadcasts and
                                notices.</span>
                        </p>
                    </div>
                </div>
                <!-- Module 5: Clubs & Events -->
                <div
                    class="bg-white border border-orange-100 rounded-xl p-4 shadow-sm card-hover transition-all duration-300 flex flex-col relative overflow-hidden group animate-fade-in opacity-0 delay-100">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-orange-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110">
                    </div>
                    <div class="flex items-center gap-4 mb-4 relative z-10">
                        <div
                            class="w-12 h-12 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center text-xl shadow-sm">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">Clubs &amp; Events</h3>
                    </div>
                    <div class="space-y-3 flex-1">
                        <p class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fas fa-check text-orange-500 mt-1 text-xs"></i>
                            <span><strong>Club Hubs:</strong> Dedicated pages for organizations to manage members and
                                news.</span>
                        </p>
                        <p class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fas fa-check text-orange-500 mt-1 text-xs"></i>
                            <span><strong>Event Discovery:</strong> Hashtag-driven search (#TechFest) for campus
                                activities.</span>
                        </p>
                        <p class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fas fa-check text-orange-500 mt-1 text-xs"></i>
                            <span><strong>Rich Previews:</strong> Visual event promotion cards embedded in the main
                                feed.</span>
                        </p>
                    </div>
                </div>
                <!-- Module 6: Admin Panel -->
                <div
                    class="bg-white border border-red-100 rounded-xl p-4 shadow-sm card-hover transition-all duration-300 flex flex-col relative overflow-hidden group animate-fade-in opacity-0 delay-200">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-red-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110">
                    </div>
                    <div class="flex items-center gap-4 mb-4 relative z-10">
                        <div
                            class="w-12 h-12 rounded-lg bg-red-100 text-red-600 flex items-center justify-center text-xl shadow-sm">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">Admin Panel</h3>
                    </div>
                    <div class="space-y-3 flex-1">
                        <p class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fas fa-check text-red-500 mt-1 text-xs"></i>
                            <span><strong>User Lifecycle:</strong> Tools to approve, suspend, or delete accounts based
                                on ID checks.</span>
                        </p>
                        <p class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fas fa-check text-red-500 mt-1 text-xs"></i>
                            <span><strong>Face Search Tool:</strong> Admin-only feature to identify users via image
                                upload.</span>
                        </p>
                        <p class="flex items-start gap-3 text-sm text-gray-600">
                            <i class="fas fa-check text-red-500 mt-1 text-xs"></i>
                            <span><strong>Stats Dashboard:</strong> Real-time overview of growth, posts, and
                                engagement.</span>
                        </p>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer -->
        <footer
            class="bg-white px-16 py-4 border-t border-gray-100 flex justify-between items-center text-xs font-medium text-gray-400 z-10">
            <p>Dr P.A Inamdar University • BCA Major Project</p>
            <div class="flex items-center gap-4">
                <span>Page 06</span>
                <div class="w-16 h-1 bg-gray-100 rounded-full overflow-hidden">
                    <div class="w-3/5 h-full bg-teal-500"></div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>