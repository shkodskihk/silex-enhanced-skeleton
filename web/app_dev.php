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

try {
    $loader = include_once BASEPATH . '/vendor/autoload.php';
    include BASEPATH . '/app/bootstrap.php';
    $app->run();
} catch( \Exception $e ) {
    // catch and report any stray exceptions...
    echo $e->getMessage();
}