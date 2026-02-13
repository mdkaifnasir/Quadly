<?php
$data['active_page'] = 'lost_found';
$this->load->view('components/user_header', $data);
?>

<div class="flex flex-col md:flex-row min-h-screen">
    <!-- Sidebar -->
    <?php $this->load->view('components/user_sidebar', $data); ?>

    <!-- Main Content -->
    <main class="flex-1 md:ml-[72px] lg:ml-[245px] p-4 md:p-8">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-extrabold text-navy flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-4xl">travel_explore</span>
                        Lost & Found Hub
                    </h1>
                    <p class="text-gray-500 mt-1">Campus-wide utility for reporting and finding items.</p>
                </div>
                <a href="<?= base_url('lost_found/create') ?>"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-primary/20 hover:scale-[1.02] transition-all">
                    <span class="material-symbols-outlined">add_circle</span>
                    Report New Item
                </a>
            </div>

            <!-- Filters -->
            <div
                class="flex flex-wrap gap-2 mb-8 bg-white/50 p-2 rounded-2xl backdrop-blur-md border border-white/20 w-fit">
                <a href="<?= base_url('lost_found') ?>"
                    class="px-5 py-2 rounded-xl text-sm font-bold transition-all <?= empty($current_type) ? 'bg-navy text-white shadow-md' : 'text-gray-500 hover:bg-gray-100' ?>">All
                    Items</a>
                <a href="<?= base_url('lost_found?type=lost') ?>"
                    class="px-5 py-2 rounded-xl text-sm font-bold transition-all <?= $current_type == 'lost' ? 'bg-red-500 text-white shadow-md' : 'text-red-500 hover:bg-red-50' ?>">Lost
                    Only</a>
                <a href="<?= base_url('lost_found?type=found') ?>"
                    class="px-5 py-2 rounded-xl text-sm font-bold transition-all <?= $current_type == 'found' ? 'bg-success text-white shadow-md' : 'text-success hover:bg-success/10' ?>">Found
                    Only</a>
            </div>

            <?php if ($this->session->flashdata('success')): ?>
                <div
                    class="mb-6 p-4 bg-success/10 border border-success/20 text-success rounded-2xl flex items-center gap-3 animate-bounce">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span class="font-bold"><?= $this->session->flashdata('success') ?></span>
                </div>
            <?php endif; ?>

            <!-- Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php if (!empty($items)): ?>
                    <?php foreach ($items as $item): ?>
                        <div
                            class="glass-card rounded-[32px] overflow-hidden group hover:shadow-xl transition-all duration-300">
                            <div class="relative h-48 overflow-hidden bg-gray-100">
                                <?php if ($item->image): ?>
                                    <img src="<?= base_url('uploads/lost_found/' . $item->image) ?>"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <?php else: ?>
                                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                                        <span class="material-symbols-outlined text-6xl">inventory_2</span>
                                        <span class="text-xs font-bold uppercase tracking-widest mt-2">No Photo</span>
                                    </div>
                                <?php endif; ?>
                                <div class="absolute top-4 right-4">
                                    <span
                                        class="px-4 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider shadow-lg <?= $item->type == 'lost' ? 'bg-red-500 text-white' : 'bg-success text-white' ?>">
                                        <?= $item->type ?>
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-extrabold text-navy mb-1 line-clamp-1">
                                    <?= htmlspecialchars($item->item_name) ?>
                                </h3>
                                <div class="flex items-center gap-1.5 text-gray-400 text-xs mb-4">
                                    <span class="material-symbols-outlined text-[16px]">location_on</span>
                                    <span class="font-medium"><?= htmlspecialchars($item->location) ?></span>
                                </div>
                                <p class="text-gray-500 text-sm line-clamp-2 mb-6 min-h-[40px]">
                                    <?= htmlspecialchars($item->description) ?>
                                </p>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                                    <div class="flex items-center gap-2">
                                        <img src="<?= $item->profile_photo ? base_url('uploads/' . $item->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($item->first_name) . '&background=random' ?>"
                                            class="w-8 h-8 rounded-full border border-white shadow-sm">
                                        <div>
                                            <p class="text-[11px] font-bold text-navy leading-none"><?= $item->first_name ?></p>
                                            <p class="text-[9px] text-gray-400 mt-0.5">
                                                <?= date('M j', strtotime($item->created_at)) ?>
                                            </p>
                                        </div>
                                    </div>

                                    <?php if ($item->user_id == $this->session->userdata('user_id')): ?>
                                        <div class="flex items-center gap-1">
                                            <a href="<?= base_url('lost_found/resolve/' . $item->id) ?>"
                                                class="text-success hover:bg-success/10 p-2 rounded-xl transition-colors"
                                                title="Mark Resolved">
                                                <span class="material-symbols-outlined text-[20px]">verified</span>
                                            </a>
                                            <button onclick="confirmDelete(<?= $item->id ?>)"
                                                class="text-red-500 hover:bg-red-50 p-2 rounded-xl transition-colors"
                                                title="Delete Post">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </div>
                                    <?php else: ?>
                                        <div class="flex items-center gap-1">
                                            <a href="<?= base_url('messages/chat/' . $item->user_id) ?>"
                                                class="text-primary hover:bg-primary/10 p-2 rounded-xl transition-colors"
                                                title="Message User探索">
                                                <span class="material-symbols-outlined text-[20px]">mail</span>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Replies Section -->
                                <div class="mt-6 pt-4 border-t border-gray-50">
                                    <button onclick="toggleReplies(<?= $item->id ?>)"
                                        class="text-[11px] font-bold text-gray-400 hover:text-primary transition-colors flex items-center gap-2 mb-3">
                                        <span class="material-symbols-outlined text-[16px]">chat_bubble</span>
                                        <?= count($item->replies) ?> Replies
                                    </button>

                                    <div id="replies-<?= $item->id ?>" class="hidden space-y-3">
                                        <?php foreach ($item->replies as $reply): ?>
                                            <div class="flex gap-2">
                                                <img src="<?= $reply->profile_photo ? base_url('uploads/' . $reply->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($reply->first_name) . '&background=random' ?>"
                                                    class="w-6 h-6 rounded-full border border-white shadow-sm shrink-0">
                                                <div class="bg-gray-50 rounded-2xl px-3 py-2 flex-1">
                                                    <p class="text-[10px] font-bold text-navy leading-none mb-1">
                                                        <?= $reply->first_name ?>
                                                    </p>
                                                    <p class="text-[11px] text-gray-600"><?= htmlspecialchars($reply->content) ?>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <!-- Add Reply Form -->
                                        <form action="<?= base_url('lost_found/add_reply/' . $item->id) ?>" method="POST"
                                            class="mt-4 flex gap-2">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                                                value="<?= $this->security->get_csrf_hash() ?>">
                                            <input type="text" name="content" placeholder="Add a reply..."
                                                class="flex-1 bg-gray-50 border-none rounded-xl px-3 py-2 text-[11px] focus:ring-1 focus:ring-primary/20 placeholder:text-gray-400"
                                                required>
                                            <button type="submit"
                                                class="p-2 bg-primary/10 text-primary rounded-xl hover:bg-primary/20 transition-colors">
                                                <span class="material-symbols-outlined text-[16px]">send</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full py-24 text-center">
                        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="material-symbols-outlined text-5xl text-gray-200">search_off</span>
                        </div>
                        <h3 class="text-xl font-extrabold text-navy">No items found</h3>
                        <p class="text-gray-400 max-w-xs mx-auto mt-2">Check back later or report a new lost/found item to
                            help the community.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- Mobile Nav -->
    <?php $this->load->view('components/user_mobile_nav', $data); ?>
</div>

<script>
    function toggleReplies(itemId) {
        const el = document.getElementById('replies-' + itemId);
        el.classList.toggle('hidden');
    }

    function confirmDelete(itemId) {
        if (confirm('Are you sure you want to delete this report? This action cannot be undone.')) {
            window.location.href = '<?= base_url('lost_found/delete/') ?>' + itemId;
        }
    }
</script>
</body>

</html>