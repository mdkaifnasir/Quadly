<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Forgot Password - Campus App</title>
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
        <!-- Header -->
        <a href="<?= base_url('auth/login') ?>"
            class="inline-flex items-center gap-2 text-primary font-bold mb-8 hover:opacity-80 transition-opacity">
            <div class="bg-white p-2 rounded-full shadow-sm">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </div>
            Back to Login
        </a>

        <div class="bg-white rounded-[2.5rem] p-8 card-shadow text-center">

            <div class="bg-blue-50 w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-6 text-primary">
                <span class="material-symbols-outlined text-[40px]">lock_reset</span>
            </div>

            <h1 class="text-3xl font-extrabold mb-3 text-navy-dark">Forgot Password?</h1>
            <p class="text-slate-500 mb-8 leading-relaxed">
                Enter your campus email and we will send you a link to reset your password.
            </p>

            <form action="<?= base_url('auth/send_reset_link') ?>" method="POST" class="text-left space-y-4">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                    value="<?= $this->security->get_csrf_hash(); ?>">
                <div>
                    <label class="block text-sm font-bold ml-1 mb-2 text-navy-dark">Campus Email</label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">mail</span>
                        <input type="email" name="email" required
                            class="w-full h-14 pl-12 pr-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all font-medium placeholder:text-slate-400"
                            placeholder="your.name@university.edu">
                    </div>
                </div>

                <button type="submit"
                    class="w-full h-14 bg-navy-dark text-white rounded-2xl font-bold text-lg mt-4 shadow-xl shadow-navy-dark/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                    Send Reset Link
                    <span class="material-symbols-outlined">send</span>
                </button>
            </form>
        </div>

        <!-- Feedback Messages (Optional, based on Flashdata) -->
        <?php if ($this->session->flashdata('error')): ?>
            <div
                class="bg-red-50 text-red-600 p-4 rounded-2xl mt-6 text-center font-bold text-sm border border-red-100 animate-pulse">
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
            <div
                class="bg-green-50 text-green-600 p-4 rounded-2xl mt-6 text-center font-bold text-sm border border-green-100">
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

    </div>

</body>

</html>