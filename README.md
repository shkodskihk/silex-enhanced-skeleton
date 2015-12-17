# Silex Enhanced

A simple web framework for bootstrap web and console applications. For further
details check [Silex documentation](http://silex.sensiolabs.org/documentation).

On [Silex Enhanced](https://github.com/alvk4r/silex-enhanced) almost everything
works based on config. The config files are located under `app/Resources/config`.
Like [Symfony2](http://symfony.com/) supports import resources and parameters
replacement.

## Installing

### Prerequisites

- [PHP](http://php.net) version >5.4
- Apache2 web server or similar
- Composer
- Bower
### Deploying

1. Clone [Silex Enhanced](https://github.com/alvk4r/silex-enhanced) project with git.
2. Run `composer update` and `bower update`.
3. Run `php bin/console assets:install` command from console.
4. Configure your web server, create a virtual host with `path/to/project/web` as
document root.
5. Set web server write permissions.
    Ubuntu example:
    ```bash
    sudo chmod -R 775 path/to/project/var && sudo chown -R www-data:www-data path/to/project/var
    ```

6. Access your project url with web browser.

## Configuration

### config.yml
All common configs shared by both, console and web applications. Put your service
providers under `service_providers` section.

 ```yaml
 service_providers:
    monolog:
        class: Silex\Provider\MonologServiceProvider
        construct_parameters: ~
        parameters:
            monolog.logfile: %log_path%/common.log
            monolog.name: COMMON
 ...
 ```

### console.yml \& application.yml
The console and web bootstrap config respectively. If you use `imports` statement
the config will be merged recursively allows partial specific configs.

### parameters.yml
Values for config parameters substitution. On application code parameters are 
accessible through `Fluency\Silex\Application` instance 
`$app->getParameter('parameterName')` or `$app['config']['parameters']`.

### routing.yml
Holds controller service names and routes for binding.
 ```yaml
 routing:
     controllers:
         My.Controller.Service.Name: My\Controller\Class\Name
    routes:
        - { name: my_route_name, pattern: route_pattern, controller: My.Controller.Service.Name:MyAction, method: get }
 ```

### security.yml
The security firewalls and access control config. All information about it's available
[here](http://silex.sensiolabs.org/doc/providers/security.html).

## Acme demo
Simple Bootstrap 3 based demo using 
[Xeon](http://shapebootstrap.net/item/xeon-best-onepage-site-template) template from 
[Shape Bootstrap](http://shapebootstrap.net).