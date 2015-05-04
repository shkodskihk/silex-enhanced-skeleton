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

// Base path
if (!defined('BASEPATH')) {
    define('BASEPATH', realpath(__DIR__ . '/../'));
}

// Runtime Environment
if (isset($_SERVER['ENVIRONMENT'])) {
    define('ENVIRONMENT', strtolower($_SERVER['ENVIRONMENT']));
} else {
    define('ENVIRONMENT', 'prod');
}

$environment = ENVIRONMENT;

if ($environment == 'prod') {
    include_once 'app.php';
} else {
    include_once "app_{$environment}.php";
}