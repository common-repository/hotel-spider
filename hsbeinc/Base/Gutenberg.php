<?php
/*
	@package HSDirectBooking
	
*/
namespace HSBEInc\Base;

use \HSBEInc\Base\BaseController;

class Gutenberg extends BaseController{
	public function register(){
		add_action('init', [$this, 'gutenbergBlock']);
	}

	function gutenbergBlock(){
		if(function_exists('register_block_type')){
			wp_register_script('hsbe-gutenberg-js', $this->plugin_url.'/build/index.js', array('wp-blocks'));

			register_block_type('hsbe/booking-engine', array(
				'editor_script' => 'hsbe-gutenberg-js'
			));
		}
	}
}