<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 */

get_header(); ?>
 

<div id="main-container" class="row"><?php
side_nav();
?>      

		<div id="primary" class="ninecol last">
		<div id="primary-container">
			<div id="content" role="main">
			 <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', 'page' ); ?>

             <?php endwhile; // end of the loop. ?>
                			
			</div><!-- #content -->
		</div><!-- #primary-container -->
		</div><!-- #primary -->
		</div>

<?php get_footer(); ?>