<?php
/**
 * PHP version ~5.5
 *
 * @category Application
 * @package  Application
 * @author   Rafael Ernesto Espinosa Santiesteban <ralphlnx@gmail.com>
 * @license  MIT <http://www.opensource.org/licenses/mit-license.php>
 * @link     http://fluency.inc.com
 */

if (!defined('BASEPATH')) {
    define('BASEPATH', realpath(__DIR__ . '/../'));
}

$app = new \Fluency\Silex\Application();

// Load configurations
$app->register(
    new \Fluency\Silex\Provider\YamlConfigServiceProvider(
        array(
            '%base_path%' => BASEPATH, '%log_path%' => BASEPATH . '/var/logs',
            '%cache_path%' => BASEPATH . '/var/cache'
        )
    ),
    array(
        'config.dir' => BASEPATH . '/app/Resources/config',
        'config.files' => array(
            'application.yml', 'routing.yml', 'security.yml', 'services.yml'
        ),
    )
);

//Set debug option
$app['debug'] = $app['config']['parameters']['debug'];

//Set Timezone
if (isset($app['config']['parameters']['timezone'])) {
    date_default_timezone_set($app['config']['parameters']['timezone']);
}

// If you don't like this way you can register providers manually.
foreach ($app['config']['service_providers'] as $serviceProviderConfig) {
    $app->register(
        new $serviceProviderConfig['class'](
            (!isset($serviceProviderConfig['construct_parameters'])) ?
                null:$serviceProviderConfig['construct_parameters']
        ),
        (isset($serviceProviderConfig['parameters']) &&
        null !== $serviceProviderConfig['parameters']) ?
        $serviceProviderConfig['parameters'] : array()
    );
}

// Check and extend some service if they are available
//Extend translator
if (isset($app['translator']) AND $app['translator'] instanceof \Silex\Translator) {
    $app['translator'] = $app->share(
        $app->extend(
            'translator', function (\Silex\Translator $translator, $app) {
                $translator->addLoader(
                    'yaml',
                    new \Symfony\Component\Translation\Loader\YamlFileLoader()
                );
                $translator->addResource(
                    'yaml', BASEPATH .'/app/resources/i18n/en.yml', 'en'
                );
                $translator->addResource(
                    'yaml', BASEPATH .'/app/resources/i18n/es.yml', 'es'
                );
                return $translator;
            }
        )
    );
}

//Extend twig
if (isset($app['twig'])) {
    $app['twig'] = $app->share(
        $app->extend(
            'twig', function (Twig_Environment $twig, $app) {
                $twig->addGlobal('now', time());
                return $twig;
            }
        )
    );

    $app['twig'] = $app->share(
        $app->extend(
            'twig', function (Twig_Environment $twig, $app) {
                $twig->addFunction(
                    new \Twig_SimpleFunction(
                        'asset', function ($asset) use ($app) {
                            return sprintf(
                                $app['request']->getBasePath().'/%s',
                                ltrim($asset, '/')
                            );
                        }
                    )
                );
                return $twig;
            }
        )
    );
}

// If you don't like this way you can set routing and controllers manually.
if (isset($app['config']['routing']['controllers'])
    && isset($app['config']['routing']['routes'])
) {
    foreach ($app['config']['routing']['controllers']
        as $controllerServiceName => $controllerClass
    ) {
            $app[$controllerServiceName] = $app->share(
                function () use ($app, $controllerServiceName, $controllerClass) {
                    return new $controllerClass;
                }
            );
    }

    foreach ($app['config']['routing']['routes'] as $route) {
        $method = (isset($route['method']))?$route['method']:'get';
        $controller = $app->$method($route['pattern'], $route['controller']);
        //Bind route name, then url generator can be used
        if (isset($route['name'])) {
            $controller->bind($route['name']);
        }
    }
}
return $app;