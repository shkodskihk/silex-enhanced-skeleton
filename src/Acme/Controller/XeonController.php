<?php
/**
 * PHP version ~5.5
 *
 * @category PHPClass
 * @package  Fluency\Acme\Controller
 * @author   Rafael Ernesto Espinosa Santiesteban <ralphlnx@gmail.com>
 * @license  MIT <http://www.opensource.org/licenses/mit-license.php>
 * @link     http://fluency.inc.com
 */

namespace Fluency\Acme\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HelloController
 *
 * @category Controller
 * @package  Fluency\Acme\Controller
 * @author   Rafael Ernesto Espinosa Santiesteban <ralphlnx@gmail.com>
 * @license  MIT <http://www.opensource.org/licenses/mit-license.php>
 * @link     http://fluency.inc.com
 */
class XeonController
{
    /**
     * The home controller action
     *
     * @param Request     $request Request for this action
     * @param Application $app     Silex application instance
     *
     * @return mixed
     */
    public function homeAction(Request $request, Application $app)
    {
        return $app['twig']->render('acme/xeon/home.html.twig');
    }
}