<?php
$data['active_page'] = 'profile';
$this->load->view('components/user_header', $data);
?>
<!-- AI Moderation: TensorFlow.js and NSFWJS -->
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@3.11.0/dist/tf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/nsfwjs@2.4.1/dist/nsfwjs.min.js"></script>
<link rel="stylesheet" href="<?= base_url('assets/css/post_menu.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/follow_popup.css') ?>">

<div class="flex flex-col md:flex-row min-h-screen">
    <!-- Sidebar -->
    <?php $this->load->view('components/user_sidebar', $data); ?>

    <!-- Main Content -->
    <main class="flex-1 md:ml-[72px] lg:ml-[245px] transition-all duration-300 w-full flex justify-center">

        <div class="w-full max-w-4xl mx-auto min-h-screen flex flex-col bg-transparent">

            <!-- Top Header (Mobile Only) -->
            <header class="md:hidden sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-gray-100">
                <div class="flex items-center p-4 justify-between h-14">
                    <a href="<?= base_url('home') ?>" class="text-navy">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </a>
                    <div class="flex-1 flex justify-center">
                        <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo"
                            class="h-8 w-auto object-contain">
                    </div>
                    <div class="flex items-center gap-3">
                        <button onclick="toggleOptionsModal()" class="text-navy">
                            <span class="material-symbols-outlined">more_horiz</span>
                        </button>
                        <div class="w-8"></div> <!-- Spacer for symmetry -->
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto pb-20 md:pb-0 pt-4 md:pt-10">
                <!-- Profile Header (Vibrant Style) -->
                <div class="px-4 md:px-10 max-w-2xl mx-auto w-full">

                    <?php if ($this->session->userdata('user_id') == $user->id && (!$user->is_verified || $user->status !== 'active')): ?>
                        <div
                            class="glass-card rounded-2xl p-4 mb-6 border-amber-200/50 bg-amber-50/30 flex items-center gap-3">
                            <span class="material-symbols-outlined text-amber-500">info_i</span>
                            <div>
                                <p class="text-xs font-extrabold text-amber-900">Account Pending Verification</p>
                                <p class="text-[11px] text-amber-800/80 font-medium">An admin needs to verify your
                                    profile before you can start posting.</p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="glass-card rounded-[32px] overflow-hidden mb-6">
                        <!-- Banner Gradient -->
                        <div class="h-32 bg-gradient-to-r from-primary via-accent to-indigo-500 opacity-80"></div>

                        <div class="px-6 pb-6 -mt-12">
                            <div class="flex justify-between items-end gap-4 mb-4">
                                <!-- Avatar with Ring -->
                                <div class="shrink-0 relative">
                                    <div
                                        class="w-24 h-24 md:w-28 md:h-28 rounded-full bg-white p-1 shadow-lg ring-4 ring-white/50">
                                        <div class="w-full h-full rounded-full overflow-hidden">
                                            <?php $my_avatar = $user->profile_photo ? base_url('uploads/' . $user->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->first_name) . '&background=random'; ?>
                                            <div class="w-full h-full bg-center bg-no-repeat bg-cover"
                                                style='background-image: url("<?= $my_avatar ?>");'></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions Row (Right aligned) -->
                                <div class="flex gap-2">
                                    <?php if ($this->session->userdata('user_id') == $user->id): ?>
                                        <button onclick="toggleEditModal()"
                                            class="px-5 py-2 rounded-xl bg-white/80 backdrop-blur-md border border-gray-200 text-navy font-bold text-sm hover:bg-gray-50 transition-all hover:shadow-md">
                                            Edit Profile
                                        </button>
                                        <button onclick="toggleShareModal()"
                                            class="p-2 rounded-xl bg-white/80 backdrop-blur-md border border-gray-200 text-navy hover:bg-gray-50 transition-all hover:shadow-md">
                                            <span class="material-symbols-outlined text-[20px]">share</span>
                                        </button>
                                    <?php else: ?>
                                        <button id="mainFollowBtn" onclick="handleMainFollow(<?= $user->id ?>)"
                                            class="px-6 py-2 rounded-xl <?= $is_following ? 'bg-gray-100 text-navy' : 'bg-gradient-to-r from-primary to-accent text-white shadow-lg shadow-primary/20' ?> font-bold text-sm hover:opacity-90 transition-all hover:scale-[1.02] active:scale-[0.98]">
                                            <?= $is_following ? 'Following' : 'Follow' ?>
                                        </button>
                                        <button onclick="location.href='<?= base_url('messages/user/' . $user->id) ?>'"
                                            class="p-2 rounded-xl bg-white/80 backdrop-blur-md border border-gray-200 text-navy hover:bg-gray-50 transition-all hover:shadow-md">
                                            <span class="material-symbols-outlined text-[20px]">mail</span>
                                        </button>
                                    <?php endif; ?>
                                    <button onclick="toggleOptionsModal()"
                                        class="p-2 rounded-xl bg-white/80 backdrop-blur-md border border-gray-200 text-navy hover:bg-gray-50 transition-all hover:shadow-md">
                                        <span class="material-symbols-outlined text-[20px]">more_horiz</span>
                                    </button>
                                </div>
                            </div>

                            <!-- User Info -->
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <h1 class="text-2xl md:text-3xl font-extrabold text-navy tracking-tight">
                                        <?= htmlspecialchars($user->first_name . ' ' . $user->last_name) ?>
                                    </h1>
                                    <?php if ($user->role == 'faculty' || $user->role == 'admin'): ?>
                                        <span
                                            class="material-symbols-outlined text-primary fill-current text-[20px]">verified</span>
                                    <?php endif; ?>
                                </div>
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span
                                        class="text-[15px] font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">
                                        @<?= htmlspecialchars($user->username) ?>
                                    </span>
                                    <span
                                        class="px-2.5 py-0.5 bg-primary/10 text-primary rounded-full text-[10px] font-extrabold uppercase tracking-widest leading-none">
                                        <?= htmlspecialchars($user->major ?? 'Student') ?>
                                    </span>
                                </div>

                                <p class="mt-4 text-[15px] text-navy/80 leading-relaxed max-w-xl">
                                    <?= !empty($user->bio) ? htmlspecialchars($user->bio) : 'No bio yet.' ?>
                                </p>

                                <div class="flex items-center gap-4 mt-4">
                                    <div class="flex items-center gap-1.5 text-gray-500 text-sm">
                                        <span class="font-bold text-navy"
                                            id="followersCountVal"><?= $followers_count ?></span>
                                        <span class="cursor-pointer hover:underline"
                                            onclick="toggleFollowListModal('followers')">Followers</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-gray-500 text-sm">
                                        <span class="font-bold text-navy"
                                            id="followingCountVal"><?= $following_count ?></span>
                                        <span class="cursor-pointer hover:underline"
                                            onclick="toggleFollowListModal('following')">Following</span>
                                    </div>
                                    <?php if (!empty($user->link)): ?>
                                        <a href="<?= htmlspecialchars($user->link) ?>" target="_blank"
                                            class="flex items-center gap-1 text-primary text-sm font-bold hover:underline">
                                            <span class="material-symbols-outlined text-[16px]">link</span>
                                            <span
                                                class="line-clamp-1 max-w-[150px]"><?= parse_url($user->link, PHP_URL_HOST) ?: htmlspecialchars($user->link) ?></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Post Grid Section -->
                <!-- Tabs Section (Threads Style) -->
                <div class="mt-8 px-4 md:px-10 max-w-2xl mx-auto">
                    <div class="glass-card rounded-2xl p-1 flex mb-6">
                        <button onclick="switchTab('threads')" id="tab-btn-threads"
                            class="flex-1 py-2.5 text-navy font-bold text-sm bg-white/50 rounded-xl shadow-sm border border-white/50 transition-all">
                            Threads
                        </button>
                        <button onclick="switchTab('replies')" id="tab-btn-replies"
                            class="flex-1 py-2.5 text-gray-400 font-bold text-sm hover:text-navy transition-all">
                            Replies
                        </button>
                        <button onclick="switchTab('reposts')" id="tab-btn-reposts"
                            class="flex-1 py-2.5 text-gray-400 font-bold text-sm hover:text-navy transition-all">
                            Reposts
                        </button>
                    </div>
                </div>
                <!-- Vertical Feed Area -->
                <div class="max-w-xl mx-auto mt-4 px-4 md:px-0">

                    <!-- Threads Tab Content -->
                    <div id="content-threads" class="tab-content transition-opacity duration-300">
                        <?php if (empty($threads)): ?>
                            <div class="py-20 flex flex-col items-center text-gray-400 text-center">
                                <div
                                    class="w-16 h-16 rounded-full border border-gray-100 flex items-center justify-center mb-4">
                                    <span class="material-symbols-outlined text-3xl">edit_note</span>
                                </div>
                                <h3 class="font-bold text-navy text-lg">No threads yet</h3>
                            </div>
                        <?php else: ?>
                            <div class="flex flex-col">
                                <?php foreach ($threads as $post): ?>
                                    <?php $this->load->view('components/profile_post_item', ['post' => $post]); ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Replies Tab Content -->
                    <div id="content-replies" class="tab-content hidden opacity-0 transition-opacity duration-300">
                        <?php if (empty($replies)): ?>
                            <div class="py-20 flex flex-col items-center text-gray-400 text-center">
                                <div
                                    class="w-16 h-16 rounded-full border border-gray-100 flex items-center justify-center mb-4">
                                    <span class="material-symbols-outlined text-3xl">chat_bubble</span>
                                </div>
                                <h3 class="font-bold text-navy text-lg">No replies yet</h3>
                            </div>
                        <?php else: ?>
                            <div class="flex flex-col gap-4">
                                <?php foreach ($replies as $reply): ?>
                                    <div class="border-b border-gray-100 pb-4">
                                        <!-- Parent Context -->
                                        <div class="text-[13px] text-gray-400 mb-2 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[14px]">reply</span>
                                            <span>Replying to <span
                                                    class="text-navy font-bold">@<?= htmlspecialchars(strtolower($reply->parent_author_first)) ?></span></span>
                                        </div>
                                        <div class="pl-4 border-l-2 border-gray-100 mb-3">
                                            <p class="text-[14px] text-gray-400 line-clamp-1 italic">
                                                <?= htmlspecialchars($reply->parent_content) ?>
                                            </p>
                                        </div>
                                        <!-- Reply Content -->
                                        <div class="flex gap-3">
                                            <img src="<?= $user->profile_photo ? base_url('uploads/' . $user->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->first_name) . '&background=random' ?>"
                                                class="w-9 h-9 rounded-full object-cover">
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between mb-0.5">
                                                    <span
                                                        class="font-bold text-navy text-[15px]"><?= htmlspecialchars($user->first_name . ' ' . $user->last_name) ?></span>
                                                    <span
                                                        class="text-gray-400 text-[11px]"><?= date('j h', strtotime($reply->created_at)) ?></span>
                                                </div>
                                                <p class="text-[15px] text-navy">
                                                    <?= htmlspecialchars($reply->content) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Reposts Tab Content -->
                    <div id="content-reposts" class="tab-content hidden opacity-0 transition-opacity duration-300">
                        <?php if (empty($reposts)): ?>
                            <div class="py-20 flex flex-col items-center text-gray-400 text-center">
                                <div
                                    class="w-16 h-16 rounded-full border border-gray-100 flex items-center justify-center mb-4">
                                    <span class="material-symbols-outlined text-3xl">cached</span>
                                </div>
                                <h3 class="font-bold text-navy text-lg">No reposts yet</h3>
                            </div>
                        <?php else: ?>
                            <div class="flex flex-col">
                                <?php foreach ($reposts as $post): ?>
                                    <?php $this->load->view('components/profile_post_item', ['post' => $post]); ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Mobile Nav -->
    <?php $this->load->view('components/user_mobile_nav', $data); ?>

