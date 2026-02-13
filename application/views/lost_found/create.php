<?php
$data['active_page'] = 'lost_found';
$this->load->view('components/user_header', $data);
?>

<div class="flex flex-col md:flex-row min-h-screen">
    <!-- Sidebar -->
    <?php $this->load->view('components/user_sidebar', $data); ?>

    <!-- Main Content -->
    <main class="flex-1 md:ml-[72px] lg:ml-[245px] p-4 md:p-8">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center gap-4 mb-8">
                <a href="<?= base_url('lost_found') ?>"
                    class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-navy hover:bg-gray-100 transition-colors shadow-sm">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <div>
                    <h1 class="text-2xl font-extrabold text-navy">Report Item</h1>
                    <p class="text-gray-400 text-sm">Fill in the details to broadcast your report.</p>
                </div>
            </div>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-600 rounded-2xl flex items-center gap-3">
                    <span class="material-symbols-outlined">error</span>
                    <span class="font-bold"><?= $this->session->flashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <div class="glass-card rounded-[32px] overflow-hidden">
                <form method="POST" action="<?= base_url('lost_found/store') ?>" enctype="multipart/form-data"
                    class="p-8">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Item
                                    Status</label>
                                <div class="flex gap-4">
                                    <label class="flex-1 cursor-pointer">
                                        <input type="radio" name="type" value="lost" class="hidden peer" checked>
                                        <div
                                            class="p-4 rounded-2xl border-2 border-gray-100 flex flex-col items-center gap-2 peer-checked:border-red-500 peer-checked:bg-red-50 transition-all group">
                                            <span
                                                class="material-symbols-outlined text-red-500 text-3xl group-hover:scale-110 transition-transform">question_mark</span>
                                            <span class="text-sm font-bold text-navy">I Lost it</span>
                                        </div>
                                    </label>
                                    <label class="flex-1 cursor-pointer">
                                        <input type="radio" name="type" value="found" class="hidden peer">
                                        <div
                                            class="p-4 rounded-2xl border-2 border-gray-100 flex flex-col items-center gap-2 peer-checked:border-success peer-checked:bg-success/5 transition-all group">
                                            <span
                                                class="material-symbols-outlined text-success text-3xl group-hover:scale-110 transition-transform">volunteer_activism</span>
                                            <span class="text-sm font-bold text-navy">I Found it</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Item
                                    Name</label>
                                <input type="text" name="item_name" required placeholder="e.g. Blue Dell Laptop"
                                    class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 text-navy font-medium placeholder:text-gray-300">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Category</label>
                                    <select name="category"
                                        class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 text-navy font-medium">
                                        <option value="Electronics">Electronics</option>
                                        <option value="Documents">Documents</option>
                                        <option value="Personal Items">Personal</option>
                                        <option value="Others" selected>Others</option>
                                    </select>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Location</label>
                                    <input type="text" name="location" required placeholder="e.g. Block A"
                                        class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 text-navy font-medium placeholder:text-gray-300">
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Description</label>
                                <textarea name="description" rows="4"
                                    placeholder="Mention any specific marks or signs..."
                                    class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 text-navy font-medium placeholder:text-gray-300 resize-none"></textarea>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Add
                                    Photo</label>
                                <div class="relative group h-40 rounded-2xl border-2 border-dashed border-gray-200 flex flex-col items-center justify-center gap-2 hover:bg-gray-50 transition-all cursor-pointer overflow-hidden"
                                    onclick="document.getElementById('image_input').click()">
                                    <img id="preview" class="absolute inset-0 w-full h-full object-cover hidden">
                                    <div id="upload_prompt" class="flex flex-col items-center">
                                        <span
                                            class="material-symbols-outlined text-gray-300 text-4xl group-hover:scale-110 transition-transform">add_a_photo</span>
                                        <span class="text-xs font-bold text-gray-400">Click to upload</span>
                                    </div>
                                    <input type="file" name="image" id="image_input" hidden accept="image/*"
                                        onchange="handlePreview(this)">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <button type="submit"
                            class="w-full py-5 bg-gradient-to-r from-primary to-accent text-white font-extrabold rounded-[20px] shadow-xl shadow-primary/20 hover:scale-[1.01] transition-all">
                            Post to Hub
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Mobile Nav -->
    <?php $this->load->view('components/user_mobile_nav', $data); ?>
</div>

<script>
    function handlePreview(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.getElementById('preview');
                img.src = e.target.result;
                img.classList.remove('hidden');
                document.getElementById('upload_prompt').classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>

</html>