<?php

/**
 * German Translations
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
    'LONG_DESCRIPTION'         => 'Fügt die Self Pickup Versandmethode im Checkout ein.',
    'STATUS_TITLE'             => 'Status',
    'STATUS_DESC'              => 'Wählen Sie Ja um das Modul zu aktivieren und Nein um es zu deaktivieren.',

    /** Configuration */
    'ALLOWED_TITLE'            => '',
    'ALLOWED_DESC'             => '',

    'ADDRESS_NAME_FIRST_TITLE' => 'Vorname',
    'ADDRESS_NAME_FIRST_DESC'  => 'Geben Sie den Vornamen an.',
    'ADDRESS_NAME_LAST_TITLE'  => 'Nachname',
    'ADDRESS_NAME_LAST_DESC'   => 'Geben Sie den Nachnamen an.',
    'ADDRESS_COMPANY_TITLE'    => 'Firma',
    'ADDRESS_COMPANY_DESC'     => 'Geben Sie die Firma an.',
    'ADDRESS_STREET_TITLE'     => 'Straße',
    'ADDRESS_STREET_DESC'      => 'Geben Sie die Straße an.',
    'ADDRESS_CITY_TITLE'       => 'Stadt',
    'ADDRESS_CITY_DESC'        => 'Geben Sie die Stadt an.',
    'ADDRESS_POST_CODE_TITLE'  => 'Postleitzahl',
    'ADDRESS_POST_CODE_DESC'   => 'Geben Sie die Postleitzahl an.',
    'ADDRESS_ZONE_TITLE'       => 'Bundesland',
    'ADDRESS_ZONE_DESC'        => 'Geben Sie das Bundesland an.',
    'ADDRESS_COUNTRY_TITLE'    => 'Land',
    'ADDRESS_COUNTRY_DESC'     => 'Geben Sie das Land an.',

    'CHECKOUT_TEXT_TITLE'      => 'Checkout Text',
    'CHECKOUT_TEXT_DESC'       => 'Text der im Checkout angezeigt werden soll.',
);

foreach ($translations as $key => $value) {
    $constant = Constants::MODULE_SHIPPING_NAME . '_' . $key;

    define($constant, $value);
}
