<?php
add_action('init', 'create_phpjobs_post_type');
/*
 * Create phpjobs post type
 */
function create_phpjobs_post_type() {
	register_post_type( 'phpjob',
	array(
			'labels' => array(
					'name'=>__('PHP Jobs' ),
					'singular_name' => __( 'PHP Job' ),
					'add_new' => __( 'Add New'),
					'add_new_item' => __( 'Add New PHP Job'),
		            'edit' => __( 'Edit'),
		            'new_item' => __( 'New PHP Job'),
					'view' => __( 'View PHP Job'),
					'view_item' => __( 'View PHP Job'),
					'search_items' => __( 'Search PHP Jobs'),
					'not_found' => __( 'No PHP Jobs found'),
					'not_found_in_trash' => __( 'No PHP Jobs found in trash'),				
	),
			'public' => true,
	        'hierarchical' => true,
	        'has_archive' => true,
	        'rewrite' => array('slug'=>'jobs'),
			'supports' => array(
					'title', 'page-attributes', 'excerpt', 'editor', 'revisions'
	        ),
	        'taxonomies' => array('category'),  
	)
	);
}

add_action( 'add_meta_boxes', 'phpjobs_metadata_add' );
/*
 * Add phpjobs meta data
 */
function phpjobs_metadata_add()
{
	add_meta_box( 'phpjob-meta-box-id', 'phpjob data', 'phpjob_link_cb', 'phpjob', 'normal', 'high' );
}

/*
 * Code to display php job fields in the WP admin menu
 */
function phpjob_link_cb()
{
	global $post;
	$values = get_post_custom( $post->ID );

	wp_nonce_field( basename(__FILE__), 'phpjob_nonce' );
	
	phpj_add_startdate($values);
	
	phpj_add_enddate($values);
	
	phpj_add_salary($values);
	
	phpj_add_display_startdate($values);
	
	phpj_add_display_enddate($values);
	
	phpj_add_email($values);	

}
add_action( 'save_post', 'phpjob_metadata_save' );
/*
 * Save phpjob meta data
 */
function phpjob_metadata_save( $post_id )
{
	
	// Bail if doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// If nonce isn't there, or can't verify it, bail
	if( !isset( $_POST['phpjob_nonce'] ) || !wp_verify_nonce( $_POST['phpjob_nonce'], basename(__FILE__) ) ) return;

	// If current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	phpj_save_startdate($post_id);
	
	phpj_save_enddate($post_id);
	
	phpj_save_salary($post_id);
	
	phpj_save_display_startdate($post_id);
	
	phpj_save_display_enddate($post_id);
	
	phpj_save_email($post_id);	

	
}



