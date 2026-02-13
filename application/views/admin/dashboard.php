<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Admin User Management</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#1173d4",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Inter"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        body {
            min-height: 100vh;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark font-display text-[#0d141b] dark:text-slate-100 transition-colors duration-200 overflow-hidden">

    <div class="flex h-screen w-full">
        <!-- Desktop Sidebar -->
        <?php $this->load->view('admin/partials/sidebar', ['page' => 'users']); ?>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col h-full overflow-hidden">

            <!-- Top Navigation Bar (Mobile & Desktop) -->
            <header
                class="sticky top-0 z-30 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
                <div class="flex items-center px-4 py-3 md:px-8 justify-between">
                    <div class="flex items-center gap-3 md:hidden">
                        <button onclick="window.history.back()"
                            class="p-2 -ml-2 rounded-full hover:bg-slate-200 dark:hover:bg-slate-800 transition-colors">
                            <span
                                class="material-symbols-outlined text-[#0d141b] dark:text-slate-100">arrow_back_ios</span>
                        </button>
                        <h2 class="text-lg font-bold leading-tight tracking-tight">User Management</h2>
                    </div>

                    <!-- Desktop Header Content -->
                    <div class="hidden md:flex items-center gap-3">
                        <h2 class="text-xl font-bold leading-tight tracking-tight">Users</h2>
                        <span
                            class="bg-slate-200 dark:bg-slate-700 text-xs px-2 py-0.5 rounded-full font-bold text-slate-600 dark:text-slate-300"><?= $stats['total_users'] ?></span>
                    </div>

                    <div class="flex items-center gap-4">
                        <a href="<?= base_url('auth/logout') ?>"
                            class="md:hidden text-sm font-bold text-red-500 hover:text-red-600">Logout</a>
                        <button
                            class="flex items-center justify-center rounded-full hover:bg-slate-200 dark:hover:bg-slate-800 p-2 relative">
                            <span
                                class="material-symbols-outlined text-[#0d141b] dark:text-slate-100">notifications</span>
                            <span
                                class="absolute top-2 right-2 size-2 bg-red-500 rounded-full border-2 border-background-light dark:border-background-dark"></span>
                        </button>
                        <div
                            class="hidden md:flex items-center gap-3 pl-4 border-l border-slate-200 dark:border-slate-700">
                            <div class="text-right">
                                <p class="text-sm font-bold">Administrator</p>
                                <p class="text-xs text-slate-500">admin@campus.edu</p>
                            </div>
                            <div
                                class="size-9 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold">
                                A</div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Scrollable Content -->
            <div class="flex-1 overflow-y-auto no-scrollbar p-4 md:p-8 pb-24 md:pb-8">
                <div class="max-w-7xl mx-auto space-y-6">

                    <!-- Quick Stats Row -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6">
                        <div
                            class="flex flex-col gap-1 rounded-xl p-4 md:p-6 border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-sm">
                            <p class="text-slate-500 dark:text-slate-400 text-xs font-medium uppercase tracking-wider">
                                Pending Faculty</p>
                            <div class="flex items-end justify-between mt-2">
                                <p class="text-2xl md:text-3xl font-bold leading-tight"><?= $stats['pending_faculty'] ?>
                                </p>
                                <span class="material-symbols-outlined text-amber-500 text-3xl">pending_actions</span>
                            </div>
                        </div>
                        <div
                            class="flex flex-col gap-1 rounded-xl p-4 md:p-6 border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-sm">
                            <p class="text-slate-500 dark:text-slate-400 text-xs font-medium uppercase tracking-wider">
                                Suspended</p>
                            <div class="flex items-end justify-between mt-2">
                                <p class="text-2xl md:text-3xl font-bold leading-tight"><?= $stats['suspended'] ?></p>
                                <span class="material-symbols-outlined text-red-500 text-3xl">block</span>
                            </div>
                        </div>
                        <!-- Extra stats for desktop filling -->
                        <div
                            class="flex flex-col gap-1 rounded-xl p-4 md:p-6 border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-sm">
                            <p class="text-slate-500 dark:text-slate-400 text-xs font-medium uppercase tracking-wider">
                                Total Faculty</p>
                            <div class="flex items-end justify-between mt-2">
                                <!-- Placeholder logic since variable might not exist, verify later or use safe fallback -->
                                <p class="text-2xl md:text-3xl font-bold leading-tight">
                                    <?= isset($stats['faculty_count']) ? $stats['faculty_count'] : '-' ?></p>
                                <span class="material-symbols-outlined text-primary text-3xl">school</span>
                            </div>
                        </div>
                        <div
                            class="flex flex-col gap-1 rounded-xl p-4 md:p-6 border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-sm">
                            <p class="text-slate-500 dark:text-slate-400 text-xs font-medium uppercase tracking-wider">
                                Total Students</p>
                            <div class="flex items-end justify-between mt-2">
                                <p class="text-2xl md:text-3xl font-bold leading-tight">
                                    <?= isset($stats['student_count']) ? $stats['student_count'] : '-' ?></p>
                                <span class="material-symbols-outlined text-green-500 text-3xl">groups</span>
                            </div>
                        </div>
                    </div>

                    <!-- Controls: Search & Filters -->
                    <div class="flex flex-col md:flex-row gap-4 md:items-center justify-between">
                        <!-- Search Bar -->
                        <form action="<?= base_url('admin') ?>" method="GET" class="flex-1 max-w-lg">
                            <div
                                class="flex w-full items-stretch rounded-xl h-12 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm hover:border-primary/50 focus-within:border-primary transition-colors">
                                <div class="text-slate-400 flex items-center justify-center pl-4">
                                    <span class="material-symbols-outlined">search</span>
                                </div>
                                <input name="search" value="<?= isset($search) ? htmlspecialchars($search) : '' ?>"
                                    class="flex w-full min-w-0 flex-1 bg-transparent border-none focus:ring-0 px-3 text-base placeholder:text-slate-400 dark:text-slate-100"
                                    placeholder="Search name, department, or role..." />
                                <?php if (isset($role_filter)): ?>
                                    <input type="hidden" name="role" value="<?= $role_filter ?>">
                                <?php endif; ?>
                            </div>
                        </form>

                        <!-- Filters -->
                        <div class="flex gap-2 overflow-x-auto no-scrollbar pb-1 md:pb-0">
                            <a href="<?= base_url('admin') ?>"
                                class="flex h-10 shrink-0 items-center justify-center px-5 rounded-lg <?= !$role_filter ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' ?> text-sm font-semibold transition-all">
                                All Users
                            </a>
                            <a href="<?= base_url('admin?role=faculty') ?>"
                                class="flex h-10 shrink-0 items-center justify-center px-5 rounded-lg <?= $role_filter == 'faculty' ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' ?> text-sm font-medium transition-all">
                                Faculty
                            </a>
                            <a href="<?= base_url('admin?role=student') ?>"
                                class="flex h-10 shrink-0 items-center justify-center px-5 rounded-lg <?= $role_filter == 'student' ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' ?> text-sm font-medium transition-all">
                                Students
                            </a>
                            <button
                                class="flex h-10 shrink-0 items-center justify-center px-4 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 md:hidden">
                                <span class="material-symbols-outlined">filter_list</span>
                            </button>
                        </div>
                    </div>

                    <!-- Section Header (Mobile Only) -->
                    <div class="md:hidden flex items-center justify-between pb-2">
                        <h3 class="text-lg font-bold leading-tight">Users <span
                                class="text-slate-400 font-normal ml-1">(<?= $stats['total_users'] ?>)</span></h3>
                    </div>

                    <!-- DESKTOP TABLE VIEW -->
                    <div
                        class="hidden md:block bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="border-b border-slate-100 dark:border-slate-800 text-xs uppercase text-slate-500 dark:text-slate-400 bg-slate-50/50 dark:bg-slate-900/50">
                                    <th class="px-6 py-4 font-semibold">User</th>
                                    <th class="px-6 py-4 font-semibold">Role</th>
                                    <th class="px-6 py-4 font-semibold">Department/Major</th>
                                    <th class="px-6 py-4 font-semibold">Status</th>
                                    <th class="px-6 py-4 font-semibold text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                <?php foreach ($users as $user): ?>
                                    <?php
                                    $statusClass = 'bg-slate-100 text-slate-700';
                                    $statusLabel = 'Unknown';

                                    if ($user->status == 'pending') {
                                        $statusClass = 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400';
                                        $statusLabel = 'Pending';
                                    } elseif ($user->status == 'active') {
                                        $statusClass = 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400';
                                        $statusLabel = 'Verified';
                                    } elseif ($user->status == 'suspended') {
                                        $statusClass = 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400';
                                        $statusLabel = 'Suspended';
                                    }
                                    ?>
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="size-10 rounded-full bg-slate-100 dark:bg-slate-800 overflow-hidden border border-slate-200 dark:border-slate-700">
                                                    <?php if (!empty($user->profile_photo)): ?>
                                                        <img class="w-full h-full object-cover"
                                                            src="<?= base_url('uploads/' . $user->profile_photo) ?>" />
                                                    <?php else: ?>
                                                        <div
                                                            class="w-full h-full flex items-center justify-center text-slate-400">
                                                            <span class="material-symbols-outlined text-lg">person</span>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div>
                                                    <p class="font-bold text-sm text-[#0d141b] dark:text-slate-100">
                                                        <?= htmlspecialchars($user->first_name . ' ' . $user->last_name) ?>
                                                    </p>
                                                    <p class="text-xs text-slate-500">ID:
                                                        <?= htmlspecialchars($user->student_id) ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-slate-200 capitalize">
                                                <?= htmlspecialchars($user->role) ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300">
                                            <?= htmlspecialchars($user->major ?? $user->department ?? 'N/A') ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold uppercase tracking-wide <?= $statusClass ?>">
                                                <?= $statusLabel ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <?php if ($user->status == 'pending'): ?>
                                                    <a href="<?= base_url('admin/verify_user/' . $user->id) ?>"
                                                        class="text-primary hover:text-primary/80 font-medium text-sm">Verify</a>
                                                <?php endif; ?>

                                                <?php if ($user->status == 'suspended'): ?>
                                                    <a href="<?= base_url('admin/activate_user/' . $user->id) ?>"
                                                        class="text-primary hover:text-primary/80 font-medium text-sm">Unsuspend</a>
                                                <?php endif; ?>

                                                <?php if ($user->status == 'active' || $user->status == 'pending'): ?>
                                                    <a href="<?= base_url('admin/suspend_user/' . $user->id) ?>"
                                                        class="text-red-500 hover:text-red-700 font-medium text-sm">Suspend</a>
                                                <?php endif; ?>

                                                <button
                                                    class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-1 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800">
                                                    <span class="material-symbols-outlined text-xl">more_vert</span>
                                                </button>

                                                <a href="<?= base_url('admin/edit_user/' . $user->id) ?>"
                                                    class="text-slate-400 hover:text-primary p-1 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800"
                                                    title="Edit User">
                                                    <span class="material-symbols-outlined text-xl">edit</span>
                                                </a>

                                                <a href="<?= base_url('admin/delete_user/' . $user->id) ?>"
                                                    onclick="return confirm('Are you sure you want to permanently delete this user? This action cannot be undone.');"
                                                    class="text-slate-400 hover:text-red-500 p-1 rounded-full hover:bg-red-50 dark:hover:bg-red-900/20"
                                                    title="Delete User">
                                                    <span class="material-symbols-outlined text-xl">delete</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (empty($users)): ?>
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                            <div class="flex flex-col items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-4xl opacity-50">search_off</span>
                                                <p>No users found matching criteria.</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- MOBILE CARD VIEW -->
                    <div class="flex flex-col gap-3 md:hidden">
                        <?php foreach ($users as $user): ?>
                            <?php
                            $bgColor = 'bg-white dark:bg-slate-900';
                            $statusBadge = '<div class="px-2 py-1 rounded bg-slate-100 text-slate-700 text-[10px] font-bold uppercase tracking-wider">Unknown</div>';

                            if ($user->status == 'pending') {
                                $statusBadge = '<div class="px-2 py-1 rounded bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-[10px] font-bold uppercase tracking-wider">Pending</div>';
                            } elseif ($user->status == 'active') {
                                $statusBadge = '<div class="px-2 py-1 rounded bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-[10px] font-bold uppercase tracking-wider">Verified</div>';
                            } elseif ($user->status == 'suspended') {
                                $bgColor = 'bg-white dark:bg-slate-900 opacity-80';
                                $statusBadge = '<div class="px-2 py-1 rounded bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-[10px] font-bold uppercase tracking-wider">Suspended</div>';
                            }
                            ?>

                            <div
                                class="<?= $bgColor ?> rounded-xl border border-slate-200 dark:border-slate-800 p-4 shadow-sm">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="size-12 rounded-full bg-slate-100 dark:bg-slate-800 overflow-hidden border border-slate-200 dark:border-slate-700">
                                            <?php if (!empty($user->profile_photo)): ?>
                                                <img class="w-full h-full object-cover"
                                                    src="<?= base_url('uploads/' . $user->profile_photo) ?>" />
                                            <?php else: ?>
                                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                                    <span class="material-symbols-outlined">person</span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-base">
                                                <?= htmlspecialchars($user->first_name . ' ' . $user->last_name) ?></h4>
                                            <p class="text-xs text-slate-500 dark:text-slate-400 uppercase">
                                                <?= htmlspecialchars($user->role) ?> •
                                                <?= htmlspecialchars($user->major ?? $user->department ?? 'N/A') ?></p>
                                        </div>
                                    </div>
                                    <?= $statusBadge ?>
                                </div>
                                <div
                                    class="flex items-center justify-between pt-3 border-t border-slate-100 dark:border-slate-800">
                                    <p class="text-[11px] text-slate-400">ID: <?= htmlspecialchars($user->student_id) ?></p>
                                    <div class="flex gap-2">
                                        <?php if ($user->status == 'pending'): ?>
                                            <a href="<?= base_url('admin/verify_user/' . $user->id) ?>"
                                                class="bg-primary text-white text-xs font-bold px-4 py-2 rounded-lg">Verify</a>
                                        <?php endif; ?>

                                        <?php if ($user->status == 'suspended'): ?>
                                            <a href="<?= base_url('admin/activate_user/' . $user->id) ?>"
                                                class="bg-primary/10 text-primary text-xs font-bold px-4 py-2 rounded-lg">Unsuspend</a>
                                        <?php endif; ?>

                                        <?php if ($user->status == 'active' || $user->status == 'pending'): ?>
                                            <a href="<?= base_url('admin/suspend_user/' . $user->id) ?>"
                                                class="border border-red-200 text-red-500 text-xs font-bold px-4 py-2 rounded-lg">Suspend</a>
                                        <?php endif; ?>

                                        <button
                                            class="bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-bold px-3 py-2 rounded-lg">
                                            <span class="material-symbols-outlined text-sm leading-none">more_horiz</span>
                                        </button>

                                        <a href="<?= base_url('admin/edit_user/' . $user->id) ?>"
                                            class="bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-bold px-3 py-2 rounded-lg flex items-center justify-center">
                                            <span class="material-symbols-outlined text-sm leading-none">edit</span>
                                        </a>

                                        <a href="<?= base_url('admin/delete_user/' . $user->id) ?>"
                                            onclick="return confirm('Delete this user?');"
                                            class="bg-red-50 dark:bg-red-900/20 text-red-500 text-xs font-bold px-3 py-2 rounded-lg flex items-center justify-center">
                                            <span class="material-symbols-outlined text-sm leading-none">delete</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <?php if (empty($users)): ?>
                            <div class="text-center py-10 text-slate-500">No users found.</div>
                        <?php endif; ?>
                    </div>

                    <!-- Pagination for Desktop (Centered) -->
                    <div class="hidden md:flex justify-between items-center pt-4">
                        <p class="text-sm text-slate-500">Showing all users</p>
                        <div class="flex gap-2">
                            <button
                                class="px-4 py-2 border border-slate-200 dark:border-slate-700 rounded-lg text-sm disabled:opacity-50"
                                disabled>Previous</button>
                            <button
                                class="px-4 py-2 border border-slate-200 dark:border-slate-700 rounded-lg text-sm disabled:opacity-50"
                                disabled>Next</button>
                        </div>
                    </div>

                    <!-- Pagination / Load More (Mobile Style) -->
                    <div class="p-6 flex justify-center md:hidden">
                        <button class="flex items-center gap-2 text-slate-500 font-medium text-sm">
                            Show more
                            <span class="material-symbols-outlined">expand_more</span>
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- iOS Tab Bar (Bottom Navigation) - Mobile Only -->
    <?php $this->load->view('admin/partials/bottom_nav', ['page' => 'users']); ?>

</body>

</html>