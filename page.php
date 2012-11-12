<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>
        <div class="twocol">
			<nav id="access" role="navigation" >
		  		<div id="menu-container">			
				<?php wp_nav_menu( array( 'theme_location' => 'primary') ); ?>
				</div>
			</nav><!-- #access -->
			<div id="social">
			</div>
		</div>

		<div id="primary" class="tencol last">
		<div id="primary-container">
			<div id="content" role="main">
			 <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', 'page' ); ?>

             <?php endwhile; // end of the loop. ?>
                			
			</div><!-- #content -->
		</div><!-- #primary-container -->
		</div><!-- #primary -->

<?php get_footer(); ?>