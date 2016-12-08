<?php

/* 
 * Categories page
 */

namespace App\Controller;

class CategoriesController extends AppController {
    
    /**
     * Categories list page
     */
    public function index() {
        include ('Bus/Categories/index.php');
    }
    
    /**
     * Categories detail page
     */
    public function detail($id = '') {
        include ('Bus/Categories/detail.php');
    }
    
    /**
     * Categories update page
     */
    public function update($id = '') {
        include ('Bus/Categories/update.php');
    }
    
}
