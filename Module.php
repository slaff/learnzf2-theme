<?php
namespace Theme;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
            // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $event)
    {
        $eventManager = $event->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_RENDER,array($this,'prepareTheme'),100);
    }

    public function prepareTheme(MvcEvent $event)
    {
        $services = $event->getApplication()->getServiceManager();
        $themes = $services->get('theme');
        $config = $services->get('config');

        // From our themes service we get the current theme that is set, if any
        $themeName = $themes->getName();
        if (!$themeName) {
               return;
        }

        $themeConfig = $themes->getConfig();
        $themeConfig = $themeConfig[$themeName];

        // !! Here Comes The Magic (R) !!

        // We override the template resolver
        // Here we add the changes that need to be applied to the existing template map
        if (isset($themeConfig['template_map'])) {
            $map = $services->get('ViewTemplateMapResolver');
            $map->merge($themeConfig['template_map']);
        }

        //  And we put our theme paths on top of the stack.
        //     This way if there is template in our theme it will be taken and used
        //     Otherwise we will use the ones provided earlier from the application
        if (isset($themeConfig['template_path_stack'])) {
            $stack = $services->get('ViewTemplatePathStack');
            $stack->addPaths($themeConfig['template_path_stack']);
        }
    }
}
