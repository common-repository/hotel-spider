<?php
/*
	@package HSDirectBooking
	
*/
namespace HSBEInc\Base;

class Activate{
	public static function activate(){
		
		flush_rewrite_rules();

		if(!get_option('hs_booking_engine')){
			update_option('hs_booking_engine',[]);
		}
		
	}
}