<?php

/**
 * Italian Translations
 *
 * @author  Jay Trees <modified-self-pickup@grandels.email>
 * @link    https://github.com/grandeljay/modified-self-pickup
 * @package GrandeljaySelfPickup
 */

use Grandeljay\SelfPickup\Constants;

$translations = array(
    /** Module */
    'TITLE'                    => 'grandeljay - collezione personale',
    'TEXT_TITLE'               => 'Auto-raccolta',
    'TEXT_TITLE_WEIGHT'        => 'Raccolta autonoma (%s kg)',
    'LONG_DESCRIPTION'         => 'Aggiunge il metodo di spedizione con auto-raccolta nel checkout.',
    'STATUS_TITLE'             => 'Stato',
    'STATUS_DESC'              => 'Selezioni Sì per attivare il modulo e No per disattivarlo.',

    /** Configuration */
    'ALLOWED_TITLE'            => '',
    'ALLOWED_DESC'             => '',

    'SORT_ORDER_TITLE'         => 'Ordinamento',
    'SORT_ORDER_DESC'          => 'Determina l\'ordinamento nell\'Admin e nel Checkout. I numeri più bassi vengono visualizzati per primi.',

    'ADDRESS_NAME_FIRST_TITLE' => 'Nome',
    'ADDRESS_NAME_FIRST_DESC'  => 'Inserisca il nome.',
    'ADDRESS_NAME_LAST_TITLE'  => 'Cognome',
    'ADDRESS_NAME_LAST_DESC'   => 'Inserisca il cognome.',
    'ADDRESS_COMPANY_TITLE'    => 'Azienda',
    'ADDRESS_COMPANY_DESC'     => 'Specificare l\'azienda.',
    'ADDRESS_STREET_TITLE'     => 'Via',
    'ADDRESS_STREET_DESC'      => 'Specificare la strada.',
    'ADDRESS_CITY_TITLE'       => 'Città',
    'ADDRESS_CITY_DESC'        => 'Specifichi la città.',
    'ADDRESS_POST_CODE_TITLE'  => 'Codice postale',
    'ADDRESS_POST_CODE_DESC'   => 'Inserisca il codice postale.',
    'ADDRESS_ZONE_TITLE'       => 'Stato',
    'ADDRESS_ZONE_DESC'        => 'Specificare lo Stato federale.',
    'ADDRESS_COUNTRY_TITLE'    => 'Paese',
    'ADDRESS_COUNTRY_DESC'     => 'Specifichi il Paese.',

    'CHECKOUT_TEXT_TITLE'      => 'Testo della cassa',
    'CHECKOUT_TEXT_DESC'       => 'Testo da visualizzare nella cassa.',
);

foreach ($translations as $key => $value) {
    $constant = Constants::MODULE_SHIPPING_NAME . '_' . $key;

    define($constant, $value);
}
