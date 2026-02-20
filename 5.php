<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>System Architecture &amp; Modules</title>
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

        .layer-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
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
        <header class="px-16 pt-8 pb-3 flex justify-between items-end border-b border-gray-100 z-10 relative bg-white">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-8 h-1 bg-teal-500 rounded-full"></span>
                    <p class="text-sm font-bold text-teal-600 tracking-widest uppercase">4. Architecture</p>
                </div>
                <h1 class="text-4xl font-extrabold text-blue-900">System Architecture</h1>
            </div>
            <div class="text-right">
                <p class="text-gray-400 font-medium text-sm">MVC Framework • CodeIgniter 3 • MySQL</p>
            </div>
        </header>
        <!-- Main Content -->
        <main class="flex-1 px-16 py-4 flex gap-8 z-10 relative">
            <!-- Left Column: The 3-Tier Architecture Diagram -->
            <div class="flex-1 flex flex-col h-full">
                <!-- Label -->
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-layer-group text-blue-600"></i>
                    <h2 class="text-lg font-bold text-gray-700">Technology Stack Layers</h2>
                </div>
                <!-- Stack Container -->
                <div class="flex-1 flex flex-col gap-2">
                    <!-- 1. Presentation Layer (Frontend) -->
                    <div
                        class="bg-gradient-to-r from-blue-50 to-white border border-blue-200 rounded-xl p-4 relative layer-shadow flex flex-col justify-center group hover:border-blue-300 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg animate-fade-in opacity-0">
                        <div
                            class="absolute top-3 right-3 w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <h3 class="text-blue-900 font-bold text-lg mb-1">Presentation Layer (View)</h3>
                        <p class="text-sm text-blue-600/80 mb-3 font-medium">User Interface &amp; Client-Side Logic</p>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="px-2 py-1 bg-white border border-blue-100 rounded text-xs font-semibold text-gray-600">HTML5
                                / CSS3</span>
                            <span
                                class="px-2 py-1 bg-white border border-blue-100 rounded text-xs font-semibold text-teal-600">Tailwind
                                CSS</span>
                            <span
                                class="px-2 py-1 bg-white border border-blue-100 rounded text-xs font-semibold text-yellow-600">ES6
                                JavaScript</span>
                            <!-- AI Chips -->
                            <div
                                class="flex items-center gap-2 px-2 py-1 bg-purple-50 border border-purple-100 rounded text-xs font-bold text-purple-700">
                                <i class="fas fa-brain text-[10px]"></i> Client AI: Face-api.js, Tesseract.js
                            </div>
                        </div>
                    </div>
                    <!-- Arrow Connection -->
                    <div class="h-4 flex justify-center items-center">
                        <div class="w-0.5 h-full bg-gray-300"></div>
                        <i class="fas fa-chevron-down text-gray-300 text-xs absolute"></i>
                    </div>
                    <!-- 2. Application Layer (Backend) -->
                    <div
                        class="bg-gradient-to-r from-blue-50 to-white border border-blue-200 rounded-xl p-4 relative layer-shadow flex flex-col justify-center group hover:border-blue-300 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg animate-fade-in opacity-0 delay-200">
                        <div
                            class="absolute top-3 right-3 w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h3 class="text-indigo-900 font-bold text-lg mb-1">Application Layer (Controller)</h3>
                        <p class="text-sm text-indigo-600/80 mb-3 font-medium">Business Logic, Routing &amp; Security
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="px-2 py-1 bg-white border border-indigo-100 rounded text-xs font-semibold text-gray-600">Apache
                                Server</span>
                            <span
                                class="px-2 py-1 bg-white border border-indigo-100 rounded text-xs font-bold text-indigo-700">PHP
                                7.4+</span>
                            <span
                                class="px-2 py-1 bg-white border border-indigo-100 rounded text-xs font-semibold text-gray-600">CodeIgniter
                                3 (MVC)</span>
                            <span
                                class="px-2 py-1 bg-white border border-indigo-100 rounded text-xs font-semibold text-red-500">PHPMailer</span>
                        </div>
                    </div>
                    <!-- Arrow Connection -->
                    <div class="h-4 flex justify-center items-center">
                        <div class="w-0.5 h-full bg-gray-300"></div>
                        <i class="fas fa-chevron-down text-gray-300 text-xs absolute"></i>
                    </div>
                    <!-- 3. Data Layer (Database) -->
                    <div
                        class="bg-gradient-to-r from-blue-50 to-white border border-blue-200 rounded-xl p-4 relative layer-shadow flex flex-col justify-center group hover:border-blue-300 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg animate-fade-in opacity-0 delay-100">
                        <div
                            class="absolute top-3 right-3 w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">
                            <i class="fas fa-database"></i>
                        </div>
                        <h3 class="text-teal-900 font-bold text-lg mb-1">Data Layer (Model)</h3>
                        <p class="text-sm text-teal-600/80 mb-3 font-medium">Persistence, Schemas &amp; Relationships
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="px-2 py-1 bg-white border border-teal-100 rounded text-xs font-bold text-teal-700">MySQL
                                / MariaDB</span>
                            <span
                                class="px-2 py-1 bg-white border border-teal-100 rounded text-xs font-semibold text-gray-500">Users
                                Table</span>
                            <span
                                class="px-2 py-1 bg-white border border-teal-100 rounded text-xs font-semibold text-gray-500">Posts
                                &amp; Comments</span>
                            <span
                                class="px-2 py-1 bg-white border border-teal-100 rounded text-xs font-semibold text-gray-500">FK
                                Constraints</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Core Modules Grid -->
            <div class="flex-1 bg-white border border-gray-100 rounded-xl p-4 shadow-sm flex flex-col">
                <h3
                    class="font-extrabold text-blue-900 mb-3 pb-2 border-b border-gray-50 flex items-center justify-between">
                    <span class="text-base">System Modules</span>
                    <span
                        class="text-[10px] font-bold text-teal-600 bg-teal-50 px-2.5 py-1 rounded-full uppercase tracking-tighter">7
                        Total</span>
                </h3>
                <div class="flex-1 grid grid-cols-1 gap-1.5 pr-1">
                    <!-- Module Item -->
                    <div
                        class="flex items-center gap-3 p-1.5 bg-gray-50/50 border border-gray-100 rounded-lg hover:border-blue-200 transition-all duration-300 hover:scale-[1.02] hover:bg-white hover:shadow-sm">
                        <div
                            class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center text-sm shadow-sm">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-800 uppercase tracking-tight leading-tight">
                                Registration</p>
                            <p class="text-[9px] text-gray-500">OCR &amp; Biometric Onboarding</p>
                        </div>
                    </div>
                    <!-- Module Item -->
                    <div
                        class="flex items-center gap-3 p-1.5 bg-gray-50/50 border border-gray-100 rounded-lg hover:border-teal-200 transition-all duration-300 hover:scale-[1.02] hover:bg-white hover:shadow-sm">
                        <div
                            class="w-8 h-8 rounded-lg bg-teal-500 text-white flex items-center justify-center text-sm shadow-sm">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-800 uppercase tracking-tight leading-tight">Access
                                Control</p>
                            <p class="text-[9px] text-gray-500">Secure Biometric Login</p>
                        </div>
                    </div>
                    <!-- Module Item -->
                    <div
                        class="flex items-center gap-3 p-1.5 bg-gray-50/50 border border-gray-100 rounded-lg hover:border-indigo-200 transition-all duration-300 hover:scale-[1.02] hover:bg-white hover:shadow-sm">
                        <div
                            class="w-8 h-8 rounded-lg bg-indigo-500 text-white flex items-center justify-center text-sm shadow-sm">
                            <i class="fas fa-id-badge"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-800 uppercase tracking-tight leading-tight">User
                                Profile</p>
                            <p class="text-[9px] text-gray-500">Identity &amp; Academic Records</p>
                        </div>
                    </div>
                    <!-- Module Item -->
                    <div
                        class="flex items-center gap-3 p-1.5 bg-gray-50/50 border border-gray-100 rounded-lg hover:border-pink-200 transition-all duration-300 hover:scale-[1.02] hover:bg-white hover:shadow-sm">
                        <div
                            class="w-8 h-8 rounded-lg bg-pink-500 text-white flex items-center justify-center text-sm shadow-sm">
                            <i class="fas fa-stream"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-800 uppercase tracking-tight leading-tight">Campus
                                Feed</p>
                            <p class="text-[9px] text-gray-500">Social Interaction &amp; Posts</p>
                        </div>
                    </div>
                    <!-- Module Item -->
                    <div
                        class="flex items-center gap-3 p-1.5 bg-gray-50/50 border border-gray-100 rounded-lg hover:border-orange-200 transition-all duration-300 hover:scale-[1.02] hover:bg-white hover:shadow-sm">
                        <div
                            class="w-8 h-8 rounded-lg bg-orange-500 text-white flex items-center justify-center text-sm shadow-sm">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-800 uppercase tracking-tight leading-tight">
                                Faculty/Clubs</p>
                            <p class="text-[9px] text-gray-500">Events &amp; Notice Management</p>
                        </div>
                    </div>
                    <!-- Module Item -->
                    <div
                        class="flex items-center gap-3 p-1.5 bg-gray-50/50 border border-gray-100 rounded-lg hover:border-red-200 transition-all duration-300 hover:scale-[1.02] hover:bg-white hover:shadow-sm">
                        <div
                            class="w-8 h-8 rounded-lg bg-red-500 text-white flex items-center justify-center text-sm shadow-sm">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-800 uppercase tracking-tight leading-tight">Admin
                                System</p>
                            <p class="text-[9px] text-gray-500">User Moderation &amp; Controls</p>
                        </div>
                    </div>
                    <!-- Module Item -->
                    <div
                        class="flex items-center gap-3 p-1.5 bg-gray-50/50 border border-gray-100 rounded-lg hover:border-purple-200 transition-all duration-300 hover:scale-[1.02] hover:bg-white hover:shadow-sm">
                        <div
                            class="w-8 h-8 rounded-lg bg-purple-500 text-white flex items-center justify-center text-sm shadow-sm">
                            <i class="fas fa-search"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-800 uppercase tracking-tight leading-tight">Global
                                Search</p>
                            <p class="text-[9px] text-gray-500">Peer &amp; Content Discovery</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer -->
        <footer
            class="bg-white px-16 py-4 border-t border-gray-100 flex justify-between items-center text-xs font-medium text-gray-400 z-10">
            <p>Dr P.A Inamdar University • BCA Major Project</p>
            <div class="flex items-center gap-4">
                <span>Page 05</span>
                <div class="w-16 h-1 bg-gray-100 rounded-full overflow-hidden">
                    <div class="w-1/2 h-full bg-teal-500"></div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>