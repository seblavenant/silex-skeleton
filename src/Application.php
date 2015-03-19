<?php

namespace Assmat;

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Gaufrette\Filesystem;
use Gaufrette\Adapter\Local;
use Puzzle\Configuration;
use Silex\Provider\UrlGeneratorServiceProvider;


class Application extends \Silex\Application
{
    private
        $configuration;
        
    public function __construct()
    {
        parent::__construct();
        
        $this->loadConfiguration();
        $this->registerServiceProviders();
        $this->initializeDebugMode();
        $this->initializeServices();
        $this->mountProviders();
        $this->initializeErrorHandler();
    }
    
    private function loadConfiguration()
    {
        $fileSystem = new Filesystem(
            new Local(__DIR__ . '/../config')
        );
            
        $this->configuration = new Configuration\Yaml($fileSystem);
    }
    
    private function initializeDebugMode()
    {
        $this['debug'] = $this->configuration->readRequired('app/debug');
    }
    
    private function registerServiceProviders()
    {
        $this->register(new ServiceControllerServiceProvider());
        $this->register(new UrlGeneratorServiceProvider());
        
        $this->register(new TwigServiceProvider(), array(
            'twig.path' => __DIR__ . '/../views',
        ));
    }
    
    private function initializeServices()
    {

    }
    
    private function mountProviders()
    {
        $this->mount('/', new Controllers\Home\Provider());
    }

    private function initializeErrorHandler()
    {
        $this->error(function () {
            if(! $this['debug']) {
                return $this->redirect($this['url_generator']->generate('error'));
            }
        });
    }
}
