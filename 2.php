<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Project Overview</title>
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
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-[1280px] h-[720px] bg-white relative overflow-hidden shadow-2xl flex flex-col">
        <!-- Decorative Background -->
        <div class="absolute inset-0 bg-pattern-dots opacity-30 pointer-events-none"></div>
        <div
            class="absolute top-0 right-0 w-[600px] h-[600px] bg-blue-50/50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4 opacity-70">
        </div>
        <!-- Header -->
        <header
            class="px-16 pt-8 pb-3 flex justify-between items-end border-b border-gray-100 z-10 relative animate-fade-in opacity-0">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-8 h-1 bg-teal-500 rounded-full"></span>
                    <p class="text-sm font-bold text-teal-600 tracking-widest uppercase">1. Project Brief</p>
                </div>
                <h1 class="text-4xl font-extrabold text-blue-900">Brief Write-Up of the Project</h1>
            </div>
            <div class="text-right">
                <div class="bg-blue-50 px-4 py-2 rounded-lg border border-blue-100">
                    <p class="text-blue-800 font-semibold text-sm">
                        <i class="fas fa-layer-group mr-2"></i>What is Quadly?
                    </p>
                </div>
            </div>
        </header>
        <!-- Main Content -->
        <main class="flex-1 px-16 py-4 flex gap-10 z-10 relative">
            <!-- Left Column: Key Features List -->
            <div class="flex-1 flex flex-col gap-5">
                <!-- Item 1 -->
                <div
                    class="flex items-start gap-5 p-4 rounded-xl bg-white border border-gray-100 shadow-sm hover:shadow-lg hover:border-blue-200 transition-all duration-300 group hover:-translate-y-1 animate-fade-in opacity-0 delay-100">
                    <div
                        class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center flex-shrink-0 text-xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-1">Secure Campus-Only Platform</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            A secure, private social networking environment exclusively for verified students, faculty,
                            and campus clubs, ensuring no unauthorized external access.
                        </p>
                    </div>
                </div>
                <!-- Item 2 -->
                <div
                    class="flex items-start gap-5 p-4 rounded-xl bg-white border border-gray-100 shadow-sm hover:shadow-lg hover:border-blue-200 transition-all duration-300 group hover:-translate-y-1 animate-fade-in opacity-0 delay-200">
                    <div
                        class="w-12 h-12 bg-teal-50 text-teal-600 rounded-lg flex items-center justify-center flex-shrink-0 text-xl group-hover:bg-teal-600 group-hover:text-white transition-colors">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-1">Digital Communication Hub</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Enables verified users to create posts, view announcements, participate in discussions, and
                            stay updated with academic and extracurricular activities.
                        </p>
                    </div>
                </div>
                <!-- Item 3 -->
                <div
                    class="flex items-start gap-5 p-4 rounded-xl bg-white border border-gray-100 shadow-sm hover:shadow-lg hover:border-blue-200 transition-all duration-300 group hover:-translate-y-1 animate-fade-in opacity-0 delay-300">
                    <div
                        class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0 text-xl group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-1">Role-Based Access Control</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Distinct roles for Students, Faculty, and Admin/Clubs with specialized permissions and
                            content moderation to ensure data security and information flow.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Right Column: Summary Card & Tech -->
            <div class="w-[420px] flex flex-col gap-6">
                <!-- Primary Mission Card -->
                <div
                    class="flex-1 bg-blue-900 rounded-2xl p-8 text-white relative overflow-hidden flex flex-col justify-between shadow-lg animate-fade-in opacity-0 delay-300 hover:shadow-xl transition-all duration-500">
                    <!-- Background Icon -->
                    <i class="fas fa-globe-americas absolute -bottom-8 -right-8 text-9xl text-blue-800 opacity-20"></i>
                    <div class="relative z-10">
                        <div
                            class="inline-block bg-blue-800 px-3 py-1 rounded text-xs font-bold uppercase tracking-widest mb-4 border border-blue-700">
                            Core Objective</div>
                        <h3 class="text-2xl font-bold mb-4 leading-snug">Centralized Academic &amp; Social Engagement
                        </h3>
                        <p class="text-blue-100 text-sm leading-relaxed opacity-90">
                            To provide a controlled environment where the campus community can interact and collaborate
                            efficiently, reducing reliance on unstructured public social media platforms.
                        </p>
                    </div>
                    <div class="relative z-10 pt-6 mt-6 border-t border-blue-800/50">
                        <p class="text-xs font-bold text-blue-300 uppercase mb-3">Powered By</p>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="px-3 py-1.5 bg-white/10 backdrop-blur-sm rounded-md text-xs font-semibold border border-white/10">CodeIgniter
                                3 (MVC)</span>
                            <span
                                class="px-3 py-1.5 bg-white/10 backdrop-blur-sm rounded-md text-xs font-semibold border border-white/10">MySQL</span>
                            <span
                                class="px-3 py-1.5 bg-white/10 backdrop-blur-sm rounded-md text-xs font-semibold border border-white/10">Responsive
                                UI</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer -->
        <footer
            class="bg-white px-16 py-4 border-t border-gray-100 flex justify-between items-center text-xs font-medium text-gray-400 z-10 transition-all">
            <p>Dr P.A Inamdar University • BCA Major Project</p>
            <div class="flex items-center gap-4">
                <span>Page 02</span>
                <div class="w-16 h-1 bg-gray-100 rounded-full overflow-hidden">
                    <div class="w-1/5 h-full bg-teal-500"></div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>