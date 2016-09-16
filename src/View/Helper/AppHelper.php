<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package View.Helper
 */
class AppHelper extends Helper {

    /** @var string $controller Controller name */
    public $controller;

    /**
     * Construct
     *     
     * @author thailvn   
     * @param object $view View class     
     * @return void 
     */
//    public function __construct(View $view, $settings = array()) {
//        parent::__construct($view, $settings);
//        $this->controller = $this->loadController();
//    }

    /**
     * Load a controller
     *     
     * @author thailvn   
     * @param string $name Controller name    
     * @return Object Controller 
     */
    protected function loadController($name = null) {
        if (is_null($name))
            $name = $this->params['controller'];
        $className = ucfirst($name) . 'Controller';
        list($plugin, $className) = pluginSplit($className, true);
        App::import('Controller', $name);
        $cont = new $className;
        $cont->constructClasses();
        $cont->request = $this->request;
        return $cont;
    }
    
    /**
     * Create Common component for helper
     *     
     * @author thailvn        
     * @return Object Common component 
     */
    public static function getCommonComponent() {
        return new CommonComponent(new ComponentCollection());
    }    
}
