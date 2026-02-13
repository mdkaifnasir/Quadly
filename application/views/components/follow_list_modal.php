<!-- Follow List Modal -->
<div id="followListModal" class="fixed inset-0 z-[115] bg-black/60 backdrop-blur-sm hidden transition-all">
    <div class="absolute inset-0" onclick="toggleFollowListModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-[32px] overflow-hidden shadow-2xl flex flex-col max-h-[80vh]">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50 flex-shrink-0">
                <button onclick="toggleFollowListModal()"
                    class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 text-navy">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                </button>
                <h3 class="font-bold text-navy text-lg capitalize" id="followListTitle">Followers</h3>
                <div class="w-8"></div>
            </div>

            <!-- Tabs (Optional, can just switch lists) -->
            <div class="flex border-b border-gray-50 flex-shrink-0">
                <button onclick="switchFollowTab('followers')" id="tabFollowers"
                    class="flex-1 py-3 text-sm font-bold text-navy border-b-2 border-navy transition-all">Followers</button>
                <button onclick="switchFollowTab('following')" id="tabFollowing"
                    class="flex-1 py-3 text-sm font-bold text-gray-400 border-b-2 border-transparent hover:text-navy transition-all">Following</button>
            </div>

            <!-- List Content -->
            <div id="followListContent" class="flex-1 overflow-y-auto p-0 scrollbar-hide">
                <!-- Dynamic Content -->
            </div>
        </div>
    </div>
</div>

<script>
    let currentFollowType = 'followers';

    function toggleFollowListModal(initialType = null) {
        const modal = document.getElementById('followListModal');
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            if (initialType) switchFollowTab(initialType);
        } else {
            modal.classList.add('hidden');
        }
    }

    function switchFollowTab(type) {
        currentFollowType = type;
        document.getElementById('followListTitle').innerText = type;

        document.getElementById('tabFollowers').className = type === 'followers' ?
            'flex-1 py-3 text-sm font-bold text-navy border-b-2 border-navy transition-all' :
            'flex-1 py-3 text-sm font-bold text-gray-400 border-b-2 border-transparent hover:text-navy transition-all';

        document.getElementById('tabFollowing').className = type === 'following' ?
            'flex-1 py-3 text-sm font-bold text-navy border-b-2 border-navy transition-all' :
            'flex-1 py-3 text-sm font-bold text-gray-400 border-b-2 border-transparent hover:text-navy transition-all';

        loadFollowList(type);
    }

    async function loadFollowList(type) {
        const container = document.getElementById('followListContent');
        container.innerHTML = `<div class="p-8 flex justify-center"><span class="animate-spin material-symbols-outlined text-gray-300">cached</span></div>`;

        try {
            // Adjust endpoint based on type
            const endpoint = type === 'followers' ? 'get_followers' : 'get_following';
            const response = await fetch(`<?= base_url('follow/') ?>${endpoint}/<?= $user->id ?>`);
            const users = await response.json();

            if (users.length === 0) {
                container.innerHTML = `
                        <div class="flex flex-col items-center justify-center py-16 text-center px-4">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-3xl text-gray-300">group_off</span>
                            </div>
                            <h3 class="font-bold text-navy text-lg mb-1">No ${type} yet</h3>
                            <p class="text-sm text-gray-400">When people join, they'll show up here.</p>
                        </div>
                    `;
                return;
            }

            container.innerHTML = users.map(u => `
                    <div class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors cursor-pointer" onclick="window.location.href='<?= base_url('profile/index/') ?>${u.id}'">
                        <div class="flex items-center gap-3">
                            <img src="${u.profile_photo}" class="w-10 h-10 rounded-full object-cover border border-gray-100">
                            <div class="flex flex-col">
                                <span class="font-bold text-navy text-sm">${u.first_name} ${u.last_name}</span>
                                <span class="text-xs text-gray-400">@${u.username}</span>
                            </div>
                        </div>
                        ${!u.is_self ? `
                            <button onclick="handleListFollow(event, ${u.id}, this)" 
                                class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all ${u.is_following ? 'bg-gray-100 text-navy' : 'bg-navy text-white shadow-md shadow-primary/20'}">
                                ${u.is_following ? 'Following' : 'Follow'}
                            </button>
                        ` : ''}
                    </div>
                `).join('');

        } catch (e) {
            console.error(e);
            container.innerHTML = `<p class="text-center text-red-500 py-8">Failed to load list.</p>`;
        }
    }

    async function handleListFollow(e, userId, btn) {
        e.stopPropagation();
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
                btn.innerText = isFollowing ? 'Following' : 'Follow';

                if (isFollowing) {
                    btn.classList.remove('bg-navy', 'text-white', 'shadow-md', 'shadow-primary/20');
                    btn.classList.add('bg-gray-100', 'text-navy');
                } else {
                    btn.classList.remove('bg-gray-100', 'text-navy');
                    btn.classList.add('bg-navy', 'text-white', 'shadow-md', 'shadow-primary/20');
                }

                // If modifying the currently viewed profile's relationship
                if (userId == <?= $user->id ?>) {
                    // Update main button if it exists
                    updateMainFollowBtn(isFollowing);
                }
            } else {
                btn.innerText = originalText;
            }
        } catch (e) {
            btn.innerText = originalText;
        } finally {
            btn.disabled = false;
        }
    }
</script>