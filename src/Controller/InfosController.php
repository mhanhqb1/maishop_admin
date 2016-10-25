<?php

namespace App\Controller;

use Cake\Event\Event;

/**
 * Show info
 */
class InfosController extends AppController {
    
    /**
     * Before filter event
     * @param Event $event
     */
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }
    
    public function beforeRender(Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->layout('empty');
    }
    
    public function index() {
        include_once CONFIG . 'auth.php';
        phpinfo();
        exit;
    }
    
    public function cakephp() {
        include_once CONFIG . 'auth.php';
    }
    
    public function clearcache() {
        include_once CONFIG . 'auth.php';
        
        // Delete language cache
        $files = glob(ROOT . '/tmp/cache/persistent/*'); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file)) {
                @unlink($file); // delete file
            }
        }
        
        echo 'Done';
        exit;
    }

}