</div>
<!-- Edit Profile Modal -->
<div id="editProfileModal" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="toggleEditModal()"></div>
    <div class="relative flex min-h-full items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-3xl overflow-hidden shadow-2xl transition-all scale-95"
            id="editModalContent">
            <form action="<?= base_url('profile/update') ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                    value="<?= $this->security->get_csrf_hash(); ?>">
                <!-- Modal Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
                    <button type="button" onclick="toggleEditModal()"
                        class="text-sm font-bold text-navy hover:opacity-70 transition-opacity">Cancel</button>
                    <h3 class="font-bold text-navy text-lg">Edit profile</h3>
                    <button type="submit"
                        class="text-sm font-bold text-primary hover:opacity-70 transition-opacity">Done</button>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Profile Photo Section -->
                    <div class="flex justify-between items-center group cursor-pointer"
                        onclick="document.getElementById('profile_upload').click()">
                        <div class="flex-1">
                            <span class="block text-sm font-bold text-navy">Profile Photo</span>
                            <span class="text-xs text-gray-400">Update your account picture</span>
                        </div>
                        <div
                            class="relative w-16 h-16 rounded-full overflow-hidden border border-gray-100 group-hover:opacity-80 transition-opacity">
                            <img id="edit_avatar_preview" src="<?= $my_avatar ?>" class="w-full h-full object-cover">
                            <div
                                class="absolute inset-0 bg-black/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="material-symbols-outlined text-white text-[20px]">add_a_photo</span>
                            </div>
                        </div>
                        <input type="file" name="profile_photo" id="profile_upload" class="hidden" accept="image/*"
                            onchange="previewEditAvatar(this)">
                    </div>

                    <!-- AI Moderation Warning -->
                    <div id="ai-moderation-warning"
                        class="hidden -mt-4 p-3 bg-red-50 border border-red-100 rounded-xl flex items-start gap-2 animate-shake">
                        <span class="material-symbols-outlined text-red-500 text-sm mt-0.5">warning</span>
                        <p class="text-[11px] text-red-700 font-bold leading-tight">This image has been flagged as
                            inappropriate and cannot be used. Please select a different photo.</p>
                    </div>

                    <hr class="border-gray-50">

                    <!-- Name & Username Section -->
                    <div class="space-y-4">
                        <div class="flex flex-col gap-1">
                            <label class="text-xs font-bold text-navy/50 uppercase tracking-wider">Username</label>
                            <div class="flex items-center gap-1 border-b border-gray-100 pb-1">
                                <span class="text-navy font-bold">@</span>
                                <input type="text" name="username" value="<?= htmlspecialchars($user->username) ?>"
                                    class="w-full p-0 border-none focus:ring-0 text-navy font-bold placeholder:text-gray-300"
                                    placeholder="username" required>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-xs font-bold text-navy/50 uppercase tracking-wider">First
                                Name</label>
                            <input type="text" name="first_name" value="<?= htmlspecialchars($user->first_name) ?>"
                                class="w-full p-0 border-none focus:ring-0 text-navy font-medium placeholder:text-gray-300"
                                placeholder="Your first name">
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-xs font-bold text-navy/50 uppercase tracking-wider">Last Name</label>
                            <input type="text" name="last_name" value="<?= htmlspecialchars($user->last_name) ?>"
                                class="w-full p-0 border-none focus:ring-0 text-navy font-medium placeholder:text-gray-300"
                                placeholder="Your last name">
                        </div>
                    </div>

                    <hr class="border-gray-50">

                    <!-- Bio Section -->
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-bold text-navy/50 uppercase tracking-wider">Bio</label>
                        <textarea name="bio" rows="3"
                            class="w-full p-0 border-none focus:ring-0 text-navy text-sm placeholder:text-gray-300 resize-none"
                            placeholder="+ Write bio"><?= htmlspecialchars($user->bio ?? '') ?></textarea>
                    </div>

                    <hr class="border-gray-50">

                    <!-- Link Section -->
                    <div class="flex flex-col gap-1 pb-4">
                        <label class="text-xs font-bold text-navy/50 uppercase tracking-wider">Link</label>
                        <input type="url" name="link" value="<?= htmlspecialchars($user->link ?? '') ?>"
                            class="w-full p-0 border-none focus:ring-0 text-navy text-sm placeholder:text-gray-300"
                            placeholder="+ Add link">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Options Modal (Bottom Sheet for Mobile) -->
