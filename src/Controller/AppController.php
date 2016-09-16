<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\I18n\I18n;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /** @var object $controller Controller name. */
    public $controller = null;

    /** @var object $action Action name. */
    public $action = null;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');
        $this->loadComponent('Breadcrumb');
        $this->loadComponent('SimpleForm');
        $this->loadComponent('SearchForm');
        $this->loadComponent('UpdateForm');
        $this->loadComponent('SimpleTable');
        list($lang, $languageType) = $this->getCurrentLanguage();
        I18n::locale($lang);
        $this->set('lang', $lang);
        Configure::write('Config.LanguageType', $languageType);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        parent::beforeFilter($event);
        
        // Redirect https
        if (Configure::read('Config.HTTPS') === true) {
            if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == "http") {
                return $this->redirect('https://' . env('SERVER_NAME') . $this->here);
            } elseif (!isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 80) {
                return $this->redirect('https://' . env('SERVER_NAME') . $this->here);
            }
        }
        // Show breadcrumb
        if (!empty($this->Breadcrumb->get())) {
            $this->set('breadcrumbTitle', $this->Breadcrumb->getTitle());
            $this->set('breadcrumb', $this->Breadcrumb->get());
        }
        // Show html form, table
        if (!empty($this->SearchForm->get())) {
            $this->set('searchForm', $this->SearchForm->get());
        }
        if (!empty($this->UpdateForm->get())) {
            $this->set('updateForm', $this->UpdateForm->get());
        }
        if (!empty($this->SimpleTable->get())) {
            $this->set('table', $this->SimpleTable->get());
        }
        
        // Set common param
        $this->controller = strtolower($this->request->params['controller']);
        $this->action = strtolower($this->request->params['action']);
        $this->set('controller', $this->controller);
        $this->set('action', $this->action);
        
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
        $this->set('page', $this->request->query('page', 1));
        
        $this->viewBuilder()->layout('maishop');
    }
    
    /**
     * get current language
     *
     * @param none.
     * @return string
     */
    public function getCurrentLanguage() {
        if (isset($this->request->query['lang'])) {
            $language = $this->request->query['lang'];
        } else {
            if ($this->Cookie->check(COOKIE_LANGUAGE)) {
                $language = $this->Cookie->read(COOKIE_LANGUAGE);
            } else {
                $language = 'vi';
            }
        }
        list($language, $languageType) = $this->validateLang($language);
        $this->Cookie->write(COOKIE_LANGUAGE, $language);
        return array($language, $languageType);
    }
    
    /**
     * Check valid language
     * @param string $language
     * @param int return 2 or 3 digit
     * @return string
     */
    protected function validateLang($lang) {
        $languages = Configure::read('Config.Languages');
        $data = array('vi', 1);
        if (array_key_exists($lang, $languages)) {
            $data = array($lang, $languages[$lang]);
        }
        return $data;
    }
}
