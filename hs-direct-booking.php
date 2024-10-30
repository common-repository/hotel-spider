<?php
/*
	@package HSDirectBooking
	
	Plugin Name: Spider-Booking
	Description: Hotel-Spider plugin is for implementing web-booking-engine functionality on your website. Spider-Booking is our mobile first approach to a conversion obsessed web-booking-engine. On your website you have full control over the content and story you want to transmit to your customers. An elegant booking button transforms your website into an e-commerce platform and drives your direct reservations. Your web-booking-engine is the one tool you need have to generate direct reservations on your website. Consequently, we focus on the goal of converting visitors into paying guests. Machine learning and A/B testing allows us to optimize the booking process to increase your revenue.
	Version: 1.3-beta
	Version Log: Added Gutenberg block
	Requires at least: 5.0
	Requires PHP: 7.1
	Author: Hotel-Spider
	Author URI: https://hotel-spider.com
	License: GPLv2 or later
	Text Domain: hotel-spider
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2021 Tourisoft.
*/

// Some issue with installation. Abort!!!
if(!defined('ABSPATH'))
{
	die('Hey, WordPress is not installed properly!');
}

// Require once the Composer Autoload
if(file_exists(dirname(__FILE__).'/vendor/autoload.php')){
	require_once dirname(__FILE__).'/vendor/autoload.php';
	//exit('Autoload file loaded');
}

// Plugin activation and deactivation

function activate_hs_plugin(){
	HSBEInc\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activate_hs_plugin');

function deactivate_hs_plugin(){
	HSBEInc\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate_hs_plugin');

// Initialize all the core classes of the plugin
if(class_exists('HSBEInc\\Init')){
	HSBEInc\Init::register_services();
}