function phpj_add_startdate ($values) {
    $job_startdate = isset( $values['job_startdate'] ) ? esc_attr( $values['job_startdate'][0] ) : "";
    ?>
 	<p><label for="job_startdate"><b>Job Start Date</b></label></p>
	<p style="color: #7a7a7a">Date in format DD-MM-YYYY</p>
	<p><input type="text" name="job_startdate" id="job_startdate" value="<?php echo $job_startdate; ?>" size="80" /></p>	
	<?php
}
function phpj_add_enddate ($values) {
    $job_enddate = isset( $values['jobenddate'] ) ? esc_attr( $values['jobenddate'][0] ) : "";
    ?>
 	<p><label for="job_enddate"><b>Job End Date (only if not a permanent role)</b></label></p>
	<p style="color: #7a7a7a">Date in format DD-MM-YYYY</p>
	<p><input type="text" name="job_enddate" id="job_enddate" value="<?php echo $job_enddate; ?>" size="80" /></p>	
	<?php
}
function phpj_add_display_startdate ($values) {
    $display_startdate = isset( $values['display_startdate'] ) ? esc_attr( $values['display_startdate'][0] ) : "";
    ?>
 	<p><label for="display_startdate"><b>Display Start Date</b></label></p>
	<p style="color: #7a7a7a">Date in format DD-MM-YYYY</p>
	<p><input type="text" name="display_startdate" id="display_startdate" value="<?php echo $display_startdate; ?>" size="80" /></p>	
	<?php
}
function phpj_add_display_enddate ($values) {
    $display_enddate = isset( $values['display_enddate'] ) ? esc_attr( $values['display_enddate'][0] ) : "";
    ?>
 	<p><label for="display_enddate"><b>Display End Date</b></label></p>
	<p style="color: #7a7a7a">Date in format DD-MM-YYYY</p>
	<p><input type="text" name="display_enddate" id="display_enddate" value="<?php echo $display_enddate; ?>" size="80" /></p>	
	<?php
}
function phpj_add_salary($values) {
    $salary = isset( $values['salary'] ) ? esc_attr( $values['salary'][0] ) : "";
    ?>
 	<p><label for="salary"><b>Salary</b></label></p>
	<p style="color: #7a7a7a">Annual salary or salary range. For example: Up to &pound;45000</p>
	<p><input type="text" name="salary" id="salary" value="<?php echo $salary; ?>" size="80" /></p>	
	<?php
}
function phpj_add_email($values) {
    $email = isset( $values['email'] ) ? esc_attr( $values['email'][0] ) : "";
    ?>
 	<p><label for="email"><b>Email to send application to</b></label></p>
	<p style="color: #7a7a7a">Email address</p>
	<p><input type="text" name="email" id="email" value="<?php echo $email; ?>" size="80" /></p>	
	<?php
}
function phpj_save_startdate($post_id) {	
	if( isset( $_POST['job_startdate'] ) ) {		
    	if(preg_match('/\d+\-\d+\-\d+/', $_POST['job_startdate'])) {
			update_post_meta( $post_id, 'job_startdate', $_POST['job_startdate'] );
    	} else {
    		update_post_meta( $post_id, 'job_startdate', '' );
    	}
	}
}
function phpj_save_enddate($post_id) {	
	if( isset( $_POST['job_enddate'] ) ) {		
    	if(preg_match('/\d+\-\d+\-\d+/', $_POST['job_enddate'])) {
			update_post_meta( $post_id, 'job_enddate', $_POST['job_enddate'] );
    	} else {
    		update_post_meta( $post_id, 'job_enddate', '' );
    	}
	}
}
function phpj_save_display_startdate($post_id) {	
	if( isset( $_POST['display_startdate'] ) ) {		
    	if(preg_match('/\d+\-\d+\-\d+/', $_POST['display_startdate'])) {
			update_post_meta( $post_id, 'display_startdate', $_POST['display_startdate'] );
    	} else {
    		update_post_meta( $post_id, 'display_startdate', '' );
    	}
	}
}
function phpj_save_display_enddate($post_id) {	
	if( isset( $_POST['display_enddate'] ) ) {		
    	if(preg_match('/\d+\-\d+\-\d+/', $_POST['display_enddate'])) {
			update_post_meta( $post_id, 'display_enddate', $_POST['display_enddate'] );
    	} else {
    		update_post_meta( $post_id, 'display_enddate', '' );
    	}
	}
}
function phpj_save_salary($post_id) {	
	if( isset( $_POST['salary'] ) ) {		
    	if(preg_match('/\w+/', $_POST['salary'])) {
			update_post_meta( $post_id, 'salary', $_POST['salary'] );
    	} else {
    		update_post_meta( $post_id, 'salary', '' );
    	}
	}
}
function phpj_save_email($post_id) {	
	if( isset( $_POST['email'] ) ) {		
    	if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			update_post_meta( $post_id, 'email', $_POST['email'] );
    	} else {
    		update_post_meta( $post_id, 'email', '' );
    	}
	}
}
function display_job_summary() {
    
    $link = get_permalink();
    $title = get_the_title();
 	$salary = get_post_meta(get_the_id(), "salary", true);
 	$start_date = get_post_meta(get_the_id(), "job_startdate", true);
 	$summary = get_the_excerpt();

 	

 	$output =  '<div class="job-title">' .
 	           $title .
 	           '</div> ' . 
 	           '<div class="job-salary"><b>Salary:</b> ' .
 	           $salary .
 	           '</div> ' . 
 	           '<div class="job-startdate"><b>Start date: </b> ' .
 	           $start_date .
 	           '</div> ' .
 	            '<div class="job-summary"><b>Summary: </b>'.	    		    
	    		$summary .	 	   	   
	    		'<br><br><b><a href="'. $link . '">Read&nbsp;more&nbsp;and&nbsp;apply&nbsp;&nbsp;&raquo;</a></b>'.
	    		'</div>';
 
	return $output;
}

function display_job() {
    
    $link = get_permalink();
    $title = get_the_title();
 	$salary = get_post_meta(get_the_id(), "salary", true);
 	$start_date = get_post_meta(get_the_id(), "job_startdate", true);
 	$email = get_post_meta(get_the_id(), "email", true);
 	$content = get_the_content();

 	

 	$output =  '<div class="job-title-single">' .
 	           $title .
 	           '</div> ' . 
 	           '<div class="job-salary"><b>Salary:</b> ' .
 	           $salary .
 	           '</div> ' . 
 	           '<div class="job-startdate"><b>Start date: </b> ' .
 	           $start_date .
 	           '</div> ' .
 	            '<div class="job-detail"><b>Description: </b>'.	    		    
	    		$content .	 	   	   
	    		'</div>';
	    		
 
	return $output;
}
function apply_to() {    
    
 	$email = get_post_meta(get_the_id(), "email", true);
 	$content = '<h3>How to apply</h2><p> To apply for this job,  have your:</p>' .
 	           '<ul class="job-apply-list">' .
 	           '<li>Cover letter</li>'.
 	           '<li>CV</li>'.
 	           '<li>Linked-In profile and/or any other relevant public profiles</li>'.
 	           '<li>Links to code, eg in github</li>' .
 	           '</ul>'.
 	           '<p>ready to hand and then click the button below to bring up email.</p>';
 	

 	$output =  '<div class="job-detail">'.	    		    
	    		$content .	 	   	   
	    		'</div>' .
	    		'<div class="job-apply-button">
	    		<a href="mailto:' . $email . '">Apply Now</a></div>';
 
	return $output;
}
/*
 * Work out if this is a current posting
 */
function isValidPosting() {
    $s = get_post_meta(get_the_id(), "display_startdate", true);
 	$e = get_post_meta(get_the_id(), "display_enddate", true);
 	
	date_default_timezone_set('UTC');

	$now = new DateTime();
	$nowInSecondsSinceEpoch = $now->format("U");
	
	$start = new DateTime($s);
	$startInSecondsSinceEpoch = $start->format("U");
	
	$end = new DateTime($e);
	$endInSecondsSinceEpoch = $end->format("U");
	
	if (( $nowInSecondsSinceEpoch > $startInSecondsSinceEpoch) && ( $nowInSecondsSinceEpoch < $endInSecondsSinceEpoch)) {
		return true;
	}
	return false;
}

