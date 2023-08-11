<?php

/**
 * French Translations
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
    'LONG_DESCRIPTION'         => 'Ajoute la méthode d\'expédition Self Pickup dans le checkout.',
    'STATUS_TITLE'             => 'Statut',
    'STATUS_DESC'              => 'Sélectionnez Oui pour activer le module et Non pour le désactiver.',

    /** Configuration */
    'ALLOWED_TITLE'            => '',
    'ALLOWED_DESC'             => '',

    'ADDRESS_NAME_FIRST_TITLE' => 'Prénom',
    'ADDRESS_NAME_FIRST_DESC'  => 'Indiquez le prénom.',
    'ADDRESS_NAME_LAST_TITLE'  => 'Nom de famille',
    'ADDRESS_NAME_LAST_DESC'   => 'Indiquez le nom de famille.',
    'ADDRESS_COMPANY_TITLE'    => 'Société',
    'ADDRESS_COMPANY_DESC'     => 'Indiquez l\'entreprise.',
    'ADDRESS_STREET_TITLE'     => 'Rue',
    'ADDRESS_STREET_DESC'      => 'Indiquez la rue.',
    'ADDRESS_CITY_TITLE'       => 'Ville',
    'ADDRESS_CITY_DESC'        => 'Indiquez la ville.',
    'ADDRESS_POST_CODE_TITLE'  => 'Code postal',
    'ADDRESS_POST_CODE_DESC'   => 'Indiquez le code postal.',
    'ADDRESS_ZONE_TITLE'       => 'État fédéral',
    'ADDRESS_ZONE_DESC'        => 'Indiquez l\'État.',
    'ADDRESS_COUNTRY_TITLE'    => 'Pays',
    'ADDRESS_COUNTRY_DESC'     => 'Indiquez le pays.',

    'CHECKOUT_TEXT_TITLE'      => 'Texte de sortie',
    'CHECKOUT_TEXT_DESC'       => 'Texte à afficher dans le checkout.',
);

foreach ($translations as $key => $value) {
    $constant = Constants::MODULE_SHIPPING_NAME . '_' . $key;

    define($constant, $value);
}
