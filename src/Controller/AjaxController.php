<?php

/* 
 * Ajax process
 */

namespace App\Controller;

class AjaxController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->autoRender = false;
    }
    
    /**
     * Disable action
     */
    public function disable() {
        include ('Bus/Ajax/disable.php');
    }
    
    /**
     * Autocomplete products
     */
    public function autocompleteproduct() {
        include ('Bus/Ajax/autocompleteproduct.php');
    }
    
}
