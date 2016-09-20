<?php 
$prev_post = get_previous_post(); 
if ( ! empty( $prev_post ) ) :
?>
    <p class="prev-post">
        <a href="<?php echo get_permalink( $prev_post->ID ); ?>">&laquo;&nbsp;<?php _e('Previous Article', kopa_get_domain()); ?></a>
        <a class="article-title" href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo $prev_post->post_title; ?></a>
    </p>
<?php endif; ?>

<?php
$next_post = get_next_post();
if ( ! empty( $next_post ) ) : 
?>
    <p class="next-post">
        <a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php _e('Next Article', kopa_get_domain()); ?>&nbsp;&raquo;</a>
        <a class="article-title" href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo $next_post->post_title; ?></a>
    </p>
<?php endif; ?>