<div id="optionsModal"
    class="fixed inset-0 z-[110] bg-black/60 backdrop-blur-sm bottom-sheet-modal hidden transition-all">
    <div class="absolute inset-0" onclick="toggleOptionsModal()"></div>
    <div class="absolute inset-x-0 bottom-0 sm:inset-0 sm:flex sm:items-center sm:justify-center p-0 sm:p-4">
        <div
            class="bottom-sheet-content w-full max-w-md bg-white rounded-t-[32px] sm:rounded-[32px] overflow-hidden shadow-2xl transition-all h-[80vh] sm:h-auto flex flex-col">
            <!-- Handle for dragging on mobile -->
            <div class="flex flex-col items-center py-4 cursor-pointer sm:hidden" onclick="toggleOptionsModal()">
                <div class="w-12 h-1.5 bg-gray-200 rounded-full"></div>
            </div>

            <!-- Back Button for Desktop/Mobile Consistency -->
            <div class="px-4 pb-2 flex items-center">
                <button onclick="toggleOptionsModal()"
                    class="flex items-center gap-2 p-2 -ml-2 text-navy hover:bg-gray-100 rounded-full transition-colors">
                    <span class="material-symbols-outlined">arrow_back</span>
                    <span class="font-bold text-sm">Back</span>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto px-4 pb-8">
                <!-- Option Groups -->
                <div class="space-y-4">
                    <!-- Group 1: General -->
                    <div class="bg-gray-50/50 rounded-2xl overflow-hidden divide-y divide-gray-100/50">
                        <button onclick="openQRFromOptions()"
                            class="w-full flex items-center justify-between p-4 hover:bg-gray-100 transition-colors">
                            <span class="font-bold text-navy">QR code</span>
                            <span class="material-symbols-outlined text-navy">qr_code_2</span>
                        </button>
                        <button onclick="copyProfileLink(); toggleOptionsModal();"
                            class="w-full flex items-center justify-between p-4 hover:bg-gray-100 transition-colors">
                            <span class="font-bold text-navy">Copy link</span>
                            <span class="material-symbols-outlined text-navy">link</span>
                        </button>
                        <button
                            class="w-full flex items-center justify-between p-4 hover:bg-gray-100 transition-colors">
                            <span class="font-bold text-navy">Share to...</span>
                            <span class="material-symbols-outlined text-navy">share</span>
                        </button>
                    </div>

                    <!-- Group 2: Info & Self Actions -->
                    <div class="bg-gray-50/50 rounded-2xl overflow-hidden divide-y divide-gray-100/50">
                        <button onclick="toggleAboutModal()"
                            class="w-full flex items-center justify-between p-4 hover:bg-gray-100 transition-colors">
                            <span class="font-bold text-navy">About this profile</span>
                            <span class="material-symbols-outlined text-navy">info</span>
                        </button>
                        <?php if ($this->session->userdata('user_id') == $user->id): ?>
                            <!-- Self Actions -->
                            <button onclick="window.location.href='<?= base_url('auth/logout') ?>'"
                                class="w-full flex items-center justify-between p-4 text-red-600 hover:bg-red-50 transition-colors">
                                <span class="font-bold">Log out</span>
                                <span class="material-symbols-outlined">logout</span>
                            </button>
                        <?php endif; ?>
                    </div>

                    <!-- Group 3: Moderation (Only for others) -->
                    <?php if ($this->session->userdata('user_id') != $user->id): ?>
                        <div class="bg-gray-50/50 rounded-2xl overflow-hidden divide-y divide-gray-100/50">
                            <button onclick="handleInteraction('mute')"
                                class="w-full flex items-center justify-between p-4 hover:bg-gray-100 transition-colors">
                                <span class="font-bold text-navy" id="muteBtnText">Mute</span>
                                <span class="material-symbols-outlined text-navy">notifications_off</span>
                            </button>
                            <button onclick="handleInteraction('restrict')"
                                class="w-full flex items-center justify-between p-4 hover:bg-gray-100 transition-colors">
                                <span class="font-bold text-navy" id="restrictBtnText">Restrict</span>
                                <span class="material-symbols-outlined text-navy">block</span>
                            </button>
                            <button onclick="handleInteraction('block')"
                                class="w-full flex items-center justify-between p-4 text-red-600 hover:bg-red-50 transition-colors">
                                <span class="font-bold" id="blockBtnText">Block</span>
                                <span class="material-symbols-outlined">person_off</span>
                            </button>
                            <button onclick="handleReport()"
                                class="w-full flex items-center justify-between p-4 text-red-600 hover:bg-red-50 transition-colors">
                                <span class="font-bold">Report</span>
                                <span class="material-symbols-outlined">report</span>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Profile Modal -->
