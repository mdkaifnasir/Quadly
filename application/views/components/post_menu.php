<?php
/**
 * Post menu component (three-dot more options) for each post.
 * Include this view within a post rendering, passing `$post` object.
 */
$current_user_id = $this->session->userdata('user_id');
$is_own_post = ($post->user_id == $current_user_id);
?>
<div class="post-menu-container" data-post-id="<?php echo $post->id; ?>" data-user-id="<?php echo $post->user_id; ?>">
    <!-- Three dot icon -->
    <button class="post-menu-trigger" aria-label="More options" type="button">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <circle cx="5" cy="12" r="2" />
            <circle cx="12" cy="12" r="2" />
            <circle cx="19" cy="12" r="2" />
        </svg>
    </button>

    <!-- Bottom sheet (hidden by default) -->
    <div class="post-menu-sheet" role="dialog" aria-modal="true" aria-label="Post options" hidden>
        <div class="post-menu-backdrop" data-action="close"></div>
        <div class="post-menu-content">
            <ul class="post-menu-list">
                <?php if ($is_own_post): ?>
                    <li data-action="edit"><i class="icon-edit"></i> Edit post</li>
                    <li data-action="delete" class="destructive"><i class="icon-delete"></i> Delete post</li>
                    <li data-action="copy"><i class="icon-copy"></i> Copy link</li>
                <?php else: ?>
                    <li data-action="translate"><i class="icon-translate"></i> See Translation</li>
                    <li data-action="copy"><i class="icon-copy"></i> Copy Link</li>
                    <li data-action="save"><i class="icon-save"></i> Save</li>
                    <li data-action="not_interested"><i class="icon-not-interested"></i> Not Interested</li>
                    <li data-action="mute"><i class="icon-mute"></i> Mute</li>
                    <li data-action="restrict"><i class="icon-restrict"></i> Restrict</li>
                    <li data-action="block" class="destructive"><i class="icon-block"></i> Block</li>
                    <li data-action="report" class="destructive"><i class="icon-report"></i> Report</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>