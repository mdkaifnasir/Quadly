<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Reports</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Fonts & Config (Same as Dashboard) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
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

<body
    class="bg-background-light dark:bg-background-dark font-display text-[#0d141b] dark:text-slate-100 h-screen flex flex-col md:flex-row overflow-hidden">

    <?php $this->load->view('admin/partials/sidebar', ['page' => 'reports']); ?>

    <main class="flex-1 flex flex-col h-full overflow-hidden relative">
        <header
            class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 p-4 z-10">
            <h2 class="text-xl font-bold">Reports</h2>
        </header>

        <div class="flex-1 overflow-y-auto p-4 md:p-8 pb-24">
            <?php if (empty($reports)): ?>
                <div class="h-full flex flex-col items-center justify-center text-slate-500">
                    <span class="material-symbols-outlined text-6xl mb-4 opacity-30">flag</span>
                    <h3 class="text-lg font-bold">No Reports Found</h3>
                    <p>Everything looks good! There are no user reports to review.</p>
                </div>
            <?php else: ?>
                <div
                    class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="border-b border-slate-100 dark:border-slate-800 text-xs uppercase text-slate-500 dark:text-slate-400 bg-slate-50/50 dark:bg-slate-900/50">
                                <th class="px-6 py-4 font-semibold">Reported User</th>
                                <th class="px-6 py-4 font-semibold">Reporter</th>
                                <th class="px-6 py-4 font-semibold">Reason</th>
                                <th class="px-6 py-4 font-semibold">Date</th>
                                <th class="px-6 py-4 font-semibold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            <?php foreach ($reports as $report): ?>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-slate-100 dark:bg-slate-800 overflow-hidden">
                                                <img src="<?= $report->reported_photo ? base_url('uploads/' . $report->reported_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($report->reported_first_name) . '&background=random' ?>"
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <p class="font-bold text-sm text-[#0d141b] dark:text-slate-100">
                                                    <?= htmlspecialchars($report->reported_first_name . ' ' . $report->reported_last_name) ?>
                                                </p>
                                                <p class="text-xs text-slate-500">
                                                    @<?= htmlspecialchars($report->reported_username) ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="size-6 rounded-full bg-slate-100 dark:bg-slate-800 overflow-hidden">
                                                <img src="<?= $report->reporter_photo ? base_url('uploads/' . $report->reporter_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($report->reporter_first_name) . '&background=random' ?>"
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <span
                                                class="text-sm"><?= htmlspecialchars($report->reporter_first_name . ' ' . $report->reporter_last_name) ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p
                                            class="text-sm font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 px-2 py-1 rounded inline-block">
                                            <?= htmlspecialchars($report->reason) ?>
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-500">
                                        <?= date('M d, Y', strtotime($report->created_at)) ?>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="<?= base_url('profile/index/' . $report->reported_user_id) ?>" target="_blank"
                                            class="text-primary hover:text-primary/80 font-bold text-sm">View Profile</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <?php $this->load->view('admin/partials/bottom_nav', ['page' => 'reports']); ?>
    </main>
</body>

</html>