<div id="aboutProfileModal" class="fixed inset-0 z-[120] bg-black/60 backdrop-blur-sm hidden transition-all">
    <div class="absolute inset-0" onclick="toggleAboutModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-sm rounded-[32px] p-8 text-center shadow-2xl relative">
            <div class="w-20 h-20 bg-gray-100 rounded-full mx-auto mb-4 overflow-hidden">
                <img src="<?= $user->profile_photo ? base_url('uploads/' . $user->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->first_name) . '&background=random' ?>"
                    class="w-full h-full object-cover">
            </div>
            <h2 class="text-xl font-bold text-navy mb-1">
                <?= htmlspecialchars($user->first_name . ' ' . $user->last_name) ?>
            </h2>
            <p class="text-gray-500 font-medium text-sm mb-6">@<?= htmlspecialchars($user->username) ?></p>

            <div class="space-y-4 text-left">
                <div class="flex items-center gap-3 text-navy">
                    <span class="material-symbols-outlined text-gray-400">calendar_month</span>
                    <div>
                        <p class="text-xs text-gray-400 font-bold uppercase">Joined</p>
                        <p class="font-medium"><?= date('F Y', strtotime($user->created_at)) ?></p>
                    </div>
                </div>
                <div class="flex items-center gap-3 text-navy">
                    <span class="material-symbols-outlined text-gray-400">location_on</span>
                    <div>
                        <p class="text-xs text-gray-400 font-bold uppercase">Location</p>
                        <p class="font-medium">Based from India</p>
                    </div>
                </div>
            </div>

            <button onclick="toggleAboutModal()"
                class="mt-8 w-full py-3 bg-gray-100 text-navy font-bold rounded-xl hover:bg-gray-200 transition-colors">
                Close
            </button>
        </div>
    </div>
