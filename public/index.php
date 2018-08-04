<?php
error_reporting(E_ALL);
use Phalcon\Loader;
use Phalcon\Mvc\Router;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Application as BaseApplication;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\Collection\Manager;
use Phalcon\Db\Adapter\MongoDB\Client;

class Application extends BaseApplication
{
    /**
     * Register the services here to make them general or register in the ModuleDefinition to make them module-specific
     */
    protected function registerServices()
    {

        $di = new FactoryDefault();

        $loader = new Loader();

        $di->set(
            'url',
            function () {
                $url = new Url();

                $url->setBaseUri('http://mysomehow.vn/');

                return $url;
            }
        );

        // Initialise the mongo DB connection.
        $di->setShared('mongo', function () {
            $dsn = 'mongodb://localhost:27017';
            $mongo = new Client($dsn);
            return $mongo->selectDatabase('mysomehow');
        });

        // Collection Manager is required for MongoDB
        $di->setShared('collectionManager', function () {
            return new Manager();
        });

        /**
         * We're a registering a set of directories taken from the configuration file
         */
        $loader->registerDirs([__DIR__ . '/../apps/library/']);

        $loader->registerNamespaces(array(
            'Models' => '../apps/Models/',
            'Phalcon' => '../apps/library/incubator/Library/Phalcon/'
        ));

        $loader->register();

        // Registering a router
        $di->set('router', function () {

            $router = new Router();

            $router->setDefaultModule("frontend");

            $router->add('/:controller/:action', [
                'module'     => 'frontend',
                'controller' => 1,
                'action'     => 2,
            ])->setName('frontend');

            $router->add("/admin/home", [
                'module'     => 'backend',
            ])->setName('backend');

            $router->add('/admin/:controller/:action', [
                'module'     => 'backend',
                'controller' => 1,
                'action'     => 2,
            ])->setName('frontend-control');

            $router->add('/rockmongodb', [
                'module'     => 'Models',
            ])->setName('rockmongodb');

            return $router;
        });



        $this->setDI($di);
    }

    public function main()
    {

        $this->registerServices();

        // Register the installed modules
        $this->registerModules([
            'frontend' => [
                'className' => 'Mysomwhow\Frontend\Module',
                'path'      => '../apps/frontend/Module.php'
            ],
            'backend'  => [
                'className' => 'Mysomwhow\Backend\Module',
                'path'      => '../apps/backend/Module.php'
            ]
        ]);

        echo $this->handle()->getContent();
    }
}

$application = new Application();
$application->main();
