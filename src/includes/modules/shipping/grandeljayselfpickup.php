<?php

/**
 * Self Pickup
 *
 * @author  Jay Trees <modified-self-pickup@grandels.email>
 * @link    https://github.com/grandeljay/modified-self-pickup
 * @package GrandeljaySelfPickup
 *
 * @phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
 * @phpcs:disable Squiz.Classes.ValidClassName.NotCamelCaps
 */

use Grandeljay\SelfPickup\Constants;
use Grandeljay\ShippingModuleHelper\OrderPacker;
use RobinTheHood\ModifiedStdModule\Classes\StdModule;

class grandeljayselfpickup extends StdModule
{
    public static function addressZone(string $zone_id, string $configuration_key): string
    {
        $country_id = constant(Constants::MODULE_SHIPPING_NAME . '_ADDRESS_COUNTRY');

        $zones_query  = xtc_db_query(
            sprintf(
                'SELECT *
                   FROM `%s`
                  WHERE `zone_country_id` = %s',
                TABLE_ZONES,
                $country_id
            )
        );
        $zones_values = array();

        if ($zones_query instanceof \mysqli_result) {
            while (is_array($zone = xtc_db_fetch_array($zones_query))) {
                $id   = $zone['zone_id'];
                $text = $zone['zone_name'];

                $zones_values[] = array(
                    'id'   => $id,
                    'text' => $text,
                );
            }
        }

        $zones_dropdown = xtc_draw_pull_down_menu(
            sprintf('configuration[%s]', $configuration_key),
            $zones_values,
            $zone_id
        );

        return $zones_dropdown;
    }

    public static function addressCountry(string $country_id, string $configuration_key): string
    {
        $countries_query  = xtc_db_query(
            sprintf(
                'SELECT *
                   FROM `%s`',
                TABLE_COUNTRIES
            )
        );
        $countries_values = array();

        if ($countries_query instanceof \mysqli_result) {
            if (extension_loaded('intl')) {
                $locale_guessed_current = sprintf(
                    '%s_%s',
                    strtolower($_SESSION['language_code']),
                    strtoupper($_SESSION['language_code'])
                );
            }

            while (is_array($country = xtc_db_fetch_array($countries_query))) {
                $id   = $country['countries_id'];
                $text = $country['countries_name'];

                if (extension_loaded('intl')) {
                    $locale_guessed_country = sprintf(
                        '%s_%s',
                        strtolower($country['countries_iso_code_2']),
                        strtoupper($country['countries_iso_code_2'])
                    );

                    $text = Locale::getDisplayRegion($locale_guessed_country, $locale_guessed_current);
                }

                $countries_values[] = array(
                    'id'   => $id,
                    'text' => $text,
                );
            }
        }

        $countries_dropdown = xtc_draw_pull_down_menu(
            sprintf('configuration[%s]', $configuration_key),
            $countries_values,
            $country_id
        );

        return $countries_dropdown;
    }

    public static function checkoutText(string $value, string $option): string
    {
        $html = '';

        $languages_query = xtc_db_query(
            sprintf(
                'SELECT *
                   FROM `%s`
                  WHERE `status`       = 1
                    AND `status_admin` = 1',
                TABLE_LANGUAGES
            )
        );

        if (extension_loaded('intl')) {
            $locale_guessed_current = sprintf(
                '%s_%s',
                strtolower($_SESSION['language_code']),
                strtoupper($_SESSION['language_code'])
            );
        }

        $checkout_texts = json_decode(htmlspecialchars_decode($value), true);

        if ($languages_query instanceof \mysqli_result) {
            while (is_array($language = xtc_db_fetch_array($languages_query))) {
                $language_name  = $language['name'];
                $language_image = xtc_image(DIR_WS_LANGUAGES . $language['directory'] . '/admin/images/' . $language['image'], $language['name']);

                if (extension_loaded('intl')) {
                    $locale_guessed_language = sprintf(
                        '%s_%s',
                        strtolower($language['code']),
                        strtoupper($language['code'])
                    );

                    $language_name = Locale::getDisplayLanguage($locale_guessed_language, $locale_guessed_current);
                }

                $checkout_text = $checkout_texts[$language['code']];

                ob_start();
                ?>
                <details>
                    <summary><?= $language_image . $language_name ?></summary>
                    <div><textarea data-name="checkout-text" data-language="<?= $language['code'] ?>"><?= $checkout_text ?></textarea></div>
                </details>
                <?php
                $html .= ob_get_clean();
            }
        }

        ob_start();
        ?>
        <textarea name="configuration[<?= $option ?>]"><?= $value ?></textarea>
        <?php
        $html .= ob_get_clean();

        return $html;
    }

