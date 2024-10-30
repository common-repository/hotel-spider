<?php
/*
	@package HSDirectBooking
	
*/

namespace HSBEInc\Api\Callbacks;

use \HSBEInc\Base\BaseController;

class AdminCallbacks extends BaseController
{
	public function adminDashboard()
	{
		return require_once("$this->plugin_path/templates/adminDashboard.php");
	}

	public function adminSettings()
	{
		return require_once("$this->plugin_path/templates/adminSettings.php");
	}

	public function mandatoryFields($input)
	{
		//echo "These are mandatory fields";
	}

	public function optionalFields($input){
		echo "<p>"; _e('General settings:','hotel-spider');echo "</p>";
	}

	public function adultsFields($input)
	{
		echo "<p>"; _e('Adults:','hotel-spider');echo "</p>";
	}

	public function childrenFields($input)
	{
		echo "<p>"; _e('Children:','hotel-spider');echo "</p>";
	}

	public function infantsFields($input)
	{
		echo "<p>"; _e('Infants:','hotel-spider');echo "</p>";
	}

	public function checkField($input)
	{
		return $input;
	}

	public function inputSanitize($input){
		if (($input['hsbe_adults_min'] > $input['hsbe_adults_max']) || ($input['hsbe_adults_min'] > $input['hsbe_adults_default']) || ($input['hsbe_adults_max'] < $input['hsbe_adults_default'])) {
			$input['hsbe_adults_default'] = 1;
			$input['hsbe_adults_min'] = 1;
			$input['hsbe_adults_max'] = 8;
		}
		if (($input['hsbe_children_min'] > $input['hsbe_children_max']) || (!$input['hsbe_enable_children']) || ($input['hsbe_children_min'] > $input['hsbe_children_default']) || ($input['hsbe_children_max'] < $input['hsbe_children_default'])) {
			$input['hsbe_children_default'] = 0;
			$input['hsbe_children_min'] = 0;
			$input['hsbe_children_max'] = 4;
		}
		if (($input['hsbe_infants_min'] > $input['hsbe_infants_max']) || (!$input['hsbe_enable_infants']) || ($input['hsbe_infants_min'] > $input['hsbe_infants_default']) || ($input['hsbe_infants_max'] < $input['hsbe_infants_default'])) {
			$input['hsbe_infants_default'] = 0;
			$input['hsbe_infants_min'] = 0;
			$input['hsbe_infants_max'] = 4;
		}
		return $input;
	}

	public function hotelId(){
		$value = esc_attr(get_option('hsbe_hotel_id'));
		$placeholder = __('Your Hotel ID', 'hotel-spider');
		echo '<input type="text" class="regular-text" name="hsbe_hotel_id" value="' . $value . '" placeholder="' . $placeholder . '">';
	}

	public function dropdownField($args){
		$options = '';
		$name = $args['lable_for'];
		$option_name = $args['option_name'];
		$data = get_option($option_name);
		$values = $args['options'];
		$selected = isset($data[$name]) ? esc_attr($data[$name]) : null;
		foreach ($values as $key => $value) {
			$options = $options . '<option name="' . $value . '" value="' . $key . '"' . ($selected == $key ? 'selected' : null) . '>' . $value . '</option>';
		}

		echo '<select
				class="regular-text"
				name="' . $option_name . '[' . $name . ']"
				id="' . $name . '">'
				. $options .
			'</select>';
	}

	public function textField($args){
		$name = $args['lable_for'];
		$option_name = $args['option_name'];
		$data = get_option($option_name);
		$value = isset($data[$name]) ? esc_attr($data[$name]) : $args['default'];
		echo '<input 
				type="text" 
				class="regular-text" 
				id="' . $name . '"  
				name="' . $option_name . '[' . $name . ']" 
				value="' . $value . '" 
				placeholder="Select promo code"
			>';
	}
}
