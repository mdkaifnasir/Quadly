<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Chat with
        <?= htmlspecialchars($partner->first_name) ?>
    </title>
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
    <style>
        .kb-safe {
            padding-bottom: env(safe-area-inset-bottom);
        }
    </style>
</head>

<body class="bg-white text-navy h-screen flex flex-col">

    <!-- Header -->
    <header
        class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100 px-2 py-2 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <a href="javascript:history.back()" class="p-2 -ml-1 text-navy hover:bg-gray-100 rounded-full">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <a href="<?= base_url('profile/index/' . $partner->id) ?>"
                class="flex items-center gap-2 hover:opacity-70 transition-opacity">
                <div class="size-8 rounded-full bg-gray-200 overflow-hidden">
                    <img src="<?= $partner->profile_photo ? base_url('uploads/' . $partner->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($partner->first_name) . '&background=random' ?>"
                        class="w-full h-full object-cover">
                </div>
                <div>
                    <h1 class="font-bold text-sm leading-tight">
                        <?= htmlspecialchars($partner->first_name . ' ' . $partner->last_name) ?>
                    </h1>
                    <p class="text-xs text-gray-500">@
                        <?= htmlspecialchars($partner->username) ?>
                    </p>
                </div>
            </a>
        </div>
        <button class="p-2 text-navy hover:bg-gray-100 rounded-full">
            <span class="material-symbols-outlined">info</span>
        </button>
    </header>

    <!-- Message List -->
    <div id="messageList" class="flex-1 overflow-y-auto p-4 space-y-2 pb-20">
        <!-- Messages loaded via JS or PHP initially -->
    </div>

    <!-- Input Area -->
    <div class="sticky bottom-0 bg-white border-t border-gray-100 p-3 kb-safe">
        <!-- Preview Area -->
        <div id="mediaPreview" class="hidden mb-2 relative inline-block">
            <button onclick="clearMedia()" class="absolute -top-2 -right-2 bg-gray-900 text-white rounded-full p-0.5 z-10">
                <span class="material-symbols-outlined text-[16px]">close</span>
            </button>
            <img id="imagePreview" class="h-20 rounded-lg border border-gray-200 object-cover hidden">
            <video id="videoPreview" class="h-20 rounded-lg border border-gray-200 hidden"></video>
        </div>

        <form id="messageForm" class="flex items-end gap-2 bg-gray-100 p-1.5 rounded-[24px]">
            <input type="file" id="fileInput" class="hidden" accept="image/*,video/mp4">
            <button type="button" onclick="document.getElementById('fileInput').click()" class="p-2 text-primary bg-blue-100 rounded-full shrink-0">
                <span class="material-symbols-outlined text-[20px]">attach_file</span>
            </button>
            <textarea id="messageInput" rows="1" class="flex-1 bg-transparent border-none focus:ring-0 p-2 text-sm max-h-32 resize-none placeholder:text-gray-400" placeholder="Message..."></textarea>
            <button type="submit" id="sendBtn" class="p-2 text-gray-400 hover:text-primary font-bold disabled:opacity-50 transition-colors">
                Send
            </button>
        </form>
    </div>

    <script>
        const partnerId = <?= $partner->id ?>;
        const currentUserId = <?= $this->session->userdata('user_id') ?>;
        const messageList = document.getElementById('messageList');

        // File Selection
        const fileInput = document.getElementById('fileInput');
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const previewDiv = document.getElementById('mediaPreview');
                const imgPrev = document.getElementById('imagePreview');
                const vidPrev = document.getElementById('videoPreview');
                
                previewDiv.classList.remove('hidden');
                
                if (file.type.startsWith('image/')) {
                    imgPrev.src = URL.createObjectURL(file);
                    imgPrev.classList.remove('hidden');
                    vidPrev.classList.add('hidden');
                } else if (file.type.startsWith('video/')) {
                    vidPrev.src = URL.createObjectURL(file);
                    vidPrev.classList.remove('hidden');
                    imgPrev.classList.add('hidden');
                }
                document.getElementById('sendBtn').classList.add('text-primary', 'text-gray-400');
            }
        });

        function clearMedia() {
            fileInput.value = '';
            document.getElementById('mediaPreview').classList.add('hidden');
        }

        // Auto-resize textarea
        const textarea = document.getElementById('messageInput');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
            const hasContent = this.value.trim().length > 0 || fileInput.files.length > 0;
            document.getElementById('sendBtn').classList.toggle('text-primary', hasContent);
            document.getElementById('sendBtn').classList.toggle('text-gray-400', !hasContent);
        });

        // Send Message
        document.getElementById('messageForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const message = textarea.value.trim();
            const file = fileInput.files[0];

            if (!message && !file) return;

            const formData = new FormData();
            formData.append('receiver_id', partnerId);
            formData.append('message', message);
            if (file) {
                formData.append('attachment', file);
            }

            try {
                // Optimistic clear
                textarea.value = '';
                textarea.style.height = 'auto';
                clearMedia();
                
                const response = await fetch('<?= base_url('messages/send') ?>', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                if (data.status === 'success') {
                    fetchMessages(); // Refresh list
                }
            } catch (error) {
                console.error('Error sending message:', error);
                alert('Failed to send message');
            }
        });

        // Render Messages
        function renderMessages(messages) {
            messageList.innerHTML = messages.map(msg => {
                const isMe = msg.sender_id == currentUserId;
                
                let content = '';
                if (msg.message_type === 'image') {
                    content = `<img src="<?= base_url('uploads/') ?>${msg.attachment_path}" class="max-w-[200px] rounded-lg mb-1">`;
                } else if (msg.message_type === 'video') {
                    content = `<video src="<?= base_url('uploads/') ?>${msg.attachment_path}" controls class="max-w-[200px] rounded-lg mb-1"></video>`;
                }
                
                if (msg.message) {
                    content += `<span>${msg.message}</span>`;
                }

                return `
                    <div class="flex ${isMe ? 'justify-end' : 'justify-start'}">
                        <div class="max-w-[75%] px-4 py-2 rounded-2xl text-[15px] leading-relaxed break-words ${isMe ? 'bg-primary text-white rounded-br-none' : 'bg-gray-100 text-navy rounded-bl-none'}">
                            ${content}
                        </div>
                    </div>
                `;
            }).join('');
            scrollToBottom();
        }

        function scrollToBottom() {
            messageList.scrollTop = messageList.scrollHeight;
        }

        // Poll for new messages
        async function fetchMessages() {
            try {
                const response = await fetch(`<?= base_url('messages/fetch/') ?>${partnerId}`);
                const data = await response.json();
                renderMessages(data.messages);
            } catch (error) {
                console.error('Error fetching messages:', error);
            }
        }

        // Initial load and poll
        fetchMessages();
        setInterval(fetchMessages, 3000); // Poll every 3 seconds
    </script>
</body>

</html>