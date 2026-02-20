<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Messages</title>
    <!-- Tailwind & Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1"
        rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { "navy": "#0d141b", "primary": "#1173d4" },
                    fontFamily: { "sans": ["Inter", "sans-serif"] }
                }
            }
        }
    </script>
</head>

<body class="bg-white text-navy h-screen flex flex-col">

    <!-- Header -->
    <header
        class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100 px-4 py-3 flex items-center justify-between">
        <h1 class="text-xl font-bold">Messages</h1>
        <button class="p-2 -mr-2 text-navy hover:bg-gray-100 rounded-full">
            <span class="material-symbols-outlined">edit_square</span>
        </button>
    </header>

    <!-- Content -->
    <div class="flex-1 overflow-y-auto">
        <?php if (empty($conversations)): ?>
            <div class="h-full flex flex-col items-center justify-center text-gray-400 p-8 text-center">
                <span class="material-symbols-outlined text-6xl mb-4 opacity-30">chat_bubble</span>
                <h3 class="text-lg font-bold text-navy mb-1">No messages yet</h3>
                <p>Start a conversation with someone!</p>
            </div>
        <?php else: ?>
            <div class="divide-y divide-gray-50">
                <?php foreach ($conversations as $conv): ?>
                    <a href="<?= base_url('messages/user/' . ($conv->sender_id == $this->session->userdata('user_id') ? $conv->receiver_id : $conv->sender_id)) ?>"
                        class="flex items-center gap-3 p-4 hover:bg-gray-50 transition-colors">
                        <div class="size-12 rounded-full bg-gray-200 overflow-hidden shrink-0">
                            <img src="<?= $conv->profile_photo ? base_url('uploads/' . $conv->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($conv->first_name) . '&background=random' ?>"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-0.5">
                                <h4 class="font-bold text-sm truncate">
                                    <?= htmlspecialchars($conv->first_name . ' ' . $conv->last_name) ?>
                                </h4>
                                <span class="text-xs text-gray-400 whitespace-nowrap ml-2">
                                    <?= date('M d', strtotime($conv->created_at)) ?>
                                </span>
                            </div>
                            <p
                                class="text-sm text-gray-500 truncate <?= !$conv->is_read && $conv->receiver_id == $this->session->userdata('user_id') ? 'font-bold text-navy' : '' ?>">
                                <?= $conv->sender_id == $this->session->userdata('user_id') ? 'You: ' : '' ?>
                                <?php
                                if ($conv->message_type === 'image') {
                                    echo '📷 Sent an image';
                                } else if ($conv->message_type === 'video') {
                                    echo '🎥 Sent a video';
                                } else {
                                    echo htmlspecialchars($conv->message);
                                }
                                ?>
                            </p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bottom Nav -->
    <nav class="sticky bottom-0 z-50 bg-white border-t border-gray-100 pb-safe">
        <div class="flex justify-around items-center h-14">
            <a href="<?= base_url('home') ?>" class="p-2 text-gray-400 hover:text-navy transition-colors">
                <span class="material-symbols-outlined text-[28px]">home</span>
            </a>
            <a href="<?= base_url('search') ?>" class="p-2 text-gray-400 hover:text-navy transition-colors">
                <span class="material-symbols-outlined text-[28px]">search</span>
            </a>
            <a href="<?= base_url('post/create') ?>" class="p-2 text-gray-400 hover:text-navy transition-colors">
                <span class="material-symbols-outlined text-[28px]">add_box</span>
            </a>
            <a href="<?= base_url('messages') ?>" class="p-2 text-navy transition-colors">
                <span class="material-symbols-outlined text-[28px] fill-current">chat_bubble</span>
            </a>
            <a href="<?= base_url('profile') ?>" class="p-2 text-gray-400 hover:text-navy transition-colors">
                <span class="material-symbols-outlined text-[28px]">account_circle</span>
            </a>
        </div>
    </nav>

</body>

</html>