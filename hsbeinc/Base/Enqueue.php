<?php
/*
	@package HSDirectBooking
	
*/
namespace HSBEInc\Base;

use \HSBEInc\Base\BaseController;

class Enqueue extends BaseController{
	public function register(){
		add_action('admin_enqueue_scripts', [$this, 'adminEnqueue']);
		add_action('wp_enqueue_scripts', [$this, 'fontendEnqueue']);
	}
	
	function adminEnqueue(){
		wp_enqueue_style('hsadminnstyle', $this->plugin_url.'assets/hsadminstyle.css');
		if(isset($_GET["page"])){
			if($_GET["page"] == "hs_booking_engine_settings"){
				wp_enqueue_script('hsadminscript', $this->plugin_url.'assets/hsadminscript.js', array( 'wp-i18n' ));
			}
		}
	}
	function fontendEnqueue(){
		wp_enqueue_style('hsbestyle', 'https://wbe-static.hotel-spider.com/widget/spiderBooking4.css');
		
		wp_register_script('spiderbooking4', 'https://wbe-static.hotel-spider.com/widget/spiderBooking4.js', array('jquery'), false, true);
		wp_enqueue_script('spiderbooking4');
	}
}