    public const VERSION = '0.3.0';

    /**
     * Used by modified to determine the cheapest shipping method. Should
     * contain the return value of the `quote` method.
     *
     * @var array
     */
    public array $quotes = array();

    /**
     * Used to calculate the tax.
     *
     * @var int
     */
    public int $tax_class = 1;

    public function __construct()
    {
        parent::__construct(Constants::MODULE_SHIPPING_NAME);

        $this->addKey('SORT_ORDER');

        $this->addKey('ADDRESS_NAME_FIRST');
        $this->addKey('ADDRESS_NAME_LAST');
        $this->addKey('ADDRESS_COMPANY');
        $this->addKey('ADDRESS_STREET');
        $this->addKey('ADDRESS_CITY');
        $this->addKey('ADDRESS_POST_CODE');
        $this->addKey('ADDRESS_ZONE');
        $this->addKey('ADDRESS_COUNTRY');

        $this->addKey('CHECKOUT_TEXT');
    }

    public function install()
    {
        parent::install();

        $this->addConfiguration('ALLOWED', '', 6, 1);

        $this->addConfiguration('SORT_ORDER', 4, 6, 1);

        $address_lines  = preg_split('/\r\n|\r|\n/', \STORE_NAME_ADDRESS);
        $address_street = $address_lines[1] ?? '';
        $address_area   = $address_lines[2] ?? '';

        preg_match('/\d+/', $address_area, $address_post_code_matches);

        $address_post_code = $address_post_code_matches[0] ?? '';
        $address_city      = substr($address_area, strlen($address_post_code) + 1);

        $this->addConfiguration('ADDRESS_NAME_FIRST', '', 6, 1);
        $this->addConfiguration('ADDRESS_NAME_LAST', '', 6, 1);
        $this->addConfiguration('ADDRESS_COMPANY', \STORE_OWNER, 6, 1);
        $this->addConfiguration('ADDRESS_STREET', $address_street, 6, 1);
        $this->addConfiguration('ADDRESS_CITY', $address_city, 6, 1);
        $this->addConfiguration('ADDRESS_POST_CODE', $address_post_code, 6, 1);
        $this->addConfiguration('ADDRESS_ZONE', \STORE_ZONE, 6, 1, self::class . '::addressZone(');
        $this->addConfiguration('ADDRESS_COUNTRY', \STORE_COUNTRY, 6, 1, self::class . '::addressCountry(');

        $checkout_texts = addslashes(
            json_encode(
                array(
                    'de' => 'Selbstabholung der Ware nach vier Stunden in unserer Geschäftsstelle in Lübeck. Bestellungen außerhalb unserer Geschäftszeiten werden am nächsten Werktag bereitgestellt.',
                    'en' => 'Self-collection of the goods after four hours at our office in Lübeck. Orders placed outside our business hours will be made available on the next working day.',
                    'es' => 'Recogida de la mercancía por cuenta propia a partir de las cuatro horas en nuestra oficina de Lübeck. Los pedidos realizados fuera de nuestro horario comercial estarán disponibles el siguiente día laborable.',
                    'fr' => 'Retrait de la marchandise par vos soins après quatre heures dans nos bureaux de Lübeck. Les commandes passées en dehors de nos heures d\'ouverture sont mises à disposition le jour ouvrable suivant.',
                    'it' => 'Ritiro autonomo della merce dopo quattro ore presso il nostro ufficio di Lubecca. Gli ordini effettuati al di fuori dei nostri orari di lavoro saranno resi disponibili il giorno lavorativo successivo.',
                ),
                JSON_UNESCAPED_UNICODE
            )
        );

        $this->addConfiguration('CHECKOUT_TEXT', $checkout_texts, 6, 1, self::class . '::checkoutText(');
    }

