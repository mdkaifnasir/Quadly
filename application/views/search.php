<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Search - CampusConnect</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#2b8cee",
                        "navy": "#0a1d37",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "sans-serif"]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="bg-background-light text-slate-900 min-h-screen">
    <div class="flex min-h-screen">
        <!-- LEFT SIDEBAR (Desktop) -->
        <aside
            class="hidden md:flex w-[72px] lg:w-[245px] flex-col border-r border-gray-200 bg-white fixed h-full z-50 transition-all duration-300">
            <div class="p-6 pb-8 lg:block hidden">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" class="h-14 w-auto">
            </div>
            <div class="p-4 lg:hidden block flex justify-center pb-8">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" class="h-14 w-auto">
            </div>

            <nav class="flex-1 px-3">
                <a href="<?= base_url('home') ?>"
                    class="flex items-center gap-4 p-3 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer mb-2 text-navy">
                    <span class="material-symbols-outlined text-[28px]">home</span>
                    <span class="hidden lg:block text-[16px]">Home</span>
                </a>
                <a href="<?= base_url('search') ?>"
                    class="flex items-center gap-4 p-3 rounded-lg bg-gray-50 transition-colors cursor-pointer mb-2 text-navy font-bold">
                    <span class="material-symbols-outlined text-[28px] fill-current">search</span>
                    <span class="hidden lg:block text-[16px]">Search</span>
                </a>
                <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer mb-2 text-navy"
                    onclick="window.location.href='<?= base_url('home') ?>?create=true'">
                    <span class="material-symbols-outlined text-[28px]">edit_square</span>
                    <span class="hidden lg:block text-[16px]">Create</span>
                </div>
                <div
                    class="flex items-center gap-4 p-3 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer mb-2 text-navy">
                    <span class="material-symbols-outlined text-[28px]">favorite</span>
                    <span class="hidden lg:block text-[16px]">Activity</span>
                </div>
                <a href="<?= base_url('profile') ?>"
                    class="flex items-center gap-4 p-3 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer mb-2 text-navy">
                    <span class="material-symbols-outlined text-[28px]">person</span>
                    <span class="hidden lg:block text-[16px]">Profile</span>
                </a>
            </nav>

            <div class="px-3 pb-6 relative group">
                <div
                    class="flex items-center gap-4 p-3 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer mb-2 text-navy">
                    <span class="material-symbols-outlined text-[28px]">menu</span>
                    <span class="hidden lg:block text-[16px]">More</span>
                </div>
                <div
                    class="absolute bottom-full left-4 w-60 bg-white rounded-xl shadow-2xl border border-gray-100 p-2 hidden group-hover:block mb-2">
                    <a href="<?= base_url('auth/login') ?>"
                        class="flex items-center gap-3 p-3 hover:bg-red-50 text-red-600 rounded-lg text-sm font-medium transition-colors">
                        <span class="material-symbols-outlined text-[20px]">logout</span> Log out
                    </a>
                </div>
            </div>
        </aside>

        <!-- MAIN LAYOUT -->
        <main class="flex-1 flex justify-center md:ml-[72px] lg:ml-[245px] transition-all duration-300 w-full">
            <div class="w-full max-w-4xl mx-auto min-h-screen flex flex-col bg-background-light">

                <!-- Search Header -->
                <div class="sticky top-0 z-40 bg-background-light/80 backdrop-blur-md px-4 pt-6 pb-2">
                    <h1 class="text-3xl font-bold text-navy mb-6 px-2">Search</h1>
                    <div class="relative max-w-2xl mx-auto">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                        <input type="text" id="searchInput" value="<?= htmlspecialchars($query ?? '') ?>"
                            class="w-full h-12 pl-12 pr-4 rounded-2xl border-none bg-white shadow-sm focus:ring-2 focus:ring-gray-200 text-navy placeholder:text-gray-400"
                            placeholder="Search people, threads, or hashtags" autocomplete="off">
                    </div>

                    <!-- Tabs -->
                    <div class="flex border-b border-gray-100 max-w-2xl mx-auto mt-6">
                        <button onclick="switchTab('all')" id="tab-all"
                            class="flex-1 pb-3 <?= $type == 'all' ? 'text-navy border-navy' : 'text-gray-400 border-transparent' ?> font-bold text-sm border-b-2 transition-all">All</button>
                        <button onclick="switchTab('people')" id="tab-people"
                            class="flex-1 pb-3 <?= $type == 'people' ? 'text-navy border-navy' : 'text-gray-400 border-transparent' ?> font-bold text-sm border-b-2 hover:text-navy transition-all">People</button>
                        <button onclick="switchTab('threads')" id="tab-threads"
                            class="flex-1 pb-3 <?= $type == 'threads' ? 'text-navy border-navy' : 'text-gray-400 border-transparent' ?> font-bold text-sm border-b-2 hover:text-navy transition-all">Threads</button>
                        <button onclick="switchTab('hashtags')" id="tab-hashtags"
                            class="flex-1 pb-3 <?= $type == 'hashtags' ? 'text-navy border-navy' : 'text-gray-400 border-transparent' ?> font-bold text-sm border-b-2 hover:text-navy transition-all">Hashtags</button>
                    </div>
                </div>

                <!-- Results Area -->
                <div class="flex-1 overflow-y-auto pb-20 md:pb-10 pt-4 max-w-2xl mx-auto w-full px-4 md:px-0">
                    <div id="searchResults" class="space-y-6">
                        <!-- Initial load or empty state -->
                        <?php if (!$query): ?>
                            <div class="py-20 flex flex-col items-center text-gray-400 text-center">
                                <div
                                    class="w-16 h-16 rounded-full border border-gray-100 flex items-center justify-center mb-4">
                                    <span class="material-symbols-outlined text-3xl">search</span>
                                </div>
                                <h3 class="font-bold text-navy text-lg">Search for content</h3>
                                <p class="text-sm">Find people, posts, and hashtags on CampusConnect</p>
                            </div>
                        <?php else: ?>
                            <!-- This will be populated by AJAX if we want it fully dynamic, but for SEO/Initial load we can PHP it -->
                            <div id="resultsContent">
                                <?php
                                function highlight($text, $query)
                                {
                                    if (!$query)
                                        return htmlspecialchars($text);
                                    // Strip # if search is a tag to highlight just the word
                                    $clean_query = ltrim($query, '#');
                                    return preg_replace('/(' . preg_quote(htmlspecialchars($clean_query), '/') . ')/i', '<mark class="bg-primary/20 text-navy p-0 rounded">$1</mark>', htmlspecialchars($text));
                                }
                                ?>
                                <?php if ($type == 'all' || $type == 'people'): ?>
                                    <div class="section-people mb-8">
                                        <?php if ($people): ?>
                                            <h2 class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-4 px-2">
                                                People</h2>
                                            <?php foreach ($people as $u): ?>
                                                <div class="flex items-center justify-between p-4 hover:bg-gray-50/50 transition-colors cursor-pointer group rounded-2xl"
                                                    onclick="window.location.href='<?= base_url('profile/index/' . $u->username) ?>'">
                                                    <div class="flex items-center gap-3">
                                                        <div
                                                            class="w-12 h-12 rounded-full bg-gray-200 overflow-hidden border border-gray-100">
                                                            <img src="<?= $u->profile_photo ? base_url('uploads/' . $u->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($u->first_name) . '&background=random' ?>"
                                                                class="w-full h-full object-cover">
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <div class="flex items-center gap-1">
                                                                <span
                                                                    class="font-bold text-navy text-[15px]"><?= highlight($u->username, $query) ?></span>
                                                            </div>
                                                            <span
                                                                class="text-gray-400 text-sm"><?= highlight($u->first_name . ' ' . $u->last_name, $query) ?></span>
                                                        </div>
                                                    </div>
                                                    <button
                                                        class="px-4 py-1.5 rounded-xl border border-gray-200 text-navy font-bold text-sm hover:bg-gray-50 transition-colors">
                                                        View
                                                    </button>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($type == 'all' || $type == 'threads'): ?>
                                    <div class="section-threads <?= ($type == 'all' && $people) ? 'mt-8' : '' ?>">
                                        <?php if ($threads): ?>
                                            <h2 class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-4 px-2">
                                                Threads</h2>
                                            <?php foreach ($threads as $post): ?>
                                                <?php
                                                // Create a highlight version for display
                                                $display_post = clone $post;
                                                $display_post->content = highlight($post->content, $query);
                                                if (!empty($post->repost_comment)) {
                                                    $display_post->repost_comment = highlight($post->repost_comment, $query);
                                                }
                                                ?>
                                                <div class="mb-4">
                                                    <?php $this->load->view('components/profile_post_item', ['post' => $display_post, 'is_search' => true]); ?>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($type == 'all' || $type == 'hashtags'): ?>
                                    <div
                                        class="section-hashtags space-y-2 <?= ($type == 'all' && ($people || $threads)) ? 'mt-8' : '' ?>">
                                        <?php if ($hashtags): ?>
                                            <h2 class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-4 px-2">
                                                Hashtags</h2>
                                            <?php foreach ($hashtags as $h): ?>
                                                <div class="p-4 bg-white rounded-2xl flex items-center justify-between cursor-pointer hover:bg-gray-50 transition-colors"
                                                    onclick="setSearch('#<?= $h->tag ?>')">
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center">
                                                            <span class="font-bold text-navy">#</span>
                                                        </div>
                                                        <div>
                                                            <p class="font-bold text-navy">#<?= highlight($h->tag, $query) ?></p>
                                                            <p class="text-xs text-gray-400"><?= $h->count ?> posts</p>
                                                        </div>
                                                    </div>
                                                    <span class="material-symbols-outlined text-gray-300">chevron_right</span>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (empty($people) && empty($threads) && empty($hashtags)): ?>
                                    <div class="py-20 flex flex-col items-center text-gray-400 text-center">
                                        <p>No results found for "
                                            <?= htmlspecialchars($query) ?>"
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Mobile Bottom Navigation -->
    <nav
        class="md:hidden fixed bottom-0 left-0 right-0 h-16 bg-white/80 backdrop-blur-lg border-t border-gray-100 flex items-center justify-around px-2 z-50">
        <a href="<?= base_url('home') ?>" class="p-2 text-navy opacity-50"><span
                class="material-symbols-outlined text-[30px]">home</span></a>
        <a href="<?= base_url('search') ?>" class="p-2 text-navy"><span
                class="material-symbols-outlined text-[30px] fill-current">search</span></a>
        <button onclick="window.location.href='<?= base_url('home') ?>?create=true'"
            class="p-2 text-navy opacity-50"><span
                class="material-symbols-outlined text-[30px]">edit_square</span></button>
        <button class="p-2 text-navy opacity-50"><span
                class="material-symbols-outlined text-[30px]">favorite</span></button>
        <a href="<?= base_url('profile') ?>" class="p-2 text-navy opacity-50"><span
                class="material-symbols-outlined text-[30px]">person</span></a>
    </nav>

    <script>
        let searchTimer;
        const searchInput = document.getElementById('searchInput');
        let currentType = '<?= $type ?>';

        searchInput.addEventListener('input', (e) => {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                const q = e.target.value.trim();
                if (q.length > 0) {
                    window.location.href = `<?= base_url('search') ?>?q=${encodeURIComponent(q)}&type=${currentType}`;
                }
            }, 800);
        });

        function switchTab(type) {
            currentType = type;
            const q = searchInput.value.trim();
            window.location.href = `<?= base_url('search') ?>?q=${encodeURIComponent(q)}&type=${type}`;
        }

        function setSearch(tag) {
            window.location.href = `<?= base_url('search') ?>?q=${encodeURIComponent(tag)}`;
        }
    </script>
</body>

</html>