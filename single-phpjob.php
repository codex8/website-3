<?php
/**
 * The Template for displaying all single job posts.
 *
 */

get_header(); ?>
<div id="main-container" class="row">
<?php
side_nav();
?>
<div id="primary" class="ninecol last">

<div id="primary-container">	

  
			<?php while ( have_posts() ) : the_post(); ?>
			    <div id="job-description">
			    <?php 
			    if(isValidPosting()) {
			       echo display_job();
			       echo apply_to();
			    } else {
			        ?>
			        <div> So sorry - this job is no longer available.</div>
			        <?php
			    } 
			    ?>
				</div>
			<?php endwhile; // end of the loop. ?>


</div>
</div>
</div>

<?php get_footer(); ?>