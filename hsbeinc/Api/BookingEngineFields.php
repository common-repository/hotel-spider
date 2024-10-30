<?php
/*
	@package HSDirectBooking
	
*/

namespace HSBEInc\Api;


class BookingEngineFields
{
	protected $general_settings = array();
	// Only disply widget if its true
	// It will be set to true if Hotel ID is available
	protected $displayFlag		= false;


	/*
		Checking if the fields are set or not, if not set don't populate settings variables
		Constructor triggers other dedicated functions for this
	*/
	public function __construct()
	{
		$this->populateGeneralSettings();
	}

	private function populateGeneralSettings()
	{
		$hsbe_hotel_id 			= esc_attr(get_option('hsbe_hotel_id'));

		$hsbe_options = get_option('hs_booking_engine');

		$hsbe_channel_id 		= !empty($hsbe_options['hsbe_channel_id']) ? esc_attr($hsbe_options['hsbe_channel_id']): '';
		$hsbe_widget_type 		= !empty($hsbe_options['hsbe_widget_type']) ? esc_attr($hsbe_options['hsbe_widget_type']) : '';
		$hsbe_widget_template 	= !empty($hsbe_options['hsbe_widget_template']) ? esc_attr($hsbe_options['hsbe_widget_template']) : '';
		$hsbe_lang 				= !empty($hsbe_options['hsbe_lang']) ? esc_attr($hsbe_options['hsbe_lang']) : '';
		$hsbe_date_format		= !empty($hsbe_options['hsbe_date_format']) ? esc_attr($hsbe_options['hsbe_date_format']) : '';
		$hsbe_adults_default	= !empty($hsbe_options['hsbe_adults_default']) ? esc_attr($hsbe_options['hsbe_adults_default']) : '';
		$hsbe_adults_min		= !empty($hsbe_options['hsbe_adults_min']) ? esc_attr($hsbe_options['hsbe_adults_min']) : '';
		$hsbe_adults_max		= !empty($hsbe_options['hsbe_adults_max']) ? esc_attr($hsbe_options['hsbe_adults_max']) : '';
		$hsbe_enable_children	= !empty($hsbe_options['hsbe_enable_children']) ? esc_attr($hsbe_options['hsbe_enable_children']) : '';
		$hsbe_children_default	= !empty($hsbe_options['hsbe_children_default']) ? esc_attr($hsbe_options['hsbe_children_default']) : '';
		$hsbe_children_min		= !empty($hsbe_options['hsbe_children_min']) ? esc_attr($hsbe_options['hsbe_children_min']) : '';
		$hsbe_children_max		= !empty($hsbe_options['hsbe_children_max']) ? esc_attr($hsbe_options['hsbe_children_max']) : '';
		$hsbe_infants_default	= !empty($hsbe_options['hsbe_infants_default']) ? esc_attr($hsbe_options['hsbe_infants_default']) : '';
		$hsbe_infants_min		= !empty($hsbe_options['hsbe_infants_min']) ? esc_attr($hsbe_options['hsbe_infants_min']) : '';
		$hsbe_infants_max		= !empty($hsbe_options['hsbe_infants_max']) ? esc_attr($hsbe_options['hsbe_infants_max']) : '';
		$hsbe_enable_infants	= !empty($hsbe_options['hsbe_enable_infants']) ? esc_attr($hsbe_options['hsbe_enable_infants']) : '';
		$hsbe_promo_code 		= !empty($hsbe_options['hsbe_promo_code']) ? esc_attr($hsbe_options['hsbe_promo_code']) : '';
		$hsbe_room_id	 		= !empty($hsbe_options['hsbe_room_id']) ? esc_attr($hsbe_options['hsbe_room_id']) : '';

		if (!empty($hsbe_hotel_id)) {
			$this->general_settings['hotelId'] = $hsbe_hotel_id;

			$this->displayFlag = true;

			if (!empty($hsbe_channel_id)) {
				$this->general_settings['channelId'] = $hsbe_channel_id;
			} else {
				$this->general_settings['channelId'] = false;
			}

			switch ($hsbe_widget_type) {
				case 'form':
					$this->general_settings['type'] = 'form';
					break;
				case 'iframe';
					$this->general_settings['type'] = 'iframe';
					break;
				default:
					$this->general_settings['type'] = false;
			}

			switch ($hsbe_widget_template) {
				case 'horizontal':
					$this->general_settings['template'] = 'horizontal';
					break;
				case 'vertical';
					$this->general_settings['template'] = 'vertical';
					break;
				case 'homepage';
					$this->general_settings['template'] = 'homepage';
					break;
				default:
					$this->general_settings['template'] = false;
			}

			switch ($hsbe_lang) {
				case 'en':
					$this->general_settings['lang'] = 'en';
					break;
				case 'de';
					$this->general_settings['lang'] = 'de';
					break;
				case 'fr';
					$this->general_settings['lang'] = 'fr';
					break;
				default:
					$this->general_settings['lang'] = false;
			}

			switch ($hsbe_date_format) {
				case 'mm/dd/yyyy':
					$this->general_settings['dateFormat'] = 'm/d/Y';
					break;
				case 'dd/mm/yyyy';
					$this->general_settings['dateFormat'] = 'd/m/Y';
					break;
				case 'yyyy/mm/dd';
					$this->general_settings['dateFormat'] = 'Y/m/d';
					break;
				case 'swmm/dd/yyyy';
					$this->general_settings['dateFormat'] = 'D m/d/Y';
					break;
				case 'swdd/mm/yyyy';
					$this->general_settings['dateFormat'] = 'D d/m/Y';
					break;
				case 'swyyyy/mm/dd';
					$this->general_settings['dateFormat'] = 'D Y/m/d';
					break;
				case 'mm-dd-yyyy';
					$this->general_settings['dateFormat'] = 'm-d-Y';
					break;
				case 'dd-mm-yyyy';
					$this->general_settings['dateFormat'] = 'd-m-Y';
					break;
				case 'yyyy-mm-dd';
					$this->general_settings['dateFormat'] = 'Y-m-d';
					break;
				case 'swmm-dd-yyyy';
					$this->general_settings['dateFormat'] = 'D m-d-Y';
					break;
				case 'swdd-mm-yyyy';
					$this->general_settings['dateFormat'] = 'D d-m-Y';
					break;
				case 'swyyyy-mm-dd';
					$this->general_settings['dateFormat'] = 'D Y-m-d';
					break;
				case 'mm.dd.yyyy';
					$this->general_settings['dateFormat'] = 'm.d.Y';
					break;
				case 'dd.mm.yyyy';
					$this->general_settings['dateFormat'] = 'd.m.Y';
					break;
				case 'yyyy.mm.dd';
					$this->general_settings['dateFormat'] = 'Y.m.d';
					break;
				case 'swmm.dd.yyyy';
					$this->general_settings['dateFormat'] = 'D m.d.Y';
					break;
				case 'swdd.mm.yyyy';
					$this->general_settings['dateFormat'] = 'D d.m.Y';
					break;
				case 'swyyyy.mm.dd';
					$this->general_settings['dateFormat'] = 'D Y.m.d';;
					break;
				case 'fmdd,yyyy';
					$this->general_settings['dateFormat'] = 'F d, Y';
					break;
				case 'ddfm,yyyy';
					$this->general_settings['dateFormat'] = 'd F, Y';
					break;
				case 'fwfmdd,yyyy';
					$this->general_settings['dateFormat'] = 'l F d, Y';
					break;
				case 'fwddfm,yyyy';
					$this->general_settings['dateFormat'] = 'l d F, Y';
					break;
				case 'smdd,yyyy';
					$this->general_settings['dateFormat'] = 'M d, Y';
					break;
				case 'ddsm,yyyy';
					$this->general_settings['dateFormat'] = 'd M, Y';
					break;
				case 'swsmdd,yyyy';
					$this->general_settings['dateFormat'] = 'D M d, Y';
					break;
				case 'swddsm,yyyy';
					$this->general_settings['dateFormat'] = 'D f M, Y';
					break;
				default:
					$this->general_settings['dateFormat'] = false;
			}

			if (!empty($hsbe_adults_default)) {
				$this->general_settings['hsbe_adults_default'] = $hsbe_adults_default;
			} else {
				$this->general_settings['hsbe_adults_default'] = 1;
			}

			if (!empty($hsbe_adults_min)) {
				$this->general_settings['hsbe_adults_min'] = $hsbe_adults_min;
			} else {
				$this->general_settings['hsbe_adults_min'] = 1;
			}

			if (!empty($hsbe_adults_max)) {
				$this->general_settings['hsbe_adults_max'] = $hsbe_adults_max;
			} else {
				$this->general_settings['hsbe_adults_max'] = 1;
			}

			if (!empty($hsbe_enable_children)) {
				$this->general_settings['hsbe_enable_children'] = true;
			} else {
				$this->general_settings['hsbe_enable_children'] = false;
			}

			if (!empty($hsbe_children_default)) {
				$this->general_settings['hsbe_children_default'] = $hsbe_children_default;
			} else {
				$this->general_settings['hsbe_children_default'] = 0;
			}

			if (!empty($hsbe_children_min)) {
				$this->general_settings['hsbe_children_min'] = $hsbe_children_min;
			} else {
				$this->general_settings['hsbe_children_min'] = 0;
			}

			if (!empty($hsbe_children_max)) {
				$this->general_settings['hsbe_children_max'] = $hsbe_children_max;
			} else {
				$this->general_settings['hsbe_children_max'] = 0;
			}

			if (!empty($hsbe_infants_default)) {
				$this->general_settings['hsbe_infants_default'] = $hsbe_infants_default;
			} else {
				$this->general_settings['hsbe_infants_default'] = 0;
			}

			if (!empty($hsbe_enable_infants)) {
				$this->general_settings['hsbe_enable_infants'] = true;
			} else {
				$this->general_settings['hsbe_enable_infants'] = false;
			}

			if (!empty($hsbe_infants_min)) {
				$this->general_settings['hsbe_infants_min'] = $hsbe_infants_min;
			} else {
				$this->general_settings['hsbe_infants_min'] = 0;
			}

			if (!empty($hsbe_infants_max)) {
				$this->general_settings['hsbe_infants_max'] = $hsbe_infants_max;
			} else {
				$this->general_settings['hsbe_infants_max'] = 0;
			}

			if (!empty($hsbe_promo_code)) {
				$this->general_settings['promoCode'] = $hsbe_promo_code;
			} else {
				$this->general_settings['promoCode'] = false;
			}

			if (!empty($hsbe_room_id)) {
				$this->general_settings['roomId'] = $hsbe_room_id;
			} else {
				$this->general_settings['roomId'] = false;
			}
		}
	}
}
