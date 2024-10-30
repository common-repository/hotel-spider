<?php
/*
	@package HSDirectBooking
	
*/
namespace HSBEInc;

final class Init{
	
	
	/*
	* Store all the classes inside the array
	* @return array | Full list of classes
	*/
	public static function get_services(){
		return [
			Pages\Admin::class,
			Base\SettingsLinks::class,
			Base\Enqueue::class,
			Frontend\DisplayWidget::class,
			Base\Gutenberg::class
		];
	}
	
	/*
	* Loop through the class, initialise them
	* and call the register method if it exists
	* @return
	*/
	public static function register_services(){
		foreach(self::get_services() as $class){
			$service = self::instantiate($class);
			if(method_exists($service, 'register')){
				$service->register();
			}
		}
	}
	
	/*
	* Initialise the class
	* @return class $class | class from the services array 
	* @return class instance | New instance of the class
	*/
	private static function instantiate($class){
		$service = new $class;
		
		return $service;
	}
	
}