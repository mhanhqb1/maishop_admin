<?php

/* 
 * Products page
 */

namespace App\Controller;

class ProductsController extends AppController {
    
    /**
     * Products list page
     */
    public function index() {
        include ('Bus/Products/index.php');
    }
    
    /**
     * Products detail page
     */
    public function detail($id = '') {
        include ('Bus/Products/detail.php');
    }
    
    /**
     * Products update page
     */
    public function update($id = '') {
        include ('Bus/Products/update.php');
    }
    
}
