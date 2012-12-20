<?php
/*
 * Fix a problem which puts a 28px space at the screen on some browsers
 */
function my_function_admin_bar(){ return false; }
add_filter( 'show_admin_bar' , 'my_function_admin_bar');

/*
 * Add menu support 
 */
register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'phplon' ),
    ) );


/* 
 * Get the details of the next meetup
 */
function next_meetup() {
	
	$nextDetails = array();
	$plusOneDetails= array();
	$plusTwoDetails= array();
	
	
	
	$next_meetup = json_decode(loadFile('http://api.meetup.com/2/events?key=5b29476d622b3ba464c656e2d2c567e&sign=true&group_urlname=phplondon&page=3'));
	
	$nextDetails['meetupName'] = $next_meetup->results[0]->name;
    $nextDetails['venueName'] =  $next_meetup->results[0]->venue->name;
	$nextDetails['venueAddress'] =$next_meetup->results[0]->venue->address_1;
    $nextDetails['meetupYes'] =  $next_meetup->results[0]->yes_rsvp_count;
	$nextDetails['meetupUsers'] = $next_meetup->results[0]->group->who;
    $nextDetails['meetupURL'] = $next_meetup->results[0]->event_url;
    $nextDetails['date'] = date("F jS Y - ga", $next_meetup->results[0]->time/1000);
    $nextDetails['description'] = $next_meetup->results[0]->description;
    
    $pretty = print_r($nextDetails['description'], true);
	file_put_contents("/tmp/wtf", $pretty, FILE_APPEND);
   
    
    //Extract the agenda and talk topic if possible. Relies on keeping a consistent format in Meetup.
    
    if(preg_match('/Title:<\/span>\s*<span style="color : #000000 ; font-size : medium">(.*?)<\/span>/s', $nextDetails['description'], $matches) ) {   	
		$td= "<h2>" . $matches[1] . "</h2>";
		if(preg_match('/By:<\/span>\s*<span style="color : #000000 ; font-size : medium">(.*?)<\/span>/s', $nextDetails['description'], $matches) ) {   	
		$td .= " <br> By: <strong>" . $matches[1] . "</strong></br>";
		}
		if(preg_match('/About:<\/span>\s*<span style="color : #000000 ; font-size : medium">(.*?)<\/span>/s', $nextDetails['description'], $matches) ) {   	
		$td .= " <br>" . $matches[1];
		}
	$nextDetails['description'] = $td;	
		
    } else {
    	$nextDetails['description']= 'See <a href="'. $nextDetails['meetupURL'] .'">Meetup</a> site for details';
    }
       
    $plusOneDetails['date'] = date("F jS Y - ga", $next_meetup->results[1]->time/1000);
    $plusOneDetails['meetupURL'] = $next_meetup->results[1]->event_url;
      
    $plusTwoDetails['date'] = date("F jS Y - ga", $next_meetup->results[2]->time/1000);
    $plusTwoDetails['meetupURL'] = $next_meetup->results[2]->event_url;
    
    $meetUpDetails = array( 'next' => $nextDetails,
	                        'plusOne' => $plusOneDetails,
	                        'plusTwo' => $plusTwoDetails
	);
	

    
	return $meetUpDetails;

}

/*
 * Load and check a file.
 */
function loadFile($sFilename, $sCharset = 'UTF-8')
{
    if (floatval(phpversion()) >= 4.3) {
        $sData = file_get_contents($sFilename);
    } else {
        if (!file_exists($sFilename)) return -3;
        $rHandle = fopen($sFilename, 'r');
        if (!$rHandle) return -2;

        $sData = '';
        while(!feof($rHandle))
            $sData .= fread($rHandle, filesize($sFilename));
        fclose($rHandle);
    }
 /*TODO Temporary removal as test site does not have mb_string      
    if ($sEncoding = mb_detect_encoding($sData, 'auto', true) != $sCharset)
        $sData = @mb_convert_encoding($sData, $sCharset, $sEncoding);
 */
    return $sData;
}

function side_nav() {
	?>
	<div class="threecol">
			<nav id="access" role="navigation" >
			    <p class="menu-heading">FIND OUT MORE</p>	
		  		<div id="menu-container">				
				<?php 
				$li_image = get_template_directory_uri(). '/images/menu-bullet.png';
				wp_nav_menu( array( 'theme_location' => 'primary', 'after' => '<img src="'. $li_image . '" class="list-image" height="12px" width="12px"/>') ); ?>
				</div>
			</nav>
			<div id="social">
			   <p class="menu-heading">GET INVOLVED</p>
			   <div class="row">
			   <a href="http://www.meetup.com/phplondon/">
			   <img src="<?php echo get_template_directory_uri() ?>/images/Social1.png" class="alignright"/>
			   </a>
			   
		       </div>
		       <div class="row">
		       <a href="https://twitter.com/PHPLondon">
			   <img src="<?php echo get_template_directory_uri() ?>/images/Social2.png" class="alignright"/>
			   </a>
			   
			   </div>
		      
			</div>
		</div>
		<?php 
}
