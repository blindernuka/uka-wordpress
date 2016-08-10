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
			echo '<table class="uka-program">';
			foreach ($program['events'] as $key => $event){
				
				if (($event['time_start']) && ($event['time_start'] > $day + 86400)){
					if ($day){
						echo '</tbody>';
					}
					//echo '<br>';
					$day = strtotime('midnight', $event['time_start']) + 21600;
					//echo '<thead>';
					echo '<thead class="uka-program-row uka-program-header uka-program-daytheme">';
					echo '<tr>';
					echo '<th colspan="100%">';
					echo '<span class="uka-program-daytheme-title">';
					foreach ($program['daythemes'] as $key => $daytheme){
						if (strtotime('midnight', $event['time_start']) == $daytheme['date']){
							echo $daytheme['title'];
							break;
						}
					}
					echo '</span>';
					
					echo '<span class="uka-program-daytheme-date">';
						echo '<span class="uka-program-daytheme-day">'.strftime('%A', $day).'</span>'.strftime(' %e. %B', $day).'</span>';
					
					echo '</th>';
					echo '</tr>';
					echo '</thead>';
					echo '<tbody class="uka-day">';
					
				}
				if (($event['time_start'] > $day) && ($event['time_start'] < $day + 86400)){
					$title = $event['title'];
					if ($event['link'] !== NULL){
						$title = '<a href="'.$event['link'].'">'.$title.'</a>';
					}
					echo '<tr class="uka-program-row uka-program-event ">';
					echo '<td class="event-time">'.strftime('%H:%M', $event['time_start']).'</td>';
					echo '<td class="event-location">'.$event['location'];
					echo '</td>';
					echo '<td class="event-title">'.$title.'</td>';
					echo '</tr>';
				}
			}
			echo '</tbody>';
			echo '</table>';
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
