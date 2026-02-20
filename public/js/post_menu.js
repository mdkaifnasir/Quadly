// public/js/post_menu.js

// Global function for direct onclick handler
window.togglePostMenu = function (trigger, event) {
    if (event) {
        event.stopPropagation();
        event.preventDefault();
    }

    const container = trigger.closest('.post-menu-container');
    const sheet = container.querySelector('.post-menu-sheet');

    // Close all other open sheets first
    document.querySelectorAll('.post-menu-sheet:not([hidden])').forEach(s => {
        if (s !== sheet) s.setAttribute('hidden', '');
    });

    if (sheet.hasAttribute('hidden')) {
        sheet.removeAttribute('hidden');
    } else {
        sheet.setAttribute('hidden', '');
    }
};

document.addEventListener('DOMContentLoaded', function () {
    // Action handlers
    // Use global baseUrl defined in views, or fallback to root
    const apiBase = (typeof baseUrl !== 'undefined') ? baseUrl : '/';
    const actionMap = {
        edit: function (postId) {
            alert('Edit post modal coming soon for post ' + postId);
        },
        delete: function (postId) {
            if (!confirm('Are you sure you want to delete this post?')) return;
            fetch(`${apiBase}api/post/delete/${postId}`)
                .then(r => r.json())
                .then(d => { if (d.success) location.reload(); });
        },
        translate: function (postId) {
            fetch(`${apiBase}api/post/translate/${postId}`)
                .then(r => r.json())
                .then(d => {
                    if (d.success) {
                        const postContainer = document.querySelector(`[data-post-id="${postId}"]`).closest('article');
                        const contentEl = postContainer.querySelector('.post-content') || postContainer.querySelector('div.mt-1');
                        if (contentEl) {
                            if (!contentEl.dataset.original) contentEl.dataset.original = contentEl.textContent;
                            contentEl.textContent = contentEl.textContent.trim().startsWith('[Translated]') ? contentEl.dataset.original : d.translated;
                        }
                    }
                });
        },
        copy: function (postId) {
            fetch(`${apiBase}api/post/copy_link/${postId}`)
                .then(r => r.json())
                .then(d => {
                    if (d.success) {
                        navigator.clipboard.writeText(d.url).then(() => {
                            alert('Link copied');
                        });
                    }
                });
        },
        save: function (postId) {
            fetch(`${apiBase}api/post/save/${postId}`)
                .then(r => r.json())
                .then(d => { if (d.success) alert('Saved to collection'); });
        },
        unsave: function (postId) {
            fetch(`${apiBase}api/post/unsave/${postId}`)
                .then(r => r.json())
                .then(d => { if (d.success) alert('Removed from collection'); });
        },
        not_interested: function (postId) {
            fetch(`${apiBase}api/post/not_interested/${postId}`)
                .then(r => r.json())
                .then(d => {
                    if (d.success) {
                        const postContainer = document.querySelector(`[data-post-id="${postId}"]`).closest('article');
                        if (postContainer) postContainer.style.display = 'none';
                    }
                });
        },
        mute: function (userId) {
            fetch(`${apiBase}api/post/mute_user/${userId}`)
                .then(r => r.json())
                .then(d => { if (d.success) alert('User muted'); });
        },
        restrict: function (userId) {
            fetch(`${apiBase}api/post/restrict_user/${userId}`)
                .then(r => r.json())
                .then(d => { if (d.success) alert('User restricted'); });
        },
        block: function (userId) {
            if (!confirm('Block this user? This action cannot be undone.')) return;
            fetch(`${apiBase}api/post/block_user/${userId}`)
                .then(r => r.json())
                .then(d => { if (d.success) alert('User blocked'); });
        },
        report: function (postId) {
            const type = prompt('Report type (spam, hate, harassment, false, other):');
            if (!type) return;
            const details = prompt('Additional details (optional):');
            const body = new URLSearchParams();
            body.append('type', type);
            body.append('details', details || '');
            if (typeof csrfTokenName !== 'undefined' && typeof csrfHash !== 'undefined') {
                body.append(csrfTokenName, csrfHash);
            }

            fetch(`${apiBase}api/post/report/${postId}`, {
                method: 'POST',
                body: body
            })
                .then(r => r.json())
                .then(d => { if (d.success) alert('Report submitted'); });
        },
        close: function (postId) {
            // Just closes the menu (handled by default logic)
            console.log('Menu closed');
        }
    };

    // Event Delegation for action handlers (excluding trigger which is now inline)
    document.addEventListener('click', function (e) {
        // Handle close button click
        const closeBtn = e.target.closest('.post-menu-close-btn');
        if (closeBtn) {
            e.stopPropagation();
            const sheet = closeBtn.closest('.post-menu-sheet');
            if (sheet) sheet.setAttribute('hidden', '');
            return;
        }

        // Handle backdrop click
        if (e.target.classList.contains('post-menu-backdrop')) {
            const sheet = e.target.closest('.post-menu-sheet');
            sheet.setAttribute('hidden', '');
            return;
        }

        // Handle menu item action click
        const li = e.target.closest('.post-menu-list li');
        if (li) {
            const action = li.dataset.action;
            const container = li.closest('.post-menu-container');
            if (!container) return; // Should not happen

            const postId = container.dataset.postId;
            const targetUserId = container.dataset.userId || null;

            if (actionMap[action]) {
                if (['mute', 'restrict', 'block'].includes(action) && targetUserId) {
                    actionMap[action](targetUserId);
                } else {
                    actionMap[action](postId);
                }
                // Close sheet
                const sheet = container.querySelector('.post-menu-sheet');
                if (sheet) sheet.setAttribute('hidden', '');
            }
        }
    });

    // Close on click outside
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.post-menu-container')) {
            document.querySelectorAll('.post-menu-sheet:not([hidden])').forEach(s => s.setAttribute('hidden', ''));
        }
    });
});
