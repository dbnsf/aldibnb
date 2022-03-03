<?php
get_header(); ?>


<div class="comments-section">
<hr id="hr" />

<h2>Comments section</h2>
<?php $args = array(
    'max_depth'         => '5',
    'reply_text'             => 'Reply to comment',

); ?>
<?php $args_comment = array(
'label_submit' => __('Post test')
); ?>
<?php wp_list_comments(); ?>
<?php comment_form($args_comment); ?>
</div>