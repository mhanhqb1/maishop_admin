<?php

namespace App\Controller;

/**
 * Show info
 */
class InfosController extends AppController {
    
    public function beforeRender(Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->layout('empty');
    }
    
    public function index() {
        phpinfo();
        exit;
    }
    
    public function cakephp() {
        
    }
    
    public function pc() {
        
    }
}
