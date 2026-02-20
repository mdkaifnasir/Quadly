<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Quadly Cover Slide</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;family=Merriweather:ital,wght@0,300;0,400;0,700;1,400&amp;display=swap"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .serif {
            font-family: 'Merriweather', serif;
        }

        .bg-pattern {
            background-color: #ffffff;
            background-image: radial-gradient(#f1f5f9 1px, transparent 1px);
            background-size: 20px 20px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
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

        .delay-500 {
            animation-delay: 0.5s;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-[1280px] h-[720px] bg-white relative overflow-hidden shadow-2xl flex flex-col">
        <!-- Decorative Background Elements -->
        <div class="absolute inset-0 bg-pattern opacity-50 pointer-events-none"></div>
        <div
            class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 opacity-60">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-teal-50 rounded-full blur-3xl translate-y-1/3 -translate-x-1/4 opacity-60">
        </div>
        <!-- Top Bar -->
        <div class="w-full h-2 bg-blue-900 z-10"></div>
        <!-- Header Section -->
        <header class="pt-8 px-16 text-center z-10 relative animate-fade-in opacity-0">
            <div class="flex flex-col items-center justify-center border-b border-gray-200 pb-6">
                <!-- University Branding -->
                <div class="mb-2">
                    <i class="fas fa-university text-blue-900 text-3xl mb-3"></i>
                </div>
                <p class="text-sm font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">M.C.E Society’s</p>
                <h1 class="text-3xl font-extrabold text-blue-900 mb-2 leading-tight">Dr P.A Inamdar University, Pune
                </h1>
                <p class="text-lg text-gray-600 font-medium serif italic">School of Commerce, Management and Computer
                    Studies</p>
            </div>
        </header>
        <!-- Main Content Section -->
        <main
            class="flex-1 flex flex-col justify-center items-center text-center z-10 relative px-10 animate-fade-in opacity-0 delay-200">
            <!-- Project Badge -->
            <div
                class="inline-flex items-center gap-2 bg-blue-100 border border-blue-200 px-4 py-1.5 rounded-full mb-6">
                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                <p class="text-xs font-bold text-blue-800 uppercase tracking-wider">BCA23605: Major Project • 2025–26
                </p>
            </div>
            <!-- Title -->
            <div class="mb-4">
                <h1 class="text-7xl font-extrabold text-gray-900 tracking-tight leading-none mb-2">
                    <span class="text-transparent bg-clip-text text-blue-900"
                        style="background-color: #1e3a8a;">Quadly</span>
                </h1>
                <p class="text-2xl text-gray-400 font-light max-w-3xl mx-auto">
                    Campus Social Network Project Synopsis
                </p>
            </div>
            <!-- Action Hint (Micro-interaction example) -->
            <div class="mt-4 animate-bounce opacity-40">
                <i class="fas fa-chevron-down text-blue-900"></i>
            </div>
        </main>
        <!-- Footer / Details Section -->
        <footer class="bg-gray-50 border-t border-gray-100 py-6 px-20 z-2 relative animate-fade-in opacity-0 delay-500">
            <div class="flex justify-center items-end gap-52">
                <!-- Presented By Section -->
                <div class="text-left">
                    <p class="text-xs font-bold text-teal-600 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <i class="fas fa-user-graduate"></i> Presented By
                    </p>
                    <div class="space-y-4">
                        <div class="group">
                            <p class="text-xs text-gray-400 font-mono mb-0.5">Roll No. 154</p>
                            <p class="text-lg font-bold text-gray-800 group-hover:text-blue-700 transition-colors">
                                Md Kaif Nair Sundke</p>
                        </div>
                        <div class="group">
                            <p class="text-xs text-gray-400 font-mono mb-0.5">Roll No. 160</p>
                            <p class="text-lg font-bold text-gray-800 group-hover:text-blue-700 transition-colors">
                                Dev Vivek Tiwari</p>
                        </div>
                    </div>
                </div>

                <!-- Guidance Section -->
                <div class="text-right">
                    <p
                        class="text-xs font-bold text-teal-600 uppercase tracking-widest mb-4 flex items-center justify-end gap-2">
                        Under Guidance of <i class="fas fa-chalkboard-teacher"></i>
                    </p>
                    <div
                        class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 inline-block text-right hover:border-blue-200 hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                        <p class="text-xl font-bold text-blue-900">Prof. Mahwish Momin</p>
                        <p class="text-sm text-gray-500 font-medium mt-1">Project Guide</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bottom Accent -->
        <div class="absolute bottom-0 left-0 w-full h-1.5 bg-gradient-to-r from-blue-900 via-blue-700 to-teal-500"
            style="background: #1e3a8a;"></div>
        <div class="absolute bottom-0 right-0 w-1/3 h-1.5 bg-teal-500"></div>
    </div>
</body>

</html>