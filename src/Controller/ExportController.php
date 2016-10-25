<?php

/* 
 * Export page
 */

namespace App\Controller;

class ExportController extends AppController {
    
    /**
     * Export Order page
     */
    public function index() {
        include ('Bus/Export/index.php');
    }
    
}
