<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Edit User - Admin</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
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

<body
    class="bg-background-light dark:bg-background-dark font-display text-[#0d141b] dark:text-slate-100 min-h-screen flex items-center justify-center p-4">

    <div
        class="w-full max-w-2xl bg-white dark:bg-slate-900 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
            <h1 class="text-xl font-bold">Edit User Details</h1>
            <a href="<?= base_url('admin') ?>" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                <span class="material-symbols-outlined">close</span>
            </a>
        </div>

        <form action="<?= base_url('admin/edit_user_submit/' . $user->id) ?>" method="POST" class="px-8 py-6 space-y-6">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>">

            <div class="grid grid-cols-2 gap-6">
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-bold uppercase text-slate-500 tracking-wider">First Name</label>
                    <input type="text" name="first_name" value="<?= htmlspecialchars($user->first_name) ?>"
                        class="bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-3 font-semibold focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-bold uppercase text-slate-500 tracking-wider">Last Name</label>
                    <input type="text" name="last_name" value="<?= htmlspecialchars($user->last_name) ?>"
                        class="bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-3 font-semibold focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-xs font-bold uppercase text-slate-500 tracking-wider">Email Address</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user->email) ?>"
                    class="bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-3 font-semibold focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-bold uppercase text-slate-500 tracking-wider">Student/Faculty ID</label>
                    <input type="text" name="student_id" value="<?= htmlspecialchars($user->student_id) ?>"
                        class="bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-3 font-semibold focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-bold uppercase text-slate-500 tracking-wider">Department/Major</label>
                    <select name="major"
                        class="bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-3 font-semibold focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none appearance-none">
                        <option value="">Select Department</option>
                        <?php if (isset($departments)): ?>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?= htmlspecialchars($dept->name) ?>" <?= ($user->major == $dept->name) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($dept->name) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-bold uppercase text-slate-500 tracking-wider">Role</label>
                    <select name="role"
                        class="bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-3 font-semibold focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none appearance-none">
                        <option value="student" <?= $user->role == 'student' ? 'selected' : '' ?>>Student</option>
                        <option value="faculty" <?= $user->role == 'faculty' ? 'selected' : '' ?>>Faculty</option>
                        <option value="admin" <?= $user->role == 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-bold uppercase text-slate-500 tracking-wider">Account Status</label>
                    <select name="status"
                        class="bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-3 font-semibold focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none appearance-none">
                        <option value="pending" <?= $user->status == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="active" <?= $user->status == 'active' ? 'selected' : '' ?>>Active/Verified</option>
                        <option value="suspended" <?= $user->status == 'suspended' ? 'selected' : '' ?>>Suspended</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 flex gap-4">
                <a href="<?= base_url('admin') ?>"
                    class="flex-1 py-3.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-bold text-center hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">Cancel</a>

                <button type="button"
                    onclick="if(confirm('Are you sure you want to permanently delete this user? This action cannot be undone.')) window.location.href='<?= base_url('admin/delete_user/' . $user->id) ?>'"
                    class="flex-1 py-3.5 rounded-xl bg-red-50 text-red-600 border border-red-200 font-bold hover:bg-red-100 transition-colors">
                    Delete User
                </button>

                <button type="submit"
                    class="flex-1 py-3.5 rounded-xl bg-primary text-white font-bold shadow-lg shadow-primary/30 hover:shadow-primary/50 hover:scale-[1.02] active:scale-[0.98] transition-all">Save
                    Changes</button>
            </div>
        </form>
    </div>

</body>

</html>