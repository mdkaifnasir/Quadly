<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= isset($department) ? 'Edit' : 'Add' ?> Department - Admin</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
                },
            },
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-[#0d141b] dark:text-slate-100 min-h-screen flex items-center justify-center p-4">

<div class="w-full max-w-lg bg-white dark:bg-slate-900 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
    <div class="px-8 py-6 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
        <h1 class="text-xl font-bold"><?= isset($department) ? 'Edit' : 'Add' ?> Department</h1>
        <a href="<?= base_url('admin/departments') ?>" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
            <span class="material-symbols-outlined">close</span>
        </a>
    </div>

    <?php 
        $action = isset($department) ? 'admin/update_department/' . $department->id : 'admin/save_department';
    ?>
    <form action="<?= base_url($action) ?>" method="POST" class="px-8 py-6 space-y-6">
        
        <div class="flex flex-col gap-2">
            <label class="text-xs font-bold uppercase text-slate-500 tracking-wider">Department Name</label>
            <input type="text" name="name" value="<?= isset($department) ? htmlspecialchars($department->name) : '' ?>" placeholder="e.g. Computer Science" required class="bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-3 font-semibold focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
        </div>

        <div class="flex flex-col gap-2">
            <label class="text-xs font-bold uppercase text-slate-500 tracking-wider">Code / Abbreviation</label>
            <input type="text" name="code" value="<?= isset($department) ? htmlspecialchars($department->code) : '' ?>" placeholder="e.g. CS" required class="bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-3 font-semibold focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
        </div>

        <div class="flex items-center gap-3">
            <input type="checkbox" name="is_active" id="is_active" value="1" <?= (!isset($department) || $department->is_active) ? 'checked' : '' ?> class="w-5 h-5 rounded border-slate-300 text-primary focus:ring-primary/50">
            <label for="is_active" class="font-medium">Active Department</label>
        </div>

        <div class="pt-4 flex gap-4">
            <a href="<?= base_url('admin/departments') ?>" class="flex-1 py-3.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-bold text-center hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">Cancel</a>
            <button type="submit" class="flex-1 py-3.5 rounded-xl bg-primary text-white font-bold shadow-lg shadow-primary/30 hover:shadow-primary/50 hover:scale-[1.02] active:scale-[0.98] transition-all">Save Department</button>
        </div>
    </form>
</div>

</body>
</html>
