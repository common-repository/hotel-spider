<?php
/*
	@package HSDirectBooking
	
*/
namespace HSBEInc\Frontend;

use \HSBEInc\Api\BookingEngineFields;

class DisplayWidget extends BookingEngineFields{
	private $hsbe_script = '';

	public function register(){
		$this->generateScript();

		add_shortcode('hs_booking_engine',array($this, 'generateShortcode'));
	}

	public function generateShortcode(){
		$transPrint = __('Hotel ID is not set in the plugin. Please enter Hotel ID in the settings section and check again.','hotel-spider');
		$print = '<b style="color: red;">'.$transPrint.'</b>';
		if($this->displayFlag){
			$print = '<div id="spiderBooking"></div>';
			$pre_script = '
				<script>
					window.onload = (event) => {
						
						  		jQuery("#spiderBooking").SpiderBooking4({
			';

			$post_script = '
						  		});
					};
				</script>
			';
			$print = $print.$pre_script.($this->hsbe_script).$post_script;
		}
		return $print;
	}

	private function generateScript(){
		if(!$this->displayFlag){
			return;
		}

		$enableChildren 	= 'false';
		$enableInfants 		= 'false';
		$dafaultAdults 		= 2;
		$minAdults			= 1;
		$maxAdults			= 8;
		$dafaultChildren	= 0;
		$minChildren		= 0;
		$maxChildren		= 4;
		$dafaultInfants 	= 0;
		$minInfants 		= 0;
		$maxInfants 		= 4;


		foreach ($this->general_settings as $key => $value) {

				if($key=='hsbe_enable_children'){
					if($value){
						$enableChildren = 'true';
					}
				}
				if($key=='hsbe_enable_infants'){
					if($value){
						$enableInfants = 'true';
					}
				}
				elseif($key=='hsbe_adults_default'){
					$dafaultAdults = $value;
				}
				elseif($key=='hsbe_adults_min'){
					$minAdults = $value;
				}
				elseif($key=='hsbe_adults_max'){
					$maxAdults = $value;
				}
				elseif($key=='hsbe_children_default'){
					$dafaultChildren = $value;
				}
				elseif($key=='hsbe_children_min'){
					$minChildren = $value;
				}
				elseif($key=='hsbe_children_max'){
					$maxChildren = $value;
				}
				elseif($key=='hsbe_infants_default'){
					$dafaultInfants = $value;
				}
				elseif($key=='hsbe_infants_min'){
					$minInfants = $value;
				}
				elseif($key=='hsbe_infants_max'){
					$maxInfants = $value;
				}
				else{
					if(($value!=false)){
					$this->hsbe_script = $this->hsbe_script.$key.': "'.$value.'",';
					}
				}

			
		}

		$tempScript = 'displayNbPersons:{adults:{initial:'.$dafaultAdults.',min:'.$minAdults.',max:'.$maxAdults.'},children:{display: '.$enableChildren.',initial:'.$dafaultChildren.',min:'.$minChildren.',max:'.$maxChildren.'},infants: {display: '.$enableInfants.',initial:'.$dafaultInfants.',min:'.$minInfants.',max:'.$maxInfants.'},},';

		$this->hsbe_script = $this->hsbe_script.$tempScript;
		/*
		if($value){
			$this->hsbe_script = $this->hsbe_script.'displayNbPersons:{infants: {display: true,},},';
		}
		else{
			$this->hsbe_script = $this->hsbe_script.'displayNbPersons:{infants: {display: false,},},';
		}
		*/

		if(empty($this->persons_settings)){
			return;
		}

	}
}