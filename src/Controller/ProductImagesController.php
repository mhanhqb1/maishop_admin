<?php

/* 
 * ProductImages page
 */

namespace App\Controller;

class ProductImagesController extends AppController {
    
    /**
     * ProductImages list page
     */
    public function index() {
        include ('Bus/ProductImages/index.php');
    }
    
    /**
     * ProductImages update page
     */
    public function update($id = '') {
        include ('Bus/ProductImages/update.php');
    }
    
}
