<?php

/* 
 * Itemsets page
 */

namespace App\Controller;

class ItemsetsController extends AppController {
    
    /**
     * Itemsets list page
     */
    public function index() {
        include ('Bus/Itemsets/index.php');
    }
    
    /**
     * Itemsets detail page
     */
    public function detail($id = '') {
        include ('Bus/Itemsets/detail.php');
    }
    
    /**
     * Itemsets update page
     */
    public function update($id = '') {
        include ('Bus/Itemsets/update.php');
    }
    
}