</div>

<!-- Share Profile Modal -->
<div id="shareProfileModal" class="fixed inset-0 z-[101] hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="toggleShareModal()"></div>
    <div class="relative flex h-full items-end sm:items-center justify-center p-0 sm:p-4">
        <!-- Modal Content -->
        <div class="w-full max-w-md bg-[#f6f7f8] rounded-t-[32px] sm:rounded-[32px] overflow-hidden shadow-2xl transition-all translate-y-full sm:translate-y-0"
            id="shareModalContent">
            <!-- Top Navigation for Modal -->
            <div class="flex items-center justify-between p-6 pb-2">
                <button onclick="toggleShareModal()"
                    class="flex items-center gap-1 text-navy hover:opacity-70 transition-opacity">
                    <span class="material-symbols-outlined font-bold">arrow_back</span>
                    <span class="font-bold text-sm">Back</span>
                </button>
                <div class="w-12 h-1 bg-gray-300 rounded-full sm:hidden"></div>
                <div class="w-10"></div> <!-- Spacer -->
            </div>

            <div class="px-8 pb-10 flex flex-col items-center">
                <!-- QR Code Card -->
                <div class="bg-white p-8 rounded-[40px] shadow-sm mb-6 flex flex-col items-center w-full max-w-[300px]">
                    <div class="relative w-48 h-48 mb-4">
                        <img id="profile_qr_code"
                            src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=<?= urlencode(current_url()) ?>"
                            class="w-full h-full object-contain">
                        <!-- Optional logo overlay for that "Threads" look -->
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <div class="bg-white p-1 rounded-full border-4 border-white">
                                <img src="<?= base_url('assets/images/logo.png') ?>" class="w-6 h-6 object-contain">
                            </div>
                        </div>
                    </div>
                    <span
                        class="font-bold text-navy text-lg"><?= htmlspecialchars($user->first_name . ' ' . $user->last_name) ?></span>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 w-full mb-6">
                    <button onclick="downloadQR()"
                        class="flex-1 bg-white p-4 rounded-[20px] flex flex-col items-center justify-center gap-2 hover:bg-gray-50 transition-colors shadow-sm">
                        <span class="material-symbols-outlined text-navy text-[24px]">download</span>
                        <span class="text-xs font-bold text-navy">Download</span>
                    </button>
                    <button onclick="toggleShareModal()"
                        class="flex-1 bg-white p-4 rounded-[20px] flex flex-col items-center justify-center gap-2 hover:bg-gray-50 transition-colors shadow-sm">
                        <span class="material-symbols-outlined text-navy text-[24px]">qr_code_scanner</span>
                        <span class="text-xs font-bold text-navy">Scan</span>
                    </button>
                </div>

                <!-- List Options -->
                <div class="w-full bg-white rounded-[24px] shadow-sm divide-y divide-gray-50">
                    <button onclick="copyProfileLink()"
                        class="w-full flex items-center justify-between p-5 hover:bg-gray-50 transition-colors first:rounded-t-[24px]">
                        <span class="font-bold text-navy">Copy link</span>
                        <span class="material-symbols-outlined text-navy text-[20px]">link</span>
                    </button>
                    <button onclick="shareProfile()"
                        class="w-full flex items-center justify-between p-5 hover:bg-gray-50 transition-colors last:rounded-b-[24px]">
                        <span class="font-bold text-navy">Share to</span>
                        <span class="material-symbols-outlined text-navy text-[20px]">share</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleEditModal() {
        const modal = document.getElementById('editProfileModal');
        const content = document.getElementById('editModalContent');
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
        } else {
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 150);
        }
    }

    function toggleShareModal() {
        const modal = document.getElementById('shareProfileModal');
        const content = document.getElementById('shareModalContent');
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

    function toggleOptionsModal() {
        const modal = document.getElementById('optionsModal');
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
        } else {
            modal.classList.add('hidden');
        }
    }

    function openQRFromOptions() {
        toggleOptionsModal();
        setTimeout(toggleShareModal, 350);
    }

    function toggleAboutModal() {
        const modal = document.getElementById('aboutProfileModal');
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            // Close options modal if open
            const options = document.getElementById('optionsModal');
            if (!options.classList.contains('hidden')) toggleOptionsModal();
        } else {
            modal.classList.add('hidden');
        }
    }

    // Initialize Interaction State
    document.addEventListener('DOMContentLoaded', () => {
        fetchInteractionStatus();
    });

    async function fetchInteractionStatus() {
        try {
            const response = await fetch('<?= base_url('interactions/get_status/' . $user->id) ?>');
            const data = await response.json();

            if (data.is_muted) document.getElementById('muteBtnText').innerText = 'Unmute';
            if (data.is_restricted) document.getElementById('restrictBtnText').innerText = 'Unrestrict';
            if (data.is_blocked) document.getElementById('blockBtnText').innerText = 'Unblock';
        } catch (e) { console.error('Error fetching interaction status', e); }
    }

    async function handleInteraction(type) {
        const endpoints = {
            'mute': 'toggle_mute',
            'restrict': 'toggle_restrict',
            'block': 'toggle_block'
        };

        if (!endpoints[type]) return;

        try {
            const response = await fetch(`<?= base_url('interactions/') ?>${endpoints[type]}/<?= $user->id ?>`);
            const data = await response.json();

            if (data.status === 'success') {
                // Update UI text
                const btnId = `${type}BtnText`;
                const btn = document.getElementById(btnId);

                if (type === 'mute') btn.innerText = data.new_state === 'muted' ? 'Unmute' : 'Mute';
                if (type === 'restrict') btn.innerText = data.new_state === 'restricted' ? 'Unrestrict' : 'Restrict';
                if (type === 'block') btn.innerText = data.new_state === 'blocked' ? 'Unblock' : 'Block';

                // Optional: Show toast feedback
                alert(`${type.charAt(0).toUpperCase() + type.slice(1)} action successful.`);
                toggleOptionsModal();
                if (type === 'block' && data.new_state === 'blocked') window.location.href = '<?= base_url('home') ?>';
            }
        } catch (e) {
            alert('Action failed. Please try again.');
        }
    }

    async function handleReport() {
        const reason = prompt("Please provide a reason for reporting this user:");
        if (!reason) return;

        const formData = new FormData();
        formData.append(csrfTokenName, csrfHash);
        formData.append('reason', reason);

        try {
            const response = await fetch('<?= base_url('interactions/report/' . $user->id) ?>', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();

            if (data.status === 'success') {
                alert('Report submitted successfully.');
                toggleOptionsModal();
            } else {
                alert(data.message || 'Report failed.');
            }
        } catch (e) {
            alert('An error occurred.');
        }
    }

    function copyProfileLink() {
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
            alert('Link copied to clipboard!');
        });
    }

    function shareProfile() {
        if (navigator.share) {
            navigator.share({
                title: 'Check out this profile on Campus App',
                url: window.location.href
            }).catch(console.error);
        } else {
            copyProfileLink();
        }
    }

    function downloadQR() {
        const qrUrl = document.getElementById('profile_qr_code').src;
        const link = document.createElement('a');
        link.href = qrUrl;
        link.download = 'profile_qr.png';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    // AI Moderation Initialization
    let nsfwModel = null;
    async function loadNSFWModel() {
        if (nsfwModel) return nsfwModel;
        try {
            nsfwModel = await nsfwjs.load();
            return nsfwModel;
        } catch (e) {
            console.error('Failed to load NSFWJS model', e);
        }
    }

    async function previewEditAvatar(input) {
        const warningEl = document.getElementById('ai-moderation-warning');
        const submitBtn = document.querySelector('#editProfileModal button[type="submit"]');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = async function (e) {
                const previewImg = document.getElementById('edit_avatar_preview');
                const tempImg = new Image();

                tempImg.src = e.target.result;
                tempImg.onload = async () => {
                    // Show checking state
                    warningEl.classList.add('hidden');
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-50');

                    const model = await loadNSFWModel();
                    if (model) {
                        const predictions = await model.classify(tempImg);
                        console.log('NSFW Predictions:', predictions);

                        // Comprehensive AI Check
                        const findP = (c) => predictions.find(p => p.className === c)?.probability || 0;
                        const porn = findP('Porn');
                        const hentai = findP('Hentai');
                        const sexy = findP('Sexy');
                        const neutral = findP('Neutral');

                        console.log('NSFW Result:', { porn, hentai, sexy, neutral });

                        if (porn > 0.2 || hentai > 0.2 || sexy > 0.5 || neutral < 0.3) {
                            warningEl.classList.remove('hidden');
                            input.value = ''; // Clear file input
                            submitBtn.disabled = true;
                            return;
                        }
                    }

                    // If clean
                    previewImg.src = e.target.result;
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50');
                };
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // --- Post Actions ---
    async function handleLike(postId, btn) {
        const icon = btn.querySelector('.material-symbols-outlined');
        const countEl = btn.closest('div').nextElementSibling; // The likes count div

        // Visual feedback immediately (optimistic UI)
        const wasLiked = icon.classList.contains('fill-current');

        if (wasLiked) {
            icon.classList.remove('fill-current', 'text-red-500');
            icon.classList.add('text-navy');
            let count = parseInt(countEl.innerText) || 0;
            countEl.innerText = (count > 0 ? count - 1 : 0) + ' likes';
        } else {
            icon.classList.add('fill-current', 'text-red-500');
            icon.classList.remove('text-navy');
            let count = parseInt(countEl.innerText) || 0;
            countEl.innerText = (count + 1) + ' likes';
        }

        // Backend Call
        const formData = new FormData();
        formData.append(csrfTokenName, csrfHash);
        formData.append('post_id', postId);

        try {
            const response = await fetch('<?= base_url('post/toggle_like') ?>', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();

            if (data.status === 'success') {
                // Sync count exactly from server to be safe
                countEl.innerText = data.new_count + ' likes';
            } else {
                // Revert on error
                console.error('Like failed:', data.message);
                // Revert UI logic here if strict
            }
        } catch (e) {
            console.error('Like error', e);
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

    function switchTab(tab) {
        // Update buttons
        document.querySelectorAll('[id^="tab-btn-"]').forEach(btn => {
            btn.classList.remove('text-navy', 'bg-white/50', 'shadow-sm', 'border-white/50');
            btn.classList.add('text-gray-400');
        });
        const activeBtn = document.getElementById('tab-btn-' + tab);
        activeBtn.classList.remove('text-gray-400');
        activeBtn.classList.add('text-navy', 'bg-white/50', 'shadow-sm', 'border-white/50');

        // Update content
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden', 'opacity-0');
        });
        const activeContent = document.getElementById('content-' + tab);
        activeContent.classList.remove('hidden');
        setTimeout(() => {
            activeContent.classList.remove('opacity-0');
        }, 10);
    }
</script>

<!-- Comment Modal -->
<div id="commentModal" class="fixed inset-0 z-[120] hidden">
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
                        class="bg-navy text-white px-4 py-2 rounded-xl text-sm font-bold hover:opacity-90 disabled:opacity-50 transition-opacity"
                        id="postCommentBtn">
                        Post
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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

<!-- Repost Options Modal -->
<div id="repostOptionsModal" class="fixed inset-0 z-[130] hidden">
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
<div id="quoteModal" class="fixed inset-0 z-[140] hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="toggleQuoteModal()"></div>
    <div class="relative flex h-full items-end sm:items-center justify-center p-0 sm:p-4">
        <div class="w-full max-w-lg bg-white rounded-t-[32px] sm:rounded-[32px] flex flex-col transition-all translate-y-full sm:translate-y-0"
            id="quoteModalContent">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
                <button onclick="toggleQuoteModal()" class="text-sm font-bold text-navy">Cancel</button>
                <h3 class="font-bold text-navy">Quote repost</h3>
                <button onclick="submitRepost(document.getElementById('quoteInput').value)"
                    class="bg-navy text-white px-4 py-1.5 rounded-full text-sm font-bold">Repost</button>
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
                    document.getElementById('undoRepostBtn').classList.remove('hidden');
                    toggleRepostOptions();
                    return;
                }
                window.location.reload();
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

                // If we are on the profile of the user being followed, update the main button too
                const mainBtn = document.getElementById('mainFollowBtn');
                if (mainBtn && currentTargetUserId == '<?= $user->id ?>') {
                    updateMainFollowBtn(data.action === 'followed');
                }

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

    async function handleMainFollow(userId) {
        const btn = document.getElementById('mainFollowBtn');
        const originalText = btn.innerText;
        btn.innerText = '...';
        btn.disabled = true;

        const formData = new FormData();
        formData.append(csrfTokenName, csrfHash);
        formData.append('user_id', userId);

        try {
            const response = await fetch('<?= base_url('follow/toggle') ?>', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            if (data.status === 'success') {
                const isFollowing = data.action === 'followed';
                updateMainFollowBtn(isFollowing);
            } else {
                alert(data.message);
                btn.innerText = originalText;
                btn.disabled = false;
            }
        } catch (e) {
            alert('Connection error');
            btn.innerText = originalText;
            btn.disabled = false;
        }
    }

    function updateMainFollowBtn(isFollowing) {
        const btn = document.getElementById('mainFollowBtn');
        if (btn) {
            btn.disabled = false;
            btn.innerText = isFollowing ? 'Following' : 'Follow';
            if (isFollowing) {
                btn.classList.remove('bg-gradient-to-r', 'from-primary', 'to-accent', 'text-white', 'shadow-lg', 'shadow-primary/20');
                btn.classList.add('bg-gray-100', 'text-navy');
            } else {
                btn.classList.remove('bg-gray-100', 'text-navy');
                btn.classList.add('bg-gradient-to-r', 'from-primary', 'to-accent', 'text-white', 'shadow-lg', 'shadow-primary/20');
            }
        }

        // Update follower count (crude increment/decrement)
        const countEl = document.getElementById('followersCountVal');
        if (countEl) {
            let count = parseInt(countEl.innerText) || 0;
            countEl.innerText = isFollowing ? (count + 1) : (count > 0 ? count - 1 : 0);
        }
    }

    document.addEventListener('click', (e) => {
        if (!followPopup.contains(e.target)) {
            followPopup.classList.remove('active');
        }
    });
</script>
<?php $this->load->view('components/follow_list_modal'); ?>
<script>const baseUrl = "<?= base_url() ?>";</script>
<script src="<?= base_url('public/js/post_menu.js') ?>"></script>
</body>

</html>