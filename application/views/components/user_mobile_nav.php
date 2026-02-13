<?php
$active_page = isset($active_page) ? $active_page : '';
?>
<nav
    class="md:hidden fixed bottom-6 left-4 right-4 z-[90] h-16 bg-white/90 backdrop-blur-xl border border-white/40 rounded-[32px] flex items-center justify-between px-6 shadow-2xl shadow-slate-500/10 transition-all duration-300">
    <!-- Home -->
    <a href="<?= base_url('home') ?>"
        class="flex flex-col items-center justify-center w-10 h-10 rounded-full transition-all duration-300 <?= $active_page == 'home' ? 'text-indigo-600 bg-indigo-50' : 'text-slate-400 hover:text-slate-600' ?>">
        <span
            class="material-symbols-outlined text-[24px] <?= $active_page == 'home' ? 'fill-current' : '' ?>">home</span>
    </a>

    <!-- Search -->
    <a href="<?= base_url('search') ?>"
        class="flex flex-col items-center justify-center w-10 h-10 rounded-full transition-all duration-300 <?= $active_page == 'search' ? 'text-indigo-600 bg-indigo-50' : 'text-slate-400 hover:text-slate-600' ?>">
        <span
            class="material-symbols-outlined text-[24px] <?= $active_page == 'search' ? 'fill-current' : '' ?>">search</span>
    </a>

    <!-- Create Button (Floating Center) -->
    <div onclick="typeof toggleCreatePost === 'function' ? toggleCreatePost() : window.location.href='<?= base_url('home?create=true') ?>'"
        class="relative -top-6 cursor-pointer group">
        <div
            class="w-14 h-14 bg-[#0F172A] rounded-full flex items-center justify-center text-white shadow-xl shadow-slate-900/20 border-[4px] border-[#f3f4f6] transform transition-transform duration-300 group-hover:scale-110 group-active:scale-95">
            <span class="material-symbols-outlined text-[24px]">edit_square</span>
        </div>
    </div>

    <!-- Inventory -->
    <a href="<?= base_url('lost_found') ?>"
        class="flex flex-col items-center justify-center w-10 h-10 rounded-full transition-all duration-300 <?= $active_page == 'lost_found' ? 'text-indigo-600 bg-indigo-50' : 'text-slate-400 hover:text-slate-600' ?>">
        <span
            class="material-symbols-outlined text-[24px] <?= $active_page == 'lost_found' ? 'fill-current' : '' ?>">inventory_2</span>
    </a>

    <!-- Profile -->
    <a href="<?= base_url('profile') ?>"
        class="flex flex-col items-center justify-center w-10 h-10 rounded-full transition-all duration-300 <?= $active_page == 'profile' ? 'text-indigo-600 bg-indigo-50' : 'text-slate-400 hover:text-slate-600' ?>">
        <span
            class="material-symbols-outlined text-[24px] <?= $active_page == 'profile' ? 'fill-current' : '' ?>">person</span>
    </a>
</nav>