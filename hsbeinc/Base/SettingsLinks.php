<?php
/*
	@package HSDirectBooking
	
*/
namespace HSBEInc\Base;

use \HSBEInc\Base\BaseController;

class SettingsLinks extends BaseController{
	public function register(){
		add_filter('plugin_action_links_'.$this->plugin, [$this, 'settings_link']);
	}
	
	function settings_link($links){
		$transLink = __('Settings','hotel-spider');
		$settings_link = '<a href="admin.php?page=hs_booking_engine_settings">'.$transLink.'</a>';
		array_push($links, $settings_link);
		return $links;
	}
}