<?php
/*
    @package HSDirectBooking
    
*/

namespace HSBEInc\Pages;

use \HSBEInc\Api\SettingsApi;
use \HSBEInc\Base\BaseController;
use \HSBEInc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{
    public $settings;
    public $pages;
    public $subpages;
    public $callbacks;


    public function register()
    {

        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->setPages();

        $this->setSubPages();

        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
    }

    public function setPages(){
        $this->pages = array(
            [
                'page_title' => 'HS Booking Engine',
                'menu_title' => 'Hotel-Spider',
                'capability' => 'manage_options',
                'menu_slug'  => 'hs_booking_engine',
                'callback'   => array($this->callbacks, 'adminDashboard'),
                'icon_url'   => $this->plugin_url . '/assets/hotel-spider-logo.svg',
                'position'   => '111'
            ]
        );
    }

    public function setSubPages(){
        $this->subpages = array(
            [
                'parent_slug' => 'hs_booking_engine',
                'page_title'  => __('Settings - HS Booking Engine', 'hotel-spider'),
                'menu_title'  => __('Settings', 'hotel-spider'),
                'capability'  => 'manage_options',
                'menu_slug'   => 'hs_booking_engine_settings',
                'callback'    => array($this->callbacks, 'adminSettings'),
            ]
        );
    }

    public function setSettings(){
        $args = array(
            array(
                'option_group' => 'hs_booking_engine_configuration',
                'option_name' => 'hs_booking_engine',
                'callback' => array($this->callbacks, 'inputSanitize')
            ),
             array(
                 'option_group' => 'hs_booking_engine_configuration',
                 'option_name'  => 'hsbe_hotel_id',
                 'callback'     => array($this->callbacks, 'checkField')
             ),
        );

        $this->settings->setSettings($args);
    }

    public function setSections(){
        $args = [
            array(
                'id'       => 'hs_booking_engine_mandatory',
                'title'    => __('Mandatory Field', 'hotel-spider'),
                'callback' => array($this->callbacks, 'mandatoryFields'),
                'page'     => 'hs_booking_engine_settings'
            ),
            array(
                'id'       => 'hs_booking_engine_optional',
                'title'    => __('Optional Field', 'hotel-spider'),
                'callback' => array($this->callbacks, 'optionalFields'),
                'page'     => 'hs_booking_engine_settings'
            ),
            array(
                'id'       => 'hs_booking_engine_adults',
                'title'    => '',
                'callback' => array($this->callbacks, 'adultsFields'),
                'page'     => 'hs_booking_engine_settings'
            ),
            array(
                'id'       => 'hs_booking_engine_children',
                'title'    => '',
                'callback' => array($this->callbacks, 'childrenFields'),
                'page'     => 'hs_booking_engine_settings'
            ),
            array(
                'id'       => 'hs_booking_engine_infants',
                'title'    => '',
                'callback' => array($this->callbacks, 'infantsFields'),
                'page'     => 'hs_booking_engine_settings'
            )
        ];

        $this->settings->setSections($args);
    }

    public function setFields(){
        $args = [
            array(
                'id'       => 'hsbe_hotel_id',
                'title'    => __('Hotel ID', 'hotel-spider'),
                'callback' => array($this->callbacks, 'hotelId'),
                'page'     => 'hs_booking_engine_settings',
                'section'  => 'hs_booking_engine_mandatory',
                'args'     => array(
                    'option_name' => 'hs_booking_engine',
                    'lable_for' => 'hsbe_hotel_id',
                    'class'     => 'no_class'
                )
            ),
            array(
                'id'       => 'hsbe_channel_id',
                'title'    => __('Channel ID', 'hotel-spider'),
                'callback' => array($this->callbacks, 'textField'),
                'page'     => 'hs_booking_engine_settings',
                'section'  => 'hs_booking_engine_optional',
                'args'     => array(
                    'option_name' => 'hs_booking_engine',
                    'default'   => 387,
                    'lable_for' => 'hsbe_channel_id',
                    'class'     => 'no_class'
                )
            ),
            array(
                'id'       => 'hsbe_widget_type',
                'title'    => __('Widget Type', 'hotel-spider'),
                'callback' => array($this->callbacks, 'dropdownField'),
                'page'     => 'hs_booking_engine_settings',
                'section'  => 'hs_booking_engine_optional',
                'args'     => array(
                    'option_name' => 'hs_booking_engine',
                    'options'    => [
                        'please_select' => __('Please select', 'hotel-spider'),
                        'form'          => __('Form', 'hotel-spider'),
                        'iframe'        => __('iFrame', 'hotel-spider')
                    ],
                    'lable_for' => 'hsbe_widget_type',
                    'class'     => 'no_class'
                )
            ),
            array(
                'id'       => 'hsbe_widget_template',
                'title'    => __('Widget Template', 'hotel-spider'),
                'callback' => array($this->callbacks, 'dropdownField'),
                'page'     => 'hs_booking_engine_settings',
                'section'  => 'hs_booking_engine_optional',
                'args'     => array(
                    'option_name' => 'hs_booking_engine',
                    'options' => [
                        'please_select' => __('Please select', 'hotel-spider'),
                        'horizontal'    => __('Horizontal', 'hotel-spider'),
                        'vertical'      => __('Vertical', 'hotel-spider'),
                        'homepage'      => __('Homepage', 'hotel-spider')
                    ],
                    'lable_for' => 'hsbe_widget_template',
                    'class'     => 'no_class'
                )
            ),
            array(
                'id'       => 'hsbe_lang',
                'title'    => __('Language', 'hotel-spider'),
                'callback' => array($this->callbacks, 'dropdownField'),
                'page'     => 'hs_booking_engine_settings',
                'section'  => 'hs_booking_engine_optional',
                'args'     => array(
                    'option_name' => 'hs_booking_engine',
                    'options' => [
                        'please_select' => __('Please select', 'hotel-spider'),
                        'de'            => __('German', 'hotel-spider'),
                        'fr'            => __('French', 'hotel-spider'),
                        'en'            => __('English', 'hotel-spider')
                    ],
                    'lable_for' => 'hsbe_lang',
                    'class'     => 'no_class'
                )
            ),
            array(
                'id'         => 'hsbe_date_format',
                'title'      => __('Date Format', 'hotel-spider'),
                'callback'   => array($this->callbacks, 'dropdownField'),
                'page'       => 'hs_booking_engine_settings',
                'section'    => 'hs_booking_engine_optional',
                'args'       => array(
                    'option_name' => 'hs_booking_engine',
                    'options' => [
                        'please_select' => __('Please select', 'hotel-spider'),
                        'mm/dd/yyyy'    => 'MM/DD/YYYY',
                        'dd/mm/yyyy'    => 'DD/MM/YYYY',
                        'yyyy/mm/dd'    => 'YYYY/MM/DD',
                        'swmm/dd/yyyy'  => 'Short Weekday MM/DD/YYYY',
                        'swdd/mm/yyyy'  => 'Short Weekday DD/MM/YYYY',
                        'swyyyy/mm/dd'  => 'Short Weekday YYYY/MM/DD',
                        'mm-dd-yyyy'    => 'MM-DD-YYYY',
                        'dd-mm-yyyy'    => 'DD-MM-YYYY',
                        'yyyy-mm-dd'    => 'YYYY-MM-DD',
                        'swmm-dd-yyyy'  => 'Short Weekday MM-DD-YYYY',
                        'swdd-mm-yyyy'  => 'Short Weekday DD-MM-YYYY',
                        'swyyyy-mm-dd'  => 'Short Weekday YYYY-MM-DD',
                        'mm.dd.yyyy'    => 'MM.DD.YYYY',
                        'dd.mm.yyyy'    => 'DD.MM.YYYY',
                        'yyyy.mm.dd'    => 'YYYY.MM.DD',
                        'swmm.dd.yyyy'  => 'Short Weekday MM.DD.YYYY',
                        'swdd.mm.yyyy'  => 'Short Weekday DD.MM.YYYY',
                        'swyyyy.mm.dd'  => 'Short Weekday YYYY.MM.DD',
                        'fmdd,yyyy'     => 'Full Month DD, YYYY',
                        'ddfm,yyyy'     => 'DD Full Month, YYYY',
                        'fwfmdd,yyyy'   => 'Full Weekday Full Month DD, YYYY',
                        'fwddfm,yyyy'   => 'Full Weekday DD Full Month, YYYY',
                        'smdd,yyyy'     => 'Short Month DD, YYYY',
                        'ddsm,yyyy'     => 'DD Short Month, YYYY',
                        'swsmdd,yyyy'   => 'Short Weekday Short Month DD, YYYY',
                        'swddsm,yyyy'   => 'Short Weekday DD Short Month, YYYY'
                    ],
                    'lable_for' => 'hsbe_date_format',
                    'class'     => 'no_class'
                )
            ),
            array(
                'id'       => 'hsbe_promo_code',
                'title'    => __('Promo Code', 'hotel-spider'),
                'callback' => array($this->callbacks, 'textField'),
                'page'     => 'hs_booking_engine_settings',
                'section'  => 'hs_booking_engine_optional',
                'args'     => array(
                    'option_name' => 'hs_booking_engine',
                    'lable_for' => 'hsbe_promo_code',
                    'class'     => 'no_class',
                    'default' => null
                )
            ),
            array(
                'id'       => 'hsbe_room_id',
                'title'    => __('Specific Room ID', 'hotel-spider'),
                'callback' => array($this->callbacks, 'textField'),
                'page'     => 'hs_booking_engine_settings',
                'section'  => 'hs_booking_engine_optional',
                'args'     => array(
                    'option_name' => 'hs_booking_engine',
                    'lable_for' => 'hsbe_room_id',
                    'class'     => 'no_class',
                    'default' => null
                )
            ),
            array(
                'id'       => 'hsbe_adults_default',
                'title'    => __('Adults default value', 'hotel-spider'),
                'callback' => array($this->callbacks, 'dropdownField'),
                'page'     => 'hs_booking_engine_settings',
                'section'  => 'hs_booking_engine_adults',
                'args'     => array(
                    'option_name' => 'hs_booking_engine',
                    'options' => [
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',
                        '7' => '7',
                        '8' => '8'
                    ],
                    'lable_for' => 'hsbe_adults_default',
                    'class'     => 'no_class'
                )
            ),
            array(
                'id'       => 'hsbe_adults_min',
                'title'    => __('Adults minimum value', 'hotel-spider'),
                'callback' => array($this->callbacks, 'dropdownField'),
                'page'     => 'hs_booking_engine_settings',
                'section'  => 'hs_booking_engine_adults',
                'args'     => array(
                    'option_name' => 'hs_booking_engine',
                    'options' => [
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',
                        '7' => '7',
                        '8' => '8'
                    ],
                    'lable_for' => 'hsbe_adults_min',
                    'class'     => 'no_class'
                )
            ),
            array(
                'id'       => 'hsbe_adults_max',
                'title'    => __('Adults maximum value', 'hotel-spider'),
                'callback' => array($this->callbacks, 'dropdownField'),
                'page'     => 'hs_booking_engine_settings',
                'section'  => 'hs_booking_engine_adults',
                'args'     => array(
                    'option_name' => 'hs_booking_engine',
                    'options' => [
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',
                        '7' => '7',
                        '8' => '8'
                    ],
                    'lable_for' => 'hsbe_adults_max',
                    'class'     => 'no_class'
                )
            ),
            array(
                'id'       => 'hsbe_enable_children',
                'title'    => __('Show', 'hotel-spider'),
                'callback' => array($this->callbacks, 'dropdownField'),
                'page'     => 'hs_booking_engine_settings',
                'section'  => 'hs_booking_engine_children',
                'args'     => array(
                    'option_name' => 'hs_booking_engine',
                    'options' => [
                        '1' => __('Yes', 'hotel-spider'),
                        '0' => __('No', 'hotel-spider')
                    ],
                    'lable_for' => 'hsbe_enable_children',
                    'class'     => 'no_class'
                )
            ),
            array(
                'id'       => 'hsbe_children_default',
                'title'    => __('Children default value', 'hotel-spider'),
                'callback' => array($this->callbacks, 'dropdownField'),
                'page'     => 'hs_booking_engine_settings',
                'section'  => 'hs_booking_engine_children',
                'args'     => array(
                    'option_name' => 'hs_booking_engine',
                    'options' => [
                        '0' => '0',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4'
                    ],
                    'lable_for' => 'hsbe_children_default',
                    'class'     => 'no_class'
                )
            ),
            array(
                'id'       => 'hsbe_children_min',
                'title'    => __('Children minimum value', 'hotel-spider'),
                'callback' => array($this->callbacks, 'dropdownField'),
                'page'     => 'hs_booking_engine_settings',
                'section'  => 'hs_booking_engine_children',
                'args'     => array(
                    'option_name' => 'hs_booking_engine',
                    'options' => [
                        '0' => '0',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4'
                    ],
                    'lable_for' => 'hsbe_children_min',
                    'class'     => 'no_class'
                )
            ),
            array(
                'id'       => 'hsbe_children_max',
                'title'    => __('Children maximum value', 'hotel-spider'),
                'callback' => array($this->callbacks, 'dropdownField'),
                'page'     => 'hs_booking_engine_settings',
                'section'  => 'hs_booking_engine_children',
                'args'     => array(
                    'option_name' => 'hs_booking_engine',
                    'options' => [
                        '0' => '0',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4'
                    ],
                    'lable_for' => 'hsbe_children_max',
                    'class'     => 'no_class'
                )
            ),
            array(
                'id'       => 'hsbe_enable_infants',
                'title'    => __('Show', 'hotel-spider'),
                'callback' => array($this->callbacks, 'dropdownField'),
                'page'     => 'hs_booking_engine_settings',
                'section'  => 'hs_booking_engine_infants',
                'args'     => array(
                    'option_name' => 'hs_booking_engine',
                    'options' => [
                        '1' => __('Yes', 'hotel-spider'),
                        '0' => __('No', 'hotel-spider')
                    ],
                    'lable_for' => 'hsbe_enable_infants',
                    'class'     => 'no_class'
                )
            ),
            array(
                'id'       => 'hsbe_infants_default',
                'title'    => __('Infants default value', 'hotel-spider'),
                'callback' => array($this->callbacks, 'dropdownField'),
                'page'     => 'hs_booking_engine_settings',
                'section'  => 'hs_booking_engine_infants',
                'args'     => array(
                    'option_name' => 'hs_booking_engine',
                    'options' => [
                        '0' => '0',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4'
                    ],
                    'lable_for' => 'hsbe_infants_default',
                    'class'     => 'no_class'
                )
            ),
            array(
                'id'       => 'hsbe_infants_min',
                'title'    => __('Infants minimum value', 'hotel-spider'),
                'callback' => array($this->callbacks, 'dropdownField'),
                'page'     => 'hs_booking_engine_settings',
                'section'  => 'hs_booking_engine_infants',
                'args'     => array(
                    'option_name' => 'hs_booking_engine',
                    'options' => [
                        '0' => '0',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4'
                    ],
                    'lable_for' => 'hsbe_infants_min',
                    'class'     => 'no_class'
                )
            ),
            array(
                'id'       => 'hsbe_infants_max',
                'title'    => __('Infants maximum value', 'hotel-spider'),
                'callback' => array($this->callbacks, 'dropdownField'),
                'page'     => 'hs_booking_engine_settings',
                'section'  => 'hs_booking_engine_infants',
                'args'     => array(
                    'option_name' => 'hs_booking_engine',
                    'options' => [
                        '0' => '0',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4'
                    ],
                    'lable_for' => 'hsbe_infants_max',
                    'class'     => 'no_class'
                )
            )
        ];
        $this->settings->setFields($args);
    }
}
