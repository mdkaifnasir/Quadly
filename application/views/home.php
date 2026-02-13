<?php
$data['active_page'] = 'home';
$this->load->view('components/user_header', $data);
?>
<link rel="stylesheet" href="<?= base_url('assets/css/post_menu.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/follow_popup.css') ?>">

<div class="flex flex-col md:flex-row min-h-screen">
    <!-- Sidebar -->
    <?php $this->load->view('components/user_sidebar', $data); ?>

    <!-- Main Content -->
    <main class="flex-1 md:ml-[72px] lg:ml-[245px] transition-all duration-300">

        <!-- MOBILE HEADER (Md Hidden) -->
        <header class="md:hidden sticky top-0 z-50 bg-white/95 backdrop-blur-md w-full transition-all duration-300">
            <div class="flex items-center justify-center h-16 w-full relative">
                <div class="absolute left-4">
                    <!-- Optional: Left icon if needed, or empty -->
                </div>
                <!-- Centered Logo -->
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-navy text-[32px]">school</span>
                </div>
                <div class="absolute right-4 flex items-center gap-2">
                    <a href="<?= base_url('messages') ?>"
                        class="p-2 text-navy hover:bg-gray-100 rounded-full transition-colors relative">
                        <span class="material-symbols-outlined text-[26px]">mail</span>
                        <!-- Unread Badge (Optional logic can be added here) -->
                    </a>
                </div>
            </div>
        </header>

        <!-- MAIN LAYOUT (Fluid center + Right Sidebar) -->
        <div class="flex-1 flex justify-center transition-all duration-300">

            <!-- FEED COLUMN -->
            <div class="w-full max-w-[630px] pt-4 md:pt-8 px-0 sm:px-4 pb-24 md:pb-0">

                <?php if (isset($is_unverified) && $is_unverified): ?>
                    <div
                        class="mb-6 mx-4 sm:mx-0 p-4 bg-amber-50 border border-amber-200 rounded-2xl flex items-center gap-3 shadow-sm">
                        <span class="material-symbols-outlined text-amber-500">pending_actions</span>
                        <div>
                            <p class="text-sm font-bold text-amber-800">Verification Required</p>
                            <p class="text-[12px] text-amber-700 leading-tight">Your profile is currently being reviewed by
                                our team. You'll be able to join the conversation once verified!</p>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- STORIES REMOVED -->

                <!-- POSTS FEED -->
                <div class="flex flex-col gap-4 md:gap-8 max-w-[470px] mx-auto">

                    <?php if (empty($posts)): ?>
                        <div class="bg-white p-8 rounded-lg shadow border border-gray-100 text-center">
                            <span class="material-symbols-outlined text-4xl text-gray-300">feed</span>
                            <h3 class="mt-2 text-lg font-bold text-navy">No Posts Yet</h3>
                            <p class="text-gray-500 text-sm">Be the first to share something!</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($posts as $post): ?>
                            <article class="flex gap-3 border-b border-gray-100 pb-4 mb-4 px-4 sm:px-0 relative">
                                <!-- Repost Header -->
                                <?php if ($post->item_type == 'repost'): ?>
                                    <div
                                        class="absolute -top-3 left-12 flex items-center gap-1.5 text-gray-400 text-[13px] font-medium bg-white px-2">
                                        <span class="material-symbols-outlined text-[16px]">cached</span>
                                        <span><?= htmlspecialchars($post->reposted_by) ?> reposted</span>
                                    </div>
                                <?php endif; ?>

                                <!-- Left Column: Avatar + Thread Line -->
                                <div
                                    class="flex flex-col items-center gap-2 shrink-0 <?= $post->item_type == 'repost' ? 'mt-2' : '' ?>">
                                    <div class="avatar-plus-container">
                                        <div class="w-9 h-9 rounded-full bg-gray-200 overflow-hidden cursor-pointer"
                                            onclick="openFollowPopup(<?= $post->user_id ?>, '<?= htmlspecialchars($post->first_name . ' ' . $post->last_name) ?>', event)">
                                            <?php $avatar = $post->profile_photo ? base_url('uploads/' . $post->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($post->first_name) . '&background=random'; ?>
                                            <div class="w-full h-full bg-center bg-no-repeat bg-cover"
                                                style='background-image: url("<?= $avatar ?>");'></div>
                                        </div>
                                        <?php if ($this->session->userdata('user_id') != $post->user_id): ?>
                                            <div class="avatar-plus-icon"
                                                onclick="openFollowPopup(<?= $post->user_id ?>, '<?= htmlspecialchars($post->first_name . ' ' . $post->last_name) ?>', event)">
                                                <span class="material-symbols-outlined">add</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <!-- Thread Line (Optional visual) -->
                                    <div class="w-[2px] h-full bg-gray-100 rounded-full mt-1 mb-2"></div>
                                </div>

                                <!-- Right Column: Content -->
                                <div class="flex-1 min-w-0">
                                    <!-- Header -->
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-1">
                                            <span
                                                class="text-navy font-bold text-[15px] leading-none"><?= htmlspecialchars($post->first_name . ' ' . $post->last_name) ?></span>
                                            <?php if ($post->role == 'faculty' || $post->role == 'admin'): ?>
                                                <span
                                                    class="material-symbols-outlined text-[14px] text-blue-500 fill-current">verified</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <span
                                                class="text-gray-400 text-xs"><?= date('j h', strtotime($post->created_at)) ?></span>
                                            <?php $this->load->view('components/post_menu', ['post' => $post]); ?>
                                        </div>
                                    </div>

                                    <!-- Content Text -->
                                    <div class="mt-1 text-[15px] text-navy leading-normal whitespace-pre-line break-words">
                                        <?= htmlspecialchars($post->content) ?>
                                    </div>

                                    <!-- Image (if exists) -->
                                    <?php if (!empty($post->image)): ?>
                                        <div class="mt-3 w-full">
                                            <div class="w-full bg-gray-100 rounded-xl overflow-hidden border border-gray-100/50">
                                                <div class="w-full bg-center bg-no-repeat bg-cover aspect-[4/3] hover:scale-[1.01] transition-transform duration-500"
                                                    style='background-image: url("<?= base_url('uploads/posts/' . $post->image) ?>");'>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Actions -->
                                    <div class="flex items-center gap-1 mt-3 -ml-2">
                                        <button onclick="handleLike(<?= $post->id ?>, this)"
                                            class="p-2 hover:bg-gray-50 rounded-full transition-colors group flex items-center gap-1">
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
                                            <?= htmlspecialchars($post->repost_comment) ?>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Likes Text (Small) -->
                                    <div class="flex items-center gap-3 text-gray-400 text-xs mt-1">
                                        <span><?= $post->likes_count ?> likes</span>
                                        <span>•</span>
                                        <span class="repost-count-text"><?= $post->reposts_count ?> reposts</span>
                                    </div>

                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
    </main>

    <!-- Mobile Nav -->
    <?php $this->load->view('components/user_mobile_nav', $data); ?>
</div>
<!-- Create Post Modal (Threads Style) -->
<div id="createPostModal" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="toggleCreatePost()"></div>
    <div class="relative flex h-full items-end sm:items-center justify-center p-0 sm:p-4">
        <div class="w-full max-w-xl bg-white rounded-t-[32px] sm:rounded-[32px] flex flex-col max-h-[90vh] transition-all translate-y-full sm:translate-y-0"
            id="createPostModalContent">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50 flex-shrink-0">
                <button onclick="toggleCreatePost()" class="text-navy font-medium text-sm">Cancel</button>
                <h3 class="font-bold text-navy text-lg">New thread</h3>
                <div class="w-12"></div>
            </div>

            <!-- Composer Body -->
            <div class="flex-1 overflow-y-auto p-6 hide-scrollbar">
                <form id="createPostForm" class="flex gap-4">
                    <!-- Left: Avatar & Line -->
                    <div class="flex flex-col items-center gap-2 shrink-0">
                        <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden border border-gray-100">
                            <?php $my_avatar = $this->session->userdata('profile_photo') ? base_url('uploads/' . $this->session->userdata('profile_photo')) : 'https://ui-avatars.com/api/?name=' . urlencode($this->session->userdata('first_name') ?? 'User') . '&background=random'; ?>
                            <img src="<?= $my_avatar ?>" class="w-full h-full object-cover">
                        </div>
                        <div class="w-[2px] flex-1 bg-gray-100 rounded-full"></div>
                        <div class="w-5 h-5 rounded-full bg-gray-100 flex items-center justify-center opacity-50">
                            <img src="<?= $my_avatar ?>" class="w-3 h-3 rounded-full grayscale">
                        </div>
                    </div>

                    <!-- Right: Content -->
                    <div class="flex-1 flex flex-col min-w-0 pb-4">
                        <span class="font-bold text-navy text-[15px] mb-1">
                            <?= htmlspecialchars($this->session->userdata('username') ?: ($this->session->userdata('first_name') ?: 'You')) ?>
                        </span>

                        <textarea id="postContentArea" name="content"
                            class="w-full p-0 border-none focus:ring-0 text-[15px] text-navy placeholder:text-gray-400 resize-none min-h-[40px] leading-normal"
                            placeholder="What's on your mind?" maxlength="500"></textarea>

                        <!-- Media Preview -->
                        <div id="mediaPreviewContainer"
                            class="hidden mt-3 relative rounded-xl overflow-hidden border border-gray-100 bg-gray-50">
                            <div id="imagePreviewWrapper" class="hidden">
                                <img id="imagePreview" class="w-full h-auto max-h-[400px] object-contain">
                            </div>
                            <div id="videoPreviewWrapper" class="hidden">
                                <video id="videoPreview" class="w-full h-auto max-h-[400px]" controls></video>
                            </div>
                            <button type="button" onclick="removeMedia()"
                                class="absolute top-3 right-3 w-8 h-8 flex items-center justify-center bg-black/50 text-white rounded-full hover:bg-black/70 transition-colors backdrop-blur-md">
                                <span class="material-symbols-outlined text-[18px]">close</span>
                            </button>
                        </div>

                        <!-- Footer Actions & Progress -->
                        <div class="mt-4 flex items-center gap-4 text-gray-400">
                            <label class="cursor-pointer hover:text-navy transition-colors">
                                <span class="material-symbols-outlined text-[20px]">image</span>
                                <input type="file" name="media" id="mediaInput" class="hidden" accept="image/*,video/*"
                                    onchange="handleMediaPreview(this)">
                            </label>
                            <button type="button" onclick="insertAtCursor('• ')"
                                class="hover:text-navy transition-colors"><span
                                    class="material-symbols-outlined text-[20px]">list</span></button>
                            <button type="button" onclick="insertAtCursor('@')"
                                class="hover:text-navy transition-colors"><span
                                    class="material-symbols-outlined text-[20px]">alternate_email</span></button>
                            <button type="button" onclick="insertAtCursor('#')"
                                class="hover:text-navy transition-colors"><span
                                    class="material-symbols-outlined text-[20px]">tag</span></button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Sticky Footer -->
            <div class="px-6 py-4 flex items-center justify-between border-t border-gray-50 flex-shrink-0">
                <div class="flex items-center gap-2">
                    <span id="charCounter" class="text-[13px] text-gray-400 font-medium">0 / 500</span>
                </div>
                <button id="submitPostBtn" onclick="submitNewThread()" disabled
                    class="px-6 py-2 bg-gradient-to-r from-primary to-accent text-white rounded-full font-bold text-sm disabled:opacity-30 transition-all hover:scale-[1.02] active:scale-[0.98] hover:shadow-lg">
                    Post
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Hidden Story Upload Form -->






<script>
    window.onerror = function (msg, url, lineNo, columnNo, error) {
        alert('JSError: ' + msg + '\nLine: ' + lineNo);
        return false;
    };



    // --- Thread Composer Logic ---
    function toggleCreatePost() {
        const modal = document.getElementById('createPostModal');
        const content = document.getElementById('createPostModalContent');
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                content.classList.remove('translate-y-full');
                content.classList.add('translate-y-0');
                document.getElementById('postContentArea').focus();
            }, 10);
        } else {
            content.classList.remove('translate-y-0');
            content.classList.add('translate-y-full');
            document.body.style.overflow = 'auto';
            setTimeout(() => modal.classList.add('hidden'), 200);
        }
    }

    const textarea = document.getElementById('postContentArea');
    const submitBtn = document.getElementById('submitPostBtn');
    const charCounter = document.getElementById('charCounter');

    textarea.addEventListener('input', function () {
        // Auto expand
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';

        // Character counter
        const length = this.value.length;
        charCounter.innerText = `${length} / 500`;

        if (length > 500) {
            charCounter.classList.add('text-red-500');
            submitBtn.disabled = true;
        } else {
            charCounter.classList.remove('text-red-500');
            submitBtn.disabled = length === 0 && !document.getElementById('mediaInput').files[0];
        }
    });

    function handleMediaPreview(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();
            const container = document.getElementById('mediaPreviewContainer');
            const imgWrapper = document.getElementById('imagePreviewWrapper');
            const vidWrapper = document.getElementById('videoPreviewWrapper');

            reader.onload = function (e) {
                if (file.type.startsWith('image/')) {
                    document.getElementById('imagePreview').src = e.target.result;
                    imgWrapper.classList.remove('hidden');
                    vidWrapper.classList.add('hidden');
                } else if (file.type.startsWith('video/')) {
                    document.getElementById('videoPreview').src = e.target.result;
                    vidWrapper.classList.remove('hidden');
                    imgWrapper.classList.add('hidden');
                }
                container.classList.remove('hidden');
                submitBtn.disabled = false;
            }
            reader.readAsDataURL(file);
        }
    }

    function removeMedia() {
        const input = document.getElementById('mediaInput');
        const container = document.getElementById('mediaPreviewContainer');
        input.value = '';
        container.classList.add('hidden');
        submitBtn.disabled = textarea.value.length === 0;
    }

    async function submitNewThread() {
        const btn = document.getElementById('submitPostBtn');
        const originalText = btn.innerText;
        btn.disabled = true;
        btn.innerText = 'Posting...';

        const formData = new FormData(document.getElementById('createPostForm'));
        formData.append(csrfTokenName, csrfHash);

        try {
            const response = await fetch('<?= base_url('home/submit_post') ?>', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();

            if (result.status === 'success') {
                toggleCreatePost();
                // Reset form
                document.getElementById('createPostForm').reset();
                removeMedia();
                textarea.value = '';
                // Ideally prepend the new post to the feed
                window.location.reload();
            } else {
                alert(result.message || 'Error creating thread');
            }
        } catch (e) {
            alert('An error occurred. Please try again.');
        } finally {
            btn.disabled = false;
            btn.innerText = originalText;
        }
    }

    function insertAtCursor(text) {
        const textarea = document.getElementById('postContentArea');
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const val = textarea.value;
        textarea.value = val.substring(0, start) + text + val.substring(end);
        textarea.selectionStart = textarea.selectionEnd = start + text.length;
        textarea.focus();
        textarea.dispatchEvent(new Event('input')); // Trigger auto-expand and counter
    }

    // Auto-open if ?create=true
    window.addEventListener('DOMContentLoaded', () => {
        if (new URLSearchParams(window.location.search).get('create') === 'true') {
            toggleCreatePost();
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    });

    // --- Post Actions ---
    function handleLike(postId, btn) {
        const icon = btn.querySelector('.material-symbols-outlined');
        const countEl = btn.closest('div').nextElementSibling; // The likes count div

        if (icon.classList.contains('fill-current')) {
            // Unlike
            icon.classList.remove('fill-current', 'text-red-500');
            icon.classList.add('text-navy');
            // Decrement count visually
            let count = parseInt(countEl.innerText) || 0;
            countEl.innerText = (count > 0 ? count - 1 : 0) + ' likes';
        } else {
            // Like
            icon.classList.add('fill-current', 'text-red-500');
            icon.classList.remove('text-navy');
            // Increment count visually
            let count = parseInt(countEl.innerText) || 0;
            countEl.innerText = (count + 1) + ' likes';
        }
    }

    function handleComment(postId) {
        openCommentModal(postId);
    }

    function handleRepost(postId) {
        openRepostOptions(postId);
    }

    function handleSharePost(postId) {
        const url = window.location.origin + window.location.pathname + '#post-' + postId;
        if (navigator.share) {
            navigator.share({
                title: 'Check out this post on Campus App',
                url: url
            });
        } else {
            navigator.clipboard.writeText(url).then(() => {
                alert('Post link copied to clipboard!');
            });
        }
    }
</script>

<!-- Comment Modal -->
<div id="commentModal" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="toggleCommentModal()"></div>
    <div class="relative flex h-full items-end sm:items-center justify-center p-0 sm:p-4">
        <div class="w-full max-w-lg bg-white rounded-t-[32px] sm:rounded-[32px] flex flex-col max-h-[90vh] transition-all translate-y-full sm:translate-y-0"
            id="commentModalContent">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50 flex-shrink-0">
                <div class="w-12"></div>
                <h3 class="font-bold text-navy text-lg">Comments</h3>
                <button onclick="toggleCommentModal()" class="text-gray-400 hover:text-navy p-2">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <!-- Comments List -->
            <div id="commentsList" class="flex-1 overflow-y-auto p-6 space-y-6 min-h-[300px] hide-scrollbar">
                <!-- Loaded dynamically -->
            </div>

            <!-- Input Footer -->
            <div class="p-4 border-t border-gray-50 bg-white rounded-b-[32px] flex-shrink-0">
                <form id="commentForm"
                    class="flex items-center gap-3 bg-gray-50 rounded-2xl p-2 pl-4 border border-gray-100 focus-within:border-primary transition-colors">
                    <input type="hidden" id="commentPostId">
                    <input type="text" id="commentInput"
                        class="flex-1 bg-transparent border-none focus:ring-0 text-sm py-2"
                        placeholder="Add a comment...">
                    <button type="submit"
                        class="bg-gradient-to-r from-primary to-accent text-white px-4 py-2 rounded-xl text-sm font-bold hover:opacity-90 disabled:opacity-50 transition-opacity hover:shadow-lg"
                        id="postCommentBtn">
                        Post
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Repost Options Modal -->
<div id="repostOptionsModal" class="fixed inset-0 z-[110] hidden">
    <div class="absolute inset-0 bg-black/40" onclick="toggleRepostOptions()"></div>
    <div class="relative flex h-full items-end sm:items-center justify-center p-0 sm:p-4">
        <div class="w-full max-w-sm bg-white rounded-t-[32px] sm:rounded-[32px] overflow-hidden shadow-2xl transition-all translate-y-full sm:translate-y-0"
            id="repostOptionsContent">
            <div class="p-4 space-y-2">
                <button onclick="submitRepost(null)"
                    class="w-full flex items-center gap-3 p-4 hover:bg-gray-50 rounded-2xl transition-colors text-left group">
                    <span
                        class="material-symbols-outlined text-navy group-hover:scale-110 transition-transform">cached</span>
                    <div class="flex flex-col">
                        <span class="font-bold text-navy">Repost</span>
                        <span class="text-xs text-gray-400">Share this post instantly</span>
                    </div>
                </button>
                <button onclick="openQuoteModal()"
                    class="w-full flex items-center gap-3 p-4 hover:bg-gray-50 rounded-2xl transition-colors text-left group">
                    <span
                        class="material-symbols-outlined text-navy group-hover:scale-110 transition-transform">edit_note</span>
                    <div class="flex flex-col">
                        <span class="font-bold text-navy">Quote</span>
                        <span class="text-xs text-gray-400">Add your own thoughts</span>
                    </div>
                </button>
                <button id="undoRepostBtn" onclick="undoRepostAction()"
                    class="w-full hidden items-center gap-3 p-4 hover:bg-red-50 rounded-2xl transition-colors text-left text-red-500 group">
                    <span class="material-symbols-outlined group-hover:scale-110 transition-transform">delete</span>
                    <div class="flex flex-col">
                        <span class="font-bold">Remove Repost</span>
                        <span class="text-xs opacity-70">Take down your shared post</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Quote Modal -->
<div id="quoteModal" class="fixed inset-0 z-[120] hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="toggleQuoteModal()"></div>
    <div class="relative flex h-full items-end sm:items-center justify-center p-0 sm:p-4">
        <div class="w-full max-w-lg bg-white rounded-t-[32px] sm:rounded-[32px] flex flex-col transition-all translate-y-full sm:translate-y-0"
            id="quoteModalContent">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
                <button onclick="toggleQuoteModal()" class="text-sm font-bold text-navy">Cancel</button>
                <h3 class="font-bold text-navy">Quote repost</h3>
                <button onclick="submitRepost(document.getElementById('quoteInput').value)"
                    class="bg-gradient-to-r from-primary to-accent text-white px-4 py-1.5 rounded-full text-sm font-bold hover:shadow-lg transition-all">Repost</button>
            </div>
            <div class="p-6">
                <textarea id="quoteInput"
                    class="w-full border-none focus:ring-0 text-navy placeholder:text-gray-300 resize-none h-32"
                    placeholder="Add a comment..."></textarea>
            </div>
        </div>
    </div>
</div>

<script>
    let currentRepostPostId = null;

    function toggleRepostOptions() {
        const modal = document.getElementById('repostOptionsModal');
        const content = document.getElementById('repostOptionsContent');
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('translate-y-full');
                content.classList.add('translate-y-0');
            }, 10);
        } else {
            content.classList.remove('translate-y-0');
            content.classList.add('translate-y-full');
            setTimeout(() => modal.classList.add('hidden'), 200);
        }
    }

    function toggleQuoteModal() {
        const modal = document.getElementById('quoteModal');
        const content = document.getElementById('quoteModalContent');
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('translate-y-full');
                content.classList.add('translate-y-0');
            }, 10);
        } else {
            content.classList.remove('translate-y-0');
            content.classList.add('translate-y-full');
            setTimeout(() => modal.classList.add('hidden'), 200);
        }
    }

    function openRepostOptions(postId) {
        currentRepostPostId = postId;
        // In a real app, we'd check status via API. For demo, we just show options.
        // If we had the status, we would show/hide the "Undo" button here.
        toggleRepostOptions();
    }

    function openQuoteModal() {
        toggleRepostOptions();
        toggleQuoteModal();
    }

    async function submitRepost(comment) {
        const formData = new FormData();
        formData.append(csrfTokenName, csrfHash);
        formData.append('post_id', currentRepostPostId);
        if (comment) formData.append('comment', comment);

        try {
            const response = await fetch('<?= base_url('home/handle_repost') ?>', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (result.status === 'success' || result.status === 'exists') {
                if (comment) toggleQuoteModal();
                else toggleRepostOptions();

                if (result.status === 'exists') {
                    // In a real app, we might ask if they want to undo
                    document.getElementById('undoRepostBtn').classList.remove('hidden');
                    toggleRepostOptions();
                    return;
                }
                window.location.reload(); // Reload to show in feed
            }
        } catch (e) { alert('An error occurred'); }
    }

    async function undoRepostAction() {
        const formData = new FormData();
        formData.append(csrfTokenName, csrfHash);
        formData.append('post_id', currentRepostPostId);
        formData.append('action', 'undo');

        try {
            const response = await fetch('<?= base_url('home/handle_repost') ?>', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (result.status === 'success') {
                window.location.reload();
            }
        } catch (e) { alert('An error occurred'); }
    }

    let currentPostId = null;

    function toggleCommentModal() {
        const modal = document.getElementById('commentModal');
        const content = document.getElementById('commentModalContent');
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('translate-y-full');
                content.classList.add('translate-y-0');
            }, 10);
        } else {
            content.classList.remove('translate-y-0');
            content.classList.add('translate-y-full');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }
    }

    function openCommentModal(postId) {
        currentPostId = postId;
        document.getElementById('commentPostId').value = postId;
        toggleCommentModal();
        loadComments(postId);
    }

    async function loadComments(postId) {
        const list = document.getElementById('commentsList');
        list.innerHTML = `<div class="flex items-center justify-center p-10"><span class="animate-spin material-symbols-outlined text-gray-300">cached</span></div>`;

        try {
            const response = await fetch(`<?= base_url('home/get_comments/') ?>${postId}`);
            const comments = await response.json();

            if (comments.length === 0) {
                list.innerHTML = `<div class="flex flex-col items-center justify-center p-10 text-gray-400 text-center">
                        <span class="material-symbols-outlined text-4xl mb-2 opacity-30">chat_bubble</span>
                        <p class="text-sm">No comments yet. Be the first to start the conversation!</p>
                    </div>`;
                return;
            }

            list.innerHTML = comments.map(c => `
                <div class="flex gap-3">
                    <img src="${c.profile_photo}" class="w-9 h-9 rounded-full bg-gray-100 object-cover flex-shrink-0">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-navy text-sm">${c.first_name} ${c.last_name}</span>
                                <span class="text-[10px] text-gray-400 font-medium">${c.created_at_human}</span>
                            </div>
                            <p class="text-[14px] text-navy leading-normal mt-0.5 break-words">${c.content}</p>
                        </div>
                </div>
                `).join('');

            list.scrollTop = list.scrollHeight;
        } catch (e) {
            list.innerHTML = `<p class="text-center text-red-500 p-10">Error loading comments.</p>`;
        }
    }

    document.getElementById('commentForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const input = document.getElementById('commentInput');
        const btn = document.getElementById('postCommentBtn');
        const content = input.value.trim();

        if (!content) return;

        btn.disabled = true;
        btn.innerHTML = '...';

        const formData = new FormData();
        formData.append(csrfTokenName, csrfHash);
        formData.append('post_id', currentPostId);
        formData.append('content', content);

        try {
            const response = await fetch('<?= base_url('home/submit_comment') ?>', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();

            if (result.status === 'success') {
                input.value = '';
                loadComments(currentPostId);
            } else {
                alert('Error posting comment');
            }
        } catch (e) {
            alert('An error occurred.');
        } finally {
            btn.disabled = false;
            btn.innerHTML = 'Post';
        }
    });
