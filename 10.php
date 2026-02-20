<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Thank You - Quadly</title>
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

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
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
    <div class="w-[1280px] h-[720px] bg-white relative overflow-hidden shadow-2xl flex flex-col justify-between">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-pattern-dots opacity-30 pointer-events-none"></div>
        <!-- Decorative Shapes -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-teal-50 rounded-bl-full -mr-10 -mt-10 opacity-60"></div>
        <div class="absolute bottom-20 left-0 w-48 h-48 bg-blue-50 rounded-tr-full -ml-8 -mb-8 opacity-60"></div>
        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col items-center justify-center z-10 relative px-20 pt-4">
            <!-- Animated Icon -->
            <div
                class="mb-6 w-20 h-20 bg-teal-50 rounded-full flex items-center justify-center text-teal-500 text-4xl shadow-sm border border-teal-100 animate-fade-in opacity-0">
                <i class="fas fa-check"></i>
            </div>
            <!-- Main Heading -->
            <h1 class="text-7xl font-extrabold text-blue-900 mb-2 tracking-tight animate-fade-in opacity-0 delay-100">
                Thank You</h1>
            <p class="text-2xl text-gray-500 font-medium mb-8 animate-fade-in opacity-0 delay-200">Questions?</p>
            <!-- Divider -->
            <div class="w-24 h-1.5 bg-teal-500 rounded-full mb-10 animate-fade-in opacity-0 delay-300"></div>
            <!-- Project Context -->
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Quadly — Campus Social Network</h2>
                <div class="inline-flex items-center gap-2 bg-gray-100 px-4 py-1.5 rounded-full">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    <p class="text-gray-600 font-medium text-sm">BCA Major Project (BCA III) • Academic Year 2025–26</p>
                </div>
            </div>
            <!-- Team & Guide Grid -->
            <div class="grid grid-cols-2 gap-8 w-full max-w-4xl">
                <!-- Students Column -->
                <div
                    class="bg-white border border-gray-200 shadow-lg rounded-2xl p-6 relative group hover:border-blue-300 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl animate-fade-in opacity-0 delay-500">
                    <div
                        class="absolute -top-3 left-6 bg-blue-600 text-white px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider shadow-sm">
                        Project Team
                    </div>
                    <div class="flex flex-col gap-4 mt-2">
                        <!-- Student 1 -->
                        <div class="flex items-center gap-4 border-b border-gray-100 pb-3 last:border-0 last:pb-0">
                            <div
                                class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm border border-blue-100">
                                154
                            </div>
                            <div class="text-left">
                                <p class="font-bold text-gray-800">Md Kaif Nair Sundke</p>
                                <p class="text-xs text-gray-400 font-medium">BCA III Student</p>
                            </div>
                        </div>
                        <!-- Student 2 -->
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm border border-blue-100">
                                160
                            </div>
                            <div class="text-left">
                                <p class="font-bold text-gray-800">Dev Vivek Tiwari</p>
                                <p class="text-xs text-gray-400 font-medium">BCA III Student</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Guide Column -->
                <div
                    class="bg-white border border-gray-200 shadow-lg rounded-2xl p-6 relative group hover:border-teal-300 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl animate-fade-in opacity-0 delay-500 flex flex-col justify-center">
                    <div
                        class="absolute -top-3 left-6 bg-teal-500 text-white px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider shadow-sm">
                        Project Guide
                    </div>
                    <div class="flex items-center gap-4 mt-2">
                        <div
                            class="w-14 h-14 rounded-full bg-teal-50 text-teal-600 flex items-center justify-center text-2xl border border-teal-100">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="text-left">
                            <p class="font-bold text-gray-800 text-lg">Prof. Mahwish Momin</p>
                            <p class="text-xs text-gray-500 font-medium leading-tight">Department of
                                Computer<br />Applications</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Institutional Footer -->
        <footer
            class="w-full py-4 bg-white border-t border-gray-100 z-10 flex flex-col items-center justify-center relative animate-fade-in opacity-0 delay-500">
            <div class="absolute inset-x-0 bottom-0 h-1 bg-teal-500"></div>
            <div class="flex flex-col items-center">
                <p class="text-xs font-bold text-gray-400 tracking-widest uppercase mb-1">M.C.E Society’s</p>
                <p class="text-xl font-extrabold text-blue-900">Dr P.A Inamdar University, Pune</p>
                <p class="text-xs text-gray-500 mt-1 font-medium">School of Commerce, Management and Computer Studies
                </p>
            </div>
        </footer>
    </div>
</body>

</html>