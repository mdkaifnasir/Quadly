<?php
// active class helper
$active = 'bg-primary/10 text-primary';
$inactive = 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-slate-200';
?>
<aside
    class="hidden md:flex w-64 flex-col bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 flex-shrink-0 z-50">
    <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-center">
        <img src="<?= base_url('assets/images/logo.png?v=' . time()) ?>" alt="CampusConnect Logo" class="h-14 w-auto">
    </div>

    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <a href="<?= base_url('admin/overview') ?>"
            class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg <?= $page == 'dashboard' ? $active : $inactive ?>">
            <span class="material-symbols-outlined">dashboard</span>
            Dashboard
        </a>
        <a href="<?= base_url('admin') ?>"
            class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg <?= $page == 'users' ? $active : $inactive ?>">
            <span class="material-symbols-outlined">group</span>
            User Management
        </a>
        <a href="<?= base_url('admin/departments') ?>"
            class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg <?= $page == 'departments' ? $active : $inactive ?>">
            <span class="material-symbols-outlined">domain</span>
            Departments
        </a>
        <a href="<?= base_url('admin/post') ?>"
            class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg <?= $page == 'post' ? $active : $inactive ?>">
            <span class="material-symbols-outlined">campaign</span>
            Announcements
        </a>
        <a href="<?= base_url('admin/reports') ?>"
            class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg <?= $page == 'reports' ? $active : $inactive ?>">
            <span class="material-symbols-outlined">flag</span>
            Reports
        </a>
        <a href="<?= base_url('admin/face_search') ?>"
            class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg <?= $page == 'face_search' ? $active : $inactive ?>">
            <span class="material-symbols-outlined">face</span>
            Face Search
        </a>
        <a href="<?= base_url('admin/media') ?>"
            class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg <?= $page == 'media' ? $active : $inactive ?>">
            <span class="material-symbols-outlined">perm_media</span>
            Media Monitor
        </a>
        <a href="<?= base_url('admin/settings') ?>"
            class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg <?= $page == 'settings' ? $active : $inactive ?>">
            <span class="material-symbols-outlined">settings</span>
            Settings
        </a>
    </nav>

    <div class="p-4 border-t border-slate-100 dark:border-slate-800">
        <a href="<?= base_url('auth/logout') ?>"
            class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-900/10">
            <span class="material-symbols-outlined">logout</span>
            Logout
        </a>
    </div>
</aside>