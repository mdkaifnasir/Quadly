<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: { "primary": "#1173d4", "background-light": "#f6f7f8", "background-dark": "#101922" },
                    fontFamily: { "display": ["Inter"] }
                },
            },
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-[#0d141b] dark:text-slate-100 h-screen flex flex-col md:flex-row overflow-hidden">

    <!-- Sidebar (Desktop) -->
    <?php $this->load->view('admin/partials/sidebar', ['page' => 'dashboard']); ?>

    <main class="flex-1 flex flex-col h-full overflow-hidden relative">
        <!-- Header -->
        <header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 p-4 flex justify-between items-center z-10">
            <h2 class="text-xl font-bold">Dashboard Overview</h2>
            <div class="flex items-center gap-4">
                 <div class="hidden md:flex items-center gap-2">
                    <span class="text-sm font-bold">Administrator</span>
                    <div class="size-8 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold">A</div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-4 md:p-8 pb-24">
            <div class="max-w-7xl mx-auto space-y-6">
                <!-- Welcome Section -->
                <div class="bg-gradient-to-r from-primary to-blue-600 rounded-2xl p-6 md:p-10 text-white shadow-lg relative overflow-hidden">
                    <div class="relative z-10">
                        <h1 class="text-2xl md:text-3xl font-bold mb-2">Welcome back, Admin!</h1>
                        <p class="opacity-90">Here's what's happening on campus today.</p>
                    </div>
                    <span class="material-symbols-outlined absolute -right-4 -bottom-8 text-[150px] opacity-20">dashboard</span>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-white dark:bg-slate-900 p-5 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            <span class="p-2 rounded-lg bg-blue-50 text-blue-600 material-symbols-outlined">group</span>
                            <span class="text-xs font-bold text-green-500">+12%</span>
                        </div>
                        <p class="text-slate-500 text-xs font-medium uppercase">Total Users</p>
                        <p class="text-2xl font-bold"><?= $stats['total_users'] ?></p>
                    </div>
                     <div class="bg-white dark:bg-slate-900 p-5 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            <span class="p-2 rounded-lg bg-orange-50 text-orange-600 material-symbols-outlined">school</span>
                            <span class="text-xs font-bold text-slate-400">0%</span>
                        </div>
                        <p class="text-slate-500 text-xs font-medium uppercase">Faculty</p>
                        <p class="text-2xl font-bold"><?= $stats['faculty_count'] ?></p>
                    </div>
                     <div class="bg-white dark:bg-slate-900 p-5 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            <span class="p-2 rounded-lg bg-green-50 text-green-600 material-symbols-outlined">groups</span>
                            <span class="text-xs font-bold text-green-500">+5%</span>
                        </div>
                        <p class="text-slate-500 text-xs font-medium uppercase">Students</p>
                        <p class="text-2xl font-bold"><?= $stats['student_count'] ?></p>
                    </div>
                     <div class="bg-white dark:bg-slate-900 p-5 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            <span class="p-2 rounded-lg bg-red-50 text-red-600 material-symbols-outlined">warning</span>
                        </div>
                        <p class="text-slate-500 text-xs font-medium uppercase">Pending Actions</p>
                        <p class="text-2xl font-bold text-red-500"><?= $stats['pending_faculty'] ?></p>
                    </div>
                </div>

                <!-- Recent Activity Placeholder -->
                 <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="p-5 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
                        <h3 class="font-bold text-lg">Recent Registration Activity</h3>
                        <button class="text-primary text-sm font-bold">View All</button>
                    </div>
                    <div class="p-8 text-center text-slate-500">
                        <span class="material-symbols-outlined text-4xl mb-2 opacity-30">history</span>
                        <p>No recent activity data available.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Nav (Mobile) -->
        <?php $this->load->view('admin/partials/bottom_nav', ['page' => 'dashboard']); ?>
    </main>
</body>
</html>
