<?php
$active_page = isset($active_page) ? $active_page : '';
?>
<aside class="hidden md:flex w-[72px] lg:w-[245px] flex-col glass-panel fixed h-full z-50 transition-all duration-300">
    <div class="p-6 pb-8 lg:block hidden">
        <img src="<?= base_url('assets/images/logo.png') ?>" alt="CampusConnect Logo"
            class="h-14 w-auto object-contain">
    </div>
    <div class="p-4 lg:hidden block flex justify-center pb-8">
        <img src="<?= base_url('assets/images/logo.png') ?>" alt="CampusConnect Logo"
            class="h-10 w-auto object-contain">
    </div>

    <nav class="flex-1 px-3">
        <a href="<?= base_url('home') ?>"
            class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-100 transition-colors cursor-pointer mb-2 <?= $active_page == 'home' ? 'bg-white shadow-sm ring-1 ring-black/5 font-bold text-primary' : 'text-navy' ?>">
            <span
                class="material-symbols-outlined text-[28px] <?= $active_page == 'home' ? 'fill-current' : '' ?>">home</span>
            <span class="hidden lg:block text-[15px]">Home</span>
        </a>
        <a href="<?= base_url('search') ?>"
            class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-100 transition-colors cursor-pointer mb-2 <?= $active_page == 'search' ? 'bg-white shadow-sm ring-1 ring-black/5 font-bold text-primary' : 'text-navy' ?>">
            <span
                class="material-symbols-outlined text-[28px] <?= $active_page == 'search' ? 'fill-current' : '' ?>">search</span>
            <span class="hidden lg:block text-[15px]">Search</span>
        </a>
        <a href="<?= base_url('lost_found') ?>"
            class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-100 transition-colors cursor-pointer mb-2 <?= $active_page == 'lost_found' ? 'bg-white shadow-sm ring-1 ring-black/5 font-bold text-primary' : 'text-navy' ?>">
            <span
                class="material-symbols-outlined text-[28px] <?= $active_page == 'lost_found' ? 'fill-current' : '' ?>">inventory_2</span>
            <span class="hidden lg:block text-[15px]">Lost & Found</span>
        </a>

        <a href="<?= base_url('messages') ?>"
            class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-100 transition-colors cursor-pointer mb-2 <?= $active_page == 'messages' ? 'bg-white shadow-sm ring-1 ring-black/5 font-bold text-primary' : 'text-navy' ?>">
            <span
                class="material-symbols-outlined text-[28px] <?= $active_page == 'messages' ? 'fill-current' : '' ?>">mail</span>
            <span class="hidden lg:block text-[15px]">Messages</span>
        </a>

        <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-100 transition-colors cursor-pointer mb-2 text-navy"
            onclick="typeof toggleCreatePost === 'function' ? toggleCreatePost() : window.location.href='<?= base_url('home?create=true') ?>'">
            <span class="material-symbols-outlined text-[28px]">edit_square</span>
            <span class="hidden lg:block text-[15px]">Create</span>
        </div>

        <div
            class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-100 transition-colors cursor-pointer mb-2 text-navy">
            <span class="material-symbols-outlined text-[28px]">favorite</span>
            <span class="hidden lg:block text-[15px]">Activity</span>
        </div>

        <a href="<?= base_url('profile') ?>"
            class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-100 transition-colors cursor-pointer mb-2 <?= $active_page == 'profile' ? 'bg-white shadow-sm ring-1 ring-black/5 font-bold text-primary' : 'text-navy' ?>">
            <span
                class="material-symbols-outlined text-[28px] <?= $active_page == 'profile' ? 'fill-current' : '' ?>">person</span>
            <span class="hidden lg:block text-[15px]">Profile</span>
        </a>
    </nav>

    <div class="px-3 pb-6 relative group">
        <div
            class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-100 transition-colors cursor-pointer mb-2 text-navy">
            <span class="material-symbols-outlined text-[28px]">menu</span>
            <span class="hidden lg:block text-[15px]">More</span>
        </div>

        <!-- More Dropdown -->
        <div
            class="absolute bottom-full left-4 w-60 bg-white rounded-2xl shadow-2xl border border-gray-100 p-2 hidden group-hover:block mb-2 overflow-hidden animate-in fade-in slide-in-from-bottom-2 duration-200">
            <a href="#"
                class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-xl text-sm font-medium text-navy transition-colors">
                <span class="material-symbols-outlined text-[20px]">settings</span> Settings
            </a>
            <hr class="my-2 border-gray-50">
            <a href="<?= base_url('auth/logout') ?>"
                class="flex items-center gap-3 p-3 hover:bg-red-50 text-red-600 rounded-xl text-sm font-medium transition-colors">
                <span class="material-symbols-outlined text-[20px]">logout</span> Log out
            </a>
        </div>
    </div>
</aside>