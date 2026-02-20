<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>System Comparison</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Dot pattern for background texture */
        .bg-pattern-dots {
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
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
        <!-- Header -->
        <header
            class="px-16 pt-8 pb-3 flex justify-between items-end border-b border-gray-100 z-10 relative bg-white animate-fade-in opacity-0">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-8 h-1 bg-teal-500 rounded-full"></span>
                    <p class="text-sm font-bold text-teal-600 tracking-widest uppercase">3. Analysis</p>
                </div>
                <h1 class="text-4xl font-extrabold text-blue-900">System Comparison</h1>
            </div>
            <div class="text-right">
                <p class="text-gray-400 font-medium text-sm">Existing vs. Proposed Architecture</p>
            </div>
        </header>
        <!-- Main Content -->
        <main class="flex-1 px-16 py-4 flex gap-8 z-10 relative items-stretch">
            <!-- Left Column: Existing System -->
            <div
                class="flex-1 bg-gray-50 rounded-2xl border border-gray-200 p-8 relative flex flex-col animate-fade-in opacity-0 delay-100">
                <!-- Header Badge -->
                <div
                    class="absolute -top-4 left-8 bg-gray-700 text-white px-4 py-1.5 rounded-lg shadow-sm flex items-center gap-2">
                    <i class="fas fa-history text-sm text-gray-300"></i>
                    <span class="text-sm font-bold tracking-wide uppercase">Existing System</span>
                </div>
                <div class="mt-4 flex-1 flex flex-col gap-5">
                    <!-- Item 1 -->
                    <div
                        class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-red-400 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-start gap-4">
                            <div
                                class="mt-1 w-8 h-8 rounded-full bg-red-50 flex items-center justify-center text-red-500 flex-shrink-0">
                                <i class="fas fa-bullhorn text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-base mb-1">Manual Communication</h3>
                                <p class="text-sm text-gray-500 leading-snug">Reliance on physical notice boards and
                                    scattered emails leads to delayed or missed information.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div
                        class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-red-400 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-start gap-4">
                            <div
                                class="mt-1 w-8 h-8 rounded-full bg-red-50 flex items-center justify-center text-red-500 flex-shrink-0">
                                <i class="fas fa-user-secret text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-base mb-1">Unverified Platforms</h3>
                                <p class="text-sm text-gray-500 leading-snug">Public social media lacks institutional
                                    control, allowing unauthorized access and potential data leaks.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Item 3 -->
                    <div
                        class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-red-400 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-start gap-4">
                            <div
                                class="mt-1 w-8 h-8 rounded-full bg-red-50 flex items-center justify-center text-red-500 flex-shrink-0">
                                <i class="fas fa-layer-group text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-base mb-1">Unstructured Data</h3>
                                <p class="text-sm text-gray-500 leading-snug">Information is scattered across multiple
                                    channels, making it difficult to track academic history.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Summary Status -->
                    <div class="mt-auto pt-4 border-t border-gray-200">
                        <div class="flex items-center gap-2 text-red-600 font-semibold text-sm">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>High risk of misinformation &amp; inefficiency</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Center Arrow visual -->
            <div class="flex flex-col justify-center items-center">
                <div
                    class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 shadow-md z-20 border-4 border-white animate-fade-in opacity-0 delay-200">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
            <!-- Right Column: Proposed System -->
            <div
                class="flex-1 bg-blue-50 rounded-2xl border border-blue-100 p-8 relative flex flex-col animate-fade-in opacity-0 delay-300">
                <!-- Header Badge -->
                <div
                    class="absolute -top-4 left-8 bg-blue-600 text-white px-4 py-1.5 rounded-lg shadow-md flex items-center gap-2">
                    <i class="fas fa-rocket text-sm text-blue-200"></i>
                    <span class="text-sm font-bold tracking-wide uppercase">Proposed (Quadly)</span>
                </div>
                <div class="mt-4 flex-1 flex flex-col gap-5">
                    <!-- Item 1 -->
                    <div
                        class="bg-white p-4 rounded-xl shadow-sm border border-blue-100 border-l-4 border-l-teal-500 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-start gap-4">
                            <div
                                class="mt-1 w-8 h-8 rounded-full bg-teal-50 flex items-center justify-center text-teal-600 flex-shrink-0">
                                <i class="fas fa-rss text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-base mb-1">Centralized Digital Hub</h3>
                                <p class="text-sm text-gray-500 leading-snug">A structured feed for real-time
                                    announcements, ensuring 100% delivery of important notices.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div
                        class="bg-white p-4 rounded-xl shadow-sm border border-blue-100 border-l-4 border-l-teal-500 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-start gap-4">
                            <div
                                class="mt-1 w-8 h-8 rounded-full bg-teal-50 flex items-center justify-center text-teal-600 flex-shrink-0">
                                <i class="fas fa-id-card text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-base mb-1">Verified Campus Access</h3>
                                <p class="text-sm text-gray-500 leading-snug">Strict login via institutional credentials
                                    ensures only students and faculty can access the network.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Item 3 -->
                    <div
                        class="bg-white p-4 rounded-xl shadow-sm border border-blue-100 border-l-4 border-l-teal-500 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-start gap-4">
                            <div
                                class="mt-1 w-8 h-8 rounded-full bg-teal-50 flex items-center justify-center text-teal-600 flex-shrink-0">
                                <i class="fas fa-users-cog text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-base mb-1">Admin &amp; Role Control</h3>
                                <p class="text-sm text-gray-500 leading-snug">Dedicated Admin panels and role-based
                                    permissions (Student/Faculty) maintain discipline and privacy.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Summary Status -->
                    <div class="mt-auto pt-4 border-t border-blue-200">
                        <div class="flex items-center gap-2 text-teal-700 font-semibold text-sm">
                            <i class="fas fa-check-circle"></i>
                            <span>Secure, organized, and efficient</span>
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
                <span>Page 04</span>
                <div class="w-16 h-1 bg-gray-100 rounded-full overflow-hidden">
                    <div class="w-2/5 h-full bg-teal-500"></div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>