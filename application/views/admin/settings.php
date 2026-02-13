<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Settings</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
    
    <?php $this->load->view('admin/partials/sidebar', ['page' => 'settings']); ?>

    <main class="flex-1 flex flex-col h-full overflow-hidden relative">
        <header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 p-4 z-10">
            <h2 class="text-xl font-bold">Settings</h2>
        </header>

        <div class="flex-1 overflow-y-auto p-4 md:p-8 pb-24">
             <div class="max-w-2xl mx-auto space-y-4">
                 <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-4 flex items-center justify-between">
                     <div>
                         <p class="font-bold">Dark Mode</p>
                         <p class="text-xs text-slate-500">Toggle application theme</p>
                     </div>
                     <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                 </div>

                 <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-4">
                     <p class="font-bold mb-4 text-red-500">Danger Zone</p>
                     <a href="<?= base_url('auth/login') ?>" class="block w-full text-center bg-red-50 text-red-500 font-bold py-3 rounded-lg hover:bg-red-100">
                         Log Out
                     </a>
                 </div>
             </div>
        </div>
        
        <?php $this->load->view('admin/partials/bottom_nav', ['page' => 'settings']); ?>
    </main>
</body>
</html>
