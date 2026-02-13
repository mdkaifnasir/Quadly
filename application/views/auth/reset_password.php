<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Reset Password - Campus App</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap"
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
                        "primary": "#1173d4",
                        "navy-dark": "#0D1B2A",
                        "background-light": "#f6f7f8",
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "lg": "2rem",
                        "xl": "3rem",
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: "Plus Jakarta Sans", sans-serif;
            min-height: 100dvh;
        }

        .card-shadow {
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<body class="bg-background-light text-navy-dark flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-[420px]">

        <div class="bg-white rounded-[2.5rem] p-8 card-shadow text-center">

            <div class="bg-green-50 w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-6 text-green-600">
                <span class="material-symbols-outlined text-[40px]">check_circle</span>
            </div>

            <h1 class="text-3xl font-extrabold mb-3 text-navy-dark">Set New Password</h1>
            <p class="text-slate-500 mb-8 leading-relaxed">
                Your identity has been verified. Create a strong new password below.
            </p>

            <form action="<?= base_url('auth/update_password') ?>" method="POST" class="text-left space-y-4">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                    value="<?= $this->security->get_csrf_hash(); ?>">
                <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token'] ?? '') ?>">

                <div>
                    <label class="block text-sm font-bold ml-1 mb-2 text-navy-dark">New Password</label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">key</span>
                        <input type="password" name="password" id="password" required
                            class="w-full h-14 pl-12 pr-12 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all font-medium placeholder:text-slate-400"
                            placeholder="At least 8 chars">
                        <span
                            class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 cursor-pointer hover:text-primary"
                            onclick="togglePassword('password')">visibility</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold ml-1 mb-2 text-navy-dark">Confirm Password</label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">key_vertical</span>
                        <input type="password" name="confirm_password" id="confirm_password" required
                            class="w-full h-14 pl-12 pr-12 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all font-medium placeholder:text-slate-400"
                            placeholder="Re-enter password">
                        <span
                            class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 cursor-pointer hover:text-primary"
                            onclick="togglePassword('confirm_password')">visibility</span>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full h-14 bg-navy-dark text-white rounded-2xl font-bold text-lg shadow-xl shadow-navy-dark/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                        Reset Password
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                </div>
            </form>
        </div>

        <?php if ($this->session->flashdata('error')): ?>
            <div
                class="bg-red-50 text-red-600 p-4 rounded-2xl mt-6 text-center font-bold text-sm border border-red-100 animate-pulse">
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>

</body>

</html>