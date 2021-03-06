<?php

namespace Tests;

use Zend\Loader\AutoloaderFactory;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\ArrayUtils;

define('ROOT_PATH', dirname(__DIR__));
chdir(__DIR__);
define('DEVELOPMENT_ENV', (getenv('APPLICATION_ENV') === 'development') ? true : false);

/**
 * Test bootstrap, for setting up auto loading
 */
class Bootstrap
{
    /**
     * @var ServiceManager
     */
    protected static $serviceManager;

    /**
     * @var array
     */
    protected static $config;

    public static function init()
    {
        static::setupAutoloader();
        static::setupConfig();
        static::setupServiceManager(self::$config);
    }

    /**
     * @return ServiceManager
     */
    public static function getServiceManager()
    {
        return static::$serviceManager;
    }

    /**
     * @return array
     */
    public static function getConfig()
    {
        return static::$config;
    }

    protected static function setupServiceManager($config)
    {
        $serviceManager = new ServiceManager(new ServiceManagerConfig());
        $serviceManager->setService('ApplicationConfig', $config);
        $serviceManager->get('ModuleManager')->loadModules();

        static::$serviceManager = $serviceManager;
    }

    protected static function setupConfig()
    {
        // Load the user-defined test configuration file, if it exists; otherwise, load
        if (is_readable(__DIR__ . '/TestConfig.php')) {
            $testConfig = include __DIR__ . '/TestConfig.php';
        } else {
            $testConfig = include __DIR__ . '/TestConfig.php.dist';
        }

        $zf2ModulePaths = array();

        if (isset($testConfig['module_listener_options']['module_paths'])) {
            $modulePaths = $testConfig['module_listener_options']['module_paths'];
            foreach ($modulePaths as $modulePath) {
                if (($path = static::findParentPath($modulePath))) {
                    $zf2ModulePaths[] = $path;
                }
            }
        }

        $zf2ModulePaths = implode(PATH_SEPARATOR, $zf2ModulePaths) . PATH_SEPARATOR;
        $zf2ModulePaths .= getenv('ZF2_MODULES_TEST_PATHS')
            ?: (defined(
                'ZF2_MODULES_TEST_PATHS'
            ) ? ZF2_MODULES_TEST_PATHS : '');

        // use ModuleManager to load this module and it's dependencies
        $baseConfig = array(
            'module_listener_options' => array(
                'module_paths' => explode(PATH_SEPARATOR, $zf2ModulePaths),
            ),
        );

        static::$config = ArrayUtils::merge($baseConfig, $testConfig);
    }

    protected static function findParentPath($path)
    {
        $dir = __DIR__;
        $previousDir = '.';
        while (!is_dir($dir . '/' . $path)) {
            $dir = dirname($dir);
            if ($previousDir === $dir) {
                return false;
            }
            $previousDir = $dir;
        }

        return $dir . '/' . $path;
    }

    protected static function setupAutoloader()
    {
        $vendorPath = ROOT_PATH . '/vendor';
        $zf2Path = $vendorPath . '/zendframework/zendframework/library';

        if (!$zf2Path) {
            throw new \RuntimeException('Unable to load ZF2. Run `php composer.phar install` or define a ZF2_PATH environment variable.');
        }

        if (file_exists($vendorPath . '/autoload.php')) {
            include $vendorPath . '/autoload.php';
        } else {
            die("Could not get composer/autoload.php");
        }

        include $zf2Path . '/Zend/Loader/AutoloaderFactory.php';

        AutoloaderFactory::factory(
            array(
                'Zend\Loader\StandardAutoloader' => array(
                    'autoregister_zf' => true,
                    'namespaces'      => array(
                        __NAMESPACE__   => __DIR__ . '/' . __NAMESPACE__,
                        'OpsWay\TocatUserTest' => ROOT_PATH . '/modules/OpsWay/TocatUser/tests/TocatUserTest',
                    ),
                ),
            )
        );
    }

    /**
     * @param object $entity
     * @param int    $id
     *
     * @return object
     */
    public static function setIdToEntity(&$entity, $id)
    {
        $reflector = new \ReflectionObject($entity);
        $idProperty = $reflector->getProperty('id');
        $idProperty->setAccessible(true);
        $idProperty->setValue($entity, $id);

        return $entity;
    }
}

Bootstrap::init();
