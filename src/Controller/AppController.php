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
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        // Redirect https
        if (Configure::read('Config.HTTPS') === true) {
            if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == "http") {
                return $this->redirect('https://' . env('SERVER_NAME') . $this->here);
            } elseif (!isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 80) {
                return $this->redirect('https://' . env('SERVER_NAME') . $this->here);
            }
        }
        parent::beforeFilter($event);

        // Set common param
        $this->controller = strtolower($this->request->params['controller']);
        $this->action = strtolower($this->request->params['action']);
        $this->set('controller', $this->controller);
        $this->set('action', $this->action);

        // Only allow mobile access
        if (Configure::read('Config.SupportPC') != true && !$this->RequestHandler->isMobile() && $this->controller != 'infos') {
            return $this->redirect('/pc');
        } else if (Configure::read('Config.SupportPC') != true && $this->RequestHandler->isMobile() && $this->controller == 'infos' && $this->action == 'pc') {
            return $this->redirect('/');
        }
        
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
        
        $this->viewBuilder()->layout('maishop');
    }
}
