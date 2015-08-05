<?php
/**
 * Template Name: Site Map Page
 *
 * @package BerryMakeup
 */

get_header(); ?>

<div id="primary" class="content-area">
<main id="main" class="site-main" role="main">

	<?php while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="entry-header">
				<?php the_title( sprintf( '<h1 class="entry-title"><a 		href="%s" rel="bookmark">', esc_url( get_permalink() ) )		, '</a></h1>' ); ?>
				<?php if ( 'post' == get_post_type() ) : ?>
					<div class="entry-meta">
						<?php cd_posted_on(); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->
		
			<div class="entry-content">
				<?php the_content(); ?>
		
				<h2>Pages</h2>
   					<ul class="sitemap">
    		 		<?php wp_list_pages
  					('sort_column=menu_order&title_li='); ?>
					</ul>
		
				<h2>Categories</h2>
   					<ul class="sitemap">
    		 		<?php wp_list_categories('title_li=');?>
					</ul>
		
				<h2>Posts</h2>
   					<ul class="sitemap">
    				 <?php wp_get_archives('type=postbypost' ); ?>
					</ul>
			</div><!-- .entry-content -->
		
	</article><!-- #post-## -->
	<?php endwhile; // end of the loop. ?>
		
</main><!-- #main -->
</div><!-- #primary -->
</div><!-- #page -->
<?php get_footer(); ?>