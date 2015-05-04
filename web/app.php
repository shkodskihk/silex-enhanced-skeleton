<?php
/**
 * PHP version ~5.5
 *
 * @category FrontController
 * @package  Application
 * @author   Rafael Ernesto Espinosa Santiesteban <ralphlnx@gmail.com>
 * @license  MIT <http://www.opensource.org/licenses/mit-license.php>
 * @link     http://fluency.inc.com
 */

use Symfony\Component\ClassLoader\ApcClassLoader;

try {
    $loader = include_once BASEPATH . '/vendor/autoload.php';

    if (extension_loaded('apc') && ini_get('apc.enabled')) {
        $apcLoader = new ApcClassLoader(sha1(__FILE__), $loader);
        $loader->unregister();
        $apcLoader->register(true);
    }
    $app = include_once BASEPATH . '/app/bootstrap.php';

    $app->run();
} catch( \Exception $e ) {
    // catch and report any stray exceptions...
    echo $e->getMessage();
}