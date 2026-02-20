<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Manage Departments</title>
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
<body class="bg-background-light dark:bg-background-dark font-display text-[#0d141b] dark:text-slate-100 h-screen flex overflow-hidden">

    <!-- Sidebar -->
    <?php $this->load->view('admin/partials/sidebar', ['page' => 'departments']); ?>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-full overflow-hidden">
        
        <header class="bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 px-8 py-4 flex items-center justify-between">
            <h1 class="text-xl font-bold">Departments</h1>
            <a href="<?= base_url('admin/add_department') ?>" class="bg-primary text-white font-bold px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-primary/90 transition-colors">
                <span class="material-symbols-outlined text-lg">add</span>
                Add New
            </a>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            <div class="max-w-4xl mx-auto bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-800 text-xs uppercase text-slate-500 font-semibold">
                            <th class="px-6 py-4">Department Name</th>
                            <th class="px-6 py-4">Code</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <?php if(!empty($departments)): ?>
                            <?php foreach($departments as $dept): ?>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="px-6 py-4 font-bold text-sm"><?= htmlspecialchars($dept->name) ?></td>
                                    <td class="px-6 py-4 text-sm font-mono text-slate-500"><?= htmlspecialchars($dept->code) ?></td>
                                    <td class="px-6 py-4">
                                        <?php if($dept->is_active): ?>
                                            <span class="inline-flex px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wide bg-green-100 text-green-700">Active</span>
                                        <?php else: ?>
                                            <span class="inline-flex px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wide bg-slate-100 text-slate-500">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                                        <a href="<?= base_url('admin/edit_department/' . $dept->id) ?>" class="text-slate-400 hover:text-primary p-1 rounded hover:bg-slate-100 dark:hover:bg-slate-800">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </a>
                                        <a href="<?= base_url('admin/delete_department/' . $dept->id) ?>" onclick="return confirm('Delete this department?');" class="text-slate-400 hover:text-red-500 p-1 rounded hover:bg-red-50 dark:hover:bg-red-900/20">
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-500">No departments found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>
