<?php

/**
 * Spanish Translations
 *
 * @author  Jay Trees <modified-self-pickup@grandels.email>
 * @link    https://github.com/grandeljay/modified-self-pickup
 * @package GrandeljaySelfPickup
 */

use Grandeljay\SelfPickup\Constants;

$translations = array(
    /** Module */
    'TITLE'                    => 'grandeljay - colección propia',
    'TEXT_TITLE'               => 'Auto-recolección',
    'TEXT_TITLE_WEIGHT'        => 'Recogida propia (%s kg)',
    'LONG_DESCRIPTION'         => 'Añade el método de envío de auto-recolección en la caja.',
    'STATUS_TITLE'             => 'Estado',
    'STATUS_DESC'              => 'Seleccione Sí para activar el módulo y No para desactivarlo.',

    /** Configuration */
    'ALLOWED_TITLE'            => '',
    'ALLOWED_DESC'             => '',

    'SORT_ORDER_TITLE'         => 'Orden de clasificación',
    'SORT_ORDER_DESC'          => 'Determina la clasificación en Admin y Checkout. Los números más bajos se muestran primero.',

    'ADDRESS_NAME_FIRST_TITLE' => 'Nombre',
    'ADDRESS_NAME_FIRST_DESC'  => 'Introduzca el nombre de pila.',
    'ADDRESS_NAME_LAST_TITLE'  => 'Apellido',
    'ADDRESS_NAME_LAST_DESC'   => 'Introduzca el apellido.',
    'ADDRESS_COMPANY_TITLE'    => 'Empresa',
    'ADDRESS_COMPANY_DESC'     => 'Especifique la empresa.',
    'ADDRESS_STREET_TITLE'     => 'Calle',
    'ADDRESS_STREET_DESC'      => 'Especifique la calle.',
    'ADDRESS_CITY_TITLE'       => 'Ciudad',
    'ADDRESS_CITY_DESC'        => 'Especifique la ciudad.',
    'ADDRESS_POST_CODE_TITLE'  => 'Código postal',
    'ADDRESS_POST_CODE_DESC'   => 'Introduzca el código postal.',
    'ADDRESS_ZONE_TITLE'       => 'Estado',
    'ADDRESS_ZONE_DESC'        => 'Especifique el estado federal.',
    'ADDRESS_COUNTRY_TITLE'    => 'País',
    'ADDRESS_COUNTRY_DESC'     => 'Especifique el país.',

    'CHECKOUT_TEXT_TITLE'      => 'Texto de pago',
    'CHECKOUT_TEXT_DESC'       => 'Texto que se mostrará en la caja.',
);

foreach ($translations as $key => $value) {
    $constant = Constants::MODULE_SHIPPING_NAME . '_' . $key;

    define($constant, $value);
}
