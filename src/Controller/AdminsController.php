<?php

/* 
 * Admin page
 */

namespace App\Controller;

class AdminsController extends AppController {
    
    /**
     * Admin list page
     */
    public function index() {
        include ('Bus/Admins/index.php');
    }
    
    /**
     * Admin update page
     */
    public function detail($id = '') {
        include ('Bus/Admins/detail.php');
    }
    
    /**
     * Admin update page
     */
    public function update($id = '') {
        include ('Bus/Admins/update.php');
    }
    
    /**
     * Admin change password
     */
    public function password($id = '') {
        include ('Bus/Admins/password.php');
    }
    
}
