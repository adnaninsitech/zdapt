<?php
/**
 * Plugin name: MWC Core.
 */

namespace GoDaddy\WordPress\MWC\Core;

use Exception;
use GoDaddy\WordPress\MWC\Core\Plugin\SystemPluginPatchLoader;

if (version_compare(PHP_VERSION, '7.2', '>=')) {
    require_once __DIR__.'/vendor/autoload.php';
}

try {
    // load the MWC core package
    add_action('plugins_loaded', static function () {
        try {
            if (version_compare(PHP_VERSION, '7.2', '>=')) {
                SystemPluginPatchLoader::getInstance()->load();
            }
        } catch (Exception $exception) {
            throw new \GoDaddy\WordPress\MWC\Core\Exceptions\CoreLoadingException("Failed to get core instance: {$exception->getMessage()}");
        }
    });
    // display a notice to administrators if the current installation is running an outdated version of PHP
    add_action('admin_notices', static function () {
        if (version_compare(PHP_VERSION, '7.2', '<')) {
            ?>
            <div class="notice notice-error">
                <p><strong>Your WordPress installation is using an unsupported PHP version (<?php echo PHP_VERSION; ?>).</strong> Some managed features are currently unavailable for this PHP version. <a href="https://www.godaddy.com/help/change-my-php-version-32202">View instructions for how to update your PHP version.</a></p>
            </div>
            <?php
        } elseif (version_compare(PHP_VERSION, '7.4', '<') && ! in_array('mwc-deprecated-php-version-notice', (array) get_user_meta(get_current_user_id(), '_mwc_dismissed_notices', true))) {
            ?>
            <div data-message-id="mwc-deprecated-php-version-notice" class="notice notice-warning is-dismissible">
                <p><strong>Your WordPress installation is using an old PHP version (<?php echo PHP_VERSION; ?>)</strong>. Support for PHP versions older than 8.0 will be removed in the near future, and some features may become unavailable. We encourage you to upgrade to PHP 8.0 or above. <a href='https://www.godaddy.com/help/change-my-php-version-32202'>View instructions for how to update your PHP version.</a></p>
            </div>
            <?php
        }
    }, 15);
} catch (Exception $exception) {
    // TODO: log the exception when a custom logger is added {CW 2021-02-22}
}
