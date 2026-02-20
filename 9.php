<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Limitations &amp; Future Scope</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Removed radial gradient to comply with export requirements */
        .bg-dots-pattern {
            background-color: #f3f4f6;
            background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23cbd5e1' fill-opacity='0.4' fill-rule='evenodd'%3E%3Ccircle cx='1' cy='1' r='1'/%3E%3C/g%3E%3C/svg%3E");
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
        <div class="absolute inset-0 bg-dots-pattern pointer-events-none"></div>
        <!-- Header -->
        <header
            class="px-16 pt-8 pb-3 flex justify-between items-end border-b border-gray-100 z-10 relative bg-white animate-fade-in opacity-0">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-8 h-1 bg-teal-500 rounded-full"></span>
                    <p class="text-sm font-bold text-teal-600 tracking-widest uppercase">8. Roadmap</p>
                </div>
                <h1 class="text-4xl font-extrabold text-blue-900">Limitations &amp; Future Scope</h1>
            </div>
            <div class="text-right">
                <p class="text-gray-400 font-medium text-sm">Constraints &amp; Growth Strategy</p>
            </div>
        </header>
        <!-- Main Content -->
        <main class="flex-1 px-16 py-4 flex gap-8 z-10 relative items-stretch">
            <!-- Left Column: Limitations -->
            <div class="flex-1 flex flex-col gap-6 animate-fade-in opacity-0 delay-100">
                <!-- Column Header -->
                <div class="flex items-center gap-3 pb-2 border-b-2 border-blue-100">
                    <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Current Limitations</h2>
                        <p class="text-xs text-blue-500 font-semibold uppercase tracking-wide">Technical &amp;
                            Operational</p>
                    </div>
                </div>
                <!-- Technical Limitations -->
                <div class="bg-blue-50/50 rounded-xl p-5 border border-blue-100 section-card flex-1">
                    <h3 class="text-sm font-bold text-blue-800 uppercase mb-4 flex items-center gap-2">
                        <i class="fas fa-microchip text-blue-500"></i> Technical Constraints
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-mobile-alt mt-1 text-blue-400 w-4 text-center"></i>
                            <div>
                                <p class="text-sm font-bold text-gray-700">Hardware Dependency</p>
                                <p class="text-xs text-gray-500">Client-side AI (Face/OCR) performance relies heavily on
                                    user device CPU/RAM.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-wifi mt-1 text-blue-400 w-4 text-center"></i>
                            <div>
                                <p class="text-sm font-bold text-gray-700">Connectivity Reliance</p>
                                <p class="text-xs text-gray-500">Dependent on CDNs for libraries; strictly requires
                                    active internet connection.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-server mt-1 text-blue-400 w-4 text-center"></i>
                            <div>
                                <p class="text-sm font-bold text-gray-700">Vertical Scalability</p>
                                <p class="text-xs text-gray-500">Monolithic architecture limits easy horizontal scaling
                                    without refactoring.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Operational Limitations -->
                <div class="bg-white rounded-xl p-5 border border-gray-200 section-card">
                    <h3 class="text-sm font-bold text-gray-600 uppercase mb-4 flex items-center gap-2">
                        <i class="fas fa-cogs text-gray-400"></i> Operational Factors
                    </h3>
                    <div class="grid grid-cols-1 gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-gray-100 flex items-center justify-center text-gray-500"><i
                                    class="fas fa-lightbulb"></i></div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">Environment</p>
                                <p class="text-sm font-bold text-gray-700">Requires optimal lighting for verification.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-gray-100 flex items-center justify-center text-gray-500"><i
                                    class="fas fa-id-card"></i></div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">ID Standardization</p>
                                <p class="text-sm font-bold text-gray-700">OCR limited to specific card formats.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Divider -->
            <div class="w-px bg-gray-200 self-stretch my-4"></div>
            <!-- Right Column: Future Scope -->
            <div class="flex-1 flex flex-col gap-6 animate-fade-in opacity-0 delay-200">
                <!-- Column Header -->
                <div class="flex items-center gap-3 pb-2 border-b-2 border-teal-100">
                    <div class="w-10 h-10 rounded-lg bg-teal-100 text-teal-600 flex items-center justify-center">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Future Enhancements</h2>
                        <p class="text-xs text-teal-500 font-semibold uppercase tracking-wide">Development Roadmap</p>
                    </div>
                </div>
                <!-- Platform Expansion -->
                <div class="bg-teal-50/50 rounded-xl p-5 border border-teal-100 section-card flex-1">
                    <h3 class="text-sm font-bold text-teal-800 uppercase mb-4 flex items-center gap-2">
                        <i class="fas fa-expand-arrows-alt text-teal-500"></i> Platform Expansion
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <i class="fab fa-app-store-ios mt-1 text-teal-400 w-4 text-center"></i>
                            <div>
                                <p class="text-sm font-bold text-gray-700">Native Mobile Apps</p>
                                <p class="text-xs text-gray-500">iOS/Android apps with push notifications &amp;
                                    background sync.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-cloud-download-alt mt-1 text-teal-400 w-4 text-center"></i>
                            <div>
                                <p class="text-sm font-bold text-gray-700">Offline Support (PWA)</p>
                                <p class="text-xs text-gray-500">Implementation of PWA for caching feed and limited
                                    offline access.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-key mt-1 text-teal-400 w-4 text-center"></i>
                            <div>
                                <p class="text-sm font-bold text-gray-700">SSO Integration</p>
                                <p class="text-xs text-gray-500">SAML/OAuth2 support for institutional login
                                    integration.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Advanced Features -->
                <div class="bg-white rounded-xl p-5 border border-gray-200 section-card">
                    <h3 class="text-sm font-bold text-gray-600 uppercase mb-4 flex items-center gap-2">
                        <i class="fas fa-brain text-gray-400"></i> Advanced Capabilities
                    </h3>
                    <div class="grid grid-cols-1 gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-gray-100 flex items-center justify-center text-gray-500"><i
                                    class="fas fa-network-wired"></i></div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">Infrastructure</p>
                                <p class="text-sm font-bold text-gray-700">Redis for sessions &amp; Load Balancers.</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-gray-100 flex items-center justify-center text-gray-500"><i
                                    class="fas fa-robot"></i></div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">AI Moderation</p>
                                <p class="text-sm font-bold text-gray-700">ML-assisted content abuse detection.</p>
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
                <span>Page 09</span>
                <div class="w-16 h-1 bg-gray-100 rounded-full overflow-hidden">
                    <div class="w-4/5 h-full bg-teal-500"></div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>