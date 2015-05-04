<?php
/**
 * PHP version ~5.5
 *
 * @category Controller
 * @package  Fluency\Acme\Controller
 * @author   Rafael Ernesto Espinosa Santiesteban <ralphlnx@gmail.com>
 * @license  MIT <http://www.opensource.org/licenses/mit-license.php>
 * @link     http://fluency.inc.com
 */

namespace Fluency\Acme\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AdminController
 *
 * @category Controller
 * @package  Fluency\Acme\Controller
 * @author   Rafael Ernesto Espinosa Santiesteban <ralphlnx@gmail.com>
 * @license  MIT <http://www.opensource.org/licenses/mit-license.php>
 * @link     http://fluency.inc.com
 */
class AdminController
{
    /**
     * Login controller action
     *
     * @param Request     $request Request for this action
     * @param Application $app     Silex application instance
     *
     * @return mixed
     */
    public function loginAction(Request $request, Application $app)
    {
        return $app['twig']->render(
            "acme/admin/login.html.twig", array(
            'error' => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
            )
        );

    }
}