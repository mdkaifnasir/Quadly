<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Post Announcement</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Fonts & Config (Same as Dashboard) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
      <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: { "primary": "#1173d4", "background-light": "#f6f7f8", "background-dark": "#101922" },
                    fontFamily: { "display": ["Inter"] }
                },
            },
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-[#0d141b] dark:text-slate-100 h-screen flex flex-col md:flex-row overflow-hidden">
    
    <?php $this->load->view('admin/partials/sidebar', ['page' => 'post']); ?>

    <main class="flex-1 flex flex-col h-full overflow-hidden relative">
        <header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 p-4 z-10">
            <h2 class="text-xl font-bold">New Announcement</h2>
        </header>

        <div class="flex-1 overflow-y-auto p-4 md:p-8 pb-24">
            <div class="max-w-3xl mx-auto bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6 md:p-8">
                <form action="#" class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold mb-2">Title</label>
                        <input type="text" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 p-3" placeholder="e.g. Schedule Change">
                    </div>
                     <div>
                        <label class="block text-sm font-bold mb-2">Recipient</label>
                        <select class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 p-3">
                            <option>All Users</option>
                            <option>Faculty Only</option>
                            <option>Students Only</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2">Message</label>
                        <textarea rows="6" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 p-3" placeholder="Type your announcement here..."></textarea>
                    </div>
                    
                    <button class="w-full md:w-auto bg-primary text-white font-bold py-3 px-8 rounded-xl hover:bg-blue-600 transition-colors">Post Announcement</button>
                </form>
            </div>
        </div>
        
        <?php $this->load->view('admin/partials/bottom_nav', ['page' => 'post']); ?>
    </main>
</body>
</html>
