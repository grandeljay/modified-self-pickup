<?php

/**
 * Self Pickup
 *
 * @author  Jay Trees <modified-self-pickup@grandels.email>
 * @link    https://github.com/grandeljay/modified-self-pickup
 * @package GrandeljaySelfPickup
 */

namespace Grandeljay\SelfPickup;

if (rth_is_module_disabled(Constants::MODULE_SHIPPING_NAME)) {
    return;
}

/** Only enqueue JavaScript when module settings are open */
$grandeljayselfpickup_admin_screen = array(
    'set'    => 'shipping',
    'module' => \grandeljayselfpickup::class,
    'action' => 'edit',
);

parse_str($_SERVER['QUERY_STRING'] ?? '', $query_string);

foreach ($grandeljayselfpickup_admin_screen as $key => $value) {
    if (!isset($query_string[$key]) || $query_string[$key] !== $value) {
        return;
    }
}

$file_name    = '/' . DIR_ADMIN . 'includes/javascript/grandeljayselfpickup.js';
$file_path    = DIR_FS_CATALOG .  $file_name;
$file_version = hash_file('crc32c', $file_path);
$file_url     = $file_name . '?v=' . $file_version;
?>
<script type="text/javascript" src="<?= $file_url ?>" defer></script>
