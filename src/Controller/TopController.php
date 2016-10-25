<?php

/* 
 * Top page
 */

namespace App\Controller;

class TopController extends AppController {
    
    /**
     * Top page
     */
    public function index() {
        include ('Bus/Top/index.php');
    }
    
}
