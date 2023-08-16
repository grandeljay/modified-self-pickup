<?php

/**
 * English Translations
 *
 * @author  Jay Trees <modified-self-pickup@grandels.email>
 * @link    https://github.com/grandeljay/modified-self-pickup
 * @package GrandeljaySelfPickup
 */

use Grandeljay\SelfPickup\Constants;

$translations = array(
    /** Module */
    'TITLE'                    => 'grandeljay - Self Pickup',
    'TEXT_TITLE'               => 'Self Pickup',
    'TEXT_TITLE_WEIGHT'        => 'Self Pickup (%s kg)',
    'LONG_DESCRIPTION'         => 'Adds the Self Pickup shipping method in the checkout.',
    'STATUS_TITLE'             => 'Status',
    'STATUS_DESC'              => 'Select Yes to activate the module and No to deactivate it.',

    /** Configuration */
    'ALLOWED_TITLE'            => '',
    'ALLOWED_DESC'             => '',

    'SORT_ORDER_TITLE'         => 'Sort order',
    'SORT_ORDER_DESC'          => 'Determines the sorting in the Admin and Checkout. Lowest numbers are displayed first.',

    'ADDRESS_NAME_FIRST_TITLE' => 'First name',
    'ADDRESS_NAME_FIRST_DESC'  => 'Enter the first name.',
    'ADDRESS_NAME_LAST_TITLE'  => 'Last name',
    'ADDRESS_NAME_LAST_DESC'   => 'Enter the surname.',
    'ADDRESS_COMPANY_TITLE'    => 'Company',
    'ADDRESS_COMPANY_DESC'     => 'Specify the company.',
    'ADDRESS_STREET_TITLE'     => 'Street',
    'ADDRESS_STREET_DESC'      => 'Specify the street.',
    'ADDRESS_CITY_TITLE'       => 'City',
    'ADDRESS_CITY_DESC'        => 'Specify the city.',
    'ADDRESS_POST_CODE_TITLE'  => 'Postcode',
    'ADDRESS_POST_CODE_DESC'   => 'Enter the postcode.',
    'ADDRESS_ZONE_TITLE'       => 'State',
    'ADDRESS_ZONE_DESC'        => 'Specify the federal state.',
    'ADDRESS_COUNTRY_TITLE'    => 'Country',
    'ADDRESS_COUNTRY_DESC'     => 'Specify the country.',

    'CHECKOUT_TEXT_TITLE'      => 'Checkout text',
    'CHECKOUT_TEXT_DESC'       => 'Text to be displayed in the checkout.',
);

foreach ($translations as $key => $value) {
    $constant = Constants::MODULE_SHIPPING_NAME . '_' . $key;

    define($constant, $value);
}
