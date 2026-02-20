<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Technology Stack Visualization</title>
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

        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
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
        <header
            class="px-16 pt-8 pb-3 flex justify-between items-end border-b border-gray-100 z-10 relative bg-white animate-fade-in opacity-0">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-8 h-1 bg-teal-500 rounded-full"></span>
                    <p class="text-sm font-bold text-teal-600 tracking-widest uppercase">6. Tech Stack</p>
                </div>
                <h1 class="text-4xl font-extrabold text-blue-900">Technology Stack</h1>
            </div>
            <div class="text-right">
                <p class="text-gray-400 font-medium text-sm">Full Stack Development Overview</p>
            </div>
        </header>
        <!-- Main Content: Quadrant Grid -->
        <main class="flex-1 px-16 py-4 z-10 relative">
            <div class="grid grid-cols-2 grid-rows-2 gap-6 h-full">
                <!-- Quadrant 1: Frontend -->
                <div
                    class="bg-white border border-blue-200 rounded-2xl p-6 card-shadow card-hover transition-all duration-300 flex flex-col relative overflow-hidden group animate-fade-in opacity-0">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <i class="fas fa-desktop text-9xl text-blue-600 transform translate-x-4 -translate-y-4"></i>
                    </div>
                    <div class="flex items-center gap-4 mb-5 border-b border-blue-50 pb-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
                            <i class="fas fa-code"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Frontend Layer</h2>
                            <p class="text-sm text-blue-500 font-medium">User Interface &amp; Experience</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-y-3 gap-x-4">
                        <div class="flex items-center gap-3">
                            <i class="fab fa-html5 text-orange-500 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">HTML5 Semantic</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fab fa-css3-alt text-blue-500 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">Tailwind CSS</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fab fa-js text-yellow-500 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">ES6+ JavaScript</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-font text-gray-500 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">Google Fonts</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-icons text-indigo-500 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">Material Symbols</span>
                        </div>
                    </div>
                </div>
                <!-- Quadrant 2: Backend -->
                <div
                    class="bg-white border border-indigo-200 rounded-2xl p-6 card-shadow card-hover transition-all duration-300 flex flex-col relative overflow-hidden group animate-fade-in opacity-0 delay-100">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <i class="fas fa-server text-9xl text-indigo-600 transform translate-x-4 -translate-y-4"></i>
                    </div>
                    <div class="flex items-center gap-4 mb-5 border-b border-indigo-50 pb-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Backend Layer</h2>
                            <p class="text-sm text-indigo-500 font-medium">Server Logic &amp; Security</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-y-3 gap-x-4">
                        <div class="flex items-center gap-3">
                            <i class="fab fa-php text-indigo-600 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">PHP 7.4 / 8.x</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-fire text-orange-600 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">CodeIgniter 3</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-server text-gray-600 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">Apache Server</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-envelope text-red-500 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">PHPMailer (OTP)</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-lock text-green-600 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">BCrypt Hashing</span>
                        </div>
                    </div>
                </div>
                <!-- Quadrant 3: Database -->
                <div
                    class="bg-white border border-teal-200 rounded-2xl p-6 card-shadow card-hover transition-all duration-300 flex flex-col relative overflow-hidden group animate-fade-in opacity-0 delay-200">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <i class="fas fa-database text-9xl text-teal-600 transform translate-x-4 -translate-y-4"></i>
                    </div>
                    <div class="flex items-center gap-4 mb-5 border-b border-teal-50 pb-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl">
                            <i class="fas fa-hdd"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Database Layer</h2>
                            <p class="text-sm text-teal-500 font-medium">Storage &amp; Persistence</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-y-3 gap-x-4">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-database text-teal-600 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">MariaDB / MySQL</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-table text-blue-500 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">Relational Schema</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-key text-yellow-600 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">Foreign Keys (Cascade)</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-bolt text-yellow-400 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">Optimized Indexes</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-users text-purple-500 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">User &amp; Post Entities</span>
                        </div>
                    </div>
                </div>
                <!-- Quadrant 4: Specialized AI -->
                <div
                    class="bg-white border border-purple-200 rounded-2xl p-6 card-shadow card-hover transition-all duration-300 flex flex-col relative overflow-hidden group animate-fade-in opacity-0 delay-300">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <i class="fas fa-brain text-9xl text-purple-600 transform translate-x-4 -translate-y-4"></i>
                    </div>
                    <div class="flex items-center gap-4 mb-5 border-b border-purple-50 pb-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl">
                            <i class="fas fa-microchip"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Specialized &amp; AI Tools</h2>
                            <p class="text-sm text-purple-500 font-medium">Client-Side Intelligence</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-y-3 gap-x-4">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-id-card-alt text-blue-600 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">Face-api.js (Biometric)</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-print text-gray-600 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">Tesseract.js (OCR)</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-qrcode text-gray-800 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">jsQR (Scanner)</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-search text-teal-500 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">Fuzzy Search Logic</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-file-code text-yellow-600 text-lg w-5 text-center"></i>
                            <span class="text-gray-700 font-medium text-sm">JSON Descriptors</span>
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
                <span>Page 07</span>
                <div class="w-16 h-1 bg-gray-100 rounded-full overflow-hidden">
                    <div class="w-7/10 h-full bg-teal-500" style="width: 70%;"></div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>