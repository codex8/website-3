<?php
/**
 * The template for displaying product archive pages. 
 * This generates the top level product summary page.
 *
 */
get_header(); ?>
<div id="main-container" class="row"><?php
side_nav();

?>
<div id="primary" class="ninecol last">

<div id="primary-container">	
<div id="job-listing">	
<h2>Job Listing</h2>
	     <?php if (have_posts() ) {
								
		      $number_of_current_postings = 0;
	          while ( have_posts() ) : the_post();
	           if(isValidPosting()) {
	                $number_of_current_postings++;
	     	        echo display_job_summary();
	            }
	           endwhile;
	           
	            if($number_of_current_postings++ == 0) {
	            ?>
	            <div><p>We have no jobs to advertise this month!</p>
	            <p>Advertising your job here costs &#163;50 + VAT for a month, we accept 
advertisements from companies and individuals but not from recruiters. Please read the <a href="<?php site_url()?>/JobFAQs">FAQs</a> before emailing us, thanks.</p>
<p>&nbsp;&nbsp;&raquo;&nbsp;<a href="mailto:secretary@phplondon.org?Subject=JobAdvert">Advertise your job</a></p></div>
	            <?php 
	            }
	    

	
	     } else { ?>

				<article id="post-0" class="post no-results not-found">

					<div class="entry-content">
					<div><p>We have no jobs to advertise this month!</p>
	            <p>Advertising your job here costs &#163;50 + VAT for a month, we accept 
advertisements from companies and individuals but not from recruiters. Please read the <a href="<?php site_url()?>/JobFAQs">FAQs</a> before emailing us, thanks.</p>
<p>&nbsp;&nbsp;&raquo;&nbsp;<a href="mailto:secretary@phplondon.org?Subject=JobAdvert">Advertise your job</a></p></div>
						
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php } ?>

</div><!-- job-listing -->
</div>
</div>
<?php get_footer(); ?>