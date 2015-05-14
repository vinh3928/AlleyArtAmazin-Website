<?php
$output = $title = $date = $hours = $mins = $timer_text = $bgcolor = $el_class = '';
extract(shortcode_atts(array(
	'title'			=> '',
	'date'			=> '',
	'hours'			=> '',
	'mins' 			=> '',
	'timer_text' 	=> '',
	'bgcolor'		=> '',
	'el_class'      => '',
),$atts));

$el_class 	= $this->getExtraClass($el_class);
if( ! empty( $bgcolor ) ) {
	$bgcolor = ' '. $bgcolor;
}
if( ! empty( $el_class ) ) {
	$el_class = ' '. $el_class;
}
$target_time 		= $date . ' '. $hours .':'. $mins . ':00';
$target_time_unx 	= strtotime( $target_time );
$now_time_unx		= (int) current_time( 'timestamp' );
$difference 		=  $target_time_unx - $now_time_unx;
$difference 		= ($difference < 0) ? $difference = 0 : $difference;

if( $difference < 1 ) {
	$output .= '<p>'.  $timer_text  .'</p>';
} else {
	
	$target_year 	= getdate($target_time_unx);
	$current_year 	= getdate($now_time_unx);
	
	$output .= '<div id="clock-ticker" class="countdown-timer timer-main'. esc_attr( $el_class ) .'">';
	$output .= '<input type="hidden" class="tp-widget-date" value="'. esc_attr( $date ) .'" />
            <input type="hidden" class="tp-widget-time" value="'. esc_attr( $hours ) .':'. esc_attr( $mins ) .':00" />';
	
	$seconds	=	1000;
    $minutes	=	$seconds * 60;
    $hours		=	$minutes*60;
    $days		=	$hours*24;
    $years		=   $days*365;
	
	$difference = $difference * 1000;
	$tp_years 	= floor( $difference / $years ); 
	$tp_days 	= floor( $difference / $days ) - ( $tp_years * 365 );
	$tp_hours 	= floor( $difference/ $hours )-( $tp_days*24 )-( $tp_years*365*24 );
	$tp_minutes = floor( $difference/ $minutes )-( $tp_hours*60 )-( $tp_days*24*60 )-( $tp_years*365*24*60 );
	$tp_seconds = floor( $difference/ $seconds )-( $tp_minutes*60 )-( $tp_hours*60*60 )-( $tp_days*60*24*60 )-( $tp_years*365*24*60*60 );
	
	if( $target_year['year'] > $current_year['year'] ) {
		$output .= '<div class="block'. esc_attr( $bgcolor ) .'">
						<span class="flip-top year" id="years" class="year">'. esc_attr( $tp_years ) .'</span>
						<span class="flip-btm"></span>
						<footer class="label">'.__('Year', 'samathemes').'</footer>
					</div>';
	}
	$output .= '<div class="block'. esc_attr( $bgcolor ) .'">
					<span class="flip-top days" id="numdays">'. esc_attr( $tp_days ) .'</span>
					<span class="flip-btm"></span>
					<footer class="label">'.__('Days', 'samathemes').'</footer>
				</div>';
	$output .= '<div class="block'. esc_attr( $bgcolor ) .'">
					<span class="flip-top hours" id="numhours">'. esc_attr( ($tp_hours) ) .'</span>
					<span class="flip-btm"></span>
					<footer class="label">'.__('Hours', 'samathemes').'</footer>
				</div>';
	$output .= '<div class="block'. esc_attr( $bgcolor ) .'">
					<span class="flip-top mins" id="nummins">'. esc_attr( $tp_minutes ) .'</span>
					<span class="flip-btm"></span>
					<footer class="label">'.__('Minutes', 'samathemes').'</footer>
				</div>';
	$output .= '<div class="block'. esc_attr( $bgcolor ) .'">
					<span class="flip-top secs" id="numsecs">'. esc_attr( $tp_seconds ) .'</span>
					<span class="flip-btm"></span>
					<footer class="label">'.__('Seconds', 'samathemes').'</footer><br>
				</div>';
	$output .= '</div>';
}
echo $output;