    public function remove()
    {
        parent::remove();

        $this->removeConfiguration('ALLOWED');

        $this->removeConfiguration('SORT_ORDER');

        $this->removeConfiguration('ADDRESS_NAME_FIRST');
        $this->removeConfiguration('ADDRESS_NAME_LAST');
        $this->removeConfiguration('ADDRESS_COMPANY');
        $this->removeConfiguration('ADDRESS_STREET');
        $this->removeConfiguration('ADDRESS_CITY');
        $this->removeConfiguration('ADDRESS_POST_CODE');
        $this->removeConfiguration('ADDRESS_ZONE');
        $this->removeConfiguration('ADDRESS_COUNTRY');

        $this->removeConfiguration('CHECKOUT_TEXT');
    }

    /**
     * Used by modified to show shipping costs. Will be ignored if the value is
     * not an array.
     *
     * @var ?array
     */
    public function quote(): ?array
    {
        $lang_current = $_SESSION['language_code'] ?? 'de';

        if ('de' !== $lang_current) {
            return null;
        }

        $order_packer = new OrderPacker();
        $order_packer->setIdealWeight(15);
        $order_packer->setMaximumWeight(60);
        $order_packer->packOrder();

        $checkout_title      = sprintf(
            $this->getConfig('TEXT_TITLE_WEIGHT'),
            $order_packer->getWeightFormatted()
        );
        $checkout_texts_json = $this->getConfig('CHECKOUT_TEXT');
        $checkout_texts      = json_decode($checkout_texts_json, true);
        $checkout_text       = $checkout_texts[$_SESSION['language_code']];

        $quotes = array(
            'id'      => self::class,
            'module'  => $checkout_title,
            'methods' => array(
                array(
                    'id'    => 'self-pickup',
                    'title' => $checkout_text,
                    'cost'  => 0,
                    'type'  => 'self',
                ),
            ),
        );

        return $quotes;
    }

    public function address(): array
    {
        $country_id    = $this->getConfig('ADDRESS_COUNTRY');
        $country_query = xtc_db_query(
            sprintf(
                'SELECT *
                  FROM `%s`
                 WHERE `countries_id` = %s',
                TABLE_COUNTRIES,
                $country_id
            )
        );
        $country       = '';

        if ($country_query instanceof \mysqli_result) {
            $country         = xtc_db_fetch_array($country_query) ?: '';
            $country_address = array(
                'id'         => $country['countries_id'],
                'title'      => $country['countries_name'],
                'iso_code_2' => $country['countries_iso_code_2'],
                'iso_code_3' => $country['countries_iso_code_3'],
            );
        }

        $address = array(
            'firstname'      => $this->getConfig('ADDRESS_NAME_FIRST'),
            'lastname'       => $this->getConfig('ADDRESS_NAME_LAST'),
            'company'        => $this->getConfig('ADDRESS_COMPANY'),
            'street_address' => $this->getConfig('ADDRESS_STREET'),
            'city'           => $this->getConfig('ADDRESS_CITY'),
            'postcode'       => $this->getConfig('ADDRESS_POST_CODE'),
            'zone_id'        => $this->getConfig('ADDRESS_ZONE'),
            'country'        => $country_address,
            'country_id'     => $country['countries_id'] ?? '',
            'format_id'      => $country['address_format_id'] ?? '',
        );

        return $address;
    }

    /**
     * Do not automatically select this method as the cheapest.
     *
     * @return bool
     */
    // phpcs:ignore PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    public function ignore_cheapest(): bool
    {
        return true;
    }
}
