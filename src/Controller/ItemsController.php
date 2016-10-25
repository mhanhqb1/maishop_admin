<?php

/* 
 * Items page
 */

namespace App\Controller;

class ItemsController extends AppController {
    
    /**
     * Items list page
     */
    public function index() {
        include ('Bus/Items/index.php');
    }
    
    /**
     * Items detail page
     */
    public function detail($id = '') {
        include ('Bus/Items/detail.php');
    }
    
    /**
     * Itemsets update page
     */
    public function update($id = '') {
        include ('Bus/Items/update.php');
    }
    
}
