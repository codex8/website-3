<?php
/**
 * The main template file.
 */

get_header();

?>

<div id="main-container" class="row"><?php
side_nav();
?>

<div id="primary" class="ninecol last">
<div id="primary-container">
<div id="content" role="main"><?php if ( have_posts() ) : ?> <?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?> <?php
get_template_part( 'content', get_post_format() );
?> <?php endwhile; ?> 
<?php endif; ?>
<!-- #content --></div>
<!-- primary-container --></div>
<!-- #primary --></div>

<?php get_footer(); ?>