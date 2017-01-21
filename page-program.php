<?php
/*
Template Name: Program
*/
?>
<?php get_header(); ?>


		
		<section id="articles" class="column">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>

			<div class="entry-content">
			
<?php

		global $program;
		
		// day calculated from 0600-0600
		//$today = strtotime('today') + 21600;
		
		$day = 0;
	
		if ($program === NULL){
			//echo __('Error retrieving eventgroup '.$data['id'], 'uka');
		}
		else if (count($program['events'] > 0)){
			echo '<table class="uka-program '.$class.'">';
			foreach ($program['events'] as $key => $event){

				if (($event['time_start']) && ($event['time_start'] > $day + 86400)){
										
					$day = strtotime('midnight', $event['time_start']) + 21600;
					
					if ($day < $today){
						$class = "past";
					}
					else if ($day == $today){
						$class = "today";
					}
					else{
						$class = "future";
					}
					
					//echo '<table class="uka-program '.$class.'">';
					echo '<thead class="uka-program-header uka-program-daytheme '.$class.'">';
					echo '<tr class="uka-program-row">';
					echo '<th colspan="3">';
					echo '<span class="uka-program-daytheme-title">';
					foreach ($program['daythemes'] as $key => $daytheme){
						if (strtotime('midnight', $day) == $daytheme['date']){
							echo $daytheme['title'];
							break;
						}
					}
					echo '</span>';
					echo '<span class="uka-program-daytheme-date">'.strftime('%A %e. %B', $day).'</span>';
					
					echo '</th>';
					echo '</tr>';
					echo '</thead>';
					echo '<tbody class="uka-day '.$class.'">';
					
				}
				if (($event['time_start'] > $day) && ($event['time_start'] < $day + 86400)){
					$title = $event['title'];
					$location = $event['location'];
					if ($event['link'] !== NULL){
						$title = '<a href="'.$event['link'].'">'.$title.'</a>';
					}
					$ticket = $event['web_selling_status'];
					if ($ticket == "sale" || $ticket == "old"){
						$title = $title.'<a class="event-ticket" href="https://billett.blindernuka.no/billett/event/'.$event['id'].'" target="_blank"><i class="fa fa-ticket" aria-hidden="true"></i></a>';
					}
					echo '<tr class="uka-program-row uka-program-event ">';
					echo '<td class="event-title">'.$title.'</td>';
					echo '<td class="event-time">'.strftime('%H:%M', $event['time_start']).'</td>';
					echo '<td class="event-location">'.$location.'</td>';
					echo '</tr>';
				}
			}
			
			echo '</tbody>';
			echo '</table>';
			//echo '<div id="uka-program-spacer"></div>';
		}
		else{
			//echo __('No events in eventgroup '.$data['id'], 'uka');
		}
?>

			</div>
			</article>
		</section>

	<?php get_sidebar(); ?>
	
<?php get_footer(); ?>
