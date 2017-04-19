<?php 
/*
Plugin Name: Spot view Cron Job
Plugin URI: http://www.veteranlogix.com
Description: This plugin registers a shortcode .You can add shortcode [veteranlogix_cron_job] to any page to view list of all scheduled crons on your wordpress website .This plugin also adds a page on wordpress backend to view all cron jobs.
Author: Mahboob Ur Rehman
Version: 1.0.0
Author URI: http://www.veteranlogix.com
*/
add_action('admin_menu', 'veteranlogix_admin_menu' );	

function veteranlogix_admin_menu(){
	add_menu_page( 'VeteranLogix Cron Show', 'VeteranLogix Cron Show',"administrator", 'veteranlogix','veteranlogix_cron_job_function' );
}
function veteranlogix_cron_job_function() {
  $cron = _get_cron_array();
  $schedules = wp_get_schedules();
  $date_format = 'M j, Y @ G:i:s';
 ?>
  <div class="wrap" id="cron-gui">
   <h2>Cron Events Scheduled</h2>
   <table class="widefat fixed">
	<thead>
	 <tr>
	  <th scope="col">Next Run (GMT/UTC)</th>
	  <th scope="col">Schedule</th>
	  <th scope="col">Hook Name</th>
	 </tr>
	</thead>
	<tbody>
	 <?php foreach ( $cron as $timestamp => $cronhooks ) { ?>
	  <?php foreach ( (array) $cronhooks as
	   $hook => $events ) { ?>
	   <?php foreach ( (array) $events as $event ) { ?>
		<tr>
		 <td><?php echo date_i18n( $date_format, wp_next_scheduled( $hook ) ); ?></td>
		 <td>
		  <?php
		  if ( $event[ 'schedule' ] ) {
		   echo $schedules[$event[ 'schedule' ]][ 'display' ];
		  } else { ?>
		   One-time
		  <?php
		  }
		  ?>
		 </td>
		 <td><?php echo $hook; ?></td>
		</tr>
	   <?php } ?>
	  <?php } ?>
	 <?php } ?>
	</tbody>
   </table>
  </div>
  <br />
  <br />
 <?php
  echo 'Current Time : ' . date('M j, Y @ G:i:s', time());
  echo "<pre>";
  print_r('');
  echo "</pre>";
  
	}
add_shortcode('veteranlogix_cron_job', 'veteranlogix_cron_job_function');	
?>