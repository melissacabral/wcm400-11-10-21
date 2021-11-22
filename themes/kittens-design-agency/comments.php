<?php 
/**
 * Display this file by calling comments_template() in your single templates
 */ 

//stop this file if the post is password protected
if( post_password_required() ){
	return;
}

?>
<section class="comments">
	<h3><?php comments_number('No replies', 'One reply', '% replies'); ?> on this post</h3>
	<ol class="comment-list">
		<?php wp_list_comments( array(
			'type'	=> 'comment', //hide trackbacks and pingbacks
			'avatar_size' => 50,
		) ); ?>
	</ol>
</section>

<?php if( get_option( 'page_comments' ) ){ ?>
<section class="pagination comment-pagination">
	<?php 
	previous_comments_link();
	next_comments_link();
	 ?>
</section>
<?php } //end if paginated comments?>

<section class="comment-form">	
	<?php comment_form(); ?>
</section>


<?php //if there are pings, show them
$pings_count = mmc_pings_count();
if( $pings_count ){ ?>

<section class="mentions">
	<h3><?php 
	echo $pings_count == 1 ? 
			'One Site mentions this post' : 
			"$pings_count Sites mention this post";
	 ?></h3>
	<ol class="trackback-list">
		<?php wp_list_comments(array(
			'type' 			=> 'pings', //both trackbacks and pingbacks
			'short_ping'	=> true,
		)); ?>
	</ol>
</section>

<?php } //end if pings ?>