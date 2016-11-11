<?php

/* 
 * Orders page
 */

namespace App\Controller;

class OrdersController extends AppController {
    
    /**
     * Orders list page
     */
    public function index() {
        include ('Bus/Orders/index.php');
    }
    
    /**
     * Orders detail page
     */
    public function detail($id = '') {
        include ('Bus/Orders/detail.php');
    }
    
    /**
     * Orders update page
     */
    public function update($id = '') {
        include ('Bus/Orders/update.php');
    }
    
}
