<?php
namespace Theme\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ThemeInvokable implements ServiceLocatorAwareInterface
{
    private $serviceLocator;
    /**
     * The name of the current theme
     * @var unknown
     */
    private $name = 'default';

    private $loaded = false;

    public function load()
    {
        if ($this->loaded) {
            return;
        }

        $storage = $this->serviceLocator->get('theme-storage');
        $name = $storage->get();
        if (!$name) {
            return true;
        }

        $config = $this->serviceLocator->get('config');
        if (!isset($config['themes'][$name])) {
            return;
        }

        $this->name = $name;
    }

    public function setName($name)
    {
        $config = $this->serviceLocator->get('config');
        if (!isset($config['themes'][$name])) {
            throw new \Exception('Invalid Theme Specified');
        }
        $this->name = $name;
        $storage = $this->serviceLocator->get('theme-storage');
        $storage->set($name);
    }

    public function getName()
    {
        $this->load();

        return $this->name;
    }

    public function getConfig()
    {
        $this->load();
        $config = $this->serviceLocator->get('config');

        return $config['themes'];
    }

    /* (non-PHPdoc)
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /* (non-PHPdoc)
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;

    }

}
