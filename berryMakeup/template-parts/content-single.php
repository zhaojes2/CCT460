<?php
/**
 * Template part for displaying single posts.
 *
 * @package BerryBeauty
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php berrybeauty_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<!-- check if the post has a Post Thumbnail assigned to it. -->
		<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'full' );} ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'berrybeauty' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php berrybeauty_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

