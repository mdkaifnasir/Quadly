<?php
// active class helper
$active_text = 'text-primary font-bold';
$inactive_text = 'text-slate-400';
$active_icon = 'text-primary';
$inactive_icon = 'text-slate-400';
?>
<div class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/90 dark:bg-slate-900/90 backdrop-blur-lg border-t border-slate-200 dark:border-slate-800 px-6 py-3 flex justify-between items-center max-w-md mx-auto">
    <a href="<?= base_url('admin/overview') ?>" class="flex flex-col items-center gap-1">
        <span class="material-symbols-outlined <?= $page=='dashboard' ? $active_icon : $inactive_icon ?>">dashboard</span>
        <span class="text-[10px] <?= $page=='dashboard' ? $active_text : $inactive_text ?>">Dashboard</span>
    </a>
    
    <a href="<?= base_url('admin') ?>" class="flex flex-col items-center gap-1">
        <span class="material-symbols-outlined <?= $page=='users' ? $active_icon : $inactive_icon ?>">group</span>
        <span class="text-[10px] <?= $page=='users' ? $active_text : $inactive_text ?>">Users</span>
    </a>
    
    <a href="<?= base_url('admin/post') ?>" class="flex flex-col items-center -mt-6">
        <div class="bg-primary text-white size-12 rounded-full flex items-center justify-center shadow-lg shadow-primary/40 border-4 border-background-light dark:border-background-dark">
            <span class="material-symbols-outlined">campaign</span>
        </div>
        <span class="text-[10px] mt-1 <?= $page=='post' ? $active_text : $inactive_text ?>">Post</span>
    </a>
    
    <a href="<?= base_url('admin/reports') ?>" class="flex flex-col items-center gap-1">
        <span class="material-symbols-outlined <?= $page=='reports' ? $active_icon : $inactive_icon ?>">flag</span>
        <span class="text-[10px] <?= $page=='reports' ? $active_text : $inactive_text ?>">Reports</span>
    </a>
    
    <a href="<?= base_url('admin/settings') ?>" class="flex flex-col items-center gap-1">
        <span class="material-symbols-outlined <?= $page=='settings' ? $active_icon : $inactive_icon ?>">settings</span>
        <span class="text-[10px] <?= $page=='settings' ? $active_text : $inactive_text ?>">Settings</span>
    </a>
</div>
