<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Campus Login - Modern</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#6366f1",
                        "primary-dark": "#4f46e5",
                        "accent": "#ec4899",
                        "success": "#10b981",
                    },
                    fontFamily: {
                        "sans": ["Inter", "sans-serif"]
                    },
                },
            },
        }
    </script>
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .animate-slide-in-right {
            animation: slideInRight 0.6s ease-out forwards;
        }

        .animate-scale-in {
            animation: scaleIn 0.5s ease-out forwards;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 20px 60px -15px rgba(99, 102, 241, 0.15),
                0 10px 30px -10px rgba(99, 102, 241, 0.1);
        }

        .input-modern {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .input-modern:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.2);
        }

        .btn-modern {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-modern:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px -10px rgba(99, 102, 241, 0.4);
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }

        /* Mobile optimizations */
        @media (max-width: 1024px) {
            .glass-card {
                background: rgba(255, 255, 255, 0.98);
            }

            .input-modern:focus {
                transform: none;
            }

            .btn-modern:hover {
                transform: none;
            }
        }

        .mobile-logo {
            display: block;
        }

        @media (min-width: 1024px) {
            .mobile-logo {
                display: none;
            }
        }
    </style>
</head>

<body class="min-h-screen">

    <div class="min-h-screen flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8 relative overflow-hidden">

        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute top-20 left-20 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse">
            </div>
            <div class="absolute top-40 right-20 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"
                style="animation-delay: 2s;"></div>
            <div class="absolute -bottom-8 left-40 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"
                style="animation-delay: 4s;"></div>

            <!-- Mobile Specific Fun Elements -->
            <div
                class="lg:hidden absolute top-1/4 left-1/3 w-6 h-6 bg-pink-400 rounded-full opacity-50 animate-ping duration-1000">
            </div>
        </div>

        <!-- Main Container -->
        <div class="w-full max-w-6xl mx-auto relative z-10">
            <!-- Mobile Logo (Gradient Text Only) -->
            <div class="mobile-logo text-center mb-8 lg:hidden">
                <h1 class="text-4xl font-extrabold">
                    <span class="gradient-text">Quadly</span>
                </h1>
            </div>

            <div class="grid lg:grid-cols-2 gap-8 items-center">

                <!-- Left Side - Branding -->
                <div class="hidden lg:block animate-fade-in-up">
                    <div class="text-center lg:text-left space-y-6 p-8">
                        <div class="inline-flex items-center gap-3 mb-8">
                            <img src="<?= base_url('assets/images/logo.png?v=' . time()) ?>" alt="CampusConnect Logo"
                                class="h-44 w-auto floating">
                        </div>

                        <h1 class="text-5xl xl:text-6xl font-extrabold leading-tight">
                            Welcome Back to <br />
                            <span class="gradient-text">Quadly</span>
                        </h1>

                        <p class="text-gray-600 text-lg leading-relaxed max-w-md">
                            Reconnect with your campus community. Login to access your profile, messages, and stay
                            updated with campus activities.
                        </p>

                        <div class="flex gap-4 pt-4">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white">groups</span>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800">Active</p>
                                    <p class="text-sm text-gray-600">Community</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-cyan-400 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white">lock</span>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800">Secure</p>
                                    <p class="text-sm text-gray-600">Login</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Login Form Card -->
                <div class="animate-slide-in-right w-full">
                    <div class="glass-card rounded-2xl sm:rounded-3xl p-6 sm:p-8 lg:p-10 shadow-2xl">

                        <!-- Header -->
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-3xl font-extrabold text-gray-800">Login</h2>
                            <a href="<?= base_url('auth/register') ?>"
                                class="text-sm font-semibold text-primary hover:text-primary-dark transition-colors">
                                Sign Up →
                            </a>
                        </div>

                        <!-- Login Form -->
                        <form class="space-y-5" action="<?= base_url('auth/login_submit') ?>" method="POST">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash(); ?>">

                            <!-- Email Field -->
                            <div id="email_field_container">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                <div class="relative">
                                    <span
                                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">mail</span>
                                    <input
                                        class="input-modern w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                        placeholder="your.name@university.edu" type="email" name="credential_email"
                                        id="email_input" />
                                </div>
                            </div>


                            <!-- Password Field -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <label class="block text-sm font-semibold text-gray-700">Password</label>
                                    <a class="text-xs font-semibold text-primary hover:text-primary-dark transition-colors"
                                        href="<?= base_url('auth/forgot_password') ?>">Forgot Password?</a>
                                </div>
                                <div class="relative">
                                    <span
                                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">lock</span>
                                    <input
                                        class="input-modern w-full pl-12 pr-12 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                        placeholder="••••••••" type="password" name="password" id="login_password"
                                        required />
                                    <span
                                        class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 cursor-pointer hover:text-primary transition-colors"
                                        onclick="togglePassword('login_password')">visibility</span>
                                </div>
                            </div>

                            <!-- Remember Me -->
                            <label
                                class="flex items-center gap-3 cursor-pointer p-3 rounded-xl hover:bg-gray-50 transition-all">
                                <input
                                    class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary transition-all"
                                    type="checkbox" value="1" name="remember_me" />
                                <span class="text-sm font-medium text-gray-600">Remember Me</span>
                            </label>

                            <!-- Submit Button -->
                            <button
                                class="btn-modern w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 flex items-center justify-center gap-2"
                                type="submit">
                                Log In
                                <span class="material-symbols-outlined text-xl">login</span>
                            </button>
                        </form>

                    </div>

                    <!-- Footer -->
                    <p class="text-center text-sm text-gray-600 mt-6">
                        New to Campus?
                        <a class="text-primary font-semibold hover:underline"
                            href="<?= base_url('auth/register') ?>">Sign Up</a>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <script>
        function togglePassword(id) {
            var input = document.getElementById(id);
            var icon = event.target;
            if (input.type === "password") {
                input.type = "text";
                icon.textContent = "visibility_off";
            } else {
                input.type = "password";
                icon.textContent = "visibility";
            }
        }

    </script>
</body>

</html>