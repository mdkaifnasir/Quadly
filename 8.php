<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Software &amp; Hardware Requirements</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .section-card {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .section-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
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
                    <p class="text-sm font-bold text-teal-600 tracking-widest uppercase">7. Requirements</p>
                </div>
                <h1 class="text-4xl font-extrabold text-blue-900">Software &amp; Hardware Requirements</h1>
            </div>
            <div class="text-right">
                <p class="text-gray-400 font-medium text-sm">Deployment &amp; Usage Environment</p>
            </div>
        </header>
        <!-- Main Content -->
        <main class="flex-1 px-16 py-4 flex gap-8 z-10 relative items-stretch">
            <!-- Left Column: Server/Dev Environment -->
            <div class="flex-1 flex flex-col gap-6 animate-fade-in opacity-0 delay-100">
                <!-- Column Header -->
                <div class="flex items-center gap-3 pb-2 border-b-2 border-blue-100">
                    <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                        <i class="fas fa-server"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Server &amp; Development</h2>
                        <p class="text-xs text-blue-500 font-semibold uppercase tracking-wide">Hosting Environment</p>
                    </div>
                </div>
                <!-- Software Specs -->
                <div class="bg-blue-50/50 rounded-xl p-5 border border-blue-100 section-card flex-1">
                    <h3 class="text-sm font-bold text-blue-800 uppercase mb-4 flex items-center gap-2">
                        <i class="fas fa-code-branch text-blue-500"></i> Software Requirements
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <i class="fab fa-linux mt-1 text-blue-400 w-4 text-center"></i>
                            <div>
                                <p class="text-sm font-bold text-gray-700">Operating System</p>
                                <p class="text-xs text-gray-500">Ubuntu 20.04+ (Prod) / Windows 10/11 (Dev)</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-network-wired mt-1 text-blue-400 w-4 text-center"></i>
                            <div>
                                <p class="text-sm font-bold text-gray-700">Web Server</p>
                                <p class="text-xs text-gray-500">Apache 2.4+ (Via XAMPP/LAMP)</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fab fa-php mt-1 text-blue-400 w-4 text-center"></i>
                            <div>
                                <p class="text-sm font-bold text-gray-700">Backend Stack</p>
                                <p class="text-xs text-gray-500">PHP 7.4 or 8.x, Composer, PHPMailer</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-database mt-1 text-blue-400 w-4 text-center"></i>
                            <div>
                                <p class="text-sm font-bold text-gray-700">Database</p>
                                <p class="text-xs text-gray-500">MariaDB 10.4+ or MySQL 8.0+</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Hardware Specs -->
                <div class="bg-white rounded-xl p-5 border border-gray-200 section-card">
                    <h3 class="text-sm font-bold text-gray-600 uppercase mb-4 flex items-center gap-2">
                        <i class="fas fa-microchip text-gray-400"></i> Hardware Requirements
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-gray-100 flex items-center justify-center text-gray-500"><i
                                    class="fas fa-memory"></i></div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">RAM</p>
                                <p class="text-sm font-bold text-gray-700">4 GB+</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-gray-100 flex items-center justify-center text-gray-500"><i
                                    class="fas fa-hdd"></i></div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">Storage</p>
                                <p class="text-sm font-bold text-gray-700">10 GB+</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 col-span-2">
                            <div class="w-8 h-8 rounded bg-gray-100 flex items-center justify-center text-gray-500"><i
                                    class="fas fa-tachometer-alt"></i></div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">Processor</p>
                                <p class="text-sm font-bold text-gray-700">Dual Core 2.0 GHz or higher</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Divider -->
            <div class="w-px bg-gray-200 self-stretch my-4"></div>
            <!-- Right Column: Client/User Environment -->
            <div class="flex-1 flex flex-col gap-6 animate-fade-in opacity-0 delay-200">
                <!-- Column Header -->
                <div class="flex items-center gap-3 pb-2 border-b-2 border-teal-100">
                    <div class="w-10 h-10 rounded-lg bg-teal-100 text-teal-600 flex items-center justify-center">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Client &amp; End User</h2>
                        <p class="text-xs text-teal-500 font-semibold uppercase tracking-wide">Access Environment</p>
                    </div>
                </div>
                <!-- Software Specs -->
                <div class="bg-teal-50/50 rounded-xl p-5 border border-teal-100 section-card flex-1">
                    <h3 class="text-sm font-bold text-teal-800 uppercase mb-4 flex items-center gap-2">
                        <i class="fas fa-window-maximize text-teal-500"></i> Software Requirements
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <i class="fab fa-chrome mt-1 text-teal-400 w-4 text-center"></i>
                            <div>
                                <p class="text-sm font-bold text-gray-700">Web Browser</p>
                                <p class="text-xs text-gray-500">Chrome, Edge, Firefox, Safari (Latest)</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-cube mt-1 text-teal-400 w-4 text-center"></i>
                            <div>
                                <p class="text-sm font-bold text-gray-700">Browser Features</p>
                                <p class="text-xs text-gray-500">Must support WebGL &amp; Camera API</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-wifi mt-1 text-teal-400 w-4 text-center"></i>
                            <div>
                                <p class="text-sm font-bold text-gray-700">Connectivity</p>
                                <p class="text-xs text-gray-500">Minimum 1 Mbps stable internet connection</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-mobile-alt mt-1 text-teal-400 w-4 text-center"></i>
                            <div>
                                <p class="text-sm font-bold text-gray-700">Device Type</p>
                                <p class="text-xs text-gray-500">Smartphone, Tablet, Laptop, or Desktop</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Hardware Specs -->
                <div class="bg-white rounded-xl p-5 border border-gray-200 section-card">
                    <h3 class="text-sm font-bold text-gray-600 uppercase mb-4 flex items-center gap-2">
                        <i class="fas fa-laptop text-gray-400"></i> Hardware Requirements
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-gray-100 flex items-center justify-center text-gray-500"><i
                                    class="fas fa-memory"></i></div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">RAM</p>
                                <p class="text-sm font-bold text-gray-700">4GB (PC) / 2GB (Mobile)</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-gray-100 flex items-center justify-center text-gray-500"><i
                                    class="fas fa-camera"></i></div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">Camera</p>
                                <p class="text-sm font-bold text-gray-700">720p Min (For Face ID)</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 col-span-2">
                            <div class="w-8 h-8 rounded bg-gray-100 flex items-center justify-center text-gray-500"><i
                                    class="fas fa-microchip"></i></div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">Processor</p>
                                <p class="text-sm font-bold text-gray-700">1.2 GHz+ (Required for Client AI)</p>
                            </div>
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
                <span>Page 08</span>
                <div class="w-16 h-1 bg-gray-100 rounded-full overflow-hidden">
                    <div class="w-4/5 h-full bg-teal-500"></div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>