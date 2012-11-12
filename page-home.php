<?php

get_header();
?>
 
     <div id="main-container" class="row">
     <?php
        side_nav();
		 
		$meetUpDetails = next_meetup();	
		?>

		<div id="primary" class="ninecol last">
		
		<div id="primary-container">
				 
			<div id="home-content" role="main">
			<div id="meetup-date">			
						
			   	<div id="next-meetup" >			
					<b>Next Meetup: <?php echo $meetUpDetails['next']['date'] ?><br></b>
					<?php echo $meetUpDetails['next']['venueAddress']?>
				</div>
				<img class="map-pin" src="<?php echo get_template_directory_uri(); ?>/images/MapPin.png" alt="MapPin">
			  
			</div>
			

			<div id="home-top-row" class="row">
			  <div id="main-image" class="fivecol">
			  <img class="main-img" src="<?php echo get_template_directory_uri(); ?>/images/MainImage.png" alt="MainImage">
			  </div>
			  
			  <div class="sevencol last">
			  <div class="home-main-content">
			  <h1>Welcome to PHP London</h1>
			  <p class='purple'>PHP London is the UK's largest PHP user group dedicated to promoting knowledge sharing and best practice amongst PHP profesionals in the London area.</p>
			  <p>Our monthly meetup is held at Google's 'Campus London' on the first Thursday of every month. With more than 100 attendees you can meet PHP users, developers and recruiters and exchange ideas, talk about code or even try and find yourself a job. Anyone interested in PHP is welcome!</p>			  
			  </div>
			  </div>
			  </div>
			  
			  <div id="home-second-row" class="row">
			  
			  <div class="sixcol">
			  <div class="home-main-content">
			  <h1>Upcoming Meetups</h1>
			  <p class="purple"> Our next meetup is <?php echo $meetUpDetails['next']['date'] ?> at <?php echo $meetUpDetails['next']['venueName'] ?></p>
			  <div class="circle"><?php echo $meetUpDetails['next']['meetupYes']; ?></div> 
			  <p class="text-by-circle">PEOPLE ATTENDING</p>
			  <p class="get-on-the-list">&raquo;&nbsp;<a href="<?php echo $meetUpDetails['next']['meetupURL']?>">Get on the list</a></p>
			  <p> <?php echo $meetUpDetails['next']['description']; ?></p>
			  <h3>Future Meetups</h3>
			  <ul>
			  <li>&nbsp;&nbsp;&raquo;&nbsp;<?php echo $meetUpDetails['plusOne']['date'] ?></li>
			  <li>&nbsp;&nbsp;&raquo;&nbsp;<?php echo $meetUpDetails['plusTwo']['date'] ?></li>
			  </ul>
			  </div>
			  </div>
			  
			  <div  class="sixcol last">
			  <div class="home-main-content">
			  <h1>Job Board</h1>
			  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>			  
			  </div>
			  </div>
			  
			  </div>
			</div>
			
			</div>
			
		</div>
		</div>

<?php get_footer(); ?>
