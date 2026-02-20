<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Project Objectives</title>
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
            background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
            background-size: 24px 24px;
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

        .delay-400 {
            animation-delay: 0.4s;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-[1280px] h-[720px] bg-white relative overflow-hidden shadow-2xl flex flex-col">
        <!-- Decorative Background -->
        <div class="absolute inset-0 bg-pattern-dots opacity-30 pointer-events-none"></div>
        <div
            class="absolute top-0 right-0 w-[600px] h-[600px] bg-blue-50/50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4 opacity-70">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-teal-50/50 rounded-full blur-3xl translate-y-1/3 -translate-x-1/4 opacity-60">
        </div>
        <!-- Header -->
        <header
            class="px-16 pt-8 pb-3 flex justify-between items-end border-b border-gray-100 z-10 relative animate-fade-in opacity-0">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-8 h-1 bg-teal-500 rounded-full"></span>
                    <p class="text-sm font-bold text-teal-600 tracking-widest uppercase">2. Objectives</p>
                </div>
                <h1 class="text-3xl font-extrabold text-blue-900">Project Objectives</h1>
            </div>
            <div class="text-right">
                <div class="bg-blue-50 px-4 py-2 rounded-lg border border-blue-100">
                    <p class="text-blue-800 font-semibold text-sm">
                        <i class="fas fa-bullseye mr-2"></i>Key Goals &amp; Aims
                    </p>
                </div>
            </div>
        </header>
        <!-- Main Content -->
        <main class="flex-1 px-16 py-4 z-10 relative overflow-hidden">
            <!-- Grid Layout for 8 Objectives: 2 Columns x 4 Rows -->
            <div class="grid grid-cols-2 gap-x-8 gap-y-4 h-full">
                <!-- Objective 1 -->
                <div
                    class="flex items-start gap-4 p-3 rounded-xl bg-white border border-gray-100 shadow-sm hover:shadow-lg hover:border-blue-200 transition-all duration-300 group hover:-translate-y-1 animate-fade-in opacity-0">
                    <div
                        class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center flex-shrink-0 text-lg font-bold group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        1
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-bold text-gray-800 mb-0.5 flex items-center gap-2">
                            <i class="fas fa-university text-blue-400 text-xs"></i> Campus-Restricted Platform
                        </h3>
                        <p class="text-gray-600 text-xs leading-relaxed">
                            Develop a closed social network exclusively for authorized students, faculty, and campus
                            organizations to ensure privacy.
                        </p>
                    </div>
                </div>
                <!-- Objective 2 -->
                <div
                    class="flex items-start gap-4 p-3 rounded-xl bg-white border border-gray-100 shadow-sm hover:shadow-md hover:border-teal-200 transition-all duration-300 group">
                    <div
                        class="w-10 h-10 bg-teal-50 text-teal-600 rounded-lg flex items-center justify-center flex-shrink-0 text-lg font-bold group-hover:bg-teal-600 group-hover:text-white transition-colors">
                        2
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-bold text-gray-800 mb-0.5 flex items-center gap-2">
                            <i class="fas fa-user-lock text-teal-400 text-xs"></i> Secure Authentication
                        </h3>
                        <p class="text-gray-600 text-xs leading-relaxed">
                            Implement secure login and registration with verification to prevent unauthorized usage and
                            protect user data.
                        </p>
                    </div>
                </div>
                <!-- Objective 3 -->
                <div
                    class="flex items-start gap-4 p-3 rounded-xl bg-white border border-gray-100 shadow-sm hover:shadow-md hover:border-indigo-200 transition-all duration-300 group">
                    <div
                        class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0 text-lg font-bold group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        3
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-bold text-gray-800 mb-0.5 flex items-center gap-2">
                            <i class="fas fa-comments text-indigo-400 text-xs"></i> Centralize Communication
                        </h3>
                        <p class="text-gray-600 text-xs leading-relaxed">
                            Provide a single digital platform where all campus-related notices, updates, and discussions
                            are shared efficiently.
                        </p>
                    </div>
                </div>
                <!-- Objective 4 -->
                <div
                    class="flex items-start gap-4 p-3 rounded-xl bg-white border border-gray-100 shadow-sm hover:shadow-md hover:border-orange-200 transition-all duration-300 group">
                    <div
                        class="w-10 h-10 bg-orange-50 text-orange-600 rounded-lg flex items-center justify-center flex-shrink-0 text-lg font-bold group-hover:bg-orange-600 group-hover:text-white transition-colors">
                        4
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-bold text-gray-800 mb-0.5 flex items-center gap-2">
                            <i class="fas fa-bullhorn text-orange-400 text-xs"></i> Digital Announcements
                        </h3>
                        <p class="text-gray-600 text-xs leading-relaxed">
                            Enable faculty and clubs to publish notices and event info digitally, reducing dependency on
                            physical notice boards.
                        </p>
                    </div>
                </div>
                <!-- Objective 5 -->
                <div
                    class="flex items-start gap-4 p-3 rounded-xl bg-white border border-gray-100 shadow-sm hover:shadow-md hover:border-purple-200 transition-all duration-300 group">
                    <div
                        class="w-10 h-10 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center flex-shrink-0 text-lg font-bold group-hover:bg-purple-600 group-hover:text-white transition-colors">
                        5
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-bold text-gray-800 mb-0.5 flex items-center gap-2">
                            <i class="fas fa-graduation-cap text-purple-400 text-xs"></i> Academic Collaboration
                        </h3>
                        <p class="text-gray-600 text-xs leading-relaxed">
                            Facilitate student-faculty interaction for academic discussions, information sharing, and
                            collaborative learning.
                        </p>
                    </div>
                </div>
                <!-- Objective 6 -->
                <div
                    class="flex items-start gap-4 p-3 rounded-xl bg-white border border-gray-100 shadow-sm hover:shadow-md hover:border-pink-200 transition-all duration-300 group">
                    <div
                        class="w-10 h-10 bg-pink-50 text-pink-600 rounded-lg flex items-center justify-center flex-shrink-0 text-lg font-bold group-hover:bg-pink-600 group-hover:text-white transition-colors">
                        6
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-bold text-gray-800 mb-0.5 flex items-center gap-2">
                            <i class="fas fa-users text-pink-400 text-xs"></i> Club Management
                        </h3>
                        <p class="text-gray-600 text-xs leading-relaxed">
                            Provide tools for managing campus clubs, posting updates, promoting events, and engaging
                            students effectively.
                        </p>
                    </div>
                </div>
                <!-- Objective 7 -->
                <div
                    class="flex items-start gap-4 p-3 rounded-xl bg-white border border-gray-100 shadow-sm hover:shadow-md hover:border-cyan-200 transition-all duration-300 group">
                    <div
                        class="w-10 h-10 bg-cyan-50 text-cyan-600 rounded-lg flex items-center justify-center flex-shrink-0 text-lg font-bold group-hover:bg-cyan-600 group-hover:text-white transition-colors">
                        7
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-bold text-gray-800 mb-0.5 flex items-center gap-2">
                            <i class="fas fa-id-badge text-cyan-400 text-xs"></i> Role-Based Access
                        </h3>
                        <p class="text-gray-600 text-xs leading-relaxed">
                            Enforce access controls for Students, Faculty, and Admins, ensuring users only access
                            relevant features.
                        </p>
                    </div>
                </div>
                <!-- Objective 8 -->
                <div
                    class="flex items-start gap-4 p-3 rounded-xl bg-white border border-gray-100 shadow-sm hover:shadow-md hover:border-emerald-200 transition-all duration-300 group">
                    <div
                        class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center flex-shrink-0 text-lg font-bold group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        8
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-bold text-gray-800 mb-0.5 flex items-center gap-2">
                            <i class="fas fa-hand-holding-heart text-emerald-400 text-xs"></i> Student Engagement
                        </h3>
                        <p class="text-gray-600 text-xs leading-relaxed">
                            Enhance participation in activities via an interactive, user-friendly platform designed for
                            modern communication.
                        </p>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer -->
        <footer
            class="bg-white px-16 py-4 border-t border-gray-100 flex justify-between items-center text-xs font-medium text-gray-400 z-10 transition-all">
            <p>Dr P.A Inamdar University • BCA Major Project</p>
            <div class="flex items-center gap-4">
                <span>Page 03</span>
                <div class="w-16 h-1 bg-gray-100 rounded-full overflow-hidden">
                    <div class="w-2/5 h-full bg-teal-500"></div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>