</script>
<!-- Follow Popup Menu -->
<div id="globalFollowPopup" class="follow-popup">
    <button id="popupFollowBtn" onclick="handleFollowSubmit()">
        <span class="follow-text text-navy">Follow</span>
        <span class="material-symbols-outlined text-navy">add_circle</span>
    </button>
    <div class="divider"></div>
    <a id="popupProfileLink" href="#">
        <span class="text-navy">Visit profile</span>
        <span class="material-symbols-outlined text-navy">person</span>
    </a>
</div>

<script>
    let currentTargetUserId = null;
    const followPopup = document.getElementById('globalFollowPopup');
    const followBtn = document.getElementById('popupFollowBtn');
    const followText = followBtn.querySelector('.follow-text');
    const profileLink = document.getElementById('popupProfileLink');

    async function openFollowPopup(userId, name, event) {
        event.stopPropagation();
        currentTargetUserId = userId;

        // Set profile link
        profileLink.href = `<?= base_url('profile/index/') ?>${userId}`;

        // Position popup
        const rect = event.currentTarget.getBoundingClientRect();
        followPopup.style.top = (rect.bottom + window.scrollY + 5) + 'px';
        followPopup.style.left = (rect.left + window.scrollX) + 'px';

        // Show popup and check status
        followPopup.classList.add('active');
        followText.innerText = 'Loading...';

        try {
            const response = await fetch(`<?= base_url('follow/status/') ?>${userId}`);
            const data = await response.json();
            followText.innerText = data.is_following ? 'Unfollow' : 'Follow';
        } catch (e) {
            followText.innerText = 'Follow';
        }
    }

    async function handleFollowSubmit() {
        if (!currentTargetUserId) return;

        const originalText = followText.innerText;
        followText.innerText = 'Wait...';

        const formData = new FormData();
        formData.append(csrfTokenName, csrfHash);
        formData.append('user_id', currentTargetUserId);

        try {
            const response = await fetch('<?= base_url('follow/toggle') ?>', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            if (data.status === 'success') {
                followText.innerText = data.action === 'followed' ? 'Unfollow' : 'Follow';
                setTimeout(() => followPopup.classList.remove('active'), 500);
            } else {
                alert(data.message);
                followText.innerText = originalText;
            }
        } catch (e) {
            alert('Connection error');
            followText.innerText = originalText;
        }
    }

    document.addEventListener('click', (e) => {
        if (!followPopup.contains(e.target)) {
            followPopup.classList.remove('active');
        }
    });
</script>
<script>const baseUrl = "<?= base_url() ?>";</script>
<script src="<?= base_url('public/js/post_menu.js') ?>"></script>
</body>

</html>