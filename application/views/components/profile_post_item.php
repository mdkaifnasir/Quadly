<article class="flex gap-4 border-b border-gray-100 py-4 last:border-0 relative">
    <!-- Repost Header -->
    <?php if ($post->item_type == 'repost'): ?>
        <div class="absolute top-0 left-12 flex items-center gap-1.5 text-gray-400 text-[13px] font-medium bg-white px-2">
            <span class="material-symbols-outlined text-[16px]">cached</span>
            <span>
                <?= htmlspecialchars($post->reposted_by) ?> reposted
            </span>
        </div>
    <?php endif; ?>

    <!-- Thread Connector Visual -->
    <div class="flex flex-col items-center gap-2 shrink-0 <?= $post->item_type == 'repost' ? 'mt-4' : '' ?>">
        <div class="avatar-plus-container">
            <div class="w-9 h-9 rounded-full bg-gray-200 overflow-hidden cursor-pointer"
                onclick="openFollowPopup(<?= $post->user_id ?>, '<?= htmlspecialchars($post->first_name . ' ' . $post->last_name) ?>', event)">
                <div class="w-full h-full bg-center bg-no-repeat bg-cover"
                    style='background-image: url("<?= $post->profile_photo ? base_url('uploads/' . $post->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($post->first_name) . '&background=random' ?>");'>
                </div>
            </div>
            <?php if ($this->session->userdata('user_id') != $post->user_id): ?>
                <div class="avatar-plus-icon"
                    onclick="openFollowPopup(<?= $post->user_id ?>, '<?= htmlspecialchars($post->first_name . ' ' . $post->last_name) ?>', event)">
                    <span class="material-symbols-outlined">add</span>
                </div>
            <?php endif; ?>
        </div>
        <div class="w-[2px] h-full bg-gray-100 rounded-full mt-1 mb-2"></div>
    </div>

    <!-- Content -->
    <div class="flex-1 min-w-0 <?= $post->item_type == 'repost' ? 'mt-4' : '' ?>">
        <div class="flex items-center justify-between">
            <span class="text-navy font-bold text-[15px]">
                <?= htmlspecialchars($post->first_name . ' ' . $post->last_name) ?>
            </span>
            <div class="flex items-center gap-2">
                <span class="text-gray-400 text-xs">
                    <?= date('j h', strtotime($post->created_at)) ?>
                </span>
                <?php $this->load->view('components/post_menu', ['post' => $post]); ?>
            </div>
        </div>

        <div class="mt-1 text-[15px] text-navy leading-normal whitespace-pre-line break-words">
            <?= (isset($is_search) && $is_search) ? $post->content : htmlspecialchars($post->content) ?>
        </div>

        <?php if (!empty($post->image)): ?>
            <div class="mt-3 w-full">
                <div class="w-full bg-gray-100 rounded-xl overflow-hidden border border-gray-100/50">
                    <div class="w-full bg-center bg-no-repeat bg-cover aspect-[4/3]"
                        style='background-image: url("<?= base_url('uploads/posts/' . $post->image) ?>");'>
                    </div>
                </div>
            </div>
        <?php elseif (!empty($post->video)): ?>
            <div class="mt-3 w-full">
                <div class="w-full bg-gray-100 rounded-xl overflow-hidden border border-gray-100/50 aspect-[4/3]">
                    <video class="w-full h-full object-cover" controls>
                        <source src="<?= base_url('uploads/posts/' . $post->video) ?>" type="video/mp4">
                    </video>
                </div>
            </div>
        <?php endif; ?>

        <div class="flex items-center gap-1 mt-3 -ml-2">
            <button onclick="handleLike(<?= $post->id ?>, this)"
                class="p-2 hover:bg-gray-50 rounded-full transition-colors group">
                <span
                    class="material-symbols-outlined text-[20px] text-navy group-hover:text-red-500 transition-all">favorite</span>
            </button>
            <button onclick="handleComment(<?= $post->id ?>)"
                class="p-2 hover:bg-gray-50 rounded-full transition-colors">
                <span class="material-symbols-outlined text-[20px] text-navy">mode_comment</span>
            </button>
            <button onclick="handleRepost(<?= $post->id ?>)"
                class="p-2 hover:bg-gray-50 rounded-full transition-colors">
                <span class="material-symbols-outlined text-[20px] text-navy">cached</span>
            </button>
            <button onclick="handleSharePost(<?= $post->id ?>)"
                class="p-2 hover:bg-gray-50 rounded-full transition-colors">
                <span class="material-symbols-outlined text-[20px] text-navy">send</span>
            </button>
        </div>
        <!-- Quote Repost Comment -->
        <?php if ($post->item_type == 'repost' && !empty($post->repost_comment)): ?>
            <div
                class="mt-2 text-[15px] text-navy font-medium italic border-l-2 border-gray-200 pl-3 py-1 bg-gray-50/50 rounded-r-lg">
                <?= (isset($is_search) && $is_search) ? $post->repost_comment : htmlspecialchars($post->repost_comment) ?>
            </div>
        <?php endif; ?>

        <!-- Likes & Reposts Count (Small) -->
        <div class="flex items-center gap-3 text-gray-400 text-xs mt-1 ml-2">
            <span>
                <?= (isset($post->likes_count) ? $post->likes_count : 0) ?> likes
            </span>
            <span>•</span>
            <span>
                <?= (isset($post->reposts_count) ? $post->reposts_count : 0) ?> reposts
            </span>
        </div>
    </div>
</article>