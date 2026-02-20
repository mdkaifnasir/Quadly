<div class="flex items-center justify-between p-4 hover:bg-gray-50/50 transition-colors cursor-pointer group rounded-2xl"
    onclick="window.location.href='<?= base_url('profile/index/' . $u->username) ?>'">
    <div class="flex items-center gap-3">
        <div class="w-12 h-12 rounded-full bg-gray-200 overflow-hidden border border-gray-100">
            <img src="<?= $u->profile_photo ? base_url('uploads/' . $u->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($u->first_name) . '&background=random' ?>"
                class="w-full h-full object-cover">
        </div>
        <div class="flex flex-col">
            <div class="flex items-center gap-1">
                <span class="font-bold text-navy text-[15px]">
                    <?= htmlspecialchars($u->username) ?>
                </span>
                <?php if ($u->is_verified): ?>
                    <span class="material-symbols-outlined text-primary text-[14px]">verified</span>
                <?php endif; ?>
            </div>
            <span class="text-gray-400 text-sm">
                <?= htmlspecialchars($u->first_name . ' ' . $u->last_name) ?>
            </span>
        </div>
    </div>
    <button
        class="px-4 py-1.5 rounded-xl border border-gray-200 text-navy font-bold text-sm hover:bg-gray-50 transition-colors">
        View
    </button>
</div>