<?php
/*
Plugin Name: Aanbieders Widgets
Plugin URI: https://github.com/econtract/AnbWidgets
Description: Will be used to create several widgets for Aanbieders CE Teams.
Version: 1.0.0
Author: Imran Zahoor
Author URI: http://imranzahoor.wordpress.com/
License: A 'Slug' license name e.g. GPL2
*/

add_action( 'widgets_init', function(){
	register_widget( 'AnbWidgets\Sector_Widget' );
	register_widget( 'AnbWidgets\HomePageBanner_Widget' );
	register_widget( 'AnbWidgets\HomePageBudget_Widget' );
});
