<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Media Monitor - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#1173d4",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Inter"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        body { min-height: 100vh; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-[#0d141b] dark:text-slate-100 transition-colors duration-200 overflow-hidden">
    <div class="flex h-screen w-full">
        
        <?php $this->load->view('admin/partials/sidebar', ['page' => 'media']); ?>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col h-full overflow-hidden">
            <!-- Header (Mobile Toggle & Title) -->
            <header class="sticky top-0 z-30 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-6 py-4">
                <div class="flex items-center gap-4">
                    <button onclick="window.history.back()" class="md:hidden text-gray-500 hover:text-gray-700">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </button>
                    <h1 class="text-xl font-bold text-slate-800 dark:text-slate-100">Media Monitor</h1>
                </div>
                
                <!-- Desktop Header Profile/Logout (Optional - for consistency) -->
                <div class="hidden md:flex items-center gap-4">
                     <div class="flex items-center gap-3 pl-4 border-l border-slate-200 dark:border-slate-700">
                        <div class="text-right">
                            <p class="text-sm font-bold">Administrator</p>
                            <p class="text-xs text-slate-500">admin@campus.edu</p>
                        </div>
                        <div class="size-9 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold">A</div>
                    </div>
                </div>
            </header>

            <!-- Media Grid -->
            <div class="flex-1 overflow-y-auto no-scrollbar p-6">
                <?php if(empty($media_files)): ?>
                    <div class="flex flex-col items-center justify-center h-64 text-gray-400">
                        <span class="material-symbols-outlined text-6xl mb-4">perm_media</span>
                        <p class="text-lg font-medium">No media found</p>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                        <?php foreach($media_files as $file): ?>
                            <div class="group relative rounded-xl overflow-hidden bg-white dark:bg-slate-900 shadow-sm hover:shadow-md transition-all border border-gray-100 dark:border-slate-800">
                                
                                <!-- Thumbnail -->
                                <div class="aspect-square bg-gray-100 dark:bg-slate-800 relative">
                                    <?php if($file->message_type === 'image'): ?>
                                        <img src="<?= base_url('uploads/' . $file->attachment_path) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    <?php else: ?>
                                        <video src="<?= base_url('uploads/' . $file->attachment_path) ?>" class="w-full h-full object-cover"></video>
                                        <div class="absolute inset-0 flex items-center justify-center bg-black/20 pointer-events-none">
                                            <span class="material-symbols-outlined text-white text-4xl drop-shadow-lg">play_circle</span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Overlay Info -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/0 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-3 text-white">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="text-xs font-semibold bg-primary/80 px-1.5 py-0.5 rounded">
                                                <?= ucfirst($file->message_type) ?>
                                            </span>
                                            <span class="text-xs opacity-75">
                                                <?= date('M d, H:i', strtotime($file->created_at)) ?>
                                            </span>
                                        </div>
                                        <div class="text-xs truncate">
                                            <span class="opacity-70">From:</span> <?= htmlspecialchars($file->sender_first . ' ' . $file->sender_last) ?>
                                        </div>
                                        <div class="text-xs truncate">
                                            <span class="opacity-70">To:</span> <?= htmlspecialchars($file->receiver_first . ' ' . $file->receiver_last) ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="<?= base_url('uploads/' . $file->attachment_path) ?>" target="_blank" class="bg-white/90 text-slate-700 hover:text-primary p-1.5 rounded-full shadow-sm flex items-center justify-center transition-colors" title="View Fullsize">
